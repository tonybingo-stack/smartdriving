<script setup lang="ts"></script>

<template>
	<VApp class="bg-white app-container">
		<!-- <UserHeader /> -->
		<VMain class="main-content">
			<slot class="page-content" />
		</VMain>
		<Footer class="footer" />
	</VApp>
</template>
<style scoped>
.app-container {
	display: flex;
	flex-direction: column;
	min-height: 100vh;
}

.main-content {
	flex-grow: 1; /* Grow to take available space */
	display: flex;
	flex-direction: column;
}

#page-content {
	flex-grow: 1; /* Ensures footer sticks to bottom */
}
</style>
