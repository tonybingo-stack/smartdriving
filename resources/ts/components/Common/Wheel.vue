<script setup lang="ts">
import { computed } from "vue"

const props = defineProps(["percentage"])
const wheelColor = computed(() => {
	if (props.percentage <= 25) return "red"
	if (props.percentage <= 50) return "orange"
	if (props.percentage <= 75) return "yellow"
	return "green"
})
</script>

<template>
	<div
		class="wheel mx-2 my-4"
		:style="{ backgroundColor: wheelColor }"></div>
</template>

<style scoped>
.wheel {
	width: 30px;
	height: 55px;
	border-radius: 30%;
}
</style>
