<?php
/**
 * Theme header
 *
 * Displays all of the <head> section and everything up till <div id="main">
 * Mostly Borrowed from the TwentyTwelve 1.1 theme
 * @package WordPress
 * @subpackage cfye
 * @since cfye 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico">
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
<script type="text/javascript" src="//use.typekit.net/nqe6umn.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>
<body <?php body_class('active-menu overflow'); ?>>
<!--[if lt IE 9]>
<p class="chromeframe" >Oh this <em>sucks!</em> It seems that we do not support your old-school excuse for a browser (yet). If possible, try and make the world a better place by <a href="http://browsehappy.com/">upgrading to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">installing Google Chrome Frame</a> to experience this site in full sexyness. <br/><a href="#"class="hidethis"> Hide this message anyway</a></p>
<![endif]-->
	<div class="toggle-wrap">
		<div class="logo-flip-container">
			<div class="logo-flipper">

				<div class="logo-front">
					<h1 class="site-title">
						<i class="logo-icon icon-CFYE_NEW"></i>

					</h1><!--.site-title -->
				</div><!-- .logo-front -->

				<div class="logo-back">
					<div class="nav-toggle">
						<i class="toggle-icon icon-menu-3">
						</i>
					</div><!-- .nav-toggle -->
				</div><!-- .logo-back -->

			</div><!-- .logo-flipper -->
		</div><!-- .logo-flip-container -->
	</div><!-- .toggle-wrap -->

	<div class="navtease"></div><!-- .navtease -->

	<header  class="site-header" >
		<div class="header-search">
			<?php get_search_form( $echo = true );?>
		</div>
		<nav id="site-navigation" class="main-navigation" role="navigation">
		<?php
			wp_nav_menu(
				array(
    				'menu'       => 'side_menu',
    				'depth'      => 3,
    				'container'  => false,
    				'menu_class' => 'nav nav-tabs nav-stacked',
    				//CFYE Strap nav plugin call
    				'walker' => new cfye_strap_nav()
    			)
			);
		?>
		</nav><!-- #site-navigation -->
		<ul class="nav second-nav">
			<li class="menu-item">
				<a href="https://twitter.com/<?php the_field('cfye_twitter','option');?>" target="_blank" title="Join CFYE on Twitter!">
					<i class="nav-icon-first icon-twitter"></i> <?php _e( 'Twitter', 'cfye' ); ?>
				</a>
			</li><!-- .menu-item -->
			<?php if(get_field('cfye_facebook', 'option')):?>
			<li class="menu-item">
				<a href="<?php the_field('cfye_facebook','option');?>" target="_blank" title="Join CFYE on Facebook!">
					<i class="nav-icon-first icon-facebook"></i> <?php _e( 'Facebook', 'cfye' ); ?>
				</a>
			</li>
			<?php endif;?>
		</ul><!-- .nav .second-nav -->
	</header><!-- #masthead .site-header -->

	<div class="big-wrap">
		<dl class="youtube-loader">
			<dt></dt>
			<dd></dd>
		</dl><!-- youtube style loader -->