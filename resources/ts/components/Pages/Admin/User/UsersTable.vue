<script setup lang="ts">
import * as Yup from "yup"
import dayjs from "dayjs"
import axios from "axios"
import AdminLayout from "@/components/Layouts/AdminLayout.vue"
defineLayout(AdminLayout)

const headers = ref([
	{ title: "ID", key: "id", align: "end" },
	{ title: "Full Name", key: "name", align: "center" },
	{ title: "Email", key: "email", align: "start" },
	{ title: "Role", key: "role", align: "end" },
	{ title: "Actions", key: "actions", align: "center", sortable: false },
])

const roleEnums = ref({})

async function fetchRoleEnums() {
	const response = await axios.get(route("api.roles.enums"))
	roleEnums.value = response.data
	console.log("ROLES", roleEnums.value)
}
onBeforeMount(fetchRoleEnums)

const fields = ref([
	{
		label: "Name",
		name: "name",
		as: "input",
		rules: Yup.string().required(),
	},
	{
		label: "Email",
		name: "email",
		as: "input",
		rules: Yup.string().required(),
	},
	{
		label: "Role",
		name: "role",
		as: "select",
		options: roleEnums,
		rules: Yup.string().required(),
	},
])
const roleMappings = {
	admin: { color: "#673AB7", icon: "mdi-account-cog" },
	user: { color: "#FFC107", icon: "mdi-account" },
	mechanic: { color: "#228B22", icon: "mdi-account-convert" },
	instructor: { color: "#DC143C", icon: "mdi-account-question" },
	reseller: { color: "#4169E1", icon: "mdi-account-check" },
}
</script>

<template>
	<DataServerSide
		:headers="headers"
		:fields="fields"
		table="users"
		api="api.users"
		singular="User">
		<template #item.name="{ item }">
			<div class="flex items-center">
				<div class="avatar placeholder">
					<div class="w-8 rounded-full ring ring-accent bg-secondary ring-offset-base-100 ring-offset">
						<!-- <img
							src=""
							alt="Avatar" /> -->
						<span class="text-xl">{{ item.name.substring(0, 2) }}</span>
					</div>
				</div>
				<div class="ml-3">{{ item.name }}</div>
			</div>
		</template>
		<template #item.role="{ item }">
			<v-chip
				variant="flat"
				:color="roleMappings[item.role]?.color || 'default'"
				label>
				<v-icon left>{{ roleMappings[item.role]?.icon }}</v-icon>
				{{ item.role }}
			</v-chip>
		</template>
	</DataServerSide>
</template>
