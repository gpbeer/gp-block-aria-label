<?php
/**
 * Plugin general Info
 *
 * @package GP\GP_Block_Aria_Label
 */

namespace GP\GP_Block_Aria_Label;

/**
 * The class containing information about the plugin.
 * Class Info
 */
class Info {

	/**
	 * The plugin slug.
	 *
	 * @var string
	 */
	const PLUGIN_SLUG = 'gp-block-aria-label';

	/**
	 * Retrieves the plugin data from the main plugin file.
	 *
	 * @param string $value Plugin data to match.
	 *
	 * @return mixed
	 */
	private static function get_plugin_data( $value = 'Version' ) {
		if ( ! function_exists( 'get_plugin_data' ) ) {
			require_once ABSPATH . '/wp-admin/includes/plugin.php';
		}

		$plugin_data = get_plugin_data( self::get_path() );

		return (string) $plugin_data[ $value ];
	}

	/**
	 * Path to the main plugin entry file
	 *
	 * @return string
	 */
	public static function get_path() {
		return GP_BLOCK_ARIA_LABEL_DIR . 'plugin.php';
	}

	/**
	 * Plugin version
	 *
	 * @return mixed
	 */
	public static function get_plugin_version() {
		return self::get_plugin_data();
	}

	/**
	 * Returns plugin slug
	 *
	 * @return string
	 */
	public static function get_plugin_slug() {
		return (string) self::PLUGIN_SLUG;
	}
}
