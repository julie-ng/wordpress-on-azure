variable "name" {
  type				= string
  description = "Base name, i.e. prefix of azure resources"
}

variable "resource_group" {
  type				= string
  description	= "Resource Group where other wordpress components are installed."
}

variable "location" {
  type				= string
  description	= "Azure Region for resources. Defaults to North Europe."
  default			= "northeurope"
}

variable "tags" {
  type    = map(string)
  default = {
    public = "true"
		demo   = "true"
		oss    = "wordpress"
  }
}

# CDN

variable "cdn_sku" {
	type 	  = string
	default = "Standard_Microsoft"
}

# Variables

locals {
  name 					 = lower(var.name)
	name_flattened = replace(var.name, "-", "")
}