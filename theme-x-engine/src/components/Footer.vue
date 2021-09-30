<template>

	<footer class="text-light bg-secondary mt-5">
		
		<div class="container">

			<!-- Footer menu ... -->
			<div class="row">

				<div class="col border-bottom border-light">

					<FooterMenus
						v-if="mx_data"
						:mx_data="mx_data"
					/>

				</div>

			</div>
			<!-- ... Footer menu -->
		
			<!-- Widgets ... -->
			<div class="row pt-5 pb-5">
				
				<Sidebar
					v-if="mx_data"
					:mx_data="mx_data"
					:id="'footer-sidebar-1'"
				/>


				<Sidebar
					v-if="mx_data"
					:mx_data="mx_data"
					:id="'footer-sidebar-2'"
				/>

			</div>

		</div>
		<!-- ... Widgets -->

		<!-- Copyright ... -->
		<div class="mx-copyright footer-copyright text-center py-3 bg-dark">
			© 2021 Copyright:
			<a href="/" class="text-light"> ThemeMX</a>
		</div>
		<!-- Copyright ... -->

    </footer>

</template>

<script>

import FooterMenus from './menus/FooterMenus.vue'
import Sidebar from './sidebars/Sidebar.vue'

export default {

	name: 'Footer',
	components: {
		FooterMenus,
		Sidebar
	},
	props: {
		mx_data: {
			type: Object,
			required: true
		}
	}

}
</script>