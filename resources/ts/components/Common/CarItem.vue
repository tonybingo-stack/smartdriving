<template>
	<div class="card bg-base-200 w-1/3 shadow-xl ml-6 mt-6">
		<figure>
			<img
				:src="imageUrl().toString()"
				alt="car" />
		</figure>
		<div class="card-body text-center justify-center">
			<h2 class="card-title text-center justify-center text-3xl mb-2">{{ name }}</h2>
			<p>{{ description.substring(0, 100) }}</p>
			<p>Power (HP): {{ power }}</p>
			<p>Acceleration 0-100 (s): {{ acceleration }}</p>
			<div class="card-actions justify-center">
				<button class="btn btn-primary text-white">Book Now</button>
			</div>
		</div>
	</div>
</template>

<script setup lang="ts">
// Define props for the component
const props = defineProps(["id", "name", "description", "image", "power", "acceleration"])

const imageUrl = () => new URL(`/public/images/cars/${props.image}`, import.meta.url)
</script>
