<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<title><?php
	global $page, $paged;

	wp_title( '|', true, 'right' );

	bloginfo( 'name' );

	$site_description = get_bloginfo('description', 'display');
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	if ( $paged >= 2 || $page >= 2 )
		echo ' | Página ' . max($paged, $page);

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/favicon.ico" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(get_bloginfo('language')); ?>>
	<header id="masthead">
		<div class="container">
			<div class="site-title five columns">
				<h2 class="greenpeace">
					<a href="http://greenpeace.org/" target="_blank" rel="external">
						Greenpeace
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/greenpeace.png" class="scale-with-grid" />
					</a>
				</h2>
				<h1>
					<a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name'); ?>">
						<?php bloginfo('name'); ?>
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo3.png" class="scale-with-grid" />
					</a>
				</h1>
			</div>
			<?php /*
			<div class="four columns">
				<p class="desc">Plataformas de perfuração de petróleo com mais de 30 anos podem apresentar danos e riscos severos ao meio ambiente</p>
			</div>
			*/ ?>
			<div class="five columns offset-by-two">
				<p class="desc">O Greenpeace mapeou as plataformas antigas da região do pré-sal e apresenta seus dados e histórico de acidentes</p>
				<?php /*
				<p class="navigate"><a href="<?php echo get_post_type_archive_link('platform'); ?>" title="<?php _e('Navigate through the platforms', 'latavelha'); ?>"><?php _e('Navigate through the platforms', 'latavelha'); ?></a></p>
				*/ ?>
			</div>
	</header>
	<nav id="main-nav" class="clearfix">
		<ul>
			<?php wp_nav_menu(); ?>
		</ul>
	</nav>