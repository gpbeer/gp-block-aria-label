/**
 * External Dependencies
 */
import classnames from 'classnames';

/**
 * WordPress Dependencies
 */
import { InspectorAdvancedControls } from '@wordpress/block-editor';
import { SelectControl, TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { addFilter, applyFilters } from '@wordpress/hooks';
import { createHigherOrderComponent } from '@wordpress/compose';

/**
 * Internal Dependencies
 */
import { isAllowedBlock } from './utils';

/**
 * Add custom attributes.
 *
 * @param {Object} settings Settings for the block.
 *
 * @return {Object} settings Modified settings.
 */
function addAttributes( settings ) {
	if ( ! isAllowedBlock( settings.name, settings ) ) {
		return settings;
	}

	Object.assign( settings.attributes, {
		ariaLabel: {
			type: 'string',
			default: '',
		},
		htmlAttribute: {
			type: 'string',
			default: '',
		},
	} );

	return settings;
}

/**
 * Editor Block Panel.
 *
 * @param {Function} BlockEdit Block edit component.
 *
 * @return {Function} BlockEdit Modified block edit component.
 */
const withInspectorControl = createHigherOrderComponent( ( BlockEdit ) => {
	return ( props ) => {
		if ( isAllowedBlock( props.name ) && props.isSelected ) {
			const { attributes, setAttributes } = props;
			const { ariaLabel, htmlAttribute } = attributes;

			let htmlAttributesOptions = [
				{
					value: 'aria-label',
					label: __( 'aria-label', 'gp-block-aria-label' ),
				},
				{ value: 'title', label: __( 'Title', 'gp-block-aria-label' ) },
				{ value: 'both', label: __( 'Both', 'gp-block-aria-label' ) },
			];

			htmlAttributesOptions = applyFilters(
				'gp_block_aria-label.html_attributes_options',
				htmlAttributesOptions
			);

			const ariaLabelHelpMessage = !! ariaLabel
				? __( 'Has a aria-label.', 'gp-block-aria-label' )
				: __( 'No aria-label', 'gp-block-aria-label' );

			return (
				<>
					<BlockEdit { ...props } />
					<InspectorAdvancedControls>
						<TextControl
							autoComplete="off"
							autoCapitalize="none"
							label={ __( 'Aria label', 'gp-block-aria-label' ) }
							value={ ariaLabel || '' }
							placeholder={ __(
								'Add an aria-label',
								'gp-block-aria-label'
							) }
							onChange={ ( nextAriaLabel ) => {
								setAttributes( {
									ariaLabel: nextAriaLabel,
								} );
							} }
							help={ ariaLabelHelpMessage }
						/>

						{ ariaLabel !== '' && (
							<SelectControl
								label={ __(
									'Attribute to use for label',
									'gp-block-aria-label'
								) }
								value={ htmlAttribute || undefined }
								options={ htmlAttributesOptions }
								onChange={ ( newHtmlAttribute ) =>
									setAttributes( {
										htmlAttribute: newHtmlAttribute,
									} )
								}
							/>
						) }
					</InspectorAdvancedControls>
				</>
			);
		}

		return <BlockEdit { ...props } />;
	};
}, 'withInspectorControl' );

/**
 * Save hook.
 *
 * @param {Object} props      Additional props applied to save element
 * @param {Object} blockType  Block type
 * @param {Object} attributes Block attributes
 * @return {Object}            Filtered props applied to save element
 */
export function addSaveProps( props, blockType, attributes ) {
	if ( ! isAllowedBlock( blockType.name ) ) {
		return props;
	}

	const { ariaLabel } = attributes;

	if ( typeof ariaLabel !== 'undefined' && ariaLabel ) {
		props.className = classnames( props.className, {
			'has-aria-label': ariaLabel || null,
		} );
	}

	return props;
}

/**
 * Extends the block edit wrapper.
 *
 * @param {Object} settings Original block settings
 * @return {Object}          Filtered block settings
 */
export function addEditProps( settings ) {
	if ( ! isAllowedBlock( settings.name, settings ) ) {
		return settings;
	}

	const existingGetEditWrapperProps = settings.getEditWrapperProps;
	settings.getEditWrapperProps = ( attributes ) => {
		let props = {};
		if ( existingGetEditWrapperProps ) {
			props = existingGetEditWrapperProps( attributes );
		}

		return addSaveProps( props, settings, attributes );
	};

	return settings;
}

addFilter(
	'blocks.registerBlockType',
	'gp/aria-label/add-attributes',
	addAttributes
);

addFilter(
	'editor.BlockEdit',
	'gp/aria-label/add-inspector-controls',
	withInspectorControl
);

addFilter(
	'blocks.getSaveContent.extraProps',
	'gp/aria-label/add-save-props',
	addSaveProps
);

addFilter(
	'blocks.registerBlockType',
	'gp/aria-label/add-edit-props',
	addEditProps
);
