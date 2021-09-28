<template>

  <nav 
    v-if="menu_to_show"
    class="navbar navbar-expand-lg"
  >

     <ul
        class="navbar-nav mr-auto flex-center"
      >
        
        <li
          class="nav-item"
          v-for="item in displayParentItems( menu_to_show )"
          :class="[item.children[0] ? 'dropdown' : '']"
          :key="item.ID"
          :id="'mx-footer-menu-item-' + item.ID"
        >
          
          <a
            class="nav-link text-light"
            :href="item.url"
          >{{ item.title }}</a>

        </li>

      </ul>
    
  </nav>

</template>

<script>

export default {

	name: 'FooterMenu1',
	props: {
		menu: {
			type: Object,
			required: true
		}
	},
	data() {

		return {

      menu_to_show: null

		}

	},
	methods: {

    displaySubItems( menu, parentId ) {

      return menu.filter( ( item ) => {

        return item.menu_item_parent !== '0' && parentId === parseInt( item.menu_item_parent )

      } ) 

    },

    displayParentItems( menu ) {

      return menu.filter( ( item ) => {

        return item.menu_item_parent === '0'

      } )    

    },

    prepareMenu() {

      this.menu_to_show = this.menu

      const _this = this

      this.menu_to_show.map( ( value ) => {

        value.children = []

        if( value.menu_item_parent !== '0' ) {

          _this.menu_to_show.map( ( item, index ) => {

            if( item.ID === parseInt( value.menu_item_parent ) ) {

              _this.menu_to_show[index]['children'].push( value.ID )

            }

          } )

        }

      } )

    }

	},

  watch: {

    menu_to_show() {

      // console.log( this.menu_to_show )

    }

  },
	mounted() {

    this.prepareMenu()

	}

}
</script>