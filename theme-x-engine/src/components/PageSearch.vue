<template>
	<main class="mx-page-search mx-site-main">

		<SearchForm
			@search_string="getResult"
			:search_str="search_str"
		/>

		<div class="mx-result-count">
			Number of results: <strong>{{ number_results }}</strong>
		</div>

		<SearchResults
			v-for="post in posts"
			:post="post"
			:key="post.ID"
		/>

		<Pagination
			v-if="mx_data.pagination.enable"
			:pagination="mx_data.pagination"
			:number_news="number_results"
			:current_page="current_page"
			@to_page="setPage"
		/>

	</main>
</template>

<script>

import SearchForm from './search/SearchForm.vue'
import SearchResults from './search/SearchResults.vue'
import Pagination from './index/Pagination.vue'


const axios = require('axios')

export default {

	name: 'PageSearch',
	components: {
		SearchForm,
		SearchResults,
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
			error: null,
			posts: [],
			number_results: 0,
			current_page: 1,
			search_str: '',
			posts_per_page: 10
		}
	},
	methods: {

		/*
		* Set page
		*/
		setPage( page ) {

			this.current_page = page

			this.getSearchResult( this.search_str )

		},

		getResult( string ) {

			this.getSearchResultCount( string )

			this.getSearchResult( string )

		},

		async getSearchResult( string ) {

			if( this.search_str !== string ) {

				this.search_str = string

			}			

			if( string ) {

				const _this = this

				let rest_route = this.mx_data.rest_url + 'theme_mx/v1/search/string=' + string + '?page=' + this.current_page + '&per_page=' + this.mx_data.pagination.posts_per_page

				if( this.mx_data.search_post_type !== '' ) {

					rest_route = this.mx_data.rest_url + 'theme_mx/v1/search/string=' + string + '?page=' + this.current_page + '&per_page=' + this.mx_data.pagination.posts_per_page + '&post_type=' + this.mx_data.search_post_type

				}

				try {

					let res = await axios.get( rest_route );

					_this.posts = res.data

					_this.setUrl( string )

				} catch (err) {

					_this.error = err.response.data.message

					console.error( err.response.data );

				}

			} else {

				this.posts = []

				this.setUrl( string )

			}

		},

		async getSearchResultCount( string ) {

			if( string ) {

				const _this = this

				let rest_route = this.mx_data.rest_url + 'theme_mx/v1/search/string=' + string + '/count'

				if( this.mx_data.search_post_type !== '' ) {

					rest_route = this.mx_data.rest_url + 'theme_mx/v1/search/string=' + string + '/count?post_type=' + this.mx_data.search_post_type

				}

				try {

					let res = await axios.get( rest_route );

					_this.number_results = res.data

				} catch (err) {

					_this.error = err.response.data.message

					console.error( err.response.data );

				}

			} else {

				this.number_results = 0

				this.setUrl( string )

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

					let pages = Math.ceil( this.number_results / parseInt( this.mx_data.pagination.posts_per_page ) )

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


		setUrl( string ) {

			const state = { 'search': string }

			const title = null

			let url = new URL( window.location.href )

			url.searchParams.set( 's', string );

			history.pushState( state, title, url.href )

		},

		setSearchResultByDefault() {

			if( this.mx_data.search_str !== '' ) {

				this.search_str = this.mx_data.search_str

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

		number_results() {

			this.getCurrentPage()

			this.getSearchResult( this.search_str )

		}

	},
	mounted() {

		this.setSearchResultByDefault()

		this.checkError()
		
	}

}
</script>