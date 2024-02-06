<script setup lang="ts">
import { Link } from "@inertiajs/vue3"
</script>

<template>
	<Link :href="route('login.create')">
		<ApplicationLogo />
	</Link>
</template>
