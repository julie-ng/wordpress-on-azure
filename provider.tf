provider "azurerm" {
  version = "=2.26.0"
  features {}
}

terraform {
}

data "azurerm_client_config" "current" {}
