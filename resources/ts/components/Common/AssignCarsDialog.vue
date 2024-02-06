<script setup lang="ts">
import { ref } from "vue"
import axios from "axios"
import { TrashIcon, PlusCircleIcon, CheckCircleIcon } from "@heroicons/vue/24/solid"
const props = defineProps({
	carAssignments: Array,
})

const emit = defineEmits(["updateCarAssignments"])

const carAssignments = ref([])
const cars = ref([])
const expandedPanel = ref(null)

const addCarAssignment = () => {
	carAssignments.value.push({
		id: null,
	})
	emit("updateCarAssignments", carAssignments.value)
	expandedPanel.value = carAssignments.value.length - 1
	console.log("ASSIGNMENTS", carAssignments.value)
}

const deleteCarAssignment = (index) => {
	carAssignments.value.splice(index, 1)
	emit("updateCarAssignments", carAssignments.value)
	console.log("ASSIGNMENTS DEL", carAssignments.value)
	expandedPanel.value = null
}

const saveCars = () => {
	emit("updateCarAssignments", carAssignments.value)
	expandedPanel.value = null
}

const fetchData = () => {
	axios
		.get(route(`admin.cars.index`), {
			headers: {
				Accept: "application/json",
			},
			params: {},
		})
		.then((response) => {
			cars.value = response.data
		})
}

const getCarById = (carId) => {
	const car = cars.value.find((car) => car.id === carId)
	return car ? `${car.name} (VIN: ${car.vin}) - Fuel ${car.fuel_level}%` : "Not Assigned"
}

const fetchCurrent = (selected) => {
	carAssignments.value = JSON.parse(JSON.stringify(selected))
}
watch(
	() => props.carAssignments,
	(newVal) => {
		fetchCurrent(newVal)
	},
)

const isCarAssigned = (carId, currentIndex) => {
	return carAssignments.value.some((assignment, index) => {
		return index !== currentIndex && assignment.id === carId
	})
}

onBeforeMount(() => { fetchCurrent(props.carAssignments); })

onBeforeMount(fetchData)
</script>
<template>
	<div class="divider divider-accent">Cars ({{ carAssignments.length }})</div>
	<v-expansion-panels
		v-model="expandedPanel"
		class="text-black">
		<v-expansion-panel
			v-for="(assignment, index) in carAssignments"
			:key="index"
			variant="rounded">
			<v-expansion-panel-title>
				<div class="w-full flex justify-between items-center">
					<span class="text-black">
						Car {{ index + 1 }}: {{ assignment ? getCarById(assignment.id) : "Not Assigned" }}
					</span>
				</div>
			</v-expansion-panel-title>
			<v-expansion-panel-text>
				<v-row
					justify="space-around"
					no-gutters>
					<v-col cols="10">
						<select
							v-model="assignment.id"
							class="select select-primary bg-primary text-black w-full">
							<option
								v-for="car in cars"
								:key="car.id"
								:value="car.id"
								:disabled="isCarAssigned(car.id, index)">
								{{ car.name }} (VIN: {{ car.vin }})
							</option>
						</select>
					</v-col>
					<v-col class="ml-2">
						<button
							class="btn btn-error btn-md text-white"
							@click.prevent="deleteCarAssignment(index)">
							<TrashIcon class="h-4 w-4 text-white" />
							Remove Car
						</button>
					</v-col>
				</v-row>
			</v-expansion-panel-text>
		</v-expansion-panel>
	</v-expansion-panels>
	<div class="flex justify-center">
		<button
			class="btn btn-accent text-white mt-4"
			@click.prevent="addCarAssignment">
			<PlusCircleIcon class="h-6 w-6 text-white" />
			Add Car
		</button>
		<button
			class="btn btn-success text-white mt-4 ml-4"
			@click.prevent="saveCars">
			<CheckCircleIcon class="h-6 w-6 text-white" />
			Update Cars
		</button>
	</div>
</template>
