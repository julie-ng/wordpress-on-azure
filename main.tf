# Resource Suffix
# ---------------
# Use suffix because some Azure resources, Azure Container Registry
# and Storage Accounts must be globally unique

resource "random_string" "suffix" {
  length  = 5
  special = false
  upper   = false
}

locals {
  suffix = random_string.suffix.result
}

# Wordpress App
# -------------

module "app" {
  source = "./terraform/wordpress-app"
  name   = "wordpress-${local.suffix}"
}

# To better explain how to achieve a cloud native Wordpress setup,
# we separate out the required additional effort: object storage for
# uploads, i.e. Azure Blob Storage and the CDN for even more performance

module "uploads" {
  source         = "./terraform/wordpress-uploads"
  name           = "wordpress-${local.suffix}"
  resource_group = module.app.resource_group.name
  location       = module.app.resource_group.location
}
