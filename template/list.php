<?php
/**
 * @var array $events
 */
?>

<ul>
	<?php foreach($events as $event) { ?>
		<li>
			<img src="<?php echo esc_html($event->image_url); ?>">
			<p class="title"><a href="<?php echo $event->event_url ?>" target="_blank" rel="noopener"><?php echo esc_html($event->title); ?></a></p>
			<p></p>
		</li>
	<? } ?>
</ul>
