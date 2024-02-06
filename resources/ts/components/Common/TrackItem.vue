<!-- TrackItem.vue -->
<template>
	<div class="card card-compact w-64 bg-base-100 shadow-xl ml-6 mt-6 bg-lime-100">
		<figure><img :src="imageUrl().toString()" alt="Track" /></figure>
		<div class="card-body  items-center text-center">
			<h2 class="card-title">{{ name }}</h2>
			<p>Circuit Length: {{ length }}</p>
			<lang-flag :iso="country" />
		</div>
	</div>
</template>

<script setup lang="ts">
const props = defineProps(["id", "name", "image", "country", "length"])

const imageUrl = () => new URL(`/public/images/tracks/${props.image}`, import.meta.url)
</script>
