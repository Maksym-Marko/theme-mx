<template>

	<main class="mx-archive mx-site-main">

		<header
			v-if="archive.archive_title"
			class="page-header"
		>

			<h1 class="page-title">Archives: <span>{{ archive.archive_title }}</span></h1>

			<div
				v-if="archive.archive_description"
				class="archive-description"
			>
				<p>{{ archive.archive_description }}</p>
			</div>

		</header>

		<NewsItem
			v-for="post in posts"
			:key="post.ID"
			:the_post="post"
		/>

		<NewsPagination
			v-if="mx_data.pagination.enable"
			:pagination="mx_data.pagination"
			:number_news="number_news"
			:current_page="current_page"
			@to_page="setPage"
		/>

	</main>

</template>

<script>
import NewsItem from './news/NewsItem.vue'
import NewsPagination from './news/NewsPagination.vue'

export default {

	name: 'ArchiveContent',
	components: {
		NewsItem,
		NewsPagination
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
			current_page: 1,
			archive: {
				archive_title: null,
				archive_description: null
			}
		}

	},
	methods: {

		/*
		* Get archive data
		*/
		getArchiveData() {

			let data = {
				action: 'mx_get_archive_data',
				nonce: this.mx_data.nonce,
				extra: '&post_id=' + this.mx_data.post_id + '&current_page=' + this.current_page + '&limit=' + this.mx_data.pagination.posts_per_page + '&post_type=' + this.mx_data.post_type
			}

			this.ajaxRequestArchiveData( this.mx_data.ajax_url, data )

		},

		/*
		* AJAX Request Archive Data
		*/
		ajaxRequestArchiveData( ajax_url, data ) {

			const _this = this

			let xhr = new XMLHttpRequest()

			xhr.open( "POST", ajax_url, true )

			xhr.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded;charset=UTF-8" )

			xhr.onreadystatechange = function() {

				if ( this.readyState === XMLHttpRequest.DONE && this.status === 200 ) {

					if( _this.isJSON( this.responseText ) ) {

						_this.archive = JSON.parse( this.responseText )

						_this.error = null

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

		/*
		* Set page
		*/
		setPage( page ) {

			this.current_page = page

			this.getNews()

		},

		/*
		* Get news
		*/
		getNews() {

			let data = {
				action: 'mx_get_news',
				nonce: this.mx_data.nonce,
				extra: '&post_id=' + this.mx_data.post_id + '&current_page=' + this.current_page + '&limit=' + this.mx_data.pagination.posts_per_page + '&post_type=' + this.mx_data.post_type
			}

			this.ajaxRequestGetNews( this.mx_data.ajax_url, data )

		},

		/*
		* AJAX Request Get News
		*/
		ajaxRequestGetNews( ajax_url, data ) {

			const _this = this

			let xhr = new XMLHttpRequest()

			xhr.open( "POST", ajax_url, true )

			xhr.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded;charset=UTF-8" )

			xhr.onreadystatechange = function() {

				if ( this.readyState === XMLHttpRequest.DONE && this.status === 200 ) {

					if( _this.isJSON( this.responseText ) ) {

						_this.posts = JSON.parse( this.responseText )

						_this.error = null

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

		/*
		* Get Number of News
		*/
		getNumberNews() {

			let data = {
				action: 'mx_get_number_news',
				nonce: this.mx_data.nonce,
				extra: '&post_type=' + this.mx_data.post_type
			}

			this.ajaxRequestGetNumberNews( this.mx_data.ajax_url, data )

		},

		/*
		* AJAX Request Get Number of News
		*/
		ajaxRequestGetNumberNews( ajax_url, data ) {

			const _this = this

			let xhr = new XMLHttpRequest()

			xhr.open( "POST", ajax_url, true )

			xhr.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded;charset=UTF-8" )

			xhr.onreadystatechange = function() {

				if ( this.readyState === XMLHttpRequest.DONE && this.status === 200 ) {

					if( this.responseText ) {

						_this.number_news = parseInt( this.responseText )

						_this.error = null

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

		getCurrentPage() {

			let curretn_page = window.location.href

			if( curretn_page.indexOf( '#page-' ) >= 0 ) {

				let matches = curretn_page.match( /#page-(\d+)/ )

				let get_page = parseInt( matches[1] );

				if( Number.isInteger( get_page ) ) {

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

				}

			}

		},

		isJSON( str ) {
			try {
				JSON.parse(str);
			} catch (e) {
				return false;
			}
			return true;
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
		
			this.getNews()

			this.checkError()

		}

	},
	mounted() {

		this.getArchiveData()
		
		this.getNumberNews()

	}

}
</script>