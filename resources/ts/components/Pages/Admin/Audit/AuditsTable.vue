<script setup lang="ts">
import * as Yup from "yup"
import dayjs from "dayjs"
import AdminLayout from "@/components/Layouts/AdminLayout.vue"
import { XCircleIcon } from "@heroicons/vue/24/solid"
defineLayout(AdminLayout)

const headers = ref([
	{ title: "ID", key: "id", align: "end" },
	{ title: "Type", key: "auditable_type", align: "end" },
	{ title: "Type ID", key: "auditable_id", align: "end" },
	{ title: "Event", key: "event", align: "end" },
	{ title: "Old Values", key: "old_values", align: "end" },
	{ title: "New Values", key: "new_values", align: "end" },
])

const fields = ref([])

const dialog = ref(false)
const selectedRowJson = ref({})

const openDialog = (row) => {
	selectedRowJson.value = JSON.stringify(row, null, 2) // Convert the row data to a formatted JSON string
	dialog.value = true
}

const closeDialog = () => {
	dialog.value = false
}

const showType = (item) => {
	return item.replace("App\\Models\\", "")
}

const getColor = (event) => {
	switch (event) {
		case "created":
			return "green"
		case "updated":
			return "yellow"
		case "deleted":
			return "red"
		default:
			return "gray"
	}
}
</script>

<template>
	<v-dialog
		v-model="dialog"
		max-width="500px">
		<v-card class="rounded">
			<v-card-text>
				<pre class="json-display">{{ selectedRowJson }}</pre>
			</v-card-text>
			<v-card-actions class="justify-end">
				<button
					class="btn btn-error text-white"
					@click="closeDialog">
					<XCircleIcon class="h-6 w-6 text-white" />
					Cancel
				</button>
			</v-card-actions>
		</v-card>
	</v-dialog>
	<DataServerSide
		:headers="headers"
		:fields="fields"
		table="audits"
		api="api.audits"
		singular="Audit">
		<template #item.auditable_type="{ item }">
			{{ showType(item.auditable_type) }}
		</template>
		<template #item.event="{ item }">
			<v-chip
				:color="getColor(item.event)"
				variant="flat">
				{{ item.event }}
			</v-chip>
		</template>
		<template #item.old_values="{ item }">
			<button
				class="btn btn-accent text-white btn-sm"
				@click="openDialog(item.old_values)">
				View
			</button>
		</template>
		<template #item.new_values="{ item }">
			<button
				class="btn btn-accent text-white btn-sm"
				@click="openDialog(item.new_values)">
				View
			</button>
		</template>
	</DataServerSide>
</template>

<style scoped>
.json-display {
	color: black;
	font-family: monospace;
	white-space: pre-wrap;
	cursor: pointer; /* Add a pointer cursor to indicate interactivity */
}
</style>
