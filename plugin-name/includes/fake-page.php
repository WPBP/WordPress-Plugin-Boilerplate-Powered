<?php

//Based on https://coderwall.com/p/fwea7g

if ( !class_exists( 'Fake_Page' ) ) {

    /**
     * Simple class that generate a fake page on the fly
     *
     * @package   Plugin_Name
     * @author    Ohad Raz & Mte90 <mte90net@gmail.com>
     * @license   GPL-2.0+
     * @copyright 2014 
     */
    class Fake_Page {

        public $slug = '';
        public $args = array();

        /**
         * __construct<br>
         * initialize the Fake Page
         * @param array $args
         * @author Ohad Raz 
         * 
         */
        function __construct( $args ) {
            add_filter( 'the_posts', array( $this, 'fake_page_filter' ) );
            $this->args = $args;
            $this->slug = $args[ 'slug' ];
        }

        /**
         * fake_page_filter<br>
         * Catches the request and returns the page as if it was retrieved from the database
         * @param  array $posts 
         * @return array 
         * @author Ohad Raz & Mte90
         */
        public function fake_page_filter( $posts ) {
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

}