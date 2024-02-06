<script setup lang="ts">
import AdminLayout from "@/components/Layouts/AdminLayout.vue"
defineLayout(AdminLayout)
</script>

<template>
	<Head title="Audits" />
	<v-container class="mt-15 w-full">
		<h1 class="font-bold text-4xl text-primary mb-4 mt-20 sm:mt-0">Audits</h1>
		<AuditsTable />
	</v-container>
</template>
