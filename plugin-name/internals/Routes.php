<?php

/**
 * Plugin_Name
 *
 * @package   Plugin_Name
 * @author    {{author_name}} <{{author_email}}>
 * @copyright {{author_copyright}}
 * @license   {{author_license}}
 * @link      {{author_url}}
 */

namespace Plugin_Name\Internals;

use Plugin_Name\Engine\Base;
use WPBP\Vendor\PluboRoutes\Route\ActionRoute;
use WPBP\Vendor\PluboRoutes\Route\RedirectRoute;
use WPBP\Vendor\PluboRoutes\Route\Route;
use WPBP\Vendor\PluboRoutes\RoutesProcessor;

/**
 * Example routes using plubo-routes.
 *
 * Replaces the former Fake_Page virtual-page pattern with the
 * plubo-routes routing library. Routes are registered via the
 * `plubo/routes` filter and dispatched by RoutesProcessor.
 */
class Routes extends Base {

	/**
	 * Initialize the routing system.
	 *
	 * @return void|bool
	 */
	public function initialize() { // phpcs:ignore
		parent::initialize();

		RoutesProcessor::init();

		\add_filter( 'plubo/routes', array( $this, 'register_routes' ) );
	}

	/**
	 * Register example routes.
	 *
	 * @param array $routes Existing routes.
	 * @since {{plugin_version}}
	 * @return array
	 */
	public function register_routes( array $routes ) {
		// Virtual page served by a template file.
		$routes[] = new Route(
			'custom-page',
			PN_PLUGIN_ROOT . 'templates/custom-page.php',
			array(
				'name'  => 'custom_page',
				'title' => \__( 'Custom Page', 'plugin-name' ),
			)
		);

		// Action route with a callback that receives matched args.
		$routes[] = new ActionRoute(
			'api/custom/{id}',
			static function ( array $args ) {
				\wp_send_json( array( 'id' => $args['id'] ?? 0 ) );
			},
			array(
				'name' => 'custom_api',
			)
		);

		// Redirect route.
		$routes[] = new RedirectRoute(
			'old-page',
			\home_url( '/custom-page' ),
			array(
				'name'   => 'old_page_redirect',
				'status' => 301,
			)
		);

		return $routes;
	}

}
