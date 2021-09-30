<template>

	<article :id="'search-result-id-' + post.ID">
				
		<header class="entry-header">

			<h1
				class="entry-title"
				v-if="post.post_title"				
			>
				<a
					:href="post.permalink"
					v-html="post.post_title"
				></a>
			</h1>

			<div class="entry-meta">
				
				<time
					class="entry-date published"
					:datetime="post.post_date">
					{{ post.post_date }}
				</time>

			</div>

		</header>

		<div class="mx-thumbnail"
			v-if="post.thumbnails.full"
		>

			<img :src="post.thumbnails.medium" alt="" />

		</div>

		<div
			class="mx-the-content"
			v-if="post.excerpt"
			v-html="post.excerpt"
		></div>

	</article>

</template>

<script>
export default {

	name: 'SearchResults',
	props: {
		post: {
			tyep: Object,
			required: true
		}
	}

}
</script>