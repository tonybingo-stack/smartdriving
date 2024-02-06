<script setup lang="ts">
import { usePage } from "@inertiajs/vue3";
import { watch } from "vue"
import { ref } from "vue"
import UserLayout from "@/components/Layouts/UserLayout.vue"
defineLayout(UserLayout)

const allCars = ref(usePage().props.cars)
const cars = ref<any[]>([])

watch(
	allCars,
	(newCars: any) => {
		cars.value = newCars.slice(0, 6)
	},
	{ immediate: true },
)
</script>

<template>
	<div id="cars" class="bg-accent text-center p-12">
		<v-container class="">
			<v-row justify="center" class="mb-20 mt-8">
				<CarItem v-for="car in cars" :key="car.id" :name="car.name" :image="car.photo_url" :power="car.power"
					:acceleration="car.acceleration" :description="car.description" />
			</v-row>
		</v-container>
	</div>
</template>
