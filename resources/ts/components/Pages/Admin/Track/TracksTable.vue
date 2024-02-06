<script setup lang="ts">
import * as Yup from "yup"
import dayjs from "dayjs"
import AdminLayout from "@/components/Layouts/AdminLayout.vue"
defineLayout(AdminLayout)

const headers = ref([
	{ title: "ID", key: "id", align: "end" },
	{ title: "Name", key: "name", align: "center" },
	{ title: "Length", key: "length", align: "end" },
	{ title: "Straight Length", key: "straight_line_length", align: "end" },
	{ title: "Country", key: "country", align: "end" },
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
		label: "Length",
		name: "length",
		as: "number",
		rules: Yup.number().required(),
	},
	{
		label: "Straight Line Length",
		name: "straight_line_length",
		as: "number",
		rules: Yup.number().required(),
	},
	{
		label: "Country",
		name: "country",
		as: "input",
		rules: Yup.string().required(),
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

const imageUrl = (item) => new URL(`/public/images/tracks/${item.photo_url}`, import.meta.url)
</script>

<template>
	<DataServerSide
		:headers="headers"
		:fields="fields"
		table="tracks"
		api="api.tracks"
		singular="Track">
		<template #item.name="{ item }">
			<div class="flex items-center">
				<div class="avatar">
					<div class="w-14 mx-2 rounded-md ring ring-primary ring-offset-base-100 ring-offset">
						<img
							:src="imageUrl(item)"
							alt="Avatar" />
					</div>
				</div>
				<div class="ml-3">{{ item.name }}</div>
			</div>
		</template>
		<template #item.country="{ item }">
			<lang-flag :iso="item.country.substring(0, 2)" />
		</template>
	</DataServerSide>
</template>
