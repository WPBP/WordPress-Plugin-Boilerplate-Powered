/**
 * WordPress dependencies
 */
import { useBlockProps } from '@wordpress/block-editor';
import { ServerSideRender } from '@wordpress/editor';

/**
 * The edit function describes the structure of your block in the context of the editor.
 *
 * @param {Object} props Block properties.
 * @return {JSX.Element} Edit view.
 */
export default function Edit( { attributes } ) {
	const blockProps = useBlockProps();

	return (
		<div { ...blockProps }>
			<ServerSideRender
				block="plugin-name/hello-world"
				attributes={ attributes }
			/>
		</div>
	);
}
