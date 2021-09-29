<template>

	<!-- footer-menu-1 ... -->
	<FooterMenu1
		v-if="menus.footer_menu_1"
		:menu="menus.footer_menu_1"
	/>
	<!-- ... footer-menu-1 -->

</template>

<script>

import FooterMenu1 from './footer/FooterMenu1.vue'

const axios = require('axios')

export default {

	name: 'FooterMenus',
	components: {
		FooterMenu1
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
				footer_menu_1: null
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

					_this.menus.footer_menu_1 = res.data

				} catch (err) {

					_this.error = err.response.data.message

					console.error( err.response.data );

				}

			}

		}

	},
	mounted() {

		this.getMenu( 'footer-menu-1' )

	}

}
</script>