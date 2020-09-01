resource "random_string" "suffix" {
  length  = 5
  special = false
  upper   = false
}

module "demo" {
  source = "./terraform/wordpress"
  name   = "wordpress-${random_string.suffix.result}"
}

# output "demo" {
#   value = {
#   }
# }
