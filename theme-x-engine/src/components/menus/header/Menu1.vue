<template>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <a class="navbar-brand" href="/">Theme MX</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul
        class="navbar-nav mr-auto"
        v-if="menu_to_show"
      >

        <li
          class="nav-item"
          v-for="item in displayParentItems( menu_to_show )"
          :class="[item.children[0] ? 'dropdown' : '']"
          :key="item.ID"
          :id="'mx-menu-item-' + item.ID"
        >

          <a 
            v-if="! item.children[0]"
            class="nav-link"
            :href="item.url"
          >{{ item.title }}</a>
          <a
            v-else
            class="nav-link dropdown-toggle"
            :href="item.url"
            id="navbarDropdown"
            role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            {{ item.title }}
          </a>

          <div 
            v-if="item.children[0]"
            class="dropdown-menu"
            aria-labelledby="navbarDropdown"
          >
            <a
              v-for="subitem in displaySubItems( menu_to_show )"
              class="dropdown-item"
              :key="subitem.ID"
              :href="subitem.url"
            >{{ subitem.title }}</a>
          </div>

        </li>

      </ul>

    </div>

  </nav>

</template>

<script>

export default {

	name: 'Menu1',
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

    displaySubItems( menu ) {

      return menu.filter( ( item ) => {

        return item.menu_item_parent !== '0'

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

      console.log( this.menu_to_show )

    }

  },
	mounted() {

    this.prepareMenu()

	}

}
</script>