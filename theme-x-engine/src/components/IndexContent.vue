<template>

	<main class="mx-index-body mx-site-main">

		<Item
			v-for="post in posts"
			:key="post.id"
			:the_post="post"
		/>

		<Pagination
			v-if="mx_data.pagination.enable"
			:pagination="mx_data.pagination"
			:number_news="number_news"
			:current_page="current_page"
			@to_page="setPage"
		/>

	</main>

</template>

<script>
import Item from './index/Item.vue'
import Pagination from './index/Pagination.vue'

const axios = require('axios')

export default {

	name: 'IndexContent',
	components: {
		Item,
		Pagination
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
			posts: [],
			number_news: 0,
			current_page: 1
		}

	},
	methods: {

		/*
		* Set page
		*/
		setPage( page ) {

			this.current_page = page

			this.getItems()

		},

		/*
		* Get Items
		*/
		async getItems() {

			const _this = this

			let post_anchor = 'posts';

			if( this.mx_data.post_type !== 'post' ) {

				post_anchor = this.mx_data.post_type

			}

			let rest_route = this.mx_data.rest_url + 'wp/v2/' + post_anchor + '?per_page=' + this.mx_data.pagination.posts_per_page + '&page=' + this.current_page + '&order=desc&orderby=date'

			try {

				let res = await axios.get( rest_route )

				_this.posts = res.data

			} catch (err) {

				_this.error = err.response.data.message

				console.error( err.response.data );

			}

		},
		
		/*
		* Get Number of Items
		*/
		async getNumberNews() {

			const _this = this

			let post_anchor = 'posts';

			if( this.mx_data.post_type !== 'post' ) {

				post_anchor = this.mx_data.post_type

			}

			let rest_route = this.mx_data.rest_url + 'wp/v2/' + post_anchor

			try {

				let res = await axios.get( rest_route )

				_this.number_news = parseInt( res.headers['x-wp-total'] )

			} catch (err) {

				_this.error = err.response.data.message

				console.error( err.response.data );

			}

		},

		getCurrentPage() {

			let curretn_page = window.location.href

			if( curretn_page.indexOf( '#page-' ) >= 0 ) {

				let matches = curretn_page.match( /#page-(\d+)/ )
			
				if( matches ) {

					let get_page = parseInt( matches[1] );

					if( get_page < 1 ) {

						this.current_page = 1

						history.pushState( { mxThemeNewsPage:'1' },"",'#page-1' )

						return

					}

					let pages = Math.ceil( this.number_news / parseInt( this.mx_data.pagination.posts_per_page ) )

					if( get_page > pages ) {

						this.current_page = pages

						history.pushState( { mxThemeNewsPage: this.current_page },"",'#page-' + this.current_page )

						return

					}

					this.current_page = get_page

					return

				} else {

					this.current_page = 1

					history.pushState( { mxThemeNewsPage:'1' },"",'#page-1' )

				}

			}

		},

		checkError() {

			setTimeout( () => {

				if( this.error ) {

					console.warn( this.error )

				}

			}, 1000 )

		}

	},
	watch: {

		number_news() {

			this.getCurrentPage()

			this.getItems()
		
			this.checkError()

		}

	},
	mounted() {
		
		this.getNumberNews()

	}

}
</script>