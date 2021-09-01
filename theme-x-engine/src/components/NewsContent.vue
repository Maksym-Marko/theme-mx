<template>

	<main class="mx-news">

		<NewsItem
			v-for="post in posts"
			:key="post.ID"
			:post_content="post"
		></NewsItem>

	</main>

</template>

<script>
import NewsItem from './news/NewsItem.vue'

export default {

	name: 'NewsContent',
	components: {
		NewsItem
	},
	props: {
		mx_data: {
			type: Object,
			required: true
		}
	},
	data() {

		return {
			content: null,
			error: null,
			posts: []
		}

	},
	methods: {

		/*
		* Get news
		*/
		getNews() {

			let data = {
				action: 'mx_get_news',
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

			xhr.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded;charset=UTF-8" )

			xhr.onreadystatechange = function() {

				if ( this.readyState === XMLHttpRequest.DONE && this.status === 200 ) {

					if( _this.isJSON( this.responseText ) ) {

						_this.posts = JSON.parse( this.responseText )

					}

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

		},

		isJSON( str ) {
			try {
				JSON.parse(str);
			} catch (e) {
				return false;
			}
			return true;
		}

	},
	mounted() {
		
		this.getNews()

	}

}
</script>