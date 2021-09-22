<template>

	<!-- posts navigation -->
	<ul		
		class="mx-posts-navigation"
	>
		<li
			v-if="navigation.prev_post"
			class="mx-to-prev-post"
		>
			<a :href="navigation.prev_post.permalink"
				v-html="'&#8678; ' + navigation.prev_post.post_title"
				@click.prevent="goToPost( navigation.prev_post )"
			></a>
		</li>
		<li
			v-if="navigation.next_post"
			class="mx-to-next-post"
		>
			<a :href="navigation.next_post.permalink"
				v-html="navigation.next_post.post_title + ' &#8680;'"
				@click.prevent="goToPost( navigation.next_post )"
			></a>
		</li>
		
	</ul>

</template>

<script>
export default {

	name: 'PostNavigation',
	props: {
		navigation: {
			type: Object,
			required: true
		}
	},
	data() {

		return {

		}

	},
	methods: {

		goToPost( post_data ) {

			this.$emit( 'go_to_post', post_data )

			const state = { 'post_id': post_data.ID }

			const title = post_data.post_title

			const url = post_data.permalink

			history.pushState( state, title, url )

		}

	},
	mounted() {

		// console.log( this.navigation )

	}

}
</script>