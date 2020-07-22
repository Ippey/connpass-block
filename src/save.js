/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

import {ServerSideRender} from '@wordpress/server-side-render';

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#save
 *
 * @return {WPElement} Element to render.
 */
export default function Save({attributes, className}) {
	const { series_id, count } = attributes;
	return (
		<ServerSideRender
			className={className}
			block="connpass-block/connpass-block"
			attributes={ {
				series_id: series_id,
				count: count,
			}
			}
			/>
	);
}
