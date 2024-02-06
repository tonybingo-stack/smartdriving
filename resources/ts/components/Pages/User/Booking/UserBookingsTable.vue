<script setup lang="ts">
import * as Yup from "yup"
import dayjs from "dayjs"
import { ref } from "vue";
import UserLayout from "@/components/Layouts/UserLayout.vue"
defineLayout(UserLayout)

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
	<DataServerSide :headers="headers" :fields="fields" table="bookings" api="api.bookings" singular="Booking">
		<template v-slot:item.bookable_type="{ item }">
			{{ showType(item.bookable_type) }}
		</template>
		<template v-slot:item.bookable_id="{ item }">
			<div class="flex items-center" v-if="item.bookable.name">
				<div class="avatar">
					<div class="w-3 rounded-full ring ring-primary ring-offset-base-100 ring-offset">
						<img :src="item.bookable.profile_photo_url" alt="Avatar" />
					</div>
				</div>
				<div class="ml-3">{{ item.bookable.name }}</div>
			</div>
			<div class="flex items-center" v-else>
				<div class="ml-3">{{ item.bookable.email }}</div>
			</div>
		</template>
		<template v-slot:item.car_id="{ item }">
			{{ item.car.name }}
		</template>
		<template v-slot:item.instructor_id="{ item }">
			<div class="avatar">
				<div class="w-3 rounded-full ring ring-primary ring-offset-base-100 ring-offset">
					<img :src="item.instructor.profile_photo_url" alt="Avatar" />
				</div>
			</div>
			<div class="ml-3">{{ item.instructor.name }}</div>
		</template>
		<template v-slot:item.track_day_id="{ item }">
			{{ item.track_day.date }}
		</template>
		<template v-slot:item.slot_id="{ item }">
			{{ item.slot.start_time }}
		</template>
	</DataServerSide>
</template>
