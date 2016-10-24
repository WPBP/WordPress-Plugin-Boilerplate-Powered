<?php

/**
 * This class contain the contextual help code.
 *
 * @package   Plugin_Name
 * @author    {{author_name}} <{{author_email}}>
 * @license   {{author_license}}
 * @link      {{author_url}}
 * @copyright {{author_copyright}}
 */
class Pn_ContextualHelp {

    /**
     * Initialize the Contextual Help
     */
    function __construct() {
        add_filter( 'wp_contextual_help_docs_dir', array( $this, 'help_docs_dir' ) );
        add_filter( 'wp_contextual_help_docs_url', array( $this, 'help_docs_url' ) );
        add_action( 'init', array( $this, 'contextual_help' ) );
    }

    /**
     * Filter for change the folder of Contextual Help
     * 
     * @since     {{plugin_version}}
     * @param string $paths
     *
     * @return string The path.
     */
    public function help_docs_dir( $paths ) {
        $paths[] = plugin_dir_path( __FILE__ ) . 'help-docs/';
        return $paths;
    }

    /**
     * Filter for change the folder image of Contextual Help
     * 
     * @since     {{plugin_version}}
     * @param string $paths
     *
     * @return string the path
     */
    public function help_docs_url( $paths ) {
        $paths[] = plugin_dir_path( __FILE__ ) . 'help-docs/img';
        return $paths;
    }

    /**
     * Contextual Help, docs in /help-docs folter
     * Documentation https://github.com/voceconnect/wp-contextual-help
     * 
     * @since    {{plugin_version}} 
     * @return void
     */
    public function contextual_help() {
        if ( !class_exists( 'WP_Contextual_Help' ) ) {
            return;
        }

        // Only display on the pages - post.php and post-new.php, but only on the `demo` post_type
        WP_Contextual_Help::register_tab( 'demo-example', __( 'Demo Management', PN_TEXTDOMAIN ), array(
            'page' => array( 'post.php', 'post-new.php' ),
            'post_type' => 'demo',
            'wpautop' => true
        ) );

        // Add to a custom plugin settings page
        WP_Contextual_Help::register_tab( 'pn_settings', __( 'Boilerplate Settings', PN_TEXTDOMAIN ), array(
            'page' => 'settings_page_' . PN_TEXTDOMAIN,
            'wpautop' => true
        ) );
    }

}

new Pn_ContextualHelp();