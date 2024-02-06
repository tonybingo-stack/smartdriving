<script setup lang="ts">
import AuthLayout from "@/components/Layouts/AuthLayout.vue"
import { LockClosedIcon } from "@heroicons/vue/24/solid"
import * as Yup from "yup"
import axios from "axios"
import { ref } from "vue"
import { Link, router } from "@inertiajs/vue3"
import { route } from "momentum-trail"

const form = ref({
	email: "",
	password: "",
	remember: false,
})

const submitting = ref(false)
const serverErrors = ref({})

const fields = ref([
	{
		label: "Email",
		name: "email",
		as: "input",
		visible: true,
		rules: Yup.string().required("Email is required").email("Must be a valid email"),
	},
	{
		label: "Password",
		name: "password",
		type: "password",
		as: "input",
		visible: true,
		rules: Yup.string().required("Password is required"),
	},
])

const onSubmit = async (values: any) => {
	submitting.value = true
	try {
		const response = await axios.post(route("login.store"), values)
		console.log("response was", response.data)
		if (response.status === 200 && response.data.redirect) {
			router.visit(response.data.redirect)
		}
	} catch (error) {
		serverErrors.value = (error as any).response.data
	} finally {
		submitting.value = false
	}
}

defineLayout(AuthLayout)
</script>

<template>
	<Head title="Login" />
	<AuthenticationCard>
		<template #logo>
			<AuthenticationCardLogo />
		</template>
		<Form @submit="onSubmit">
			<div
				v-for="{ as, name, label, visible, ...attrs } in fields"
				:key="name">
				<FormField
					v-model="(form as any)[name] as any"
					:name="name"
					:label="label"
					:as="as"
					:visible="visible"
					v-bind="attrs" />
				<label class="label">
					<span
						v-show="(serverErrors as any)[name]"
						class="label-text-alt text-red-500"></span>
					<span
						v-show="(serverErrors as any)[name]"
						class="label-text-alt text-red-500"
						>{{ (serverErrors as any)[name] }}</span
					>
				</label>
			</div>
			<div class="flex justify-start space-x-4">
				<FormField
					v-model="form['remember']"
					name="remember"
					as="checkbox">
					<template #label>
						<div class="text-white text-sm">Remember Me</div>
					</template>
				</FormField>
			</div>

			<div class="flex items-center justify-end mt-4">
				<button
					type="submit"
					class="btn btn-primary ml-4 text-white"
					:disabled="submitting">
					<LockClosedIcon class="h-6 w-6 text-white" />
					Log in
				</button>
			</div>
		</Form>
	</AuthenticationCard>
</template>
