<script setup lang="ts">
import { useForm } from "@inertiajs/vue3"
import axios from "axios"
import { route } from "momentum-trail"
import { App , ref } from "vue"
import UserLayout from "@/components/Layouts/UserLayout.vue"
defineLayout(UserLayout)
</script>

<template>
	<Head title="Bookings" />
	<v-container class="mt-15">
		<h1 class="font-bold text-4xl text-primary mb-4 mt-20 sm:mt-0">Bookings</h1>
		<UserBookingsTable />
	</v-container>
</template>