<script setup lang="ts"></script>

<template>
	<VApp class="bg-white">
		<UserHeader />
		<VMain>
			<slot />
		</VMain>
		<Footer />
	</VApp>
</template>
