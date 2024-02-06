<script setup lang="ts">
const props = defineProps({
	wheelPercentages: Object,
})
const imageUrl = () => new URL(`/public/images/cars/skeleton.jpeg`, import.meta.url)

console.log("got perc", props.wheelPercentages)
</script>

<template>
	<div class="wheel-dialog flex justify-center items-center">
		<!-- Left Wheels -->
		<div class="flex flex-col items-end">
			<div class="flex items-center">
				<span class="text-black mr-2">{{ wheelPercentages?.front_left }} %</span>
				<Wheel :percentage="wheelPercentages?.front_left" />
			</div>
			<div class="flex items-center">
				<span class="text-black mr-2">{{ wheelPercentages?.rear_left }} %</span>
				<Wheel :percentage="wheelPercentages?.rear_left" />
			</div>
		</div>

		<!-- Car Skeleton Image -->
		<div class="car-skeleton">
			<img
				:src="imageUrl()"
				alt="Car Skeleton" />
		</div>

		<!-- Right Wheels -->
		<div class="flex flex-col items-start">
			<div class="flex items-center">
				<Wheel :percentage="wheelPercentages?.front_right" />
				<span class="text-black ml-2">{{ wheelPercentages?.front_right }} %</span>
			</div>
			<div class="flex items-center">
				<Wheel :percentage="wheelPercentages?.rear_right" />
				<span class="text-black ml-2">{{ wheelPercentages?.rear_right }} %</span>
			</div>
		</div>
	</div>
</template>

<style scoped>
.flex.items-center {
	margin-bottom: 10px; /* Adjust margin as needed */
}
.car-skeleton {
	margin: 0 20px; /* Adjust margin as needed */
}
</style>
