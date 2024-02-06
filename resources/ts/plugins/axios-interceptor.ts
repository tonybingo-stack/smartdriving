import axios, { type AxiosResponse, type AxiosError } from "axios"

import { useToast } from "vue-toastification"

// Add a response interceptor
const toast = useToast()

axios.interceptors.response.use(
	(response: AxiosResponse) => {
		if (["POST", "PUT", "DELETE"].includes(response.config.method!.toUpperCase())) {
			switch (response.config.method!.toUpperCase()) {
				case "POST":
					toast.success("Operation successful! 🤩", {
						timeout: 2000,
					})
					break
				case "PUT":
					toast.warning("Update successful! ✅", {
						timeout: 2000,
					})
					break
				case "DELETE":
					toast.error("Deletion successful! ⛔️", {
						timeout: 2000,
					})
					break
				default:
					toast.success("Operation successful! 🤩", {
						timeout: 2000,
					})
					break
			}
		}
		return response
	},
	async (error: AxiosError) => {
		if (error.response) {
			// The request was made, and the server responded with a status code that falls out of the range of 2xx
			const statusCode = error.response.status

			switch (statusCode) {
				case 422:
					toast("Validation failed 🥲. Please check your input.", {
						type: "error",
					})
					break
				case 500:
					toast("Internal Server Error 😵. Please try again later.", {
						type: "error",
					})
					break
				// Add more cases as needed for other error codes
				default:
					// Handle other error codes here
					toast("Internal Server Error 😵. Please try again later.", {
						type: "error",
					})
			}
		} else {
			toast("Internal Server Error 😵. Please try again later.", {
				type: "error",
			})
		}
		return await Promise.reject(error)
	},
)
