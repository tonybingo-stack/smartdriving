<script setup lang="ts">
import * as Yup from "yup"
import dayjs from "dayjs"
import AdminLayout from "@/components/Layouts/AdminLayout.vue"
import { ref } from "vue";
defineLayout(AdminLayout)

const headers = ref([
	{ title: "ID", key: "id", align: "end" },
	{ title: "Booking Type", key: "bookable_type", align: "end" },
	{ title: "Booking ID", key: "bookable_id", align: "start" },
	{ title: "Car", key: "car_id", align: "end" },
	{ title: "Instructor", key: "instructor_id", align: "end" },
	{ title: "Track Day", key: "track_day_id", align: "end" },
	{ title: "Slot", key: "slot_id", align: "end" },
])
const showType = (item: string) => {
	return item.replace("App\\Models\\", "")
}
const fields = ref([])
</script>

<template>
	<DataServerSide
		:headers="headers"
		:fields="fields"
		table="bookings"
		api="api.bookings"
		singular="Booking">
		<template #item.bookable_type="{ item }">
			{{ showType(item.bookable_type) }}
		</template>
		<template #item.bookable_id="{ item }">
			<div
				v-if="item.bookable.name"
				class="flex items-center">
				<div class="avatar">
					<div class="w-3 rounded-full ring ring-primary ring-offset-base-100 ring-offset">
						<img
							:src="item.bookable.profile_photo_url"
							alt="Avatar" />
					</div>
				</div>
				<div class="ml-3">{{ item.bookable.name }}</div>
			</div>
			<div
				v-else
				class="flex items-center">
				<div class="ml-3">{{ item.bookable.email }}</div>
			</div>
		</template>
		<template #item.car_id="{ item }">
			{{ item.car.name }}
		</template>
		<template #item.instructor_id="{ item }">
			<div class="avatar">
				<div class="w-3 rounded-full ring ring-primary ring-offset-base-100 ring-offset">
					<img
						:src="item.instructor.profile_photo_url"
						alt="Avatar" />
				</div>
			</div>
			<div class="ml-3">{{ item.instructor.name }}</div>
		</template>
		<template #item.track_day_id="{ item }">
			{{ item.track_day.date }}
		</template>
		<template #item.slot_id="{ item }">
			{{ item.slot.start_time }}
		</template>
	</DataServerSide>
</template>
