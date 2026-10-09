/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
import metadata from './block.json';

/**
 * The plugin Edit component
 */
import Edit from './edit';

/**
 * Registers the block
 */
registerBlockType( metadata, {
	edit: Edit,
} );