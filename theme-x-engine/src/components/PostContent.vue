<template>
	<main class="mx-post-body mx-site-main">

		<div
			v-if="!error"
		>
			
			<article :id="'post-' + the_post.ID">
				
				<header class="entry-header">

					<h1
						class="entry-title"
						v-html="the_post.post_title"
					>
					</h1>

					<div class="entry-meta">
						
						<div
							v-if="parseInt( the_post.get_the_time ) !== parseInt( the_post.get_the_modified_time )"
						>

							<time class="entry-date published" :datetime="the_post.post_date_date_w3c">
								{{ the_post.get_the_date }}
							</time>
							<time class="updated" :datetime="the_post.get_the_modified_date_date_w3c">
								{{ the_post.get_the_modified_date }}
							</time>
							
						</div>
						<div
							v-else
						>
						
							<time
								class="entry-date published updated"
								:datetime="the_post.post_date_date_w3c">
								{{ the_post.get_the_date }}
							</time>

						</div>

					</div>

				</header>

				<div class="mx-thumbnail"
					v-if="the_post.thumbnails.full"
				>

					<img :src="the_post.thumbnails.medium" alt="" />

				</div>

				<div
					class="mx-the-content"
					v-if="the_post.post_content"
					v-html="the_post.post_content"
				></div>

			</article>

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
	export default {

		name: 'PostContent',
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
				error: null
			}
		},
		methods: {

			/*
			* Get Page content
			*/
			getPostContent() {

				let data = {
					action: 'mx_get_post_content',
					nonce: this.mx_data.nonce,
					extra: '&post_id=' + this.mx_data.post_id + '&post_type=' + this.mx_data.post_type
				}

				this.ajaxRequest( this.mx_data.ajax_url, data )

			},

			/*
			* AJAX Request
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

			this.getPostContent()
			
		}

	}
</script>