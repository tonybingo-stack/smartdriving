<script setup lang="ts">
import { useForm, usePage } from "@inertiajs/vue3"
import axios from "axios"
import { route } from "momentum-trail"
import { App, onMounted , ref } from "vue"
import AuthLayout from "@/components/Layouts/AuthLayout.vue"

const payment = ref(null)

const form = ref()
console.log(usePage().props.payment)

const newOrder = async () => {
	form.value.submit()
}
// onMounted(newOrder)

defineLayout(AuthLayout)
</script>

<template>
	<v-container>
		<v-row justify="center">
			<VCard>
				<VCardItem>
					<VForm
						ref="form"
						:action="usePage().props.payment.url"
						method="POST"
						@submit.prevent="newOrder">
						<input
							id="data"
							type="hidden"
							name="data"
							:value="usePage().props.payment.data" />
						<input
							id="env_key"
							type="hidden"
							name="env_key"
							:value="usePage().props.payment.environmentKey" />
						<VCardActions>
							<button
								class="btn btn-primary"
								type="submit">
								Payment in process...
							</button>
						</VCardActions>
					</VForm>
				</VCardItem>
			</VCard>
		</v-row>
	</v-container>
</template>
