<?php
	$selection = EscGeneral::getSelection();
	//pr($selection);
?>
<div class="menu-submenu hidden-lg hidden-md">
	<?php include 'newsletter-form.php'; ?>
</div>
	<header>
		<div class="container-fluid">
			<div class="row">

				<div class="col-md-12">

					<a href="<?php echo get_bloginfo('url'); ?>" class="logo float-left"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png"></a>

					<a href="" class="mobile-menu hidden-lg hidden-md"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mobile-menu.png"></a>

					<nav class="float-left">
						<ul>
							<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'items_wrap' => '%3$s', 'container' => '' ) ); ?>

							<li>
								<ul class="hidden-lg hidden-md">
									<?php wp_nav_menu( array( 'theme_location' => 'header-menu-right', 'items_wrap' => '%3$s', 'container' => '' ) ); ?>
								</ul>
							</li>
							<li class="social-mobile hidden-lg hidden-md follow">
								<ul>
									<?php wp_nav_menu( array( 'theme_location' => 'social-menu', 'items_wrap' => '%3$s', 'container' => '' ) ); ?>
								</ul>

							</li>
						</ul>
					</nav>

					<ul class="social float-right hidden-sm hidden-xs follow">
						<?php wp_nav_menu( array( 'theme_location' => 'social-menu', 'items_wrap' => '%3$s', 'container' => '' ) ); ?>
					</ul>


					<ul class="second-menu float-right">
						<li>
							<ul class="second-menu-right hidden-sm hidden-xs">
								<?php wp_nav_menu( array( 'theme_location' => 'header-menu-right', 'items_wrap' => '%3$s', 'container' => '' ) ); ?>
							</ul>
						</li>
						<li id="js-popOut" class="popOut">
							<a href="<?php echo get_bloginfo('url'); ?>/selection">
								<span<?php echo (intval($selection['total_items']) > 0 ? ' class="is-selected"' : ''); ?>>BAG (<span id="js-numberOfItems"><?php echo $selection['total_items'] ?></span>)</span>
							</a>
							<div class="popOut-display">
								<div class="nosto_cart" style="display:none">
									<?php get_template_part('parts/shop/nosto-line-item'); ?>
								</div>
								<div id="js-selectedItems" class="selectedItems">
<?php
								if($selection['total_items'] > 0) {
?>
									<?php get_template_part('parts/shop/header-selection'); ?>
<?php
								}	else {
?>
									<h5>Cart empty</h5>
<?php
								}
?>
								</div>
							</div>
						</li>
					</ul>
					<div class="clearfix"></div>

				</div>

			</div>
		</div>


		<div class="newsletter-dialog">
			<div class="close-dialog">&times;</div>
			<?php include 'newsletter-form.php'; ?>
		</div>
	</header>
	<div class="wrap-page">