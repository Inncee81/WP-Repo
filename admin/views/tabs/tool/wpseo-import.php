<?php
/**
 * WPSEO plugin file.
 *
 * @package WPSEO\Admin\Views
 */

if ( ! defined( 'WPSEO_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

if ( ! defined( 'WPSEO_NAMESPACES' ) || ! WPSEO_NAMESPACES ) {
	esc_html_e( 'Import of settings is only supported on servers that run PHP 5.3 or higher.', 'wordpress-seo' );
	return;
}
?>

<p id="settings-import-desc">
	<?php
	printf(
		/* translators: 1: expands to Yoast SEO, 2: expands to Import settings. */
		esc_html__( 'Import settings from another %1$s installation by pasting them here and clicking "%2$s".', 'wordpress-seo' ),
		'Yoast SEO',
		esc_html__( 'Import settings', 'wordpress-seo' )
	);
	?>
</p>

<form
	action="<?php echo esc_url( admin_url( 'admin.php?page=wpseo_tools&tool=import-export#top#wpseo-import' ) ); ?>"
	method="post"
	accept-charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
	<div class="yoast-field-group">
		<?php wp_nonce_field( WPSEO_Import_Settings::NONCE_ACTION ); ?>
		<div class="yoast-field-group__title">
			<label class="yoast-inline-label" for="settings-import">
				<?php
				printf(
					/* translators: %s expands to Yoast SEO */
					esc_html__( '%s settings to import:', 'wordpress-seo' ),
					'Yoast SEO'
				);
				?>
			</label>
		</div>
		<textarea id="settings-import" rows="10" cols="140" name="settings_import" class="yoast-field-group__textarea" aria-describedby="settings-import-desc"></textarea>
	</div>
	<br>
	<p>
		<input type="submit" class="yoast-button yoast-button--primary" value="<?php esc_attr_e( 'Import settings', 'wordpress-seo' ); ?>"/>
	</p>
</form>
