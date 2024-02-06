<script setup lang="ts">
import { ref, watch } from "vue"
import UserLayout from "@/components/Layouts/UserLayout.vue"
import { usePage } from "@inertiajs/vue3";
defineLayout(UserLayout)

const allTracks = ref(usePage().props.tracks)
const tracks = ref<any[]>([])

watch(
	allTracks,
	(newTracks: any) => {
		tracks.value = newTracks.slice(0, 8)
	},
	{ immediate: true },
)
</script>

<template >
	<div id="tracks" class="bg-cyan-50 text-center p-12">
		<v-container class="">
			<v-row justify="center" class="mb-8 mt-8">
				<TrackItem v-for="track in tracks" :key="track.id" :id="track.id" :name="track.name"
					:image="track.photo_url" :country="track.country" :length="track.length" />
			</v-row>
		</v-container>
	</div>
</template >
