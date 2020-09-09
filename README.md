# wordpress-on-azure

[![Build Status](https://dev.azure.com/julie-msft/public-demos/_apis/build/status/wordpress-on-azure%20(docker%20image)?branchName=main)](https://dev.azure.com/julie-msft/public-demos/_build/latest?definitionId=18&branchName=main)

## Azure Architecture

TODO: add diagram

## Setup

### 1) Create Azure Infrastructure with Terraform

As of 9 Sept 2020, the Terraform script will generate _pretty much_ all of the Azure infrastructure you need. But the Wordpress configuration is not yet fully automated.

Terraform TODO: 

- [ ] Update container name (configured it differently in portal)
- [ ] Document Terraform steps
- [ ] Automatically configure storage account setup in App Service (currently done by hand)

### 1) Create Custom Docker Image

The initial app service loads _a copy_ of the official Docker image. For our demo, we create a custom image preloaded with the  need to publish the custom image with [Microsoft Azure Storage for WordPress](https://wordpress.org/plugins/windows-azure-storage/#installation) plugin.

#### 2) Push into Azure Container Registry

To get this image into the registry
- build and push from local computer
- run included Azure DevOps pipeline _after_ having 
  - configured required service connections to the 
    - Azure Resource Group, named it `ado-arm-connection`
    - Azure Container Registry, named `ado-acr-connection`
  - replaced YAML values with your terraform generated resource names, e.g.


#### Why Docker?

To avoid having to constantly uploading all the PHP files with every Wordpress release, this demo uses official Wordpress image from [Official Docker Registry](https://hub.docker.com/_/wordpress)

And upgrades are done in the [`Dockerfile`](./Dockerfile)

```
FROM wordpress:5.5
```

#### Mounting Themes and Plugins

Per [official Wordpress documentation]([Official Docker Registry](https://hub.docker.com/_/wordpress)), we can customize the image like so:

- Themes go in a subdirectory in `/var/www/html/wp-content/themes/`
- Plugins go in a subdirectory in `/var/www/html/wp-content/plugins/`

### 3) Configure Wordpress App (in Browser)

- Visit your Admin Panel
- Under "Plugins", enable [Microsoft Azure Storage for WordPress](https://wordpress.org/plugins/windows-azure-storage/#installation) plugin, which is pre-installed in this demo's Docker image.
- Under "Settings" > "Microsoft Azure" fill in the following settings:
  - Credentials for Azure Storage Account
    - Storage Account Name, e.g. `wordpressagr5kstatic`
    - Storage Account Access Key
    - Blob Storage Continer Name, e.g. `wordpress` 
  - CDN for Azure Storage Account, e.g. `https://wordpress-agr5k.azureedge.net`

Note: all these resources are created by [Terraform](https://www.terraform.io/) and you can get the values in Azure Portal after infrastructure is created.
