<?php
/**
 * WPSEO plugin file.
 *
 * @package WPSEO\Admin
 */

/**
 * Handles the media purge notification showing and hiding.
 */
class WPSEO_Admin_Media_Purge_Notification implements WPSEO_WordPress_Integration {

	/**
	 * Registers all hooks to WordPress.
	 *
	 * @deprecated 14.1
	 *
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	public function register_hooks() {
		_deprecated_function( __METHOD__, 'WPSEO 14.1' );
	}

	/**
	 * Adds a hidden setting to the media tab.
	 *
	 * @deprecated 14.1
	 *
	 * @codeCoverageIgnore
	 *
	 * @param string|null $input Current filter value.
	 *
	 * @return string|null
	 */
	public function output_hidden_setting( $input ) {
		_deprecated_function( __METHOD__, 'WPSEO 14.1' );

		return $input;
	}

	/**
	 * Manages if the notification should be shown or removed.
	 *
	 * @deprecated 14.1
	 *
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	public function manage_notification() {
		_deprecated_function( __METHOD__, 'WPSEO 14.1' );
	}

	/**
	 * Retrieves the notification that should be shown or removed.
	 *
	 * @deprecated 14.1
	 *
	 * @codeCoverageIgnore
	 *
	 * @return Yoast_Notification The notification to use.
	 */
	private function get_notification() {
		_deprecated_function( __METHOD__, 'WPSEO 14.1' );

		return null;
	}

	/**
	 * Adds the notification to the notificaton center.
	 *
	 * @deprecated 14.1
	 *
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	private function add_notification() {
		_deprecated_function( __METHOD__, 'WPSEO 14.1' );
	}

	/**
	 * Removes the notification from the notification center.
	 *
	 * @deprecated 14.1
	 *
	 * @codeCoverageIgnore
	 *
	 * @return void
	 */
	private function remove_notification() {
		_deprecated_function( __METHOD__, 'WPSEO 14.1' );
	}
}
