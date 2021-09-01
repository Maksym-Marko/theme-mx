<template>
  
  <!-- post type "page" ... -->

    <!-- templates ... -->
    
      <!-- default ... -->
      <div
        v-if="mx_data.page_template === 'default'"
      >
        <PageContent
          v-if="mx_data && mx_data.post_type === 'page'"
          :mx_data="mx_data"
        />
      </div>      
      <!-- ... default -->

      <!-- news ... -->
      <div
        v-if="mx_data.page_template === 'news'"
      >
        <NewsContent 
          v-if="mx_data"
          :mx_data="mx_data"
        />
      </div>      
      <!-- ... news -->

    <!-- ... templates -->

  <!-- ... post type "page" -->

  <!-- post type "post" -->
  <PostContent
    v-if="mx_data && mx_data.post_type === 'post'"
    :mx_data="mx_data"
  />

  

</template>

<script>

import PageContent from './components/PageContent.vue'
import PostContent from './components/PostContent.vue'
import NewsContent from './components/NewsContent.vue'

export default {
  name: 'App',
  components: {
    PageContent,
    PostContent,
    NewsContent
  },
  data() {
    return {
      templates: ['news'],
      mx_data: {
        post_type: null,
        page_template: 'default'
      }
    }
  },
  methods: {

    /*
    * Set mx_data
    */
    setMxData() {

      let theme_data = {}

      if( typeof window.theme_mx_data !== "undefined" ) {

        theme_data = window.theme_mx_data

      }

      this.mx_data = theme_data

      // check templates
      this.checkTemplate()      

    },

    /*
    * Check template
    */
    checkTemplate() {

      if( ! this.templates.includes( this.mx_data.page_template ) ) {

        // message to consol
        console.warn( '"' + this.mx_data.page_template + '" is unregistered template. Go to App.vue file and place in your template to the "templates" array.' )

        this.mx_data.page_template = 'default'

      }

    }

  },
  mounted() {

    // Set mx_data
    this.setMxData()

  }
}
</script>
