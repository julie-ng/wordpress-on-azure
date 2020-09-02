# wordpress-on-azure

This uses official Wordpress image from

[https://hub.docker.com/_/wordpress](https://hub.docker.com/_/wordpress)


### Mounting Themes and Plugins

- Themes go in a subdirectory in `/var/www/html/wp-content/themes/`
- Plugins go in a subdirectory in `/var/www/html/wp-content/plugins/`


# CI/CD - Create a Service Principal

### 1. Set subscription ID 

We never save identifiers in git. 

```
export=AZ_SUBSCRIPTION_ID=00000000-0000-0000-0000-000000000000
```

### 2. Create Service princiapl and RBAC role assignment

Note: must be done _AFTER_ terraform resources have been created b/c we are scoping service principal to a resource group. 

There are 2 ways to do this

#### Makefile (recommended)

There is a `Makefile`

- to get resource group name dynamically since we are appending random suffix to name
- also has a `reset-scope` to target so we can re-use the service principal in case we run `terraform destroy`

```
make create-sp-for-rbac
```

#### via Azure CLI

What the Makefile is doing, but filling in values for you

```
az ad sp create-for-rbac --name wordpress-demo-sp-rbac \
		--role contributor \
		--scopes /subscriptions/00000000-0000-0000-0000-000000000000/resourceGroups/wordpress-k8jul-rg \
		--sdk-auth
```

### Example Output

Note: Secrets and identifies have been _redacted_.

```
Changing "wordpress-demo-sp-rbac" to a valid URI of "http://wordpress-demo-sp-rbac", which is the required format used for service principal names
Creating a role assignment under the scope of "/subscriptions/00000000-0000-0000-0000-000000000000/resourceGroups/wordpress-k8jul-rg"
  Retrying role assignment creation: 1/36
  Retrying role assignment creation: 2/36
  Retrying role assignment creation: 3/36
  Retrying role assignment creation: 4/36
{
  "clientId": "*****",
  "clientSecret": "*****",
  "subscriptionId": "00000000-0000-0000-0000-000000000000",
  "tenantId": "00000000-0000-0000-0000-000000000000",
  "activeDirectoryEndpointUrl": "https://login.microsoftonline.com",
  "resourceManagerEndpointUrl": "https://management.azure.com/",
  "activeDirectoryGraphResourceId": "https://graph.windows.net/",
  "sqlManagementEndpointUrl": "https://management.core.windows.net:8443/",
  "galleryEndpointUrl": "https://gallery.azure.com/",
  "managementEndpointUrl": "https://management.core.windows.net/"
}
```

### 3. Add Service Principal

Now you can add those credentials as a _**manual**_ service connection in Azure DevOps, where SP id and secret correspond to `client` above.