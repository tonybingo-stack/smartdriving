<script setup lang="ts">
import { Link, router } from "@inertiajs/vue3"
import {
	HomeIcon,
	CalendarDaysIcon,
	ShoppingCartIcon,
	FlagIcon,
	RocketLaunchIcon,
	UsersIcon,
	MegaphoneIcon,
	UserCircleIcon,
	BuildingStorefrontIcon,
} from "@heroicons/vue/24/solid"
import ApplicationLogo from "../../ApplicationLogo.vue"
import CommonHeader from "../CommonHeader.vue"
import { onUnmounted, ref } from "vue"
import { route, current } from "momentum-trail"

const drawer = ref(null)
</script>
<template>
	<CommonHeader />
	<v-navigation-drawer v-model="drawer" class="bg-white">
		<div class="sidebar-header flex items-center justify-center py-4">
			<div class="inline-flex">
				<a href="#" class="inline-flex flex-row items-center">
					<ApplicationLogo />
				</a>
			</div>
		</div>
		<ul class="menu space-y-2 py-4">
			<span
				class="px-2 items-center text-center py-1 text-xs font-medium tracking-wide text-white bg-accent rounded-full"
				>Admin</span
			>
			<VListItem
				class="flex items-center ph-2 text-gray-900 rounded-lg text-white hover:bg-gray-300 group"
				:class="{ 'bg-primary': current('admin.dashboard') }">
				<Link
					class="py-0 active text-black relative flex flex-row items-center h-11"
					:href="route('admin.dashboard')">
				<span class="inline-flex justify-center items-center">
					<HomeIcon class="h-5 w-5 text-black"></HomeIcon>
				</span>
				<span class="ml-2 ms-3 text-base tracking-wider truncate">Home</span>
				</Link>
			</VListItem>
			<VListItem
				class="flex items-center ph-2 text-gray-900 rounded-lg text-white hover:bg-gray-300 group"
				:class="{ 'bg-primary': current('admin.bookings.*') }">
				<Link
					class="py-0 active text-black relative flex flex-row items-center h-11"
					:href="route('admin.bookings.index')">
				<span class="inline-flex justify-center items-center">
					<ShoppingCartIcon class="h-5 w-5 text-black"></ShoppingCartIcon>
				</span>
				<span class="ml-2 ms-3 text-base tracking-wider truncate">Bookings</span>
				</Link>
			</VListItem>
			<VListItem
				class="flex items-center ph-2 text-gray-900 rounded-lg text-white hover:bg-gray-300 group"
				:class="{ 'bg-primary': current('admin.track_days.*') }">
				<Link
					class="py-0 active text-black relative flex flex-row items-center h-11"
					:href="route('admin.track_days.index')">
				<span class="inline-flex justify-center items-center">
					<CalendarDaysIcon class="h-5 w-5 text-black"></CalendarDaysIcon>
				</span>
				<span class="ml-2 ms-3 text-base tracking-wider truncate">Track Days</span>
				</Link>
			</VListItem>
			<VListItem
				class="flex items-center ph-2 text-gray-900 rounded-lg text-white hover:bg-gray-300 group"
				:class="{ 'bg-primary': current('admin.products.*') }">
				<Link
					class="py-0 active text-black relative flex flex-row items-center h-11"
					:href="route('admin.products.index')">
					<span class="inline-flex justify-center items-center">
						<BuildingStorefrontIcon class="h-5 w-5 text-black"></BuildingStorefrontIcon>
					</span>
					<span class="ml-2 ms-3 text-base tracking-wider truncate">Products</span>
				</Link>
			</VListItem>
			<VListItem
				class="flex items-center ph-2 text-gray-900 rounded-lg text-white hover:bg-gray-300 group"
				:class="{ 'bg-primary': current('admin.users.*') }">
				<Link
					class="py-0 active text-black relative flex flex-row items-center h-11"
					:href="route('admin.users.index')">
				<span class="inline-flex justify-center items-center">
					<UsersIcon class="h-5 w-5 text-black"></UsersIcon>
				</span>
				<span class="ml-2 ms-3 text-base tracking-wider truncate">Users</span>
				</Link>
			</VListItem>
			<VListItem
				class="flex items-center ph-2 text-gray-900 rounded-lg text-white hover:bg-gray-300 group"
				:class="{ 'bg-primary': current('admin.cars.*') }">
				<Link
					class="py-0 active text-black relative flex flex-row items-center h-11"
					:href="route('admin.cars.index')">
				<span class="inline-flex justify-center items-center">
					<RocketLaunchIcon class="h-5 w-5 text-black"></RocketLaunchIcon>
				</span>
				<span class="ml-2 ms-3 text-base tracking-wider truncate">Cars</span>
				</Link>
			</VListItem>
			<VListItem
				class="flex items-center ph-2 text-gray-900 rounded-lg text-white hover:bg-gray-300 group"
				:class="{ 'bg-primary': current('admin.tracks.*') }">
				<Link
					class="py-0 active text-black relative flex flex-row items-center h-11"
					:href="route('admin.tracks.index')">
				<span class="inline-flex justify-center items-center">
					<FlagIcon class="h-5 w-5 text-black"></FlagIcon>
				</span>
				<span class="ml-2 ms-3 text-base tracking-wider truncate">Tracks</span>
				</Link>
			</VListItem>
			<VListItem
				class="flex items-center ph-2 text-gray-900 rounded-lg text-white hover:bg-gray-300 group"
				:class="{ 'bg-primary': current('admin.guests.*') }">
				<Link
					class="py-0 active text-black relative flex flex-row items-center h-11"
					:href="route('admin.guests.index')">
				<span class="inline-flex justify-center items-center">
					<UserCircleIcon class="h-5 w-5 text-black"></UserCircleIcon>
				</span>
				<span class="ml-2 ms-3 text-base tracking-wider truncate">Guests</span>
				</Link>
			</VListItem>
			<VListItem
				class="flex items-center ph-2 text-gray-900 rounded-lg text-white hover:bg-gray-300 group"
				:class="{ 'bg-primary': current('admin.audits.*') }">
				<Link
					class="py-0 active text-black relative flex flex-row items-center h-11"
					:href="route('admin.audits.index')">
				<span class="inline-flex justify-center items-center">
					<MegaphoneIcon class="h-5 w-5 text-black"></MegaphoneIcon>
				</span>
				<span class="ml-2 ms-3 text-base tracking-wider truncate">Audits</span>
				</Link>
			</VListItem>
		</ul>
	</v-navigation-drawer>
</template>
