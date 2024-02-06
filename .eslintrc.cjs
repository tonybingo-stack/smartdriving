module.exports = {
	env: {
		browser: true,
		es2021: true,
	},
	extends: [
		"standard-with-typescript",
		"plugin:vue/vue3-recommended",
		"plugin:@typescript-eslint/eslint-recommended",
		"prettier",
	],
	overrides: [
		{
			env: {
				node: true,
			},
			files: [".eslintrc.{js,cjs}"],
			parserOptions: {
				sourceType: "script",
			},
		},
	],
	parserOptions: {
		ecmaVersion: "latest",
		sourceType: "module",
		parser: "@typescript-eslint/parser",
		project: "./tsconfig.json",
		extraFileExtensions: [".vue", ".php", ".md", ".css", ".jpg"],
	},
	plugins: ["vue"],
	rules: {
		"vue/multi-word-component-names": "off",
		"vue/component-api-style": ["error", ["script-setup", "composition"]],
		"vue/component-name-in-template-casing": "error",
		"vue/block-lang": ["error", { script: { lang: "ts" } }],
		"vue/define-macros-order": [
			"error",
			{
				order: ["defineProps", "defineEmits"],
			},
		],
		"vue/define-emits-declaration": ["error", "type-based"],
		"vue/define-props-declaration": ["error", "type-based"],
		"vue/no-undef-components": "error",
		"vue/no-unused-refs": "error",
		"vue/no-v-html": "off",
		"no-undef": "off",
		"no-unused-vars": "off",
	},
	ignorePatterns: ["*.d.ts"],
	parser: "vue-eslint-parser",
}
