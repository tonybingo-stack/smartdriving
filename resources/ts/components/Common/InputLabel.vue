<script setup lang="ts">
defineProps({
	value: String,
})
</script>

<template>
	<label class="label text-white">
		<span
			v-if="value"
			class="text-white"
			>{{ value }}</span
		>
		<span
			v-else
			class="text-white"
			><slot
		/></span>
	</label>
</template>
