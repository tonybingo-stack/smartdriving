<script setup lang="ts">
import AuthLayout from "@/components/Layouts/AuthLayout.vue"
import { LockClosedIcon } from "@heroicons/vue/24/solid"
import * as Yup from "yup"
import axios from "axios"
import { ref } from "vue"
import { Link, router } from "@inertiajs/vue3"
import { route } from "momentum-trail"

const form = ref({
	name: "",
	email: "",
	password: "",
})

const submitting = ref(false)
const serverErrors = ref({})

const fields = ref([
	{
		label: "Name",
		name: "name",
		as: "input",
		visible: true,
		rules: Yup.string().required("Name is required"),
	},
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
	{
		label: "Password Confirmation",
		name: "password_confirmation",
		type: "password",
		as: "input",
		visible: true,
		rules: Yup.string().required("Password Confirmation is required"),
	},
])

const onSubmit = async (values: any) => {
	submitting.value = true
	try {
		const response = await axios.post(route("register.store"), values)
		router.visit(route("login.create"))
	} catch (error: any) {
		serverErrors.value = error.response.data
	} finally {
		submitting.value = false
	}
}

defineLayout(AuthLayout)
</script>

<template>
	<AuthenticationCard>
		<template #logo>
			<AuthenticationCardLogo />
		</template>
		<Form @submit="onSubmit">
			<div
				v-for="{ as, name, label, visible, ...attrs } in fields"
				:key="name">
				<FormField
					v-model="(form as any)[name]"
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
			<div class="flex items-center justify-center mt-4">
				<button
					type="submit"
					class="btn btn-primary ml-4 text-white"
					:disabled="submitting">
					<LockClosedIcon class="h-6 w-6 text-white" />
					Register
				</button>
			</div>
		</Form>
	</AuthenticationCard>
</template>
