<template>

	<article :id="'post-' + the_post.id">
				
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
	watch: {
		the_post() {

			// console.log( this.the_post )
			
		}
	},
	mounted() {

		

	}

}
</script>