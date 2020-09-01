provider "azurerm" {
  version = "=2.23.0"
  features {}
}

terraform {
  backend "azurerm" {
  }
}

data "azurerm_client_config" "current" {}
