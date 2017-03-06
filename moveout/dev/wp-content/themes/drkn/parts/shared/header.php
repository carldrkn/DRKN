<?php
	$selection = EscGeneral::getSelection();
	//pr($selection);
?>
	<header>
		<div class="container-fluid">
			<div class="row">

				<div class="col-md-12">

					<a href="<?php echo get_bloginfo('url'); ?>" class="logo float-left"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png"></a>

					<a href="" class="mobile-menu hidden-lg hidden-md"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mobile-menu.png"></a>

					<nav class="float-left">
						<ul>

							<li class="shop-item">
								<a href="<?php echo get_bloginfo('url'); ?>/shop" class="first-child">SHOP</a>
								<?php /*
								<ul class="hidden-lg hidden-md">
									<li><a href="">NEW ARRIVALS</a></li>
									<li><a href="">LIMITED</a></li>
									<li><a href="">LEGACY</a></li>
									<li><a href="">CS GO CAPSULE</a></li>
								</ul>
 								*/ ?>
							</li>
							<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'items_wrap' => '%3$s', 'container' => '' ) ); ?>
							<?php /*
							<li><a href="<?php bloginfo('url') ?>/news">NEWS</a></li>
							<li><a href="<?php bloginfo('url'); ?>/culture">CULTURE</a></li>
							<li><a href="<?php bloginfo('url'); ?>/about">ABOUT</a></li>
 							*/ ?>
							<li class="join-item hidden-lg hidden-md">
								<a href="" class="first-child-sec">JOIN THE COMMUNITY</a>
								<div class="menu-submenu hidden-lg hidden-md">
									<?php include 'newsletter-form.php'; ?>
								</div>
							</li>
							<li class="social-mobile hidden-lg hidden-md follow">
								<ul>
									<li>
										<a data-name="facebook" href="https://www.facebook.com/wearedrkn" target="_blank">
										</a>
									</li>
									<li>
										<a data-name="twitter" href="http://twitter.com/wearedrkn" target="_blank">
										</a>
									</li>
									<li>
										<a data-name="instagram" href="http://instagram.com/wearedrkn" target="_blank">
										</a>
									</li>
									<li>
										<a data-name="tumblr" href="http://wearedrkn.tumblr.com/" target="_blank">
										</a>
									</li>
								</ul>

							</li>
						</ul>
					</nav>

					<ul class="social float-right hidden-sm hidden-xs follow">
						<li>
							<a data-name="facebook" href="https://www.facebook.com/wearedrkn" target="_blank">
							</a>
						</li>
						<li>
							<a data-name="twitter" href="http://twitter.com/wearedrkn" target="_blank">
							</a>
						</li>
						<li>
							<a data-name="instagram" href="http://instagram.com/wearedrkn" target="_blank">
							</a>
						</li>
						<li>
							<a data-name="tumblr" href="http://wearedrkn.tumblr.com/" target="_blank">
							</a>
						</li>
					</ul>


					<ul class="second-menu float-right">
						<li><a href="#" class="toggle-dialog">JOIN THE COMMUNITY</a></li>
						<li id="js-popOut" class="popOut">
							<a href="<?php echo get_bloginfo('url'); ?>/selection">
								<span>CART (<?php echo $selection['total_items'] ?>)</span>
							</a>
							<div class="popOut-display">
								<div id="js-selectedItems" class="selectedItems">
<?php
								if($selection['total_items'] > 0) {
?>
									<?php get_template_part('parts/shop/header-selection'); ?>
<?php
								}	else {
?>
									<h5>No items selected</h5>
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