<?php
/**
 * @var array $events
 */
?>

<ul class="connpass-block">
	<?php foreach($events as $event) { ?>
		<li class="connpass-block-item">
			<p class="connpass-block-date"><?php echo esc_html($event->title); ?></p>
			<p class="connpass-block-title"><?php echo esc_html($event->title); ?></p>
			<figure class="connpass-block-image"><img src="<?php echo esc_html($event->image_url); ?>"></figure>
			<p class="connpass-block-button"><a href="<?php echo $event->event_url ?>" target="_blank" rel="noopener">参加登録</a></p>
		</li>
	<? } ?>
</ul>