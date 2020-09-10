output "resource_group" {
  value = module.app.resource_group
}

output "app_service" {
  value = module.app.app_service
}

output "uploads_storage_account" {
  value = module.app.uploads_storage_account
}

output "uploads_cdn_enpoint" {
  value = module.app.uploads_cdn_enpoint
}

# Output - for SP setup

output "resource_group_id" {
  value = module.app.resource_group.id
}
