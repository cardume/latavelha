<?php get_header(); ?>

<section id="map">
	<h2 class="map-title"><?php _e('Platforms', 'latavelha'); ?></h2>
	<?php mappress_featured_map(); ?>
</section>
	
<div class="container">
	<div class="twelve columns">
		<section id="platforms" class="content-section clearfix">
			<h2><?php _e('See platforms', 'latavelha'); ?></h2>
			<?php query_posts('post_type=platform&posts_per_page=6'); ?>
			<?php get_template_part('loop', 'platform'); ?>
			<?php wp_reset_query(); ?>
		</section>
	</div>
	<div class="five columns">
		<section id="news" class="content-section clearfix">
			<h2><?php _e('News', 'latavelha'); ?></h2>
			<?php query_posts('posts_per_page=4'); ?>
			<?php get_template_part('loop', 'post'); ?>
			<?php wp_reset_query(); ?>
		</section>
	</div>
	<div class="six columns offset-by-one">
		<section id="accidents" class="content-section clearfix">
			<h2><?php _e('Accidents', 'latavelha'); ?></h2>
			<?php query_posts('post_type=accident&posts_per_page=4'); ?>
			<?php get_template_part('loop', 'accident'); ?>
			<?php wp_reset_query(); ?>
		</section>
	</div>
</div>
<div id="info-box">
	<div class="container">
		<div class="twelve columns">
			<h2><?php _e('Get the data', 'latavelha'); ?></h2>
			<a class="button"><?php _e('Download', 'latavelha'); ?></a>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec convallis mi ut tellus convallis cursus. Maecenas vitae augue est. Sed sit amet felis a odio feugiat tempor. Pellentesque dolor tortor, accumsan vel imperdiet sit amet, dapibus at massa. Nunc quam diam, pretium eu auctor in, tincidunt et mauris.</p>
		</div>
	</div>
</div>

<?php get_footer(); ?>