<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// extends page template class
class ThemeMXIndexTemplate extends ThemeMXPageTemplate
{

	public $pagination = false;

	public $posts_per_page = 10;

	public function __construct( $args = [] )
	{		

		parent::__construct( $args );

		if( get_option( 'posts_per_page' ) ) {

			$this->posts_per_page = get_option( 'posts_per_page' );

		}

		$this->setPaginagion( $args['pagination'] ?? false );

		$this->mx_expand_javascript_vars_pagination();

	}

	public function setPaginagion( $pagination = false )
	{

		// enable pagination
		if( isset( $pagination['enable'] ) AND $pagination['enable'] ) {

			$this->pagination = true;

		}
		
		// set posts per page
		if( isset( $pagination['posts_per_page'] ) ) {

			$this->posts_per_page = intval( $pagination['posts_per_page'] );

		}

	}

	/*
	* Expand Global JS variable
	*/
	public function mx_expand_javascript_vars_pagination()
	{

		$script = '<script>';

			$script .= 'window.theme_mx_data.pagination = {';

				$script .= '"enable":"' . $this->pagination . '",';
				$script .= '"posts_per_page":"' . $this->posts_per_page . '"';

			$script .= '};';

		$script .= '</script>';

		array_push( $this->expand_javascript_vars, $script );

	}

}

/*
* Set AJAX actions
*/
// get news
if ( ! function_exists( 'mx_get_news_func' ) ) :

	add_action( 'wp_ajax_mx_get_news', 'mx_get_news_func' );

	add_action( 'wp_ajax_nopriv_mx_get_news', 'mx_get_news_func' );

	function mx_get_news_func() {

		// Check out if POST nonce is not empty
		if( empty( $_POST['nonce'] ) ) wp_die( '0' );

		// Check out if nonce's matched
		if( wp_verify_nonce( $_POST['nonce'], 'theme_mx_get_content_nonce' ) ) {

			$limit = 10;

			if( isset( $_POST['limit'] ) ) {

				$limit = esc_attr( $_POST['limit'] );

			}

			// current page
			$current_page = 1;

			if( isset( $_POST['current_page'] ) ) {

				$current_page = esc_attr( $_POST['current_page'] );

			}

			$current_page = intval( $current_page );

			$limit = intval( $limit );

			$current_page = ( $current_page * $limit ) - $limit;

			$post_type = 'post';

			if( isset( $_POST['post_type'] ) ) {

				$post_type = sanitize_text_field( $_POST['post_type'] );

			}

			global $wpdb;

			$posts_table = $wpdb->prefix . 'posts';

			$sql_str = "SELECT ID, post_title, post_date, post_title, post_content, post_excerpt
				FROM $posts_table
				WHERE post_type = '$post_type'
					AND post_status = 'publish'
				ORDER BY post_date DESC
				LIMIT $current_page, $limit";

			$results = $wpdb->get_results( $sql_str, ARRAY_A );

			if( $results ) {

				foreach ( $results as $key => $value ) {

					$post_id = $value['ID'];

					// post thumbnails ...
					$results[$key]['thumbnails'] = [];

					$the_thumbnail_full = get_the_post_thumbnail_url( $post_id );

					if( $the_thumbnail_full ) {

						// full
						$results[$key]['thumbnails']['full'] = $the_thumbnail_full;
						
						// thumbnail
						$the_thumbnail_thumbnail = get_the_post_thumbnail_url( $post_id, 'thumbnail' );

						$results[$key]['thumbnails']['thumbnail'] = $the_thumbnail_thumbnail;

						// medium
						$the_thumbnail_medium = get_the_post_thumbnail_url( $post_id, 'medium' );

						$results[$key]['thumbnails']['medium'] = $the_thumbnail_medium;

						// large
						$the_thumbnail_large = get_the_post_thumbnail_url( $post_id, 'large' );

						$results[$key]['thumbnails']['large'] = $the_thumbnail_large;

					}

					// ... post thumbnails

					// the permalink ...
					$url = get_the_permalink( $post_id );

					if( $url ) {

						$results[$key]['permalink'] = $url;

					}
					// ... the permalink

					// categories ...
					$categories = get_the_category( $post_id );

					if( $categories ) {

						$results[$key]['categories'] = $categories;

					}
					// ... categories

					// tags ...
					$tags = get_the_tags( $post_id );

					if( $tags ) {

						$results[$key]['tags'] = $tags;

					}
					// ... tags

					// excerpt ...
					$results[$key]['post_excerpt'] = get_the_excerpt( $post_id );
					// ... excerpt

					// time ...
					$results[$key]['get_the_time'] = get_the_time( 'U', $post_id );

					$results[$key]['get_the_modified_time'] = esc_attr( get_the_modified_time( 'U', $post_id ) );
					
					// %1$s
					$results[$key]['post_date_date_w3c'] = esc_attr( get_the_date( DATE_W3C, $post_id ) );

					// %2$s
					$results[$key]['get_the_date'] = esc_html( get_the_date( '', $post_id ) );

					// %3$s
					$results[$key]['get_the_modified_date_date_w3c'] = esc_attr( get_the_modified_date( DATE_W3C, $post_id ) );

					// %4$s
					$results[$key]['get_the_modified_date'] = esc_html( get_the_modified_date( '', $post_id ) );				
					// ... time 

				}			

				echo json_encode( $results );

			} else {

				echo 'error';

			}

		}

		wp_die();

	}

endif;

// get number of news
if ( ! function_exists( 'mx_get_number_news_func' ) ) :

	add_action( 'wp_ajax_mx_get_number_news', 'mx_get_number_news_func' );

	add_action( 'wp_ajax_nopriv_mx_get_number_news', 'mx_get_number_news_func' );

	function mx_get_number_news_func()
	{

		// Check out if POST nonce is not empty
		if( empty( $_POST['nonce'] ) ) wp_die( '0' );

		// Check out if nonce's matched
		if( wp_verify_nonce( $_POST['nonce'], 'theme_mx_get_content_nonce' ) ) {

			$post_type = 'post';

			if( isset( $_POST['post_type'] ) ) {

				$post_type = sanitize_text_field( $_POST['post_type'] );

			}

			global $wpdb;

			$posts_table = $wpdb->prefix . 'posts';

			$number_posts = $wpdb->get_var(
				"SELECT COUNT(ID)
					FROM $posts_table
					WHERE post_type = '$post_type'
					AND post_status = 'publish'
				"
			);

			echo $number_posts;

		}

		wp_die();

	}

endif;