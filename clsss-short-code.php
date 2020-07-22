<?php

namespace ippey\connpass_block;

use ippey\connpass_block\repository\ConnpassRepository;

class ShortCode
{
	private $connpass_repository;
	public function __construct(ConnpassRepository $connpass_repository)
	{
		$this->connpass_repository = $connpass_repository;
	}

	public function initialize()
	{
		add_shortcode( 'connpass_block_list', [$this, 'get_list'] );
	}

	public function get_list($attr)
	{
		if (!array_key_exists('series_id', $attr)) {
			return [];
		}
		$count = isset($attr['count']) ? $attr['count'] : 10;
		$events = $this->connpass_repository->find_by_series_id($attr['series_id'], $count);
		$result = "<ul>";
		foreach ($events as $event) {
			$result .= "<li>{$event->title}</li>";
		}
		$result .= "</ul>";
		return $result;
	}
}
