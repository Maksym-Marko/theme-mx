<template>

	<header class="bg-light mb-5">

		<!-- Header menu ... -->
		<HeaderMenus 
			v-if="mx_data"
			:mx_data="mx_data"
		/>
		<!-- ... Header menu -->

	</header>

</template>

<script>

import HeaderMenus from './menus/HeaderMenus.vue'

export default {

	name: 'Header',
	components: {
		HeaderMenus
	},
	props: {
		mx_data: {
			type: Object,
			required: true
		}
	}

}
</script>