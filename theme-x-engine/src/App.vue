<template>
  
  <!-- post type "page" -->
  <PageContent
    v-if="mx_data && mx_data.post_type === 'page'"
    :mx_data="mx_data"
  />

  <!-- post type "post" -->
  <PostContent
    v-if="mx_data && mx_data.post_type === 'post'"
    :mx_data="mx_data"
  />

</template>

<script>

import PageContent from './components/PageContent.vue'
import PostContent from './components/PostContent.vue'

export default {
  name: 'App',
  components: {
    PageContent,
    PostContent
  },
  data() {
    return {
      mx_data: {
        post_type: null
      }
    }
  },
  methods: {

    /*
    * Set mx_data
    */
    set_mx_data() {

      let theme_data = {}

      if( typeof window.theme_mx_data !== "undefined" ) {

        theme_data = window.theme_mx_data

      }

      this.mx_data = theme_data

    }

  },
  watch: {
    // mx_data() {
    //   console.log( this.mx_data )
    // }
  },
  mounted() {

    // Set mx_data
    this.set_mx_data()

  }
}
</script>
