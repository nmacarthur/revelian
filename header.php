<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,600" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.1/TweenMax.min.js"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>



	<!-- ******************* The Navbar Area ******************* -->
<div class="wrapper-fluid wrapper-navbar" id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">

		<a class="skip-link screen-reader-text sr-only" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>

		<nav class="navbar navbar-expand-md ">
			<div class="container">
				<div class="navbar__upper">
					<div class="dropdown show dropdown--heading">
						<a class="dropdown-toggle--heading dropdown-toggle " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							I am an employer
						</a>

						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							<a class="dropdown-item" href="<?php echo network_home_url(); ?>/employer/">I am an employer</a>
							<a class="dropdown-item" href="<?php echo network_home_url(); ?>/jobseeker/">I am a jobseeker</a>
						</div>
					</div>

					<!-- The WordPress Menu goes here -->
					<?php wp_nav_menu(
						array(
							'theme_location'  => 'top',
							'container_class' => 'navbar__navigation',
							'container_id'    => 'navbarNavDropdown',
							'menu_class'      => 'navbar-nav',
							'fallback_cb'     => '',
							'menu_id'         => 'secondary-menu',
							'walker'          => new understrap_WP_Bootstrap_Navwalker(),
						)
					); ?>
				</div>
			</div>
			<div class="container navbar--container" >
				<div class="navbar__inner">
				  <div class="navbar__inner--after"></div>
				  <section class='navbar__mega space--md' id="dropdown">
					  <div class="navbar__mega--inner container">
						  <?php if( have_rows('mega_menus', 'header') ):
								while ( have_rows('mega_menus', 'header') ) : the_row(); ?>
							<div class="row mega_menu" data-menu="<?php echo get_sub_field('parent'); ?>">


						  <div class="col-md-5 offset-md-1">
							  <?php echo get_sub_field('content', 'header'); ?>
						  </div>
						  <div class="col-md-5">
							  <div class="row">
						  <?php
							// check if the repeater field has rows of data
							if( have_rows('menus', 'header') ):
								$number_of_menus = get_field('number_of_menus','header');
								if($number_of_menus){
								$colsize = 12 /  $number_of_menus;
								}
								// loop through the rows of data
								while ( have_rows('menus', 'header') ) : the_row();
								?>
								<div class="col-md-<?php echo $colsize; ?>">
								<?php if(have_rows('sub_menu', 'header')):

									while( have_rows('sub_menu', 'header')): the_row();
									
									$link = get_sub_field('link');
									if(get_sub_field('menu_title')):
									?>
									<li><a href="<?php echo $link['url']; ?>" class="mega_menu_title small"><?php echo $link['title']; ?></a></li>
									<?
									else:
									?>
									<li><a href="<?php echo $link['url']; ?>" class="mega_menu_link small"><?php echo $link['title']; ?></a></li>
									<?
									endif;
									endwhile;

								endif; 
								?>
								</div>
								<?	
								endwhile;

							else :
								// no rows found
							endif;

							?>
							</div>
						  </div>
						  </div>

						<?php endwhile;
						endif; ?>
					  </div>
				</section>
				<div class="navbar__mega--line"></div>
				    
			
				<a href="<?php echo network_home_url(); ?>" id="site-logo" class="navbar-brand">
					Revelian
				</a>

				<!-- The WordPress Menu goes here -->
					<?php wp_nav_menu(
						array(
							'theme_location'  => 'primary',
							'container_class' => 'navbar__navigation',
							'container_id'    => 'navbarNavDropdown',
							'menu_class'      => 'navbar-nav',
							'fallback_cb'     => '',
							'menu_id'         => 'main-menu',
							'walker'          => new understrap_WP_Bootstrap_Navwalker(),
						)
					); ?>

					<div class="toggler-container">
						<button class="navbar-toggler" data-toggle="menu">
						<a href="#" class="burger-click">
							<div class="burger">
							<div class="burger__container">
								<span class="burger__icon burger__icon--top"></span>
								<span class="burger__icon burger__icon--middle"></span>
								<span class="burger__icon burger__icon--bottom"></span>
							</div>
							</div>
						</a>
						</button>
					</div>
				</div>
			</div><!-- .container -->
			
		</nav><!-- .site-navigation -->
	</div><!-- .wrapper-navbar end -->

	<div class="mobile-nav" id="expanding-nav" >
		<?php wp_nav_menu(
			array(
				'theme_location'  => 'mobile',
				'container_class' => 'mobile__navigation',
				'container_id'    => 'mobile',
				'menu_class'      => 'navbar-nav',
				'fallback_cb'     => '',
				'menu_id'         => 'mobile-menu',
				'walker'          => new understrap_WP_Bootstrap_Navwalker(),
			)
		); ?>
	</div>	

	<div class="hfeed site" id="page">