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
 * @typedef {import('@wordpress/blocks').Block<Props>} BlockType
 * @typedef {import('@wordpress/blocks').BlockConfiguration<Props>} BlockConfig
 * @typedef {import('./edit').Props} Props
 */

/**
 * @type { import('@wordpress/blocks').BlockIcon } BlockIcon - The Block Icon
 */
import { blockIcon } from './utils';

/**
 * The block configuration
 */
const blockConfig = /** @type {BlockConfig} */ (
	require( '../../block.json' )
);

/**
 * Register the block
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
registerBlockType( 'plugin-name/block-name', {
	...blockConfig,
	icon: blockIcon,
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
