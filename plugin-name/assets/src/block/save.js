import { useBlockProps } from '@wordpress/block-editor';
import { blockIcon, blockStyle } from './utils';

/**
 * @typedef {import('@wordpress/blocks').BlockSaveProps<Props>} BlockSaveProps
 * @typedef {import('./edit.js').Props} Props
 */

/**
 * The save function defines the way in which the different attributes should be combined
 * into the final markup, which is then serialized into post_content.
 *
 * @see https://wordpress.org/gutenberg/handbook/block-api/block-edit-save
 * @param {BlockSaveProps} attributes - The block attributes.
 * @return {JSX.Element} The element to render.
 */
export const Save = ( { attributes } ) => {
	return (
		<div { ...useBlockProps.save( { style: { ...blockStyle } } ) }>
			{ blockIcon }
			<h4>
				<a href={ attributes.href } className={ 'has-link-color' }>
					Hello World, WordPress Plugin Boilerplate Powered here!
				</a>
			</h4>
		</div>
	);
};
