<template>

	<footer class="text-light bg-secondary mt-5">
		
		<div class="container">

			<!-- Footer menu ... -->
			<div class="row">

				<div class="col">

					<FooterMenus
						v-if="mx_data"
						:mx_data="mx_data"
					/>

				</div>

			</div>
			<!-- ... Footer menu -->
		
			<!-- Widgets ... -->
			<div class="row pt-5 pb-5">

				<div class="col-md-4">

					Lorem ipsum dolor sit amet consectetur adipisicing, elit. Ab minima mollitia, earum aperiam voluptates cumque iste vero voluptate odio. Aspernatur quas quia, illum recusandae id laborum. Nihil autem vitae iste!

				</div>

				<div class="col-md-4">

					Lorem ipsum dolor sit amet consectetur adipisicing, elit. Ab minima mollitia, earum aperiam voluptates cumque iste vero voluptate odio. Aspernatur quas quia, illum recusandae id laborum. Nihil autem vitae iste!

				</div>

				<div class="col-md-4">

					Lorem ipsum dolor sit amet consectetur adipisicing, elit. Ab minima mollitia, earum aperiam voluptates cumque iste vero voluptate odio. Aspernatur quas quia, illum recusandae id laborum. Nihil autem vitae iste!

				</div>

			</div>

		</div>
		<!-- ... Widgets -->

    </footer>

</template>

<script>

import FooterMenus from './menus/FooterMenus.vue'

export default {

	name: 'Footer',
	components: {
		FooterMenus
	},
	props: {
		mx_data: {
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


	}

}
</script>