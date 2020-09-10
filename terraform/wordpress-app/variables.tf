variable "name" {
  type				= string
  description = "Base name, i.e. prefix of azure resources"
}

variable "location" {
  type				= string
  description	= "Azure Region for resources. Defaults to North Europe."
  default			= "northeurope"
}

variable "wordpress_image" {
  type 				= string
  description = "Docker repository name with tag, e.g. Defaults to onazureio/wordpress:5.5"
  default     = "onazureio/wordpress:5.5"
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

# Uploads

variable "storage_container_name" {
  type        = string
  description = "Name of Blob Storage container to use. Defaults to 'wordpress'"
  default     = "wordpress"
}

variable "storage_account_tier" {
  type        = string
  description = "Azure Storage Account Pricing Tier. Defaults to 'Standard'"
  default     = "Standard"
}


variable "storage_account_replication" {
  type        = string
  description = "Azure Storage Account Replication Setting. Defaults to 'LRS' for locally redundant storage"
  default     = "LRS"
}

variable "cdn_sku" {
  type 	  = string
  description = "CDN SKU. Defaults to 'Standard_Microsoft'"
  default = "Standard_Microsoft"
}

# Variables

locals {
  name 					 = lower(var.name)
  name_flattened = replace(var.name, "-", "")
}