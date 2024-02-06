<script setup lang="ts">
import * as Yup from "yup"
import dayjs from "dayjs"
import AdminLayout from "@/components/Layouts/AdminLayout.vue"
defineLayout(AdminLayout)

const headers = ref([
	{ title: "ID", key: "id", align: "end" },
	{ title: "Track", key: "track_id", align: "end" },
	{ title: "Date", key: "date", align: "end" },
	{ title: "Start", key: "start_time", align: "end" },
	{ title: "End", key: "end_time", align: "end" },
	{ title: "Event Type", key: "description", align: "end" },
	{ title: "Services", key: "services", align: "end" },
	// { title: "Cars", key: "cars", align: "center", sortable: false },
	{ title: "Actions", key: "actions", align: "center", sortable: false },
])

const showFullText = ref({})

const truncateText = (itemId, text) => {
	if (text?.length <= 20 || (showFullText.value.hasOwnProperty(itemId) && showFullText.value[itemId])) {
		return text
	} else {
		return text?.slice(0, 20) + "..."
	}
}
const toggleFullText = (itemId) => {
	if (!showFullText.value.hasOwnProperty(itemId)) {
		showFullText.value[itemId] = false
	}
	showFullText.value[itemId] = !showFullText.value[itemId]
}

const fields = ref([
	{
		label: "Track",
		name: "track_id",
		foreign: "tracks",
		as: "autocomplete",
		rules: Yup.number().required(),
	},
	{
		label: "Event Type",
		name: "description",
		as: "textarea",
		rules: Yup.string().required(),
	},
	{
		label: "Services",
		name: "services",
		as: "textarea",
		rules: Yup.string().required(),
	},
	{
		label: "Date",
		name: "date",
		as: "date",
		rules: Yup.string().required(),
		create: false,
	},
	{
		label: "Start Time",
		name: "start_time",
		as: "time",
		rules: Yup.string().required(),
	},
	{
		label: "Lunch Time",
		name: "lunch_time",
		as: "time",
		rules: Yup.string().required(),
	},
	{
		label: "End Time",
		name: "end_time",
		as: "time",
		rules: Yup.string().required(),
	},
	{
		label: "",
		name: "cars",
		as: "cars",
		rules: true,
	},
	{
		label: "",
		name: "track_dates",
		as: "dates",
		rules: true,
		edit: false,
	},
])
</script>

<template>
	<DataServerSide
		:headers="headers"
		:fields="fields"
		table="track_days"
		api="api.track_days"
		singular="Track_Day">
		<template #item.track_id="{ item }">
			{{ item.track.name }}
		</template>
		<template #item.description="{ item }">
			<div>
				{{ truncateText(item.id, item.description) }}
				<button
					class="btn btn-xs btn-accent"
					@click="toggleFullText(item.id)">
					{{ showFullText[item.id] ? "Read Less" : "Read More" }}
				</button>
			</div>
		</template>
		<template #item.services="{ item }">
			<div>
				{{ truncateText(item.id, item.services) }}
				<button
					class="btn btn-xs btn-accent"
					@click="toggleFullText(item.id)">
					{{ showFullText[item.id] ? "Read Less" : "Read More" }}
				</button>
			</div>
		</template>
		<template #item.cars="{ item }">
			<div>
				{{ truncateText(item.id, item.cars) }}
				<button
					class="btn btn-xs btn-accent"
					@click="toggleFullText(item.id)">
					{{ showFullText[item.id] ? "Read Less" : "Read More" }}
				</button>
			</div>
		</template>
	</DataServerSide>
</template>
