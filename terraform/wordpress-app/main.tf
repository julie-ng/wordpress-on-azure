# Resource Group
# --------------

resource "azurerm_resource_group" "wordpress" {
  name     = "${local.name}-rg"
  location = var.location
  tags     = var.tags
}

# Azure Container Registry
# ------------------------

resource "azurerm_container_registry" "acr" {
  name                     = local.name_flattened
  resource_group_name      = azurerm_resource_group.wordpress.name
  location                 = azurerm_resource_group.wordpress.location
  sku                      = var.acr_sku
  admin_enabled            = true
  tags                     = var.tags
}

resource "null_resource" "copy_wordpress_image" {
  triggers = {
    acr = azurerm_container_registry.acr.id
  }

  provisioner "local-exec" {
    environment = {
      ACR_FQDN     = azurerm_container_registry.acr.login_server
      ACR_NAME     = azurerm_container_registry.acr.name
      ACR_USERNAME = azurerm_container_registry.acr.admin_username
      ACR_PASSWORD = azurerm_container_registry.acr.admin_password
      WP_IMAGE     = var.default_wordpress_image
    }

    command = <<EOT
      az acr login \
        --name $ACR_NAME \
        --username $ACR_USERNAME \
        --password $ACR_PASSWORD
      docker pull $WP_IMAGE
      docker tag $WP_IMAGE $ACR_FQDN/$WP_IMAGE
      docker push $ACR_FQDN/$WP_IMAGE
      docker logout
    EOT
  }
}


# App Service
# -----------

resource "azurerm_app_service_plan" "plan" {
  name                = "${var.name}-apps-plan"
  location            = azurerm_resource_group.wordpress.location
  resource_group_name = azurerm_resource_group.wordpress.name
  tags                = var.tags
  kind                = "Linux"
  reserved            = true # must be true for Linux

  sku {
    tier = var.appservice_plan_tier
    size = var.appservice_plan_size
  }
}


resource "azurerm_app_service" "app" {
  name                    = "${var.name}-app"
  location                = azurerm_resource_group.wordpress.location
  resource_group_name     = azurerm_resource_group.wordpress.name
  app_service_plan_id     = azurerm_app_service_plan.plan.id
  https_only              = true
  client_affinity_enabled = false
  tags                		= var.tags

  # N.B. because this is a key vault pair, secrets here end up in logs (not good for CI/CD pipelines)
  app_settings = {
    "DOCKER_REGISTRY_SERVER_URL"             = "https://${azurerm_container_registry.acr.login_server}"
    "DOCKER_REGISTRY_SERVER_USERNAME"        = azurerm_container_registry.acr.admin_username
    "DOCKER_REGISTRY_SERVER_PASSWORD"        = azurerm_container_registry.acr.admin_password
    "WEBSITES_ENABLE_APP_SERVICE_STORAGE"    = "false"
    "WORDPRESS_DB_HOST"                      = azurerm_mysql_server.wordpress.fqdn
    "WORDPRESS_DB_NAME"                      = azurerm_mysql_database.wordpress.name
    "WORDPRESS_DB_USER"                      = var.mysql_admin_user
    "WORDPRESS_DB_PASSWORD"                  = random_password.mysql.result
    "DOCKER_ENABLE_CI"                       = "true"
    "MICROSOFT_AZURE_ACCOUNT_NAME"           = azurerm_storage_account.uploads.name
    "MICROSOFT_AZURE_ACCOUNT_KEY"            = azurerm_storage_account.uploads.primary_access_key
    "MICROSOFT_AZURE_CONTAINER"              = var.storage_container_name
    "MICROSOFT_AZURE_CNAME"                  = "https://${azurerm_cdn_endpoint.uploads.name}.azureedge.net"
    "MICROSOFT_AZURE_USE_FOR_DEFAULT_UPLOAD" = "true"
  }

  site_config {
    always_on        = true
    min_tls_version  = 1.2
    ftps_state       = "Disabled"
    linux_fx_version = "DOCKER|${var.default_wordpress_image}"
  }

  logs {
    # TODO
    # application_logs {}

    http_logs {
      file_system {
        retention_in_days = 90
        retention_in_mb   = 50
      }
    }
  }
}

# MySQL Database
# --------------

resource "random_password" "mysql" {
  length           = 64
  special          = false
}

resource "azurerm_mysql_server" "wordpress" {
  name                = "${var.name}-mysqlserver"
  location            = azurerm_resource_group.wordpress.location
  resource_group_name = azurerm_resource_group.wordpress.name
  tags                = var.tags

  administrator_login          = var.mysql_admin_user
  administrator_login_password = random_password.mysql.result

  sku_name   = "B_Gen5_1" # cheapest
  storage_mb = 5120 # smallest
  version    = "5.7"

  auto_grow_enabled                 = true
  backup_retention_days             = 7
  geo_redundant_backup_enabled      = false
  public_network_access_enabled     = true # for demo
  ssl_enforcement_enabled           = false # TODO
  ssl_minimal_tls_version_enforced  = "TLSEnforcementDisabled" # "TLS1_2"
}

resource "azurerm_mysql_database" "wordpress" {
  name                = "${var.name}-db"
  resource_group_name = azurerm_resource_group.wordpress.name
  server_name         = azurerm_mysql_server.wordpress.name
  charset             = "utf8"
  collation           = "utf8_unicode_ci"
}

resource "azurerm_mysql_firewall_rule" "azure" {
  name                = "public-internet"
  resource_group_name = azurerm_resource_group.wordpress.name
  server_name         = azurerm_mysql_server.wordpress.name
  start_ip_address    = "0.0.0.0"
  end_ip_address      = "255.255.255.255"
}
