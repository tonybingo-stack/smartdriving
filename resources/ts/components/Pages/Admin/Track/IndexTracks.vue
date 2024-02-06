<script setup lang="ts">
import AdminLayout from "@/components/Layouts/AdminLayout.vue"
defineLayout(AdminLayout)
</script>

<template>
	<Head title="Tracks" />
	<v-container class="mt-15">
		<h1 class="font-bold text-4xl text-primary mb-4 mt-20 sm:mt-0">Tracks</h1>
		<TracksTable />
	</v-container>
</template>
