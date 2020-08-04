<?php
/**
 * Plugin Name:     Connpass Block
 * Description:     Example block written with ESNext standard and JSX support – build step required.
 * Version:         0.1.0
 * Author:          The WordPress Contributors
 * License:         GPL-2.0-or-later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     connpass-block
 *
 * @package         connpass-block
 */

require_once(__DIR__ . '/repository/class-connpass-repository.php');
require_once(__DIR__ . '/repository/class-connpass-image-repository.php');

$connpass_repository = new \ippey\connpass_block\repository\ConnpassRepository();

/**
 * Registers all block assets so that they can be enqueued through the block editor
 * in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */
function connpass_block_block_init() {
	$dir = dirname( __FILE__ );

	$script_asset_path = "$dir/build/index.asset.php";
	if ( ! file_exists( $script_asset_path ) ) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "create-block/connpass-block" block first.'
		);
	}
	$index_js     = 'build/index.js';
	$script_asset = require( $script_asset_path );
	wp_register_script(
		'connpass-block-block-editor',
		plugins_url( $index_js, __FILE__ ),
		$script_asset['dependencies'],
		$script_asset['version']
	);

	$editor_css = 'build/index.css';
	wp_register_style(
		'connpass-block-block-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'build/style-index.css';
	wp_register_style(
		'connpass-block-block',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'connpass-block/connpass-block', array(
		'editor_script' => 'connpass-block-block-editor',
		'editor_style'  => 'connpass-block-block-editor',
		'style'         => 'connpass-block-block',
		'render_callback' => 'connpass_block_render_callback',
		'attributes' => array(
			'series_id' => ['type' => 'string'],
			'count' => ['type' => 'string'],
		),
	) );
}
add_action( 'init', 'connpass_block_block_init' );

function connpass_block_block_categories($categories, $post) {
	return array_merge($categories, [['slug' => 'connpass', 'title' => __('Connpass', 'connpass-block')]]);
}
add_filter('block_categories', 'connpass_block_block_categories', 10, 2);

function connpass_block_render_callback($attr = [])
{
	if (array_key_exists('series_id', $attr)) {
		$count = isset($attr['count']) ? $attr['count'] : 10;
		$events = connpass_block_list($attr['series_id'], $count);
		if ($events instanceof \WP_Error) {
			return '<p></p>';
		}
		$image_repository = new \ippey\connpass_block\repository\ConnpassImageRepository();
		$events = array_map( function ($event) use ($image_repository) {
			$image_url = $image_repository->findBySlug($event->event_id);
			$event->started_at = (new DateTime($event->started_at))->format('Y-m-d H:i');
			$event->image_url = $image_url;
			return $event;
		}, $events);
		$result = "<ul class=\"connpass-block\">";
		foreach ($events as $event) {
			$result .= "<li class=\"connpass-block-item\">";
			$result .= "<p class=\"connpass-block-date\">" . $event->started_at . "</p>";
			$result .= "<p class=\"connpass-block-title\"><a href=\"" . $event->event_url . "\" target=\"_blank\">" . $event->title . "</a></p>";
			$result .= "<figure class=\"connpass-block-image\"><a href=\"" . $event->event_url . "\" target=\"_blank\"><img src=\"" . $event->image_url . "\" alt=\"" . $event->title . "\"></a></figure>";
			$result .= "<p class=\"connpass-block-button\"><a href=\"" . $event->event_url . "\" target=\"_blank\">参加登録</a></p>";
			$result .= "</li>";
		}
		$result .= "</ul>";
		return $result;
	}
	return '<p>connpass ブロック</p>';
}

/**
 * @param $series_id
 * @param int $count
 * @param int $order
 * @return array|WP_Error
 */
function connpass_block_list($series_id, $count = 10, $order = 2)
{
	$connpass_repository = new \ippey\connpass_block\repository\ConnpassRepository();
	return $connpass_repository->find_by_series_id($series_id, $count, $order);
}
