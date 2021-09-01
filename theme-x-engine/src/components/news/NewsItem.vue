<template>

	<article :id="'post' + post_content.ID">

		<header class="entry-header">

			<h1
				v-html="post_content.post_title"
				class="entry-title"
			></h1>

		</header>

		<div
			v-if="post_content.thumbnails.full"
			class="mx-post-thumbnail"
		>
			<img :src="post_content.thumbnails.medium" alt="">
		</div>

		

	</article>

</template>

<script>
export default {

	name: 'NewsItem',
	props: {
		post_content: {
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

		console.log( this.post_content )

	}

}
</script>