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
<?php elseif(get_post_type() == 'platform') :
	$owner = latavelha_get_platform_owner();
	$operator = latavelha_get_platform_operator();
	$age = latavelha_get_platform_age_text();
	?>
	<h4><?php the_title(); ?></h4>
	<p><strong><?php _e('Current status', 'latavelha'); ?></strong>: <span class="status-title <?php echo latavelha_get_platform_status_class(); ?>"><?php echo latavelha_get_platform_status_name(); ?></span></p>
	<p><strong><?php _e('Owner', 'latavelha'); ?></strong>: <?php echo $owner->name; ?></p>
	<p><strong><?php _e('Operator', 'latavelha'); ?></strong>: <?php echo $operator->name; ?></p>
	<p><strong><?php _e('Age', 'latavelha'); ?></strong>: <?php echo $age; ?></p>
<?php else : ?>
	<h4><?php the_title(); ?></h4>
<?php endif; ?>