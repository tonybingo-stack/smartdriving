<!-- FeedbackCard.vue -->
<template>
	<div class="card w-80 shadow-xl ml-6 mt-6 bg-slate-200">
		<figure class="rounded w-12 h-12 mx-auto mt-12">
			<img
				:src="image"
				alt="car"
				class="rounded-full w-full h-full object-cover" />
		</figure>
		<div class="card-body">
			<h2 class="card-title justify-center">{{ name }}</h2>
			<p>{{ testimonial }}</p>
		</div>
	</div>
</template>

<script setup>
defineProps(["name", "testimonial", "image"])
</script>

<style scoped>
/* Add your styles here */
</style>
