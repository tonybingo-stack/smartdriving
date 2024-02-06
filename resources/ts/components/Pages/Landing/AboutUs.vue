<script setup lang="ts">
import Carousel from "primevue/carousel"
import { ref } from "vue"
const name = ref<string>("")

const getSeverity = (status: any) => {
	switch (status) {
		case "INSTOCK":
			return "success"

		case "LOWSTOCK":
			return "warning"

		case "OUTOFSTOCK":
			return "danger"

		default:
			return null
	}
}
/* ProductService */
const products = [
	{
		id: "1000",
		code: "f230fh0g3",
		name: "Bamboo Watch",
		description: "Product Description",
		image: "bamboo-watch.jpg",
		price: 65,
		category: "Accessories",
		quantity: 24,
		inventoryStatus: "INSTOCK",
		rating: 5,
	},
	{
		id: "1000",
		code: "f230fh0g3",
		name: "Bamboo Watch",
		description: "Product Description",
		image: "bamboo-watch.jpg",
		price: 65,
		category: "Accessories",
		quantity: 24,
		inventoryStatus: "INSTOCK",
		rating: 5,
	},
	{
		id: "1000",
		code: "f230fh0g3",
		name: "Bamboo Watch",
		description: "Product Description",
		image: "bamboo-watch.jpg",
		price: 65,
		category: "Accessories",
		quantity: 24,
		inventoryStatus: "INSTOCK",
		rating: 5,
	},
	{
		id: "1000",
		code: "f230fh0g3",
		name: "Bamboo Watch",
		description: "Product Description",
		image: "bamboo-watch.jpg",
		price: 65,
		category: "Accessories",
		quantity: 24,
		inventoryStatus: "INSTOCK",
		rating: 5,
	},
	{
		id: "1000",
		code: "f230fh0g3",
		name: "Bamboo Watch",
		description: "Product Description",
		image: "bamboo-watch.jpg",
		price: 65,
		category: "Accessories",
		quantity: 24,
		inventoryStatus: "INSTOCK",
		rating: 5,
	},
	{
		id: "1000",
		code: "f230fh0g3",
		name: "Bamboo Watch",
		description: "Product Description",
		image: "bamboo-watch.jpg",
		price: 65,
		category: "Accessories",
		quantity: 24,
		inventoryStatus: "INSTOCK",
		rating: 5,
	},
]
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
	<div id="contactus">
		<div class="mini-spacer">
			<v-container>
				<!-- -----------------------------------------------
            Start Contact Form
        ----------------------------------------------- -->
				<v-row justify="center">
					<div class="font-weight-medium contact-title mt-0 font-['Siegra'] text-2xl tracking-widest">
						Join our 100+ partners on an amazing journey
					</div>
					<div class="card">
						<Carousel
							:value="products"
							:num-visible="3"
							:num-scroll="1"
							:responsive-options="responsiveOptions"
							circular
							:autoplay-interval="3000">
							<template #item="slotProps">
								<div class="border-1 surface-border border-round m-2 text-center py-5 px-3">
									<!-- <div class="mb-3"> -->
									<img
										:src="'https://primefaces.org/cdn/primevue/images/product/' + slotProps.data.image"
										:alt="slotProps.data.name"
										class="shadow-2 w-full" />
									<!-- </div> -->
								</div>
							</template>
						</Carousel>
					</div>
				</v-row>
				<!-- -----------------------------------------------
            End Contact Form
        ----------------------------------------------- -->
			</v-container>
		</div>
	</div>
</template>
