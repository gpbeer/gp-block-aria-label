/**
 * WordPress dependencies
 */
import { applyFilters } from '@wordpress/hooks';
import { hasBlockSupport } from '@wordpress/blocks';

export const SUPPORT_KEY = 'ariaLabel';

/**
 * Check if given block is allowed.
 *
 * @param {string} blockName the block name.
 * @param {Object} blockType the type object.
 *
 * @return {boolean} true or false.
 */
export function isAllowedBlock( blockName, blockType = false ) {
	const allowedBlocks = applyFilters( 'gp-block-aria-label.allowed-blocks', [
		'core/button',
	] );

	return (
		allowedBlocks.includes( blockName ) ||
		hasBlockSupport( blockType || blockName, SUPPORT_KEY, false )
	);
}
