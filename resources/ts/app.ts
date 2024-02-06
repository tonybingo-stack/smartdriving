import "@/assets/app.css"

import { createApp, h } from "vue"
import { createInertiaApp, Head, Link } from "@inertiajs/vue3"
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers"
import type { DefineComponent } from "vue"
import { trail } from "momentum-trail"
import routes from "./routes.json"
import { createVuetify } from "vuetify"
import type { ThemeDefinition } from "vuetify"
import "@mdi/font/css/materialdesignicons.css"
import * as components from "vuetify/components"
import * as directives from "vuetify/directives"
import "vuetify/dist/vuetify.min.css"
import "@/assets/scss/style.scss"
import AppLayout from "./components/Layouts/AppLayout.vue"
import VueDatePicker from "@vuepic/vue-datepicker"
import Toast, { PluginOptions } from "vue-toastification"
import { Field, Form, ErrorMessage } from "vee-validate"
import "./plugins/axios-interceptor"
import dayjs from "dayjs"
import "dayjs/locale/ro"
import relativeTime from "dayjs/plugin/relativeTime" // Import the relativeTime plugin
import utc from "dayjs/plugin/utc"
import customParseFormat from "dayjs/plugin/customParseFormat"
// import { VueRecaptchaPlugin } from "vue-recaptcha/head"
import PrimeVue from "primevue/config"
import LangFlag from "vue-lang-code-flags"

const DarkTheme: ThemeDefinition = {
	dark: false,
	colors: {
		primary: "#0092ca",
		accent: "#ff2800",
		surface: "#fff",
		"on-fallbackbc": "#fff",
		"on-primary": "#fff",
		"on-surface": "#fff",
	},
}

const vuetify = createVuetify({
	components: {},
	directives,

	theme: {
		themes: {
			light: DarkTheme,
			variables: {},
		},
	},
})

const appName = window.document.getElementsByTagName("title")[0]?.innerText || "Template"

createInertiaApp({
	title: (title) => `${title} - ${appName}`,
	resolve: (name): any => {
		const pages = import.meta.glob("./components/Pages/**/*.vue", { eager: true })
		const page = pages[`./components/Pages/${name}.vue`] as any
		page.default.layout = page.default.layout || AppLayout
		return page
	},
	setup({ el, App, props, plugin }) {
		dayjs.locale("en")
		dayjs.extend(utc)
		dayjs.extend(relativeTime) // Extend dayjs with the relativeTime plugin
		dayjs.extend(customParseFormat)

		return (
			(createApp({ render: () => h(App, props) }) as any)
				.use(plugin)
				.use(PrimeVue)
				.use(vuetify)
				.use(Toast)
				.use(trail, { routes })
				// .use(VueRecaptchaPlugin, {
				// 	v2SiteKey: import.meta.env.VITE_RECAPTCHA_SITEKEY,
				// })
				.component("Form", Form)
				.component("Field", Field)
				.component("ErrorMessage", ErrorMessage)
				.component("VueDatePicker", VueDatePicker)
				.component("lang-flag", LangFlag)
				.mount(el)
		)
	},
	progress: {
		color: "#0092ca",
		delay: 0,
		showSpinner: true,
	},
})
