<template>
	<main class="mx-post-content">
		
		<p>
			This is a post
			
		</p>

	</main>
</template>

<script>
	export default {

		name: 'PostContent',
		props: {
			mx_data: {
				type: Object,
				required: true
			}
		},
		mounted() {
			// console.log( this.mx_data )
		}

	}
</script>