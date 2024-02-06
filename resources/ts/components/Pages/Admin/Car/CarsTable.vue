<script setup lang="ts">
import * as Yup from "yup"
import dayjs from "dayjs"
import { XCircleIcon } from "@heroicons/vue/24/solid"
import AdminLayout from "@/components/Layouts/AdminLayout.vue"
import { ref } from "vue";
defineLayout(AdminLayout)

const headers = ref([
	{ title: "ID", key: "id", align: "end" },
	{ title: "Name", key: "name", align: "center" },
	{ title: "Power", key: "power", align: "end" },
	{ title: "VIN", key: "vin", align: "end" },
	{ title: "Fuel (%)", key: "fuel_level", align: "end" },
	{ title: "Mileage (km)", key: "km", align: "end" },
	{ title: "Wheel Health", key: "wheel_percentages", align: "end" },
	{ title: "Actions", key: "actions", align: "center", sortable: false },
])

const fields = ref([
	{
		label: "Name",
		name: "name",
		as: "input",
		rules: Yup.string().required(),
	},
	{
		label: "Type",
		name: "type",
		as: "input",
		rules: Yup.string().required(),
	},
	{
		label: "VIN",
		name: "vin",
		as: "input",
		rules: Yup.string().required(),
	},
	{
		label: "Mileage",
		name: "km",
		as: "number",
		rules: Yup.number().required(),
	},
	{
		label: "Fuel %",
		name: "fuel_level",
		as: "number",
		rules: Yup.number().required(),
	},
	{
		label: "Wheel Health",
		name: "wheel_percentages",
		as: "textarea",
		create: false,
		rules: Yup.string(),
	},
	{
		label: "Damages",
		name: "damages",
		as: "textarea",
		rules: Yup.string(),
	},
	{
		label: "Engine",
		name: "engine_type",
		as: "input",
		rules: Yup.string().required(),
	},
	{
		label: "Power (HP)",
		name: "power",
		as: "number",
		rules: Yup.number().required(),
	},
	{
		label: "Acceleration (s)",
		name: "acceleration",
		as: "number",
		rules: Yup.number().required(),
	},
	{
		label: "Photo Path",
		name: "photo_url",
		as: "input",
		rules: Yup.string().required(),
	},
	{
		label: "Description",
		name: "description",
		as: "textarea",
		rules: Yup.string().required(),
	},
])

const imageUrl = (item: { photo_url: any; }) => new URL(`/public/images/cars/${item.photo_url}`, import.meta.url)

const formatNumber = (item: any) => Number(item).toLocaleString("en-US")

const dialog = ref(false)
const selectedRowJson = ref({})

const openDialog = (row: string) => {
	selectedRowJson.value = JSON.parse(row) // Convert the row data to a formatted JSON string
	dialog.value = true
}

const closeDialog = () => {
	dialog.value = false
}
</script>

<template>
	<v-dialog
		v-model="dialog"
		max-width="500px">
		<v-card class="rounded">
			<v-card-text>
				<WheelDialog :wheel-percentages="selectedRowJson" />
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
		table="cars"
		api="api.cars"
		singular="Car">
		<template #item.name="{ item }">
			<div class="flex items-center">
				<div class="avatar">
					<div class="w-14 rounded-md ring ring-primary ring-offset-base-100 ring-offset">
						<img
							:src="imageUrl(item).toString()"
							alt="Avatar" />
					</div>
				</div>
				<div class="ml-3">{{ item.name }}</div>
			</div>
		</template>
		<template #item.acceleration="{ item }">
			{{ item.acceleration.toFixed(2) }}
		</template>
		<template #item.mileage="{ item }">
			{{ formatNumber(item.mileage) }}
		</template>
		<template #item.wheel_percentages="{ item }">
			<button
				class="btn btn-accent text-white btn-sm"
				@click="openDialog(item.wheel_percentages)">
				View
			</button>
		</template>
		<template #item.fuel_level="{ item }">
			<div
				class="radial-progress bg-primary border-2 border-accent"
				:style="{ '--value': (item.fuel_level / 100) * 100.0, '--size': '2rem' }">
				{{ item.fuel_level }}
			</div>
		</template>
	</DataServerSide>
</template>
