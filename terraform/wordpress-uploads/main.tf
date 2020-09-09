# Azure Storage Account
# ---------------------

resource "azurerm_storage_account" "assets" {
  name                     = "${local.name_flattened}static"
  resource_group_name      = var.resource_group
  location                 = var.location
  account_tier             = "Standard"
  account_replication_type = "LRS"
  allow_blob_public_access = true
  tags                     = var.tags
}

resource "azurerm_storage_container" "assets" {
  name                  = "assets"
  storage_account_name  = azurerm_storage_account.assets.name
  container_access_type = "blob" # anonymous read access for blobs
}


# Azure CDN
# ---------

resource "azurerm_cdn_profile" "assets" {
  name                = "${var.name}-cdn"
  location            = var.location
  resource_group_name = var.resource_group
  sku                 = var.cdn_sku
	tags                = var.tags
}

resource "azurerm_cdn_endpoint" "assets" {
  name                      = var.name
  location                  = var.location
  resource_group_name       = var.resource_group
  profile_name              = azurerm_cdn_profile.assets.name
	tags                      = var.tags
  origin_host_header        = azurerm_storage_account.assets.primary_blob_host
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
    name      = "${var.name}-assets"
    host_name = azurerm_storage_account.assets.primary_blob_host
  }
}
