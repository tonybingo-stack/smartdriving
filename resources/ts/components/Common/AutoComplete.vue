<script setup lang="ts">
import axios from "axios"
import { onBeforeMount } from "vue"
const props = defineProps({
	selectedId: Number,
	foreign: String,
})

const emit = defineEmits(["selectOption"])

const isOpen = ref(false)
const searchText = ref("")
const loading = ref(false)
const options = ref([] as Array<{ id: number; name: string }>)
const selectedOption = ref<{ id: number; name: string } | null>(null)

const selectOption = (option) => {
	isOpen.value = false
	searchText.value = option.name
	selectedOption.value = option
	emit("selectOption", option)
}

const fetchData = () => {
	if (selectedOption.value !== null && searchText.value !== selectedOption.value.name) {
		selectedOption.value = null
	}

	loading.value = true
	axios
		.get(route(`admin.${props.foreign}.index`), {
			headers: {
				Accept: "application/json",
			},
			params: {
				...(searchText.value ? { qry: searchText.value } : {}),
			},
		})
		.then((response) => {
			options.value = response.data
			loading.value = false
		})
}

const fetchCurrent = (selectedId) => {
	if (selectedId === 0) {
		return
	}
	axios
		.get(route(`api.${props.foreign}.show`, { id: selectedId }), {
			headers: {
				Accept: "application/json",
			},
		})
		.then((response) => {
			if (response.data.data) {
				searchText.value = response.data.data.name
				selectedOption.value = response.data.data
				loading.value = false
			}
		})
}
watch(
	() => props.selectedId,
	(newVal) => {
		fetchCurrent(newVal)
	},
)
onBeforeMount(() => { fetchCurrent(props.selectedId); })

watchDebounced(searchText, fetchData, { debounce: 300 })
</script>
<template>
	<div>
		<input
			v-model="searchText"
			class="w-full input bg-white text-black"
			placeholder="Type to search..."
			:class="{ 'border-error': !selectedOption, 'border-success': selectedOption }"
			@click="isOpen = !isOpen" />
		<div
			v-if="isOpen && options?.length > 0"
			class="absolute top-14 left-0 z-10 w-full bg-white border rounded-lg">
			<div
				v-for="option in options"
				:key="index"
				class="cursor-pointer px-4 py-2 hover:bg-primary hover:rounded-lg hover:text-white"
				@click="selectOption(option)">
				{{ option.name }}
			</div>
		</div>
	</div>
</template>
