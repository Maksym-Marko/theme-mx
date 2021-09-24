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

	const axios = require('axios')

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
					thumbnails: {}
				},
				navigation: {
					next_post: null,
					prev_post: null
				},
				error: null,
				res: null
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
			async getPostNavigation( post_id = null, post_type = null ) {

				if( this.mx_data.posts_navigation === 'enable' ) {

					const _this = this

					let rest_route = this.mx_data.rest_url + 'theme_mx/v1/navigation/post_type=' + this.mx_data.post_type + '/post_id=' + this.mx_data.post_id

					if( post_id !== null && post_type !== null ) {

						rest_route = this.mx_data.rest_url + 'theme_mx/v1/navigation/post_type=' + post_type + '/post_id=' + post_id

					}

					try {

						let res = await axios.get( rest_route );

						_this.navigation = res.data

					} catch (err) {

						_this.error = err.response.data.message

						console.error( err.response.data );

					}

				}

			},

			/*
			* Get Post content
			*/
			async getPostContent( post_id = null, post_type = null ) {

				const _this = this

				let post_anchor = 'posts';

				if( this.mx_data.post_type !== 'post' ) {

					post_anchor = this.mx_data.post_type

				}				

				let rest_route = this.mx_data.rest_url + 'wp/v2/' + post_anchor + '/' + this.mx_data.post_id

				if( post_id !== null &&  post_type !== null ) {

					if( post_type !== 'post' ) {

						post_anchor = post_type

					}

					rest_route = this.mx_data.rest_url + 'wp/v2/' + post_anchor + '/' + post_id

				}

				try {

					let res = await axios.get( rest_route );

					_this.the_post = res.data

				} catch (err) {

					_this.error = err.response.data.message

					console.error( err.response.data );

				}

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