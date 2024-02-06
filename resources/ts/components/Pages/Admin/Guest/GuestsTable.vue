<script setup lang="ts">
import * as Yup from "yup"
import dayjs from "dayjs"
import AdminLayout from "@/components/Layouts/AdminLayout.vue"
defineLayout(AdminLayout)

const headers = ref([
	{ title: "ID", key: "id", align: "end" },
	{ title: "Email", key: "email", align: "center" },
])

const fields = ref([])
</script>

<template>
	<DataServerSide
		:headers="headers"
		:fields="fields"
		table="guests"
		api="api.guests"
		singular="Guest">
		<template #item.email="{ item }">
			{{ item.email }}
		</template>
	</DataServerSide>
</template>
