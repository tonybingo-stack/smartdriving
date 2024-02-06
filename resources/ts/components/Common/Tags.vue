<script setup lang="ts">
import axios from "axios"
import { onBeforeMount } from "vue"
const props = defineProps({
	selectedTags: Array,
	foreign: String,
})

const emit = defineEmits(["selectedTags"])

const loading = ref(false)
const tags = ref([] as Array<{ id: number; name: string }>)
const selectedTags = ref([] as Array<{ id: number; name: string }>)

const addTag = (tagId) => {
	const numericTagId = parseInt(tagId, 10)
	const tag = tags.value.find((t) => t.id === numericTagId)
	if (tag && !selectedTags.value.some((existingTag) => existingTag.id === tag.id)) {
		selectedTags.value.push(tag)
		emit("selectedTags", selectedTags.value)
	}
}

const removeTag = (tagId: number) => {
	const index = selectedTags.value.findIndex((tag) => tag.id === tagId)
	if (index > -1) {
		selectedTags.value.splice(index, 1)
		emit("selectedTags", selectedTags.value)
	}
}

const fetchData = () => {
	loading.value = true
	axios
		.get(route(`admin.${props.foreign}.index`), {
			headers: {
				Accept: "application/json",
			},
		})
		.then((response) => {
			tags.value = response.data
			console.log("all tags", tags.value)
			loading.value = false
		})
}

const fetchCurrent = (selected) => {
	console.log("tags", tags.value)
	selectedTags.value = JSON.parse(JSON.stringify(selected))
}
watch(
	() => props.selectedTags,
	(newVal) => {
		fetchCurrent(newVal)
	},
)
onBeforeMount(() => { fetchCurrent(props.selectedTags); })

onBeforeMount(fetchData)
</script>
<template>
	<div>
		<select
			class="w-full input input-primary text-white"
			@change="addTag($event.target.value)">
			<option
				value=""
				disabled
				selected>
				Add New
			</option>
			<option
				v-for="tag in tags"
				:key="tag.id"
				:value="tag.id">
				{{ tag.name }}
			</option>
		</select>
		<div
			v-for="tag in selectedTags"
			:key="tag.id"
			class="badge badge-primary cursor-pointer badge-lg mt-4 mx-1 gap-1"
			@click="removeTag(tag.id)">
			<svg
				xmlns="http://www.w3.org/2000/svg"
				fill="none"
				viewBox="0 0 24 24"
				class="inline-block w-4 h-4 stroke-current">
				<path
					stroke-linecap="round"
					stroke-linejoin="round"
					stroke-width="2"
					d="M6 18L18 6M6 6l12 12"></path>
			</svg>
			{{ tag.name }}
		</div>
	</div>
</template>
