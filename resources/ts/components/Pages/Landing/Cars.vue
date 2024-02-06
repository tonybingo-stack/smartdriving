<script setup lang="ts">
import { usePage } from "@inertiajs/vue3"
import { watch , ref } from "vue"

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
	<div
		id="cars"
		class="bg-accent text-center p-12">
		<v-container class="">
			<v-row justify="center">
				<div class="font-weight-medium contact-title mb-12 font-['Siegra'] text-5xl tracking-widest">Select Car</div>
			</v-row>
			<v-row
				justify="center"
				class="mb-20">
				<CarItem
					v-for="car in cars"
					:key="car.id"
					:name="car.name"
					:image="car.photo_url"
					:power="car.power"
					:acceleration="car.acceleration"
					:description="car.description" />
			</v-row>
		</v-container>
	</div>
</template>
