<script setup lang="ts">
import { ref } from "vue"
import axios from "axios"
import { TrashIcon, PlusCircleIcon, CheckCircleIcon } from "@heroicons/vue/24/solid"

const emit = defineEmits(["updateDates"])

const dates = ref([])
const expandedPanel = ref(null)

const addDate = () => {
	dates.value.push({
		date: dayjs(Date().now).format("YYYY-MM-DD"),
	})
	emit("updateDates", dates.value)
	expandedPanel.value = dates.value.length - 1
	console.log("DATES", dates.value)
}

const deleteDate = (index) => {
	dates.value.splice(index, 1)
	emit("updateDates", dates.value)
	console.log("DATES DEL", dates.value)
	expandedPanel.value = null
}

const saveDates = () => {
	emit("updateDates", dates.value)
	expandedPanel.value = null
}
</script>
<template>
	<div class="divider divider-accent">Dates ({{ dates.length }})</div>
	<v-expansion-panels
		v-model="expandedPanel"
		class="text-black">
		<v-expansion-panel
			v-for="(assignment, index) in dates"
			:key="index"
			variant="rounded">
			<v-expansion-panel-title>
				<div class="w-full flex justify-between items-center">
					<span class="text-black"> Date {{ index + 1 }}: {{ assignment.date }} </span>
				</div>
			</v-expansion-panel-title>
			<v-expansion-panel-text>
				<v-row
					justify="space-around"
					no-gutters>
					<v-col cols="10">
						<input
							v-model="assignment.date"
							type="date"
							class="input bg-white text-black w-full border-success"
							placeholder="Select a date" />
						<!-- <VueDatePicker
							v-model="assignment.date"
							format="yyyy-MM-dd"
							:clearable="false"
							text-input
							auto-apply
							:dark="false"
							teleport-center
							:utc="false">
							<template #dp-input="{ value, onInput }">

							</template>
						</VueDatePicker> -->
					</v-col>
					<v-col class="ml-2">
						<button
							class="btn btn-error btn-md text-white"
							@click.prevent="deleteDate(index)">
							<TrashIcon class="h-4 w-4 text-white" />
							Remove Date
						</button>
					</v-col>
				</v-row>
			</v-expansion-panel-text>
		</v-expansion-panel>
	</v-expansion-panels>
	<div class="flex justify-center">
		<button
			class="btn btn-accent text-white mt-4"
			@click.prevent="addDate">
			<PlusCircleIcon class="h-6 w-6 text-white" />
			Add Date
		</button>
	</div>
</template>
