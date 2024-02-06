<template>
	<div id="testimonials">
		<div class="mini-spacer">
			<v-container class="mb-20">
				<v-row justify="center">
					<div class="font-weight-medium contact-title mb-12 font-['Siegra'] text-3xl tracking-widest">
						Testimonials
					</div>
				</v-row>
				<v-row justify="center">
					<FeedbackCard
						v-for="testimonial in testimonials"
						:key="testimonial.id"
						:name="testimonial.name"
						:image="testimonial.image"
						:testimonial="testimonial.testimonial" />
				</v-row>
			</v-container>
		</div>
	</div>
</template>

<script setup>
const testimonials = ref([
	{
		id: 1,
		name: "Gabriel Minee",
		testimonial:
			"Shift down to third gear and turn left to enter the famous Variante Ascari, where you immediately shift to fourth gear and have your foot ready to hit the peddle when the track straightens.",
		designation: "design",
		company: "The Artifically.IO",
		image: "car.jpg",
	},
	{
		id: 2,
		name: "Gabriel Minee",
		testimonial:
			"Shift down to third gear and turn left to enter the famous Variante Ascari, where you immediately shift to fourth gear and have your foot ready to hit the peddle when the track straightens.",
		designation: "design",
		company: "The Artifically.IO",
		image: "car.jpg",
	},
	{
		id: 3,
		name: "Gabriel Minee",
		testimonial:
			"Shift down to third gear and turn left to enter the famous Variante Ascari, where you immediately shift to fourth gear and have your foot ready to hit the peddle when the track straightens.",
		designation: "design",
		company: "The Artifically.IO",
		image: "car.jpg",
	},
])
</script>
