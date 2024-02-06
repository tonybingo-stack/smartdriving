<script setup lang="ts">
import { Link, router } from "@inertiajs/vue3"
import { HomeIcon } from "@heroicons/vue/24/solid"
import ApplicationLogo from "../../ApplicationLogo.vue"
import CommonHeader from "../CommonHeader.vue"
import { ref } from "vue"
import { route, current } from "momentum-trail"

const drawer = ref(null)
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
				:class="{ 'bg-primary': current('reseller.dashboard') }">
				<Link
					class="py-0 active text-black relative flex flex-row items-center h-11"
					:href="route('dashboard')">
					<span class="inline-flex justify-center items-center">
						<HomeIcon class="h-5 w-5 text-black"></HomeIcon>
					</span>
					<span class="ml-2 ms-3 text-base tracking-wider truncate">Home</span>
				</Link>
			</VListItem>
		</ul>
	</v-navigation-drawer>
</template>
