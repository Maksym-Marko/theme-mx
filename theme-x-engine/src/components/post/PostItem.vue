<template>

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

</template>

<script>
export default {

	name: 'PostItem',
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