<script setup lang="ts">
import { ref } from "vue"
const videoPath = "landVideo.mp4"
</script>

<template>
	<div
		id="home"
		class="parallax-section flex">
		<video
			autoplay
			muted
			loop>
			<source
				:src="videoPath"
				type="video/mp4" />
			Your browser does not support the video tag.
		</video>
	</div>
</template>

<style scoped>
.parallax-section {
	height: 100vh;
	background-size: cover;
	background-attachment: fixed;
	background-position: center;
	position: relative;
	overflow: hidden;
	flex-direction: column;
	-ms-overflow-style: none; /* IE and Edge */
	scrollbar-width: none; /* Firefox */
}
video {
	/* Make the video fill the entire .parallax-section */
	min-width: 100%;
	min-height: 100%;
	width: auto;
	height: auto;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	/* Ensure the video is responsive */
	object-fit: cover;
}

.parallax-section::-webkit-scrollbar {
	display: none;
}
</style>
