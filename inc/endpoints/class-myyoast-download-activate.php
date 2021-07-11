<?php
/**
 * WPSEO plugin file.
 *
 * @package WPSEO\Endpoint
 */

/**
 * Represents the endpoint for activating a specific Yoast Plugin on WordPress.
 */
class WPSEO_Endpoint_MyYoast_Download_Activate implements WPSEO_Endpoint {
	/**
	 * The namespace to use.
	 *
	 * @var string
	 */
	const REST_NAMESPACE = 'yoast/v1/myyoast/download';

	/**
	 * Registers the routes for the endpoints.
	 *
	 * @codeCoverageIgnore Only contains a WordPress function.
	 *
	 * @return void
	 */
	public function register() {
		register_rest_route(
			self::REST_NAMESPACE,
			'activate',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'handle_request' ),
				'permission_callback' => array( $this, 'can_retrieve_data' ),
			)
		);
	}

	/**
	 * Determines whether or not data can be retrieved for the registered endpoints.
	 *
	 * @codeCoverageIgnore Only contains a WordPress function.
	 *
	 * @return bool Whether or not data can be retrieved.
	 */
	public function can_retrieve_data() {
		return current_user_can( 'activate_plugins' );
	}

	/**
	 * Handles the request by extracting the download url.
	 *
	 * @param WP_REST_Request $request The request to handle.
	 *
	 * @return WP_REST_Response The handle request as response.
	 */
	public function handle_request( WP_REST_Request $request ) {
		$this->require_dependencies();

		try {
			$plugin_slug       = $request->get_param( 'slug' );
			$activation_result = $this->activate_plugin( $plugin_slug );

			return new WP_REST_Response( $activation_result );
		}
		catch ( WPSEO_REST_Request_Exception $exception ) {
			return new WP_REST_Response(
				$exception->getMessage(),
				403
			);
		}
	}

	/**
	 * Activates the plugin based on the given plugin file.
	 *
	 * @param string $plugin_slug The plugin slug to get download url for.
	 *
	 * @return bool True when activation is successful.
	 *
	 * @throws WPSEO_REST_Request_Exception When error occurred during activation.
	 */
	protected function activate_plugin( $plugin_slug ) {
		$plugin_file       = $this->get_plugin_file( $plugin_slug );
		$activation_result = $this->run_activation( $plugin_file );

		if ( $activation_result !== null && is_wp_error( $activation_result ) ) {
			throw new WPSEO_REST_Request_Exception( $activation_result->get_error_message() );
		}

		return true;
	}

	/**
	 * Formats the response.
	 *
	 * @param string $plugin_slug The plugin slug to get download url for.
	 *
	 * @return array|string Array when a list is requested, string when a plugin is request.
	 *
	 * @throws WPSEO_REST_Request_Exception When no subscription isn't found for given plugin.
	 */
	protected function get_plugin_file( $plugin_slug ) {
		$plugin_file = WPSEO_Addon_Manager::get_plugin_file( $plugin_slug );

		if ( ! $plugin_file ) {
			throw new WPSEO_REST_Request_Exception(
				sprintf(
				/* translators: %1$s expands to the plugin slug  */
					esc_html__( 'Plugin %s is not installed', 'wordpress-seo' ),
					$plugin_slug
				)
			);
		}

		return $plugin_file;
	}

	/**
	 * Requires the files needed from WordPress itself.
	 *
	 * @codeCoverageIgnore Only loads a WordPress file.
	 *
	 * @return void
	 */
	protected function require_dependencies() {
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}
	}

	/**
	 * Runs the activation by using the WordPress activation routine.
	 *
	 * @param string $plugin_file The plugin to activate.
	 *
	 * @codeCoverageIgnore Contains WordPress specific logic.
	 *
	 * @return bool|WP_Error True when success, WP_Error when something went wrong.
	 */
	protected function run_activation( $plugin_file ) {
		return activate_plugin( $plugin_file );
	}
}
