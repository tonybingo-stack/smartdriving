import { createVuetify } from "vuetify"
import { VBtn } from "vuetify/components/VBtn"

export default createVuetify({
	aliases: {
		MyButton: VBtn,
	},
	defaults: {
		VBtn: { variant: "flat" },
		MyButton: { variant: "tonal" },
	},
})
