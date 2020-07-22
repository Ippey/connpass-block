/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/#registering-a-block
 */
import { registerBlockType } from '@wordpress/blocks';

/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';


/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * All files containing `style` keyword are bundled together. The code used
 * gets applied both to the front of your site and to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './style.scss';

/**
 * Internal dependencies
 */
import Edit from './edit';
import Save from './save';

/**
 * Every block starts by registering a new block type definition.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/#registering-a-block
 */
registerBlockType( 'connpass-block/connpass-block', {
	/**
	 * This is the display title for your block, which can be translated with `i18n` functions.
	 * The block inserter will show this name.
	 */
	title: __( 'Connpass イベントリスト', 'connpass-block' ),

	/**
	 * This is a short description for your block, can be translated with `i18n` functions.
	 * It will be shown in the Block Tab in the Settings Sidebar.
	 */
	description: __(
		'Connpassのイベント一覧を表示します。',
		'connpass-block'
	),

	/**
	 * Blocks are grouped into categories to help users browse and discover them.
	 * The categories provided by core are `common`, `embed`, `formatting`, `layout` and `widgets`.
	 */
	category: 'connpass',

	/**
	 * An icon property should be specified to make it easier to identify a block.
	 * These can be any of WordPress’ Dashicons, or a custom svg element.
	 */
	icon: (
		<svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="128px" height="94px" viewBox="0 0 1280 940" preserveAspectRatio="xMidYMid meet">
			<g id="layer101" fill="#c32a01" stroke="none">
				<path d="M44 868 c3 -29 6 -81 6 -116 0 -61 1 -64 43 -105 104 -101 99 -254 -10 -330 l-43 -31 0 -128 c0 -70 2 -128 4 -128 3 0 51 11 108 25 182 44 301 57 493 58 195 0 313 -14 483 -58 56 -14 103 -25 106 -25 3 0 6 58 6 128 l0 128 -43 31 c-108 76 -114 229 -12 329 l42 40 6 114 c3 63 4 116 2 118 -2 2 -54 -3 -115 -12 -284 -42 -610 -42 -920 -1 -173 23 -164 25 -156 -37z"/>
			</g>
			<g id="layer102" fill="#ffffff" stroke="none">
				<path d="M599 751 c-47 -10 -97 -39 -123 -74 -18 -25 -21 -45 -24 -164 -4 -158 -2 -171 38 -217 74 -84 224 -87 301 -6 58 61 57 75 -10 98 l-56 19 -18 -23 c-13 -18 -28 -24 -56 -24 -61 0 -71 20 -71 133 0 84 3 100 20 117 28 28 75 26 106 -5 l25 -26 55 18 c30 9 54 21 54 26 0 5 -9 25 -21 43 -39 63 -136 101 -220 85z"/>
			</g>

		</svg>
	),

	/**
	 * Optional block extended support features.
	 */
	supports: {
		// Removes support for an HTML mode.
		html: false,
	},

	/**
	 * @see ./edit.js
	 */
	edit: Edit,

	/**
	 * @see ./save.js
	 */
	save: Save,

	attributes: {
		series_id: {
			type: 'string',
		},
		count: {
			type: 'string',
		},
	},
} );
