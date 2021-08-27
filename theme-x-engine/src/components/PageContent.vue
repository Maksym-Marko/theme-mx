<template>

	<main class="mx-page-content">

		<div v-html="content"></div>

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
	data() {

		return {
			content: null,
			error: null
		}

	},
	methods: {

		/*
		* Get Page content
		*/
		getPageContent() {

			let data = {
				action: 'mx_get_page_content',
				nonce: this.mx_data.nonce,
				extra: '&post_id=' + this.mx_data.post_id
			}

			this.ajax_request( this.mx_data.ajax_url, data )

		},

		/*
		* AJAX Request
		*/
		ajax_request( ajax_url, data ) {

			const _this = this

			let xhr = new XMLHttpRequest()

			xhr.open( "POST", ajax_url, true )

			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=UTF-8")

			xhr.onreadystatechange = function() {

				if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {

					_this.content = this.responseText

					_this.error = null

				}
				else if (this.status == 400) {

					_this.error = 'Error 400'

				}
				else {

					_this.error = 'Unexpected Error'

				}
			}

			let query = `action=${data.action}&nonce=${data.nonce}${data.extra}`

			xhr.send( query )

		}

	},
	mounted() {
		
		this.getPageContent()

	}

}
</script>