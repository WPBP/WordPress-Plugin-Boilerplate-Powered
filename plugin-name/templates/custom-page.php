<?php
/**
 * Template for the custom-page route.
 *
 * @package Plugin_Name
 */

// WPBPGen{{#if libraries_joanrodas__plubo-routes}}
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main class="site-main">
	<section class="custom-page-content">
		<h1><?php esc_html_e( 'Custom Page', 'plugin-name' ); ?></h1>
		<p><?php esc_html_e( 'This page is served by a plubo-routes virtual route.', 'plugin-name' ); ?></p>
	</section>
</main>
<?php
get_footer();

// {{/if}}
