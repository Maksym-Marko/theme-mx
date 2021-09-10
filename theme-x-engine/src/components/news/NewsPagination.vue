<template>
	
	<ul class="mx-news-pagination">
		<li>
			<a href="#">Prev</a>
		</li>
		<li
			v-for="page in pages"
			:key="page"
		>
			<a
				:href="page"
				@click.prevent="goToPage( page )"
			>{{ page }}</a>
		</li>
		
		<li>
			<a href="#">Next</a>
		</li>
	</ul>

</template>

<script>
	export default {
		name: 'NewsPagination',
		props: {
			pagination: {
				type: Object,
				required: true
			},
			number_news: {
				type: Number,
				required: true
			}
		},
		data() {

			return {
				pages: 0
			}

		},
		methods: {

			goToPage( page ) {

				this.$emit( 'to_page', page )

				history.pushState( { mxThemeNewsPage: page },"",'#page-' + page )

			}

		},
		watch: {

			number_news() {

				let posts_per_page = parseInt( this.pagination.posts_per_page )

				this.pages = Math.ceil( this.number_news / posts_per_page )

			}		

		},
		mounted() {
			
		}
	}
</script>