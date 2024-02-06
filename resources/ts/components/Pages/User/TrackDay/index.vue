<script setup lang="ts">
import UserLayout from "@/components/Layouts/UserLayout.vue"
defineLayout(UserLayout)
</script>

<template>
	<Head title="Track Days" />
	<v-container class="mt-15">
		<h1 class="font-bold text-4xl text-primary mb-4 mt-20 sm:mt-0">Track Days</h1>
		<UserTrackDaysTable />
	</v-container>
</template>
