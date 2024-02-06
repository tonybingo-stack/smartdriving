<script setup lang="ts">
import { watchDebounced } from "@vueuse/core"
import { Field, ErrorMessage, useField } from "vee-validate"
import { onBeforeMount , watch , onMounted } from "vue"
import AssignCarsDialog from "./AssignCarsDialog.vue"

interface FormProps {
	rules?: string
	name: string
	type?: string | undefined
	label?: string
	as: string
	visible?: boolean
	foreign?: string | undefined
	successMessage?: string | undefined
	options?: string[] | undefined
}
const props = defineProps<FormProps>()
const dateValue = ref(null)

const {
	value: inputValue,
	errorMessage,
	handleBlur,
	handleChange,
	meta,
} = useField(props.name, props.rules, {
	syncVModel: true,
})

watch(inputValue, () => {
	if (props.as === "date") {
		dateValue.value = inputValue.value
	}
	if (props.as === "checkbox") {
		inputValue.value = inputValue.value === true // Convert to boolean
	}
})

watch(dateValue, (newDate) => {
	inputValue.value = dayjs(newDate).format("YYYY-MM-DD")
})

const handleSelectOption = (option: { id: number }) => {
	console.log("id ch", option.id)
	inputValue.value = option.id
}

const handleSelectedTags = (tags: any[]) => {
	console.log("selected tags", tags)
	inputValue.value = tags
}

const handleSelected = (selected: any[]) => {
	console.log("selected", selected)
	inputValue.value = selected
}
</script>

<template>
	<Field :name="props.name">
		<slot
			v-if="$slots.label"
			name="label">
			<slot name="label" />
		</slot>
		<InputLabel
			v-else
			:for="props.name"
			>{{ props.label }}</InputLabel
		>
		<input
			v-if="props.as === 'checkbox'"
			:id="props.name"
			type="checkbox"
			class="checkbox checkbox-primary"
			:name="props.name"
			:checked="inputValue"
			@input="handleChange($event.target.checked)"
			@blur="handleBlur" />
		<input
			v-else-if="props.as === 'input' || props.as === 'number'"
			:id="props.name"
			:class="{
				'w-full': true,
				input: true,

				// 'input-primary': !!props.visible,
				// 'input-ghost': !props.visible,
				'bg-white': true,
				'text-black': true,
				'border-primary': !!props.visible,
				'border-error': !!errorMessage,
				'border-success': meta.valid,
			}"
			:name="props.name"
			:type="props.type"
			:value="inputValue"
			:placeholder="props.label"
			@input="handleChange"
			@blur="handleBlur" />
		<select
			v-else-if="props.as === 'select'"
			:id="props.name"
			v-model="inputValue"
			class="select select-primary bg-white text-black w-full"
			:name="props.name"
			@change="handleChange"
			@blur="handleBlur">
			<option
				v-for="option in props.options"
				:key="option"
				:value="option">
				{{ option }}
			</option>
		</select>
		<textarea
			v-else-if="props.as === 'textarea'"
			:id="props.name"
			class="w-full textarea bg-white text-black"
			:name="props.name"
			:type="props.type"
			:value="inputValue"
			:placeholder="props.label"
			:class="{ 'border-error': !!errorMessage, 'border-success': meta.valid }"
			@input="handleChange"
			@blur="handleBlur" />
		<div v-else-if="props.as === 'date'">
			<VueDatePicker
				v-model="dateValue"
				format="yyyy-MM-dd"
				:clearable="false"
				text-input
				auto-apply
				:dark="false"
				teleport-center
				:utc="false">
				<template #dp-input="{ value, onInput, onEnter, onTab, onClear, onBlur, onKeypress, onPaste, isMenuOpen }">
					<input
						type="text"
						class="input bg-white text-black w-full"
						:class="'border-success'"
						:value="value"
						:placeholder="props.label" />
				</template>
			</VueDatePicker>
		</div>
		<div v-else-if="props.as === 'cars'">
			<AssignCarsDialog
				:car-assignments="inputValue"
				@update-car-assignments="handleSelected" />
		</div>
		<div v-else-if="props.as === 'dates'">
			<AssignDatesDialog
				:dates="inputValue"
				@update-dates="handleSelected" />
		</div>
		<div v-else-if="props.as === 'time'">
			<input
				type="time"
				class="input bg-white text-black w-full"
				:class="'border-success'"
				:value="inputValue"
				:placeholder="props.label"
				@input="handleChange"
				@blur="handleBlur" />
			<!-- <VueDatePicker
				v-model="timeValue"
				time-picker
				text-input
				:no-calendar="true"
				:enable-time="true"
				:time_24hr="true"
				:allowInput="true">
				<template #dp-input="{ value, onInput, onEnter, onTab, onClear, onBlur, onKeypress, onPaste, isMenuOpen }"> -->

			<!-- </template> -->
			<!-- </VueDatePicker> -->
		</div>
		<div
			v-else-if="props.as === 'autocomplete'"
			class="relative">
			<AutoComplete
				:selected-id="inputValue"
				:foreign="props.foreign"
				@select-option="handleSelectOption" />
		</div>
		<div
			v-else-if="props.as === 'video'"
			class="relative">
			<VideoField
				:name="props.name"
				:model-value="inputValue"
				:error-message="errorMessage"
				:is-valid="meta.valid"
				@update:model-value="inputValue = $event" />
		</div>
		<div
			v-else-if="props.as === 'tags'"
			class="relative">
			<Tags
				:selected-tags="inputValue"
				:foreign="props.foreign"
				@selected-tags="handleSelectedTags" />
		</div>
		<label class="label">
			<span
				v-show="errorMessage || meta.valid"
				class="label-text-alt"
				>{{ errorMessage || successMessage }}</span
			>
		</label>
	</Field>
</template>
