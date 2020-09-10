# Wordpress on Azure

[![Build Status](https://dev.azure.com/julie-msft/public-demos/_apis/build/status/wordpress-on-azure%20(docker%20image)?branchName=main)](https://dev.azure.com/julie-msft/public-demos/_build/latest?definitionId=18&branchName=main)

A Reference Architecture and Demo for Wordpress on Azure - at cloud native scale

## Architecture

Cloud Native applications separate state from their application, which means your media files should _not_ be on what the app thinks is a file system. That means **_there is no uploads folder_**. Instead we will use "Storage as a Service" with Azure Blob Storage.

![Azure Architecture](./diagrams/azure-architecture.svg)

### Microsoft Azure Storage for WordPress Plugin 

Using the [Microsoft Azure Storage for WordPress](https://wordpress.org/plugins/windows-azure-storage/#installation) plugin, we can implement this architecture with minimal effort. No code require, just plugin installation and configuration.

### Disadvantages of using File System

Out of the box, Wordpress puts uploaded files into `wp-content/uploads`, on the file system, which fine for testing and small webistes. However, file systems do not scale infinitely. You can mount additional storage, for example file shares and with path mappings to avoid architecture and software changes.

- **Performance**  
  However this only hides the underlying problem - file share performance issues, most commonly IO and latency. Increasing disk size and swapping spinning disks for SSD does not scale infinitely.

- **Site Backups**  
  When your media files sit on the file system, how do you plan on backing up something that massive? You need to separate your wordpress code, your customizations, e.g. themes, which can be version controlled. Backups can also become bloated, affecting your Recovery Time Objective (RTO) in event of failure.

### Advantages of Storage as a Service

There is no file system. Instead the application interfaces with an API over HTTP, with the many advantages, including:

- **Infinite Scale**  
  HTTP is cloud scale and web applications have tried and true patterns for handling large scale workloads. For example, if you want to upload a multi Gigabyte video, with HTTP APIs, you can split the data into smaller chunks using multiple HTTP calls that let's you recover from failure, pause uploads and more. Can your file system do that? 

- **Focus on your app, not infrastructure**  
  Like any managed service, Blob Storage does one thing and does it well. Why worry about backups, when you can get redundency out of the box?

and much more! 

## Demo - How to Use

### Why Docker?

Before we start, let's be clear that this reference architecture uses [Official Wordpress Docker Image](https://hub.docker.com/_/wordpress) in a container for convenience. You can also use the [App Service PHP runtime](https://docs.microsoft.com/en-us/azure/app-service/quickstart-php?pivots=platform-linux#push-to-azure-from-git). For this demo, we want to focus on architecure, not managing PHP files.


So our [`Dockerfile`](./Dockerfile) is short and simple:

```docker
FROM wordpress:5.5

# PHP Configuration, e.g. max upload size, etc.
COPY ./uploads.ini /usr/local/etc/php/conf.d/uploads.ini

# Pre-install Azure Storage Plugin
COPY ./wp-plugins/windows-azure-storage /var/www/html/wp-content/plugins/windows-azure-storage
```

#### Mounting Themes and Plugins

Per [official documentation on Docker Hub](https://hub.docker.com/_/wordpress), we can customize the docker image like so:

- Themes go in a subdirectory in `/var/www/html/wp-content/themes/`
- Plugins go in a subdirectory in `/var/www/html/wp-content/plugins/`


### Step 1 - Create Azure Infrastructure with Terraform

As of 9 Sept 2020, the Terraform script will generate _pretty much_ all of the Azure infrastructure you need. But the Wordpress configuration is not yet fully automated.

Terraform TODO: 

- [ ] Update container name (configured it differently in portal)
- [ ] Document Terraform steps
- [ ] Automatically configure storage account setup in App Service (currently done by hand)

### 1) Create Custom Docker Image

The initial app service loads _a copy_ of the official Docker image. For our demo, we create a custom image preloaded with the  need to publish the custom image with [Microsoft Azure Storage for WordPress](https://wordpress.org/plugins/windows-azure-storage/#installation) plugin.

### 2) Push into Azure Container Registry

To get this image into the registry
- build and push from local computer
- run included Azure DevOps pipeline _after_ having 
  - configured required service connections to the 
    - Azure Resource Group, named it `ado-arm-connection`
    - Azure Container Registry, named `ado-acr-connection`
  - replaced YAML values with your terraform generated resource names, e.g.


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
