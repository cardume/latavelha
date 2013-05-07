<?php
/*
 * Mousehover bubble content
 */
?>
<span class="arrow">&nbsp;</span>
<?php if(get_post_type() == 'accident') : ?>
	<h4><?php echo latavelha_get_accident_type_name(); ?></h4>
	<?php
	$platform = latavelha_get_accident_platform();
	if($platform) : ?>
		<p><strong><?php _e('Platform', 'latavelha'); ?></strong>: <?php echo $platform->post_title; ?></p>
	<?php endif; ?>
	<?php
	$date = latavelha_get_accident_date();
	if($date) : ?>
		<p><strong><?php _e('Date', 'latavelha'); ?></strong>: <?php echo $date; ?></p>
	<?php endif; ?>
<?php else : ?>
	<h4><?php the_title(); ?></h4>
<?php endif; ?>