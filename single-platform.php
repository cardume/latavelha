<?php get_header(); ?>

<?php latavelha_map('<a href="' . get_post_type_archive_link('platform') . '">' . __('Platforms', 'latavelha') . '</a>', false); ?>

<?php if(have_posts()) : the_post(); ?>
	<section id="platform-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="container">
			<div class="twelve columns">
				<article class="platform-content">
					<div class="seven columns alpha">
						<div class="map-content-box <?php if(latavelha_is_platform_old()) echo 'old-stamp'; ?>">
							<header class="platform-header header">
								<div class="clearfix">
									<h1><?php the_title(); ?></h1>
								</div>
								<div class="main-meta clearfix">
									<?php
									$owner = latavelha_get_platform_owner();
									$operator = latavelha_get_platform_operator();
									?>
									<?php if($owner) : ?>
										<p class="owner">
											<a href="<?php echo get_term_link($owner, 'platform-owner'); ?>">
												<span><?php _e('Owner', 'latavelha'); ?></span><?php echo $owner->name; ?>
											</a>
										</p>
									<?php endif; ?>
									<?php if($operator) : ?>
										<p class="operator">
											<a href="<?php echo get_term_link($operator, 'platform-operator'); ?>">
												<span><?php _e('Operator', 'latavelha'); ?></span><?php echo $operator->name; ?>
											</a>
										</p>
									<?php endif; ?>
								</div>
							</header>
							<section class="platform-data main-section">
								<?php if(latavelha_get_platform_status()) : ?>
									<div class="platform-status clearfix">
										<h3><?php _e('Current status', 'latavelha'); ?></h3>
										<p class="status-title <?php echo latavelha_get_platform_status_class(); ?>"><?php echo latavelha_get_platform_status_name(); ?></p>
									</div>
								<?php endif; ?>
								<div class="platform-data-table">
									<?php
									/* Grab all data */
									$other_names = get_post_meta($post->ID, 'other_names', true);
									$type = latavelha_get_platform_type();
									$construction_date = get_post_meta($post->ID, 'construction_date', true);
									$year = get_post_meta($post->ID, 'year', true);
									$lat = get_post_meta($post->ID, 'geocode_latitude', true);
									$lon = get_post_meta($post->ID, 'geocode_longitude', true);
									?>
									<table>
										<tbody>
											<?php if($other_names) : ?>
												<tr>
													<th><?php _e('Other names', 'latavelha'); ?></th>
													<td><?php echo $other_names; ?></td>
												</tr>
											<?php endif ?>
											<?php if($type) : ?>
												<tr>
													<th><?php _e('Platform type', 'latavelha'); ?></th>
													<td><a href="<?php echo get_term_link($type, 'platform-type'); ?>"><?php echo $type->name; ?></a></td>
												</tr>
											<?php endif; ?>
											<?php if($construction_date) : ?>
												<tr class="year">
													<th><?php _e('Construction year', 'latavelha'); ?></th>
													<td><?php echo $construction_date; ?></td>
												</tr>
												<tr class="age">
													<th><?php _e('Age', 'latavelha'); ?></th>
													<td><?php echo latavelha_get_platform_age_text(); ?></td>
												</tr>
											<?php endif ?>
											<?php if($year) : ?>
												<tr>
													<th><?php _e('Year', 'latavelha'); ?></th>
													<td><?php echo $year; ?></td>
												</tr>
											<?php endif ?>
											<?php if($lat) : ?>
												<tr>
													<th><?php _e('Latitude', 'latavelha'); ?></th>
													<td><?php echo $lat; ?></td>
												</tr>
											<?php endif ?>
											<?php if($lon) : ?>
												<tr>
													<th><?php _e('Longitude', 'latavelha'); ?></th>
													<td><?php echo $lon; ?></td>
												</tr>
											<?php endif ?>
										</tbody>
									</table>
								</div>
							</section>
						</div>
						<section class="below-content">
							<?php the_content(); ?>
						</section>
					</div>
					<div class="four columns omega offset-by-one">
						<aside class="related-content">
							<?php
							$args = latavelha_get_platform_related_args(array('posts_per_page' => 2));
							query_posts($args);
							if(have_posts()) : ?>
								<div class="news">
									<h2><?php _e('News', 'latavelha'); ?></h2>
									<?php get_template_part('loop', 'post'); ?>
								</div>
							<?php endif; ?>
							<?php wp_reset_query(); ?>
							<div class="links">
								<h2><?php _e('Links', 'latavelha'); ?></h2>
								<?php
								/* Grab all links */
								$local = get_post_meta($post->ID, 'platform_link_local', true);
								$rigzone = get_post_meta($post->ID, 'platform_link_rigzone', true);
								$marinetraffic = get_post_meta($post->ID, 'platform_link_marinetraffic', true);
								$site = get_post_meta($post->ID, 'platform_link_site', true);
								?>
								<ul>
									<?php if($local) : ?>
										<li>
											<h3><a href="<?php echo $local; ?>" target="_blank" rel="external">Local</a></h3>
										</li>
									<?php endif; ?>
									<?php if($rigzone) : ?>
										<li>
											<h3><a href="<?php echo $rigzone; ?>" target="_blank" rel="external">Rigzone</a></h3>
										</li>
									<?php endif; ?>
									<?php if($marinetraffic) : ?>
										<li>
											<h3><a href="<?php echo $marinetraffic; ?>" target="_blank" rel="external">Marine Traffic</a></h3>
										</li>
									<?php endif; ?>
									<?php if($site) : ?>
										<li>
											<h3><a href="<?php echo $site; ?>" target="_blank" rel="external">Website</a></h3>
										</li>
									<?php endif; ?>
								</ul>
							</div>
						</aside>
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
					<?php
					/* Accidents query */
					$args = latavelha_get_platform_related_args(array('posts_per_page'=>-1,'post_type'=>'accident'));
					query_posts($args);
					if(have_posts()) : ?>
						<section class="accidents single-section clearfix">
							<div class="twelve columns alpha omega">
								<h2><?php _e('Accidents', 'latavelha'); ?></h2>
								<?php get_template_part('loop', 'accident'); ?>
							</div>
						</section>
					<?php endif; ?>
					<?php wp_reset_query(); ?>
					<?php get_template_part('section', 'attachments'); ?>
				</article>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php get_footer(); ?>