import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { Panel, PanelBody, PanelRow, TextControl } from '@wordpress/components';
import { blockIcon, blockStyle } from './index';

export const Edit = ( { isSelected, style, attributes, setAttributes } ) => {
	return (
		<div
			{ ...useBlockProps( {
				style: { ...blockStyle, style },
			} ) }
		>
			<InspectorControls key="setting">
				<Panel header="Settings">
					<PanelBody
						title="Block Settings"
						icon={ 'settings' }
						initialOpen={ true }
					>
						<PanelRow>
							<TextControl
								label="Link Href"
								type={ 'url' }
								value={ attributes.href }
								onChange={ ( target ) =>
									setAttributes( { href: target } )
								}
							/>
						</PanelRow>
					</PanelBody>
				</Panel>
			</InspectorControls>
			{ blockIcon }
			<h4
				style={
					isSelected
						? { border: '2px solid red' }
						: { border: 'none' }
				}
			>
				<a href={ attributes.href } className={ 'has-link-color' }>
					Hello World, WordPress Plugin Boilerplate Powered here!
				</a>
			</h4>
			<p>
				Edit plugin-name/assets/src/block/index.js to change this block
			</p>
		</div>
	);
};
