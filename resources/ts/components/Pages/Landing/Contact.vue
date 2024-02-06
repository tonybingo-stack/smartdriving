<script setup lang="ts">
import { EnvelopeIcon } from "@heroicons/vue/24/solid"
import axios from "axios"
import { ref } from "vue"
// import { useRecaptchaProvider, Checkbox } from "vue-recaptcha"

// useRecaptchaProvider()

const name = ref<string>("")
const email = ref<string>("")
const message = ref<string>("")
const recaptchaValue = ref<any>(null)
const userValidation = ref<boolean>(false)

const sendEmail = async () => {
	// userValidation.value = true
	// if (!recaptchaValue.value) {
	// 	return
	// }
	// const payload = {
	// 	name: name.value,
	// 	email: email.value,
	// 	message: message.value,
	// 	"g-recaptcha-response": recaptchaValue.value,
	// }
	// try {
	// 	const response = await axios.post("/send-email", payload)
	// 	userValidation.value = false
	// } catch (error) {
	// 	console.log("Email sending failed", error)
	// }
}
</script>
<template>
	<div id="contactus">
		<div class="mini-spacer">
			<v-container>
				<!-- -----------------------------------------------
            Start Contact Form
        ----------------------------------------------- -->
				<v-row justify="center">
					<v-col
						cols="12"
						md="8">
						<div>
							<h4 class="font-weight-medium contact-title mt-0">Quick Contact</h4>
							<form @submit.prevent="sendEmail">
								<v-row class="mt-7">
									<v-col
										cols="12"
										md="6"
										class="py-0">
										<v-text-field
											v-model="name"
											label="Name"
											variant="outlined"
											color="primary"
											placeholder="Name"
											required></v-text-field>
									</v-col>
									<v-col
										cols="12"
										md="6"
										class="py-0">
										<v-text-field
											v-model="email"
											label="Email"
											variant="outlined"
											type="email"
											color="primary"
											placeholder="Email"
											required></v-text-field>
									</v-col>
									<v-col
										cols="12"
										class="py-0">
										<v-textarea
											v-model="message"
											name="message"
											color="primary"
											variant="outlined"
											label="Message"
											rows="3"
											required></v-textarea>
									</v-col>
								</v-row>
								<v-row>
									<v-col
										cols="12"
										md="6"
										class="py-0">
										<label class="label">
											<span class="label-text text-primary">{{
												userValidation ? "Please click the checkbox" : ""
											}}</span>
										</label>
										<!-- <Checkbox v-model="recaptchaValue"> </Checkbox> -->
									</v-col>
								</v-row>
								<v-row class="mt-7">
									<v-col
										cols="12"
										md="6"
										class="py-0">
										<button class="btn btn-primary btn-wide text-white">
											Send
											<EnvelopeIcon class="h-6 w-6 text-white" />
										</button>
									</v-col>
								</v-row>
							</form>
						</div>
					</v-col>
					<v-col
						cols="12"
						md="4">
						<div class="bg-primary card mt-5">
							<div class="card-body items-center text-center">
								<h2 class="card-title font-weight-medium text-white">Smart Driving</h2>
								<p class="mt-7 op-8 mb-0 text-white">STUFF</p>
								<p class="op-8 mb-8 text-white">MORE STUFF</p>
							</div>
						</div>
					</v-col>
				</v-row>
				<!-- -----------------------------------------------
            End Contact Form
        ----------------------------------------------- -->
			</v-container>
		</div>
	</div>
</template>
