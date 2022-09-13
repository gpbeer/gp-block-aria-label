/**
 * Check if given block is allowed.
 *
 * @param {string} blockName the block name.
 * @return {boolean} true or false.
 */
export function isAllowedBlock( blockName ) {
	const allowedBlocks = [ 'core/button' ];

	return allowedBlocks.includes( blockName );
}
