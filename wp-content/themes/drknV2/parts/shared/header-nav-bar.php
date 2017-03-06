<?php

$selection = EscGeneral::getSelection();

$drkn_option = get_option('drkn_theme_options');
$navdark = $drkn_option['drkn_theme_navigation_boolean'];
$navhome_class = '';
$home_logo = '/dist/images/logo-white.svg';

if( $navdark ) {
	$navhome_class = ' d-active';
	$home_logo = '/dist/images/logo-black.svg';
}

?>
<header class="banner<?php echo (is_front_page() || is_404() ? ' c-home'.$navhome_class : ''); ?>">
	<a class="navbar-brand" href="<?php echo home_url(); ?>">
		<img class="logo-sel" src="<?php echo (is_front_page() || is_404() ? bloginfo('stylesheet_directory'). $home_logo : bloginfo('stylesheet_directory'). '/dist/images/logo-black.svg' );?>" alt="<?php bloginfo('name'); ?>"  />
	</a>
	<nav role="navigation">
		<ul>
			<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'items_wrap' => '%3$s', 'container' => '' ) ); ?>
			<li>
				<a href="<?php echo get_bloginfo('url'); ?>/selection">
					<span<?php echo (intval($selection['total_items']) > 0 ? ' class="is-selected"' : ''); ?>>Cart <span id="js-numberOfItems">(<?php echo $selection['total_items'] ?>)</span></span>
				</a>
			</li>
			<li class="search-link">
				<div class="sl-form">
					<?php get_search_form(); ?>
				</div>
			</li>
		</ul>
	</nav>
</header>
