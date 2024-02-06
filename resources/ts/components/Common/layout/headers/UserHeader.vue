<script setup lang="ts">
import { Link, router } from "@inertiajs/vue3"
import {
	HomeIcon,
	CalendarDaysIcon,
	ShoppingCartIcon,
	FlagIcon,
	RocketLaunchIcon,
	UserIcon,
	MegaphoneIcon,
	UserCircleIcon,
	CreditCardIcon,
	BuildingStorefrontIcon,
	GiftIcon,
	ArchiveBoxIcon
} from "@heroicons/vue/24/solid"

import ApplicationLogo from "../../ApplicationLogo.vue"
import CommonHeader from "../CommonHeader.vue"
import { onUnmounted, ref } from "vue"
import { route, current } from "momentum-trail"

const drawer = ref(false)
function handleMouseMove(event: MouseEvent) {
	// Check if the mouse position is within the threshold from the left side
	if (drawer.value && event.clientX > 300) {
		drawer.value = false
	} else if (!drawer.value && event.clientX < 10) {
		drawer.value = true
	}
}

// Add event listener for mousemove
window.addEventListener("mousemove", handleMouseMove)

// Cleanup the event listener when the component is unmounted
onUnmounted(() => {
	window.removeEventListener("mousemove", handleMouseMove)
})
// Function to trigger re-render
function hideSideBar() {
	drawer.value = false
}
</script>
<template>
	<CommonHeader />
	<v-navigation-drawer
		v-model="drawer"
		class="bg-white">
		<div class="sidebar-header flex items-center justify-center py-4">
			<div class="inline-flex">
				<a
					href="#"
					class="inline-flex flex-row items-center">
					<ApplicationLogo />
				</a>
			</div>
		</div>
		<ul class="menu space-y-2 py-4">
			<VListItem
				class="flex items-center ph-2 text-gray-900 rounded-lg text-white hover:bg-gray-300 group"
				:class="{ 'bg-primary': current('dashboard') }"
				@click="hideSideBar">
				<Link
					class="py-0 active text-black relative flex flex-row items-center h-11"
					:href="route('dashboard')">
					<span class="inline-flex justify-center items-center">
						<HomeIcon class="h-5 w-5 text-black"></HomeIcon>
					</span>
					<span class="ml-2 ms-3 text-base tracking-wider truncate">Home</span>
				</Link>
			</VListItem>
			<VListItem
				class="flex items-center ph-2 text-gray-900 rounded-lg text-white hover:bg-gray-300 group"
				:class="{ 'bg-primary': current('profile.*') }"
				@click="hideSideBar">
				<Link
					class="py-0 active text-black relative flex flex-row items-center h-11"
					:href="route('profile.index')">
					<span class="inline-flex justify-center items-center">
						<UserIcon class="h-5 w-5 text-black"></UserIcon>
					</span>
					<span class="ml-2 ms-3 text-base tracking-wider truncate">My Profile</span>
				</Link>
			</VListItem>
			<VListItem
				class="flex items-center ph-2 text-gray-900 rounded-lg text-white hover:bg-gray-300 group"
				:class="{ 'bg-primary': current('bookings.*') }"
				@click="hideSideBar">
				<Link
					class="py-0 active text-black relative flex flex-row items-center h-11"
					:href="route('bookings.index')">
					<span class="inline-flex justify-center items-center">
						<ShoppingCartIcon class="h-5 w-5 text-black"></ShoppingCartIcon>
					</span>
					<span class="ml-2 ms-3 text-base tracking-wider truncate">Bookings</span>
				</Link>
			</VListItem>
			<VListItem
				class="flex items-center ph-2 text-gray-900 rounded-lg text-white hover:bg-gray-300 group"
				:class="{ 'bg-primary': current('payment.*') }"
				@click="hideSideBar">
				<Link
					class="py-0 active text-black relative flex flex-row items-center h-11"
					:href="route('payment.index')">
					<span class="inline-flex justify-center items-center">
						<CreditCardIcon class="h-5 w-5 text-black"></CreditCardIcon>
					</span>
					<span class="ml-2 ms-3 text-base tracking-wider truncate">Payment</span>
				</Link>
			</VListItem>
			<VListItem
				class="flex items-center ph-2 text-gray-900 rounded-lg text-white hover:bg-gray-300 group"
				:class="{ 'bg-primary': current('cars.*') }"
				@click="hideSideBar">
				<Link
					class="py-0 active text-black relative flex flex-row items-center h-11"
					:href="route('cars.index')">
					<span class="inline-flex justify-center items-center">
						<RocketLaunchIcon class="h-5 w-5 text-black"></RocketLaunchIcon>
					</span>
					<span class="ml-2 ms-3 text-base tracking-wider truncate">Cars</span>
				</Link>
			</VListItem>
			<VListItem
				class="flex items-center ph-2 text-gray-900 rounded-lg text-white hover:bg-gray-300 group"
				:class="{ 'bg-primary': current('tracks.*') }"
				@click="hideSideBar">
				<Link
					class="py-0 active text-black relative flex flex-row items-center h-11"
					:href="route('tracks.index')">
					<span class="inline-flex justify-center items-center">
						<FlagIcon class="h-5 w-5 text-black"></FlagIcon>
					</span>
					<span class="ml-2 ms-3 text-base tracking-wider truncate">Tracks</span>
				</Link>
			</VListItem>
			<VListItem
				class="flex items-center ph-2 text-gray-900 rounded-lg text-white hover:bg-gray-300 group"
				:class="{ 'bg-primary': current('trackday.*') }"
				@click="hideSideBar">
				<Link
					class="py-0 active text-black relative flex flex-row items-center h-11"
					:href="route('trackday.index')">
					<span class="inline-flex justify-center items-center">
						<CalendarDaysIcon class="h-5 w-5 text-black"></CalendarDaysIcon>
					</span>
					<span class="ml-2 ms-3 text-base tracking-wider truncate">Track Days</span>
				</Link>
			</VListItem>
			<VListItem class="flex items-center ph-2 text-gray-900 rounded-lg text-white hover:bg-gray-300 group"
				:class="{ 'bg-primary': current('instructors.*') }" @click="hideSideBar">
				<Link class="py-0 active text-black relative flex flex-row items-center h-11"
					:href="route('instructors.index')">
				<span class="inline-flex justify-center items-center">
					<ArchiveBoxIcon class="h-5 w-5 text-black"></ArchiveBoxIcon>
				</span>
				<span class="ml-2 ms-3 text-base tracking-wider truncate">Instructors</span>
				</Link>
			</VListItem>
		</ul>
	</v-navigation-drawer>
</template>
