<script setup lang="ts">
const {
	modelValue: modelValueProp,
	errorMessage,
	isValid,
} = defineProps<{
	modelValue: any
	errorMessage: string | null
	isValid: boolean
}>()

const emit = defineEmits()

const fileInput = ref(null)

const handleFileChange = (event: Event) => {
	const target = event.target as HTMLInputElement
	if (target.files) {
		emit("update:modelValue", target.files[0])
	}
}
</script>
<template>
	<input
		ref="fileInput"
		type="file"
		class="file-input file-input-ghost file-input-primary text-white w-full"
		:class="{ 'border-error': modelValue && !!errorMessage, 'border-success': isValid }"
		@change="handleFileChange" />
</template>
