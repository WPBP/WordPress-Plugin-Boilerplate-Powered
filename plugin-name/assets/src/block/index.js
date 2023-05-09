/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';

/**
 * The plugin Edit and Save components
 */
import { Edit } from './edit';
import { Save } from './save';
/**
 * @type { import('@wordpress/blocks').BlockIcon } BlockIcon - The Block Icon
 */
import { blockIcon } from './utils';

/**
 * The block configuration
 *
 * @type { import('@wordpress/blocks').BlockConfiguration } BlockConfig      - The block configuration
 */
const blockConfig = require( '../../block.json' );

/**
 * Register the block
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
registerBlockType( {
	...blockConfig,
	icon: blockIcon,
	apiVersion: 2,
	/**
	 * @see edit.js
	 */
	edit: Edit,
	/**
	 * @see save.js
	 */
	save: Save,
	// https://developer.wordpress.org/block-editor/reference-guides/block-api/block-supports/
	supports: {
		align: true,
		anchor: true,
		className: true,
		color: {
			background: true,
			link: true,
			text: true,
			gradients: true,
		},
		spacing: {
			margin: true, // Enable margin UI control.
			padding: true, // Enable padding UI control.
			blockGap: true, // Enables block spacing UI control.
		},
	},
} );
