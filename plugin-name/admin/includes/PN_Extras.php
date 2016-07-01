<?php

/**
 * This class contain all the snippet or extra that improve the experience on the backend
 *
 * @package   Plugin_name
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2016 Your Name or Company Name
 */
class Pn_Extras {

    /**
     * Initialize the snippet
     */
    function __construct() {
        $plugin = Plugin_Name::get_instance();
        $this->cpts = $plugin->get_cpts();

        // At Glance Dashboard widget for your cpts
        add_filter( 'dashboard_glance_items', array( $this, 'cpt_glance_dashboard_support' ), 10, 1 );
        // Activity Dashboard widget for your cpts
        add_filter( 'dashboard_recent_posts_query_args', array( $this, 'cpt_activity_dashboard_support' ), 10, 1 );
        // Add bubble notification for cpt pending
        add_action( 'admin_menu', array( $this, 'pending_cpt_bubble' ), 999 );
    }

    /**
     * Add the counter of your CPTs in At Glance widget in the dashboard<br>
     * NOTE: add in $post_types your cpts, remember to edit the css style (admin/assets/css/admin.css) for change the dashicon<br>
     *
     *        Reference:  http://wpsnipp.com/index.php/functions-php/wordpress-post-types-dashboard-at-glance-widget/
     *
     * @since    1.0.0
     * @return array
     */
    public function cpt_glance_dashboard_support( $items = array() ) {
        $post_types = $this->cpts;
        foreach ( $post_types as $type ) {
            if ( !post_type_exists( $type ) ) {
                continue;
            }
            $num_posts = wp_count_posts( $type );
            if ( $num_posts ) {
                $published = intval( $num_posts->publish );
                $post_type = get_post_type_object( $type );
                $text = _n( '%s ' . $post_type->labels->singular_name, '%s ' . $post_type->labels->name, $published, PN_TEXTDOMAIN );
                $text = sprintf( $text, number_format_i18n( $published ) );
                if ( current_user_can( $post_type->cap->edit_posts ) ) {
                    $items[] = '<a class="' . $post_type->name . '-count" href="edit.php?post_type=' . $post_type->name . '">' . sprintf( '%2$s', $type, $text ) . "</a>\n";
                } else {
                    $items[] = sprintf( '%2$s', $type, $text ) . "\n";
                }
            }
        }
        return $items;
    }

    /**
     * Add the recents post type in the activity widget<br>
     * NOTE: add in $post_types your cpts
     *
     * @since    1.0.0
     * @return array
     */
    function cpt_activity_dashboard_support( $query_args ) {
        if ( !is_array( $query_args[ 'post_type' ] ) ) {
            // Set default post type
            $query_args[ 'post_type' ] = array( 'page' );
        }
        $query_args[ 'post_type' ] = array_merge( $query_args[ 'post_type' ], $this->cpts );
        return $query_args;
    }

    /**
     * Bubble Notification for pending cpt<br>
     * NOTE: add in $post_types your cpts<br>
     *
     *        Reference:  http://wordpress.stackexchange.com/questions/89028/put-update-like-notification-bubble-on-multiple-cpts-menus-for-pending-items/95058
     *
     * @since    1.0.0
     * @return void
     */
    function pending_cpt_bubble() {
        global $menu;

        $post_types = $this->cpts;
        foreach ( $post_types as $type ) {
            if ( !post_type_exists( $type ) ) {
                continue;
            }
            // Count posts
            $cpt_count = wp_count_posts( $type );

            if ( $cpt_count->pending ) {
                // Menu link suffix, Post is different from the rest
                $suffix = ( 'post' == $type ) ? '' : '?post_type=' . $type;

                // Locate the key of 
                $key = self::recursive_array_search_php( 'edit.php' . $suffix, $menu );

                // Not found, just in case 
                if ( !$key ) {
                    return;
                }

                // Modify menu item
                $menu[ $key ][ 0 ] .= sprintf(
                        '<span class="update-plugins count-%1$s"><span class="plugin-count">%1$s</span></span>', $cpt_count->pending
                );
            }
        }
    }

    /**
     * Required for the bubble notification<br>
     *
     *        Reference:  http://wordpress.stackexchange.com/questions/89028/put-update-like-notification-bubble-on-multiple-cpts-menus-for-pending-items/95058
     *
     * @since    1.0.0
     * @param array $needle
     * @param array $haystack
     * 
     * @return mixed
     */
    private function recursive_array_search_php( $needle, $haystack ) {
        foreach ( $haystack as $key => $value ) {
            $current_key = $key;
            if ( $needle === $value OR ( is_array( $value ) && self::recursive_array_search_php( $needle, $value ) !== false) ) {
                return $current_key;
            }
        }
        return false;
    }

    /**
     * This method contain an example of code for caching a transient with an external request and parse the results.
     * 
     * @return void
     */
    public function transient_caching_example() {
        $key = 'siteapi_json_transient';

        // Let's see if we have a cached version
        $json_output = get_transient( $key );
        if ( $json_output === false || empty( $json_output ) ) {
            // If there's no cached version we ask 
            $response = wp_remote_get( "http://www.siteapi.org/api/v1/projects?page=1" );
            if ( is_wp_error( $response ) ) {
                // In case API is down we return the last successful count
                return;
            } else {
                // If everything's okay, parse the body and json_decode it
                $json_output = json_decode( wp_remote_retrieve_body( $response ) );

                // Store the result in a transient, expires after 1 day
                // Also store it as the last successful using update_option
                set_transient( $key, $json_output, DAY_IN_SECONDS );
                update_option( $key, $json_output );
            }
        }

        echo '<div class="siteapi-bridge-container">';
        foreach ( $json_output->projects as &$value ) {
            echo '<div class="siteapi-bridge-single">';
            //json_output is an object so use -> to call children
            echo '</div>';
        }
        echo '</div>';
    }

}

new Pn_Extras();
