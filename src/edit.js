/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
 */
import {__} from '@wordpress/i18n';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

import ServerSideRender from '@wordpress/server-side-render';

import {
	TextControl,
} from '@wordpress/components';

import { __experimentalNumberControl as NumberControl } from '@wordpress/components';

import {
	InspectorControls
} from '@wordpress/block-editor';


/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#edit
 *
 * @param {Object} [props]           Properties passed from the editor.
 * @param {string} [props.className] Class name generated for the block.
 *
 * @return {WPElement} Element to render.
 */
export default function Edit({attributes, setAttributes, className}) {
	const {series_id, count} = attributes;
	const onChangeSeriesId = (newSeriesId) => {
		console.log(newSeriesId);
		setAttributes({series_id: newSeriesId});
	};
	const onChangeCount = (newCount) => {
		console.log(newCount);
		setAttributes({count: newCount});
	};
	return (
		<>
			<InspectorControls>
				<TextControl
					label="グループID"
					value={series_id}
					onChange={onChangeSeriesId}
				/>

				<TextControl
					label="取得件数"
					value={count}
					onChange={onChangeCount}
				/>
			</InspectorControls>
			<ServerSideRender
				className={className}
				block="connpass-block/connpass-block"
				attributes={ {
					series_id: series_id,
					count: count,
				}
				}
			/>
		</>
	);
}
