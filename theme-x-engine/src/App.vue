<template>

  <div
    class="mx-app-wrapper"
    v-if="mx_data.rest_url"
  >

  <!-- ******
            *
            * Header
            *
            ****** -->

  <Header 
    v-if="mx_data"
    :mx_data="mx_data"
  />

  <!-- ******
            *
            * Content
            *
            ****** -->
  
    <!-- post type "page" ... -->
    <div
      v-if="! mx_data.is_single"
      class="container"
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

        <!-- index ... -->
        <div
          v-if="mx_data.page_template === 'index'"
        >
          <IndexContent 
            v-if="mx_data"
            :mx_data="mx_data"
          />
        </div>
        <!-- ... index -->

        <!-- archive ... -->
        <div
          v-if="mx_data.page_template === 'archive'"
        >
          <ArchiveContent 
            v-if="mx_data"
            :mx_data="mx_data"
          />
        </div>      
        <!-- ... archive -->

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

        <!-- 404 ... -->
        <div
          v-if="mx_data.page_template === '404'"
        >

          <Page404Content 
            v-if="mx_data"
            :mx_data="mx_data"
          />

        </div>      
        <!-- ... 404 -->  

      <!-- ... templates -->
    </div>
    <!-- ... post type "page" -->

    <div
      v-else
      class="container"
    >

      <!-- post type "post", CPT ... -->
      <PostContent
        v-if="mx_data.is_single"
        :mx_data="mx_data"
      />
      <!-- ... post type "post", CPT -->

    </div>

    <!-- ******
              *
              * Footer
              *
              ****** -->

    <Footer 
      v-if="mx_data"
      :mx_data="mx_data"
    />    

  </div>
  <div
    v-else
  >
    <p class="mx-error">
      There is not an rest api url!
    </p>

  </div>

</template>

<script>

import Header from './components/Header.vue'

import PageContent from './components/PageContent.vue'
import PostContent from './components/PostContent.vue'
import IndexContent from './components/IndexContent.vue'
import NewsContent from './components/NewsContent.vue'
import ArchiveContent from './components/ArchiveContent.vue'
import Page404Content from './components/Page404Content.vue'

import Footer from './components/Footer.vue'

export default {
  name: 'App',
  components: {
    Header,
    PageContent,
    PostContent,
    IndexContent,
    NewsContent,
    ArchiveContent,
    Page404Content,
    Footer
  },
  data() {
    return {
      templates: [
        'default',
        'index',
        'archive',
        'news',
        'archive',
        '404'
      ],
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
