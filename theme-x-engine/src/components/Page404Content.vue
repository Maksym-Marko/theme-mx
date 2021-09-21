<template>
	<main class="mx-page404 mx-site-main">

		<section class="error-404 not-found">

			<header class="page-header">

				<h1
					class="page-title"
					v-html="title"
				></h1>

			</header>

			<div class="page-content">

				<p
					v-html="description"
				></p>

			</div>

		</section>

	</main>
</template>

<script>
export default {

	name: 'Page404Content',
	props: {
		mx_data: {
			type: Object,
			required: true
		}
	},
	data() {
		return {
			title: 'Oops! That page can’t be found.',
			description: 'It looks like nothing was found at this location. Maybe try one of the links below or a search?'
		}
	},
	methods: {

		set404Data() {

			if( this.mx_data.page404_title ) {

				this.title = this.mx_data.page404_title

			}

			if( this.mx_data.page404_description ) {

				this.description = this.mx_data.page404_description

			}

		}

	},
	mounted() {

		this.set404Data()

	}

}
</script>