<template>

	<article :id="'post-' + the_post.ID">

		<header class="entry-header">

			<h1
				class="entry-title"
			>
				<a
					:href="the_post.permalink"
					v-html="the_post.post_title"
				></a>
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

		<div
			v-if="the_post.thumbnails.full"
			class="mx-post-thumbnail"
		>
			<img :src="the_post.thumbnails.medium" alt="" />
		</div>

		<div
			class="mx-the-excerpt"
			v-if="the_post.post_excerpt"
			v-html="the_post.post_excerpt"
		></div>

	</article>

</template>

<script>
export default {

	name: 'NewsItem',
	props: {
		the_post: {
			type: Object,
			required: true
		}
	},
	data() {

		return {

		}

	},
	methods: {

	},
	mounted() {

		// console.log( this.the_post )

	}

}
</script>