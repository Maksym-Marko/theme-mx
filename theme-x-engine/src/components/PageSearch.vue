<template>
	<main class="mx-page-search mx-site-main">

		<SearchForm
			@search_string="getResult"
			:search_str="search_str"
		/>

		<SearchResults
			v-for="post in posts"
			:post="post"
			:key="post.ID"
		/>

	</main>
</template>

<script>

import SearchForm from './search/SearchForm.vue'
import SearchResults from './search/SearchResults.vue'

const axios = require('axios')

export default {

	name: 'PageSearch',
	components: {
		SearchForm,
		SearchResults
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
			search_str: ''
		}
	},
	methods: {

		getResult( string ) {

			this.getSearchResultCount( string )

			this.getSearchResult( string )

		},

		async getSearchResult( string ) {

			if( string ) {

				const _this = this

				let rest_route = this.mx_data.rest_url + 'theme_mx/v1/search/string=' + string

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
	mounted() {

		this.setSearchResultByDefault()

		this.checkError()
		
	}

}
</script>