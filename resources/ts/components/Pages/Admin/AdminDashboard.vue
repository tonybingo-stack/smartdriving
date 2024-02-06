<script setup lang="ts">
import AdminLayout from "@/components/Layouts/AdminLayout.vue"

import {
	CalendarDaysIcon,
	ShoppingCartIcon,
	FlagIcon,
	RocketLaunchIcon,
	UsersIcon,
	UserCircleIcon,
	CreditCardIcon,
	AcademicCapIcon,
} from "@heroicons/vue/24/outline"

import { onBeforeMount } from "vue"
import axios from "axios"
defineLayout(AdminLayout)

const stats = ref({})
const fetchData = () => {
	axios
		.get(route(`api.stats.index`), {
			headers: {
				Accept: "application/json",
			},
		})
		.then((response) => {
			stats.value = response.data
			console.log("all stats", stats.value)
		})
}

onBeforeMount(fetchData)
</script>

<template>
	<Head title="Admin" />
	<v-container class="mt-15 w-full">
		<h1 class="font-bold text-4xl text-primary mb-4 mt-20 sm:mt-0">Home</h1>
		<div class="stats shadow bg-primary stats-vertical lg:stats-horizontal">
			<div class="stat">
				<div class="stat-figure text-white">
					<ShoppingCartIcon class="inline-block w-8 h-8 stroke-current"></ShoppingCartIcon>
				</div>
				<div class="stat-title text-white">Total Bookings</div>
				<div class="stat-value text-white">{{ stats.bookingsCount }}</div>
				<div class="stat-desc text-white mt-2">0% more than last month</div>
			</div>

			<div class="stat">
				<div class="stat-figure text-accent">
					<CalendarDaysIcon class="inline-block w-8 h-8 stroke-current"></CalendarDaysIcon>
				</div>
				<div class="stat-title text-white">Track Days</div>
				<div class="stat-value text-accent">{{ stats.trackDaysCount }}</div>
				<div class="stat-desc text-white mt-2">0% more than last month</div>
			</div>

			<div class="stat">
				<div class="stat-figure text-warning">
					<CreditCardIcon class="inline-block w-8 h-8 stroke-current"></CreditCardIcon>
				</div>
				<div class="stat-title text-white">Revenue</div>
				<div class="stat-value text-warning">{{ stats.revenue }} €</div>
				<div class="stat-desc text-white mt-2">0% more than last month</div>
			</div>

			<div class="stat">
				<div class="stat-figure text-lime">
					<UsersIcon class="inline-block w-8 h-8 stroke-current"></UsersIcon>
				</div>
				<div class="stat-title text-white">Users</div>
				<div class="stat-value text-lime">{{ stats.usersCount }}</div>
				<div class="stat-desc text-white mt-2">0% more than last month</div>
			</div>
		</div>
		<div class="stats shadow bg-primary mt-4 stats-vertical lg:stats-horizontal">
			<div class="stat">
				<div class="stat-figure text-white">
					<UserCircleIcon class="inline-block w-8 h-8 stroke-current"></UserCircleIcon>
				</div>
				<div class="stat-title text-white">Guests Booked</div>
				<div class="stat-value text-white">{{ stats.guestsCount }}</div>
				<div class="stat-desc text-white mt-2">0% more than last month</div>
			</div>

			<div class="stat">
				<div class="stat-figure text-accent">
					<RocketLaunchIcon class="inline-block w-8 h-8 stroke-current"></RocketLaunchIcon>
				</div>
				<div class="stat-title text-white">Fleet of Cars</div>
				<div class="stat-value text-accent">{{ stats.carsCount }}</div>
				<div class="stat-desc text-white mt-2">0% more than last month</div>
			</div>

			<div class="stat">
				<div class="stat-figure text-warning">
					<FlagIcon class="inline-block w-8 h-8 stroke-current"></FlagIcon>
				</div>
				<div class="stat-title text-white">Tracks</div>
				<div class="stat-value text-warning">{{ stats.tracksCount }}</div>
				<div class="stat-desc text-white mt-2">0% more than last month</div>
			</div>

			<div class="stat">
				<div class="stat-figure text-lime">
					<AcademicCapIcon class="inline-block w-8 h-8 stroke-current"></AcademicCapIcon>
				</div>
				<div class="stat-title text-white">Instructors</div>
				<div class="stat-value text-lime">{{ stats.instructorsCount }}</div>
				<div class="stat-desc text-white mt-2">0% more than last month</div>
			</div>
		</div>
	</v-container>
</template>
