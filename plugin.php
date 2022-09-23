<?php
/**
 * Plugin Name:     Block Aria Label Extension
 * Description:     Adds aria label field to Gutenberg Blocks.
 * Version:         0.0.1
 * Author:          German PICHARDO-BEER
 * Text Domain:     gp-block-aria-label
 * Domain Path:     /languages
 * Tested up to:    6.0.2
 *
 * @link            https://github.com/german-pichardo/gp-block-aria-label
 * @package         GP\GP_Block_Aria_Label
 */

namespace GP\GP_Block_Aria_Label;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'GP_BLOCK_ARIA_LABEL_FILE', __FILE__ );
define( 'GP_BLOCK_ARIA_LABEL_DIR', plugin_dir_path( GP_BLOCK_ARIA_LABEL_FILE ) );
define( 'GP_BLOCK_ARIA_LABEL_URL', plugin_dir_URL( GP_BLOCK_ARIA_LABEL_FILE ) );
define( 'GP_BLOCK_ARIA_LABEL_URL_SHARED', GP_BLOCK_ARIA_LABEL_URL . 'src/shared' );

// Plugin Global information.
require_once GP_BLOCK_ARIA_LABEL_DIR . 'includes/class-info.php';

/**
 * The code that runs during plugin activation.
 */
function run_activation() {
	include_once GP_BLOCK_ARIA_LABEL_DIR . 'includes/class-activator.php';
	Activator::activate();
}

register_activation_hook( __FILE__, __NAMESPACE__ . '\run_activation' );

/**
 * Begins execution of the plugin.
 */
function run_init() {
	include_once GP_BLOCK_ARIA_LABEL_DIR . 'includes/class-init.php';
	new Init();
}

run_init();
