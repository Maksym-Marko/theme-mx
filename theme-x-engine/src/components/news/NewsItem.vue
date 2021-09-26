<template>

	<article :id="'post-' + the_post.id">

		<header class="entry-header">

			<h1
				class="entry-title"
			>
				<a
					:href="the_post.link"
					v-html="the_post.title.rendered"
				></a>
			</h1>

			<div class="entry-meta">
					
				<time
					class="entry-date published"
					:datetime="the_post.modified_gmt">
					{{ the_post.date }}
				</time>

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
			v-if="the_post.excerpt"
			v-html="the_post.excerpt.rendered"
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