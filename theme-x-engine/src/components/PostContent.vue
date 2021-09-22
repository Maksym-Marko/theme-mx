<template>
	<main class="mx-post-body mx-site-main">

		<div
			v-if="!error"
		>

			<PostItem
				:the_post="the_post"
			/>

			<PostNavigation
				v-if="navigation.prev_post || navigation.next_post"
				:navigation="navigation"
				@go_to_post="setNewPost"
			/>			

		</div>
		<div
			v-else
		>
			<p class="mx-error">
				{{ error }}
			</p>
		</div>

	</main>
</template>

<script>
	import PostItem from './post/PostItem.vue'
	import PostNavigation from './post/PostNavigation.vue'

	export default {

		name: 'PostContent',
		components: {
			PostItem,
			PostNavigation
		},
		props: {
			mx_data: {
				type: Object,
				required: true
			}
		},
		data() {
			return {
				the_post: {
					thumbnails: {
						full: null,
						medium: null,
						thumbnail: null,
						large: null
					}
				},
				navigation: {
					next_post: null,
					prev_post: null
				},
				error: null
			}
		},
		methods: {

			setNewPost( post_data ) {

				this.getPostContent( post_data.ID, post_data.post_type )

				this.getPostNavigation( post_data.ID, post_data.post_type )

			},

			/*
			* Get Post Navigation
			*/
			getPostNavigation( post_id = null, post_type = null ) {

				if( this.mx_data.posts_navigation === 'enable' ) {

					let data = {
						action: 'mx_get_post_navigation',
						nonce: this.mx_data.nonce,
						extra: '&post_id=' + this.mx_data.post_id + '&post_type=' + this.mx_data.post_type
					}

					if( post_id !== null &&  post_type !== null ) {

						data = {
							action: 'mx_get_post_navigation',
							nonce: this.mx_data.nonce,
							extra: '&post_id=' + post_id + '&post_type=' + post_type
						}

					}

					this.ajaxRequestNavigation( this.mx_data.ajax_url, data )

				}

			},

			/*
			* AJAX Request. Post Navigation
			*/
			ajaxRequestNavigation( ajax_url, data ) {

				const _this = this

				let xhr = new XMLHttpRequest()

				xhr.open( "POST", ajax_url, true )

				xhr.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded;charset=UTF-8" )

				xhr.onreadystatechange = function() {

					if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {

						if( _this.isJSON( this.responseText ) ) {

							_this.navigation = JSON.parse( this.responseText )

							_this.error = null

						} else {

							_this.error = 'Something went wrong with Post content getting!'

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
			* Get Post content
			*/
			getPostContent( post_id = null, post_type = null ) {

				let data = {
					action: 'mx_get_post_content',
					nonce: this.mx_data.nonce,
					extra: '&post_id=' + this.mx_data.post_id + '&post_type=' + this.mx_data.post_type
				}

				if( post_id !== null &&  post_type !== null ) {

					data = {
						action: 'mx_get_post_content',
						nonce: this.mx_data.nonce,
						extra: '&post_id=' + post_id + '&post_type=' + post_type
					}

				}

				this.ajaxRequest( this.mx_data.ajax_url, data )

			},

			/*
			* AJAX Request. Get Post
			*/
			ajaxRequest( ajax_url, data ) {

				const _this = this

				let xhr = new XMLHttpRequest()

				xhr.open( "POST", ajax_url, true )

				xhr.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded;charset=UTF-8" )

				xhr.onreadystatechange = function() {

					if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {

						if( _this.isJSON( this.responseText ) ) {

							_this.the_post = JSON.parse( this.responseText )

							_this.error = null

						} else {

							_this.error = 'Something went wrong with Post content getting!'

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

			// Get Post Content
			this.getPostContent()

			// Get Post Navigation
			this.getPostNavigation()
			
		}

	}
</script>