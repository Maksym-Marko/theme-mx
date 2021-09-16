<template>

  <div
    v-if="mx_data.ajax_url"
  >
  
    <!-- post type "page" ... -->
    <div
      v-if="! mx_data.is_single"
    >

      <!-- templates ... -->
      
        <!-- default ... -->
        <div
          v-if="mx_data.page_template === 'default'"
        >
          <PageContent
            v-if="mx_data"
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
    </div>
    <!-- ... post type "page" -->

    <div
      v-else
    >

      <!-- post type "post", CPT ... -->
      <PostContent
        v-if="mx_data.is_single"
        :mx_data="mx_data"
      />
      <!-- ... post type "post", CPT -->

    </div>    

  </div>
  <div
    v-else
  >
    <p class="mx-error">
      There is not an ajax url!
    </p>

  </div>

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
      templates: ['default', 'news'],
      mx_data: {
        post_type: null,
        page_template: 'default',
        is_single: false
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

      if( ! this.templates.includes( this.mx_data.page_template ) && this.mx_data.post_type === 'page' ) {

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
