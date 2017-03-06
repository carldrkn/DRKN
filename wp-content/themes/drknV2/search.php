<?php

/**
 * Search results page
 */

get_template_part( 'parts/shared/header' );
get_template_part( 'parts/shared/header-nav-bar' );
?>
<div class="post-single">
	<div class="wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4 sidebar-menu col-sm-4">
					<div class="cat-nav">
						<div class="nav-sbmenu hidden-xs">
							<?php wp_nav_menu( array( 'theme_location' => 'pages-menu' ) ); ?>
						</div>

						<?php

						$argsShop = array(
							'post_type' => 'page',
							'posts_per_page' => 1,
							'meta_key' => '_wp_page_template',
							'meta_value' => 'shop_landing.php'
						);

						$wpQueryShop = new WP_Query( $argsShop );
						$shopPage = reset( $wpQueryShop->posts );
						?>
						<div class="nav-menuselect visible-xs" data-shoplink="<?php echo get_permalink( $shopPage ); ?>">
							<select></select>
						</div>
					</div>
				</div>

				<div class="col-md-8 col-sm-8">
					<?php if( $posts ): ?>
						<article>
							<h2><?php echo __( 'Search Results for', 'DRKN' ) . " '". get_search_query()."'"; ?></h2>
						</article>

					<div class="product-list row">
						<?php

						foreach( $posts as $product ) {
							$productID = $product->ID;
							$productClass = 'col-md-6';

							include( locate_template( 'parts/shared/product.php' ) );
						}
						?>
					</div>
					<?php else: ?>
					<article><h2><?php echo __( 'No results found for', 'DRKN' ) . " '". get_search_query()."'"; ?></h2></article>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php

get_template_part( 'parts/shared/footer' );
