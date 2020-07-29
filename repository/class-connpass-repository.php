<?php


namespace ippey\connpass_block\repository;


class ConnpassRepository
{
	private $url = 'https://connpass.com/api/v1/event/';

	/**
	 * @param $series_id
	 * @param int $limit
	 * @param int $order
	 * @return \WP_Error|array
	 */
	public function find_by_series_id($series_id, $limit = 10, $order = 2)
	{
		$params = [
			'series_id' => $series_id,
			'count' => $limit,
			'order' => $order
		];
		$query_string = http_build_query($params);
		$response = wp_remote_get("{$this->url}?{$query_string}");
		if ($response instanceof \WP_Error) {
			return $response;
		}
		$json = json_decode($response['body']);
		return $json->events;
	}
}
