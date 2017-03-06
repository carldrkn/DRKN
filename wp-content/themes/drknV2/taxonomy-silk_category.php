<?php

/**
 * Product pages from Silk.
 */

get_template_part( 'parts/shared/header' );
get_template_part( 'parts/shared/header-nav-bar' );
?>

<div class="wrapper">
	<div class="container-fluid sticky-menu">
		<div class="row">
			<div class="col-md-3 col-sm-3">
				<div class="list-nav">
					<div class="nav-sticky">
						<div class="nav-sbmenu hidden-xs">
							<?php wp_nav_menu( array( 'theme_location' => 'sidebar-menu' ) ); ?>
						</div>
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
			
			<div class="col-md-9 col-sm-9">
				<?php
				
				$object = get_queried_object();
				$isColab = get_term_meta( $object->term_id, 'is_colab', true );
				
				if( $isColab ) :
				?>
				<div class="colab-content">
					<h1><?php echo $object->name; ?></h1>
					
					<p><?php echo $object->description; ?></p>
				</div>
				<?php endif; ?>
				
				<?php

				global $wp_query;

				$currentCategory = $wp_query->query_vars['silk_category'];
				$productArray = get_option( 'category_order_' . $currentCategory );
				$tempProductOrder = array();

				foreach( $wp_query->posts as $post ) {
					$silkProductID = get_post_meta( $post->ID, 'product_id' );

					for( $i = 0; $i < count( $productArray ); $i++ ) {
						if( $productArray[$i] != $silkProductID[0] ) {
							continue;
						}
						
						$tempProductOrder[$i] = $post;
					}
				}

				ksort( $tempProductOrder );

				$wp_query->posts = array_values( $tempProductOrder );


				if( $wp_query->posts ) :
				?>
				<div class="product-list row">
					<?php
					
					$colabImages = array();
					
					for( $i = 1; $i <= 3; $i++ ) {
						$image = get_term_meta( $object->term_id, 'colab_image_' . $i, true );
						$position = get_term_meta( $object->term_id, 'colab_image_pos_' . $i, true );
						$isWide = get_term_meta( $object->term_id, 'colab_image_set_' . $i, true );
						
						if( !$image ) {
							continue;
						}
						
						array_push(
							$colabImages,
							array(
								'imageID' => $image['id'],
								'position' => ( $position ) ? $position : 1,
								'isWide' => $isWide
							)
						);
					}
					
					$products = $wp_query->posts;
					
					foreach( $colabImages as $item  ) {
						$position = $item['position'];
						
						$temp = array( 'colab_image_' . $position => array(
							'imageID' => $item['imageID'],
							'isWide' => $item['isWide']
						) );
						
						if( $position == 1 ) {
							$products = $temp + $products;
						} else {
							$res = array_slice( $products, 0, $position - 1, true ) + $temp +
									array_slice( $products, $position - 1, count( $products ) - 1, true) ;

							$products = $res;
						}
					}
					
					foreach( $products as $key => $product ) {
						$productID = $product->ID;
						$productClass = 'col-sm-6 f-img';
						
						if( is_object( $product ) ) {
							include( locate_template( 'parts/shared/product.php' ) );
						} else {
							$imageID = $product['imageID'];
							$isWide = $product['isWide'];
							$classes = 'prod-wrap img-big-xs';
							
							if( $isWide ) {
								$image = wp_get_attachment_image( (int) $imageID, 'drkn_1000', false, array( 'class' => 'img-responsive' ) );
								$classes .= ' col-sm-12 full-img';
							} else {
								$image = wp_get_attachment_image( (int) $imageID, 'drkn_500', false, array( 'class' => 'img-responsive' ) );
								$classes .= ' col-sm-6';
							}
							
							echo '<div class="' . $classes . '">' . $image . '</div>';
						}
					}
					?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<?php

get_template_part( 'parts/shared/footer' );
