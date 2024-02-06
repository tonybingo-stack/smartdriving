<script setup lang="ts">
import { useForm } from "@inertiajs/vue3"
import axios from "axios"
import { route } from "momentum-trail"
import { App , ref } from "vue"
import UserLayout from "@/components/Layouts/UserLayout.vue"
defineLayout(UserLayout)
</script>

<template>
	<!-- <BannerText /> -->
	<div class="mini-spacer"></div>
	<div>
		<div class="banner1-component">
			<v-container>
				<v-row justify="center">
					<h2>My Profile</h2>
				</v-row>
			</v-container>
		</div>
	</div>
</template>
