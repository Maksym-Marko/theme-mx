<template>
	<main class="mx-page-with-sidebar mx-site-main container-fluid">

		<div class="row">
			
			<div class="col-md-8">

				<article :id="'page-' + the_post.id">
				
					<header class="entry-header">

						<h1
							class="entry-title"
							v-if="the_post.title"
							v-html="the_post.title.rendered"
						>
						</h1>

						<div class="entry-meta">
							
							<time
								class="entry-date published"
								:datetime="the_post.modified_gmt">
								{{ the_post.date }}
							</time>

						</div>

					</header>

					<div class="mx-thumbnail"
						v-if="the_post.thumbnails.full"
					>

						<img :src="the_post.thumbnails.medium" alt="" />

					</div>

					<div
						class="mx-the-content"
						v-if="the_post.content"
						v-html="the_post.content.rendered"
					></div>

				</article>
				
			</div>

			<div class="col-md-4">
				
				<Sidebar
						v-if="mx_data"
						:mx_data="mx_data"
						:id="'sidebar-1'"
					/>

			</div>

		</div>		

	</main>
</template>

<script>

import Sidebar from './sidebars/Sidebar.vue'

const axios = require('axios')

export default {

	name: 'PageWithSidebar',
	components: {
		Sidebar
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
				error: null
			}
		},
		methods: {

			/*
			* Get Page content
			*/
			async getPageContent() {

				const _this = this

				let rest_route = this.mx_data.rest_url + 'wp/v2/pages/' + this.mx_data.post_id

				try {

					let res = await axios.get( rest_route );

					_this.the_post = res.data

				} catch (err) {

					_this.error = err.response.data.message

					console.error( err.response.data );

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

			this.getPageContent()

			this.checkError()
			
		}

}
</script>