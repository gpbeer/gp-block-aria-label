<?php
/**
 * Block render.
 *
 * @package GP\GP_Block_Aria_Label
 */

namespace GP\GP_Block_Aria_Label;

defined( 'ABSPATH' ) || exit;

$gp_block_aria_label = new class() {
	/**
	 * Constructor.
	 */
	public function __construct() {
		add_filter(
			'render_block',
			function( $block_content, $block ) {
				if ( isset( $block['blockName'] ) && 'core/button' === $block['blockName'] ) {
					$aria_label = $block['attrs']['ariaLabel'] ?? false;

					if ( $aria_label ) {
						$aria_label    = wp_strip_all_tags( $aria_label );
						$block_content = str_replace( 'href=', 'aria-label="' . esc_attr( $aria_label ) . '" title="' . esc_attr( $aria_label ) . '" href=', $block_content );
					}
				}

				return $block_content;
			},
			5,
			2
		);
	}
};


