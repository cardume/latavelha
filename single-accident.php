<?php get_header(); ?>

<?php latavelha_map('<a href="' . get_post_type_archive_link('accident') . '">' . __('Accidents', 'latavelha') . '</a>', false); ?>

<?php if(have_posts()) : the_post(); ?>
	<section id="platform-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php
		// accident data
		$type_name = latavelha_get_accident_type_name();
		$platform = latavelha_get_accident_platform();
		$date = latavelha_get_accident_date();
		$notes = latavelha_get_accident_notes();
		$link = latavelha_get_accident_link();
		?>
		<div class="container">
			<div class="twelve columns">
				<article class="accident-content">
					<div class="seven columns alpha">
						<div class="map-content-box">
							<header class="accident-header header">
								<div class="clearfix">
									<h1><?php echo $type_name; ?></h1>
								</div>
								<div class="main-meta clearfix">
									<?php if($platform) : ?>
										<p class="platform"><a href="<?php echo get_permalink($platform->ID); ?>"><span><?php _e('Platform', 'latavelha'); ?></span><?php echo $platform->post_title; ?></a></p>
									<?php endif; ?>
									<?php if($date) : ?>
										<p class="date"><span><?php _e('Date', 'latavelha'); ?></span><?php echo $date; ?></p>
									<?php endif; ?>
								</div>
							</header>
							<section class="accident-data main-section">
								<?php the_content(); ?>
							</section>
						</div>
						<section class="below-content">
							<?php echo $notes; ?>
						</section>
					</div>
					<div class="four columns omega offset-by-one">
						<?php if($link) : ?>
							<aside class="related-content">
									<div class="links">
										<h2><?php _e('Links', 'latavelha'); ?></h2>
										<ul>
											<li>
												<h3><a href="<?php echo $link; ?>" rel="external" target="_blank"><?php _e('Accident report link', 'latavelha'); ?></a></h3>
											</li>
										</ul>
									</div>
							</aside>
						<?php endif; ?>
						<?php if(latavelha_get_accident_type()) : ?>
							<a class="button dark" style="display:block;margin-bottom:30px;" href="<?php echo get_term_link(latavelha_get_accident_type(), 'accident-type'); ?>"><?php _e('View all accidents by', 'latavelha'); ?> <?php echo $type_name; ?></a>
						<?php endif; ?>
						<aside class="social">
							<div class="facebook">
								<iframe src="//www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;send=false&amp;layout=box_count&amp;width=60&amp;show_faces=false&amp;font=verdana&amp;colorscheme=light&amp;action=like&amp;height=90&amp;appId=521681297871040" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width: 60px; height:90px;" allowTransparency="true"></iframe>
							</div>
							<div class="twitter">
								<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-lang="en" data-count="vertical">Tweet</a>
								<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
							</div>
						</aside>
					</div>
					<?php get_template_part('section', 'attachments'); ?>
				</article>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php get_footer(); ?>