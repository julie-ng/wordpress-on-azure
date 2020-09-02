.EXPORT_ALL_VARIABLES:

AZ_SP_NAME=wordpress-demo-sp-rbac
AZ_RESOURCE_GROUP=$(shell terraform output resource_group_id)

# Export this in your parent shell
# AZ_SUBSCRIPTION_ID=00000000-0000-0000-0000-000000000000

create-sp-for-rbac:
	az ad sp create-for-rbac --name ${AZ_SP_NAME} \
		--role contributor \
		--scopes ${AZ_RESOURCE_GROUP} \
		--sdk-auth

set-roles:
	az role assignment create \
		--assignee http://${AZ_SP_NAME} \
		--role contributor \
		--scope ${AZ_RESOURCE_GROUP}

# Use after `terraform destroy`
reset-roles:
	az role assignment delete \
		--assignee http://${AZ_SP_NAME} \
		--scope ${AZ_RESOURCE_GROUP}