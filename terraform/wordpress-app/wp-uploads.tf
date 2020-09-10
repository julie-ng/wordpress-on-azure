# Additional Infrastructure Required for Azure Storage Plugin
# -----------------------------------------------------------

# Azure Storage Account

resource "azurerm_storage_account" "uploads" {
  name                     = "${local.name_flattened}uploads"
  resource_group_name      = azurerm_resource_group.wordpress.name
  location                 = azurerm_resource_group.wordpress.location
  account_tier             = var.storage_account_tier
  account_replication_type = var.storage_account_replication
  allow_blob_public_access = true # Allow public access
  tags                     = var.tags
}

resource "azurerm_storage_container" "uploads" {
  name                  = var.storage_container_name
  storage_account_name  = azurerm_storage_account.uploads.name
  container_access_type = "blob" # enable Anonymous read access for blobs
}

# Azure CDN
# ---------

resource "azurerm_cdn_profile" "uploads" {
  name                = "${var.name}-cdn"
  location            = azurerm_resource_group.wordpress.location
  resource_group_name = azurerm_resource_group.wordpress.name
  sku                 = var.cdn_sku
  tags                = var.tags
}

resource "azurerm_cdn_endpoint" "uploads" {
  name                      = var.name
  location                  = azurerm_resource_group.wordpress.location
  resource_group_name       = azurerm_resource_group.wordpress.name
  profile_name              = azurerm_cdn_profile.uploads.name
  tags                      = var.tags
  origin_host_header        = azurerm_storage_account.uploads.primary_blob_host
  is_compression_enabled    = true
  content_types_to_compress = [
    "text/plain",
    "text/css",
    "text/javascript",
    "application/x-javascript",
    "application/javascript",
    "application/json",
    "image/jpeg",
    "image/png"
  ]

  origin {
    name      = "${var.name}-uploads"
    host_name = azurerm_storage_account.uploads.primary_blob_host
  }
}
