output "resource_group" {
  value = module.app.resource_group
}

output "app_service" {
  value = module.app.app_service
}

output "azure_container_registry" {
  value = module.app.azure_container_registry
}

output "assets_storage_account" {
  value = module.app.assets_storage_account
}

# Output - for SP setup

output "resource_group_id" {
  value = module.app.resource_group.id
}
