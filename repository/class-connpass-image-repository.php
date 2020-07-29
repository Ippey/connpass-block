<?php


namespace ippey\connpass_block\repository;


class ConnpassImageRepository
{
	public function findBySlug($slug)
	{
		$args = array(
			'post_type' => 'attachment',
			'name' => sanitize_title($slug),
			'posts_per_page' => 1,
			'post_status' => 'inherit',
		);
		$_header = get_posts($args);
		$header = $_header ? array_pop($_header) : null;
		return $header ? wp_get_attachment_url($header->ID) : $this->findNoImage();
	}

	public function findNoImage()
	{
		$args = array(
			'post_type' => 'attachment',
			'name' => sanitize_title('noimage'),
			'posts_per_page' => 1,
			'post_status' => 'inherit',
		);
		$_header = get_posts($args);
		$header = $_header ? array_pop($_header) : null;
		return $header ? wp_get_attachment_url($header->ID) : '';
	}
}
