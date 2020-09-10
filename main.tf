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
