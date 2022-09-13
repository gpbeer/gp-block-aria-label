<?php
/**
 * Plugin initialization file.
 *
 * @package GP\GP_Block_Aria_Label
 */

namespace GP\GP_Block_Aria_Label;

/**
 * Class Init
 */
class Init {
	/**
	 * Define the core functionality of the plugin.
	 */
	public function __construct() {
		$this->load_dependencies();
		$this->register();
	}

	/**
	 * Load all dependencies
	 */
	private function load_dependencies() {
		$plugin_dir = GP_BLOCK_ARIA_LABEL_DIR;

		// Includes.
		include_once $plugin_dir . 'includes/class-i18n.php';
		include_once $plugin_dir . 'includes/class-block-assets.php';

		// Register php files.
		foreach ( glob( dirname( GP_BLOCK_ARIA_LABEL_FILE ) . '/src/extensions/*/index.php' ) as $block_logic ) {
			require_once $block_logic; // todo: load individual blocks.
		}
	}

	/**
	 * Register all necessary hooks.
	 */
	private function register() {
		$translator = new I18n();
		add_action( 'plugins_loaded', [ $translator, 'load_plugin_textdomain' ], 99 );

		$block_assets = new Block_Assets();
		$block_assets->init();
	}
}
