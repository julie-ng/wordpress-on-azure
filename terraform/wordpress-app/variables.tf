variable "name" {
  type				= string
  description = "Base name, i.e. prefix of azure resources"
}

variable "location" {
  type				= string
  description	= "Azure Region for resources. Defaults to North Europe."
  default			= "northeurope"
}

variable "docker_image" {
	type 				= string
	description = "Docker repository name with tag, e.g. wordpress:dev"
	default     = "wordpress:dev"
}

variable "tags" {
  type    = map(string)
  default = {
    public = "true"
		demo   = "true"
		oss    = "wordpress"
  }
}

# App Service

variable "appservice_plan_tier" {
  type    = string
  default = "Basic"
}

variable "appservice_plan_size" {
  type    = string
  default = "B1"
}

# Database (for testing only!)

variable "mysql_admin_user" {
	type    = string
	default = "mysqladminun"
}

variable "default_wordpress_image" {
	type    = string
	default = "wordpress:5.5"
}

variable "acr_sku" {
  type        = string
  description = "Azure Container Registry SKU. Defaults to 'Standard'"
  default     = "Standard"
}

# Variables

locals {
  name 					 = lower(var.name)
	name_flattened = replace(var.name, "-", "")
}