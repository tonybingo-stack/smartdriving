<script setup>
import { ref } from "vue"
import Carousel from "primevue/carousel"

const tracks = ref(usePage().props.tracks)

const responsiveOptions = ref([
	{
		breakpoint: "1400px",
		numVisible: 2,
		numScroll: 1,
	},
	{
		breakpoint: "1199px",
		numVisible: 3,
		numScroll: 1,
	},
	{
		breakpoint: "767px",
		numVisible: 2,
		numScroll: 1,
	},
	{
		breakpoint: "575px",
		numVisible: 1,
		numScroll: 1,
	},
])
</script>

<template>
	<div
		id="tracks"
		class="bg-primary text-center p-12">
		<div class="font-weight-bold contact-title mt-12 text-black font-['Siegra'] text-5xl tracking-widest">
			Select Track
		</div>
		<div class="card">
			<Carousel
				:value="tracks"
				:num-visible="3"
				:num-scroll="1"
				:responsive-options="responsiveOptions"
				circular
				:autoplay-interval="3000">
				<template #item="slotProps">
					<div class="border-1 surface-border border-round m-2 text-center py-5 px-3">
						<div class="mb-3">
							<TrackItem
								:key="slotProps.data.id"
								:name="slotProps.data.name"
								:image="slotProps.data.photo_url"
								:length="slotProps.data.length"
								:country="slotProps.data.country" />
						</div>
					</div>
				</template>
			</Carousel>
		</div>
	</div>
</template>
