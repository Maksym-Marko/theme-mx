<template>

	<div 
		class="col"
		v-if="content && ! error"
		v-html="content"
	></div>

</template>

<script>

const axios = require('axios')

export default {

	name: 'Sidebar',
	props: {
		mx_data: {
			type: Object,
			required: true
		},
		id: {
			type: String,
			required: true
		}
	},
	data() {

		return {
			content: null,
			error: null
		}

	},
	methods: {

		/*
		* Get Sidebar
		*/
		async getSidebar() {

			const _this = this

			let rest_route = this.mx_data.rest_url + 'theme_mx/v1/sidebars/' + this.id

			try {

				let res = await axios.get( rest_route );

				_this.content = res.data.rendered

			} catch (err) {

				_this.error = err.response.data.message

				console.error( err.response.data );

			}

		}

	},
	mounted() {

		this.getSidebar()

	}

}
</script>