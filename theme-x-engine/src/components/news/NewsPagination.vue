<template>
	
	<ul
		v-if="this.pages > 1"
		class="mx-news-pagination"
	>
		<li
			v-if="current_page !== 1"
		>
			<a 
				href="#"
				@click.prevent="toPrevPage"
			>Prev</a>
		</li>
		<li
			v-for="page in pages"
			:key="page"
			:class="[current_page === page ? 'active' : '']"
		>
			<a
				:href="page"
				@click.prevent="goToPage( page )"
			>{{ page }}</a>
		</li>
		
		<li
			v-if="pages !== current_page"
		>
			<a
				href="#"
				@click.prevent="toNextPage"
			>Next</a>
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
			},
			current_page: {
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

			toNextPage() {

				let next_page = this.current_page + 1

				this.$emit( 'to_page', next_page )

				history.pushState( { mxThemeNewsPage: next_page },"",'#page-' + next_page )

			},

			toPrevPage() {

				let prev_page = this.current_page - 1

				this.$emit( 'to_page', prev_page )

				history.pushState( { mxThemeNewsPage: prev_page },"",'#page-' + prev_page )

			},

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

		}

	}
</script>