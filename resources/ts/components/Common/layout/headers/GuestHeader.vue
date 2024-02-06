<script setup lang="ts">
import { ref } from "vue"
import { route } from "momentum-trail"
const logoPath = () => new URL(`/public/images/logo.jpg`, import.meta.url)

const smoothScrollTo = (elementId: string) => {
	const element = document.getElementById(elementId)
	if (element) {
		element.scrollIntoView({ behavior: "smooth" })
	}
}
</script>
<template>
	<div>
		<v-app-bar
			class="app-header pt-lg-0 pt-3 mt-6"
			absolute
			flat
			elevate-on-scroll>
			<a
				href="#"
				class="ml-24"
				><img :src="logoPath()"
			/></a>
			<v-container class="fill-height">
				<v-toolbar class="bg-transparent d-flex align-center">
					<div class="navigation ml-auto d-lg-block">
						<ul class="d-flex navbar-nav">
							<li class="nav-item ml-2">
								<a
class="nav-link cursor-pointer border-b-2 border-transparent hover:border-b-2 hover:border-primary transition duration-500 text-white"
									@click="() => smoothScrollTo('home')">HOME</a>
							</li>
							<li class="nav-item ml-2">
								<a
class="nav-link cursor-pointer border-b-2 border-transparent hover:border-b-2 hover:border-primary transition duration-500 text-white"
									@click="() => smoothScrollTo('contactus')">ABOUT US</a>
							</li>
							<li class="nav-item ml-2">
								<a
class="nav-link cursor-pointer border-b-2 border-transparent hover:border-b-2 hover:border-primary transition duration-500 text-white"
									@click="() => smoothScrollTo('cars')">CARS</a>
							</li>
							<li class="nav-item ml-2">
								<a
class="nav-link cursor-pointer border-b-2 border-transparent hover:border-b-2 hover:border-primary transition duration-500 text-white"
									@click="() => smoothScrollTo('tracks')">TRACKS</a>
							</li>
							<li class="nav-item ml-2">
								<a
class="nav-link cursor-pointer border-b-2 border-transparent hover:border-b-2 hover:border-primary transition duration-500 text-white"
									@click="() => smoothScrollTo('advantages')">ADVANTAGES</a>
							</li>
							<li class="nav-item ml-2">
								<a
class="nav-link cursor-pointer border-b-2 border-transparent hover:border-b-2 hover:border-primary transition duration-500 text-white"
									@click="() => smoothScrollTo('faq')">FAQ</a>
							</li>
							<li class="nav-item ml-2">
								<a
class="nav-link cursor-pointer border-b-2 border-transparent hover:border-b-2 hover:border-primary transition duration-500 text-white"
									@click="() => smoothScrollTo('testimonials')">TESTIMONIALS</a>
							</li>
							<li class="nav-item ml-2 d-md-flex d-sm-none">
								<Link
:href="route('login.create')"
									class="nav-link cursor-pointer cursor-pointer border-b-2 border-transparent hover:border-b-2 hover:border-primary transition duration-500 text-white">
								LOGIN
								</Link>
							</li>
						</ul>
					</div>
				</v-toolbar>
			</v-container>
		</v-app-bar>
	</div>
</template>
