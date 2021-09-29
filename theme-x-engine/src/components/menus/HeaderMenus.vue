<template>

	<!-- menu-1 ... -->
	<Menu1
		v-if="menus.menu_1"
		:menu="menus.menu_1"
	/>
	<!-- ... menu-1 -->

</template>

<script>

import Menu1 from './header/Menu1.vue'

const axios = require('axios')

export default {

	name: 'HeaderMenus',
	components: {
		Menu1
	},
	props: {
		mx_data: {
			type: Object,
			required: true
		}
	},
	data() {

		return {
			menus: {
				menu_1: null
			},
			error: null
		}

	},
	methods: {

		/*
		* Get Page content
		*/
		async getMenu( menu = null ) {

			if( menu ) {

				const _this = this

				let rest_route = this.mx_data.rest_url + 'theme_mx/v1/menus/' + menu

				try {

					let res = await axios.get( rest_route );

					_this.menus.menu_1 = res.data

				} catch (err) {

					_this.error = err.response.data.message

					console.error( err.response.data );

				}

			}			

		}

	},
	mounted() {

		this.getMenu( 'menu-1' )

	}

}
</script>