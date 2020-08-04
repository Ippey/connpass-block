<?php
/**
 * @var array $events
 */
?>

<ul class="connpass-block">
	<?php foreach($events as $event) { ?>
		<li class="connpass-block-item">
			<p class="connpass-block-date"></p>
			<p class="connpass-block-title"><a href="<?php echo $event->event_url ?>" target="_blank" rel="noopener"><?php echo esc_html($event->title); ?></a></p>
			<figure class="connpass-block-image"><a href="<?php echo $event->event_url ?>" target="_blank" rel="noopener"><img src="<?php echo esc_html($event->image_url); ?>"></a></figure>
			<p class="connpass-block-button"><a href="<?php echo $event->event_url ?>" target="_blank" rel="noopener">参加登録</a></p>
		</li>
	<? } ?>
</ul>