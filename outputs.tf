output "resource_group" {
  value = module.demo.resource_group
}

output "app_service" {
  value = module.demo.app_service
}

output "azure_container_registry" {
  value = module.demo.azure_container_registry
}

output "assets_storage_account" {
  value = module.demo.assets_storage_account
}

# Output - for SP setup

output "resource_group_id" {
  value = module.demo.resource_group.id
}
