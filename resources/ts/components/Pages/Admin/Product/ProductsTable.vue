<script setup lang="ts">
import * as Yup from "yup"
import dayjs from "dayjs"
import AdminLayout from "@/components/Layouts/AdminLayout.vue"
defineLayout(AdminLayout)

const headers = ref([
	{ title: "ID", key: "id", align: "end" },
	{ title: "Name", key: "name", align: "center" },
	{ title: "Description", key: "description", align: "end" },
	{ title: "Price", key: "price_eur", align: "end" },
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
		label: "Description",
		name: "description",
		as: "textarea",
		rules: Yup.string().required(),
	},
	{
		label: "Price (€)",
		name: "price_eur",
		as: "number",
		rules: Yup.number().required(),
	},
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
</script>

<template>
	<DataServerSide
		:headers="headers"
		:fields="fields"
		table="products"
		api="api.products"
		singular="Product">
		<template #item.price_eur="{ item }">
			<v-chip
				color="green"
				label
				variant="flat">
				€ {{ item.price_eur }}
			</v-chip>
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
	</DataServerSide>
</template>
