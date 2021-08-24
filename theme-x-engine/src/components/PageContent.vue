<template>
	<main class="mx-page-content">
		
		<p>
			This is a page
		</p>

	</main>
</template>

<script>
	export default {

		name: 'PageContent',
		props: {
			mx_data: {
				type: Object,
				required: true
			}
		},
		mounted() {
			console.log( this.mx_data )
		}

	}
</script>