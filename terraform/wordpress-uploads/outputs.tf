output "assets_storage_account" {
  value = {
		name = azurerm_storage_account.assets.name
		location = azurerm_storage_account.assets.location
	}
}
