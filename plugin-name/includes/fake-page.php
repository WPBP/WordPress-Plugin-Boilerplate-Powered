<?php

// Based on https://coderwall.com/p/fwea7g

if ( !class_exists( 'Fake_Page' ) ) {

	/**
	 * Fake_Page
	 * @author Ohad Raz
	 * @since 0.1
	 * Class to create pages "On the FLY"
	 * Usage: 
	 *   $args = array(
	 *       'slug' => 'fake_slug',
	 *       'post_title' => 'Fake Page Title',
	 *       'post content' => 'This is the fake page content'
	 *   );
	 *   new Fake_Page($args);
	 */
	class Fake_Page {

		public $slug = '';
		public $args = array();

		/**
		 * __construct
		 * <a href="/param">@param</a> array $arg post to create on the fly
		 * @author Ohad Raz 
		 * 
		 */
		function __construct( $args ) {
			add_filter( 'the_posts', array( $this, 'fly_page' ) );
			$this->args = $args;
			$this->slug = $args[ 'slug' ];
		}

		/**
		 * fly_page 
		 * the Money function that catches the request and returns the page as if it was retrieved from the database
		 * <a href="/param">@param</a>  array $posts 
		 * @return array 
		 * @author Ohad Raz
		 */
		public function fly_page( $posts ) {
			global $wp, $wp_query;
			$page_slug = $this->slug;

			//check if user is requesting our fake page
			if ( count( $posts ) == 0 && (strtolower( $wp->request ) == $page_slug || $wp->query_vars[ 'page_id' ] == $page_slug) ) {
				//create a fake post
				$post = new stdClass;
				$post->post_author = 1;
				$post->post_name = $page_slug;
				$post->guid = get_bloginfo( 'wpurl' . '/' . $page_slug );
				$post->post_title = 'page title';
				$post->post_content = "Fake Content";
				$post->ID = '-' . rand();
				$post->post_status = 'static';
				$post->comment_status = 'closed';
				$post->ping_status = 'closed';
				$post->comment_count = 0;
				//dates may need to be overwritten if you have a "recent posts" widget or similar - set to whatever you want
				$post->post_date = current_time( 'mysql' );
				$post->post_date_gmt = current_time( 'mysql', 1 );

				$post = ( object ) array_merge( ( array ) $post, ( array ) $this->args );
				$posts = NULL;
				$posts[] = $post;

				$wp_query->is_page = true;
				$wp_query->is_singular = true;
				$wp_query->is_home = false;
				$wp_query->is_archive = false;
				$wp_query->is_category = false;
				$wp_query->is_404 = false;
				unset( $wp_query->query[ "error" ] );
				$wp_query->query_vars[ "error" ] = "";
				$wp_query->found_posts = 1;
				$wp_query->post_count = 1;
				$wp_query->comment_count = 0;
				$wp_query->current_comment = null;
				$wp_query->queried_object = $post;
				$wp_query->queried_object_id = $post->ID;
				$wp_query->current_post = $post->ID;
			}

			return $posts;
		}

	}

	//end class
}//end if