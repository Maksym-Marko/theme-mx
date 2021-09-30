<template>

	<form
		@submit.prevent="searchResult"
	>
		<div class="form-row">

			<div class="col-md-4 mb-3">
				<label for="validationCustomUsername">Search Bar</label>
				<div class="input-group">				

					<input
						type="text"
						class="form-control"
						placeholder="Search ... "
						v-model="search"
					/>

					<div class="input-group-append">
						<input type="submit" value="Go" />
					</div>

				</div>
			</div>

		</div>		

	</form>

</template>

<script>
export default {

	name: 'SearchForm',
	props: {
		search_str: {
			type: String
		}
	},
	data() {

		return {
			search: null,
			timeout: null
		}

	},
	methods: {

		searchResult() {

			const _this = this

			clearTimeout( this.timeout )

			this.timeout = setTimeout( function() {

				_this.$emit( 'search_string', _this.search )

			}, 1000 )

		}

	},
	watch: {

		search() {

			this.searchResult();

		},

		search_str() {

			this.search = this.search_str

		}
	}

}
</script>