<?php
/**
 * Enqueue block assets for use within Gutenberg.
 *
 * @package GP\GP_Block_Aria_Label
 */

namespace GP\GP_Block_Aria_Label;

/**
 * Class Block_Assets
 */
class Block_Assets {
	/**
	 * The script handle prefix.
	 *
	 * @var string Plugin slug
	 */
	private $handle_prefix;

	/**
	 * Init hooks.
	 */
	public function init() {
		$this->handle_prefix = (string) Info::get_plugin_slug();

		add_action( 'enqueue_block_editor_assets', [ $this, 'block_localization' ] );
		add_action( 'enqueue_block_assets', [ $this, 'editor_assets' ] );
	}

	/**
	 * Enqueue block assets for use within editor.
	 */
	public function editor_assets() {
		if ( ! is_admin() ) {
			return;
		}

		// Styles.
		$asset   = self::get_asset_metadata( 'index' );
		$version = $asset['version'];

		// Scripts.
		$dependencies = $asset['dependencies'];

		wp_enqueue_script(
			$this->handle_prefix . '-editor',
			GP_BLOCK_ARIA_LABEL_URL . 'build/index.js',
			array_merge( $dependencies, [ 'wp-api', 'wp-compose' ] ),
			$version,
			false
		);
	}

	/**
	 * Enqueue localization data for our blocks.
	 */
	public function block_localization() {
		if ( function_exists( 'wp_set_script_translations' ) ) {
			wp_set_script_translations( $this->handle_prefix );
		}
	}

	/**
	 * Get asset metadata.
	 *
	 * @param string $handle Asset handle to reference.
	 *
	 * @return array
	 */
	public static function get_asset_metadata( $handle ) {
		$asset_file            = GP_BLOCK_ARIA_LABEL_DIR . 'build/' . $handle . '.asset.php';
		$asset                 = is_readable( $asset_file ) ? require $asset_file : [];
		$asset['dependencies'] = $asset['dependencies'] ?? [];
		$asset['version']      = $asset['version'] ?? Info::get_plugin_version();

		return $asset;
	}
}
