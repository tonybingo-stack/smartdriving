<script setup lang="ts">
import { MagnifyingGlassCircleIcon, ArrowLeftOnRectangleIcon, UserIcon } from "@heroicons/vue/24/solid"
import { computed, ref } from "vue"
import { route } from "momentum-trail"
import { usePage } from "@inertiajs/vue3";

const user = (usePage().props.auth as any).user
const imageUrl = () => new URL(`/public/images/cars/car.jpg`, import.meta.url)
</script>
<template>
	<v-app-bar
		class="bg-primary pt-lg-0 overflow-visible"
		absolute
		flat
		elevate-on-scroll>
		<v-container class="fill-height justify-center mb-3">
			<div
				class="flex flex-row flex-grow -ml-64 md:ml-0 transition-all duration-150 ease-in justify-center items-center">
				<form action="#">
					<div class="hidden md:flex relative">
						<div class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
							<MagnifyingGlassCircleIcon class="h-6 w-6 text-accent" />
						</div>

						<input
							id="search"
							type="text"
							name="search"
							class="input input-bordered input-primary text-white text-sm sm:text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-300 w-full h-10 focus:outline-none focus:border-primary"
							placeholder="Search..." />
					</div>
					<div class="flex md:hidden">
						<a
							href="#"
							class="flex items-center justify-center h-10 w-10 border-transparent">
							<svg
								class="h-6 w-6 text-gray-500"
								fill="none"
								stroke-linecap="round"
								stroke-linejoin="round"
								stroke-width="2"
								viewBox="0 0 24 24"
								stroke="currentColor">
								<path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
							</svg>
						</a>
					</div>
				</form>
				<div class="flex ml-auto dropdown dropdown-end">
					<div
						class="flex flex-row items-center cursor-pointer"
						tabindex="0">
						<span class="w-20 font-semibold tracking-wide leading-none">{{ user.name }}</span>
						<label class="btn btn-ghost btn-secondary btn-circle avatar">
							<div class="w-8 rounded-full ring ring-accent ring-offset-base-100 ring-offset">
								<img
									alt="Avatar"
									:src="imageUrl().toString()" />
							</div>
						</label>
					</div>
					<ul
						tabindex="0"
						class="mt-12 dropdown-content z-[1] menu p-2 shadow bg-base-200 rounded-box w-36">
						<li>
							<Link
								:href="route('logout')"
								method="post">
								<ArrowLeftOnRectangleIcon class="h-6 w-6 text-red" />
								Log Out
							</Link>
						</li>
					</ul>
				</div>
			</div>
		</v-container>
	</v-app-bar>
</template>
