<?php

/**
 * Template Name: Shop landing
 */

use DRKN\Library\ShopMetaBox;

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
					
					<div class="nav-menuselect visible-xs" data-shoplink="<?php echo get_permalink(); ?>">
						<select></select>
					</div>
				</div>
			</div>
			
			<div class="col-md-9 col-sm-9">
				<?php

				$args = array(
					'post_type' => 'silk_products',
					'posts_per_page' => -1,
				);

				if( isset( $_GET['sq'] ) ) {
					$args['s'] = $_GET['sq'];
				}

				$wpQuery = new WP_Query( $args );
				
				if( $wpQuery->posts ) :
					if( $wpQuery->is_search ) :
				?>
					<article>
						<h2><?php echo __( 'Search Results for', 'DRKN' ) . " '". $wpQuery->query['s'] . "'"; ?></h2>
					</article>
				<?php


					$products =  $wpQuery->posts;

					else:

					$position = 'frontpage';
					$products =  get_frontpage_products($position);




					endif;
				?>
				
				<div class="product-list row">
					<?php
					
					$colabImages = array();
					
					for( $i = 1; $i <= 3; $i++ ) {
						$image = get_post_meta( $post->ID, 'Image_' . $i, true );
						$position = get_post_meta( $post->ID, 'Position_' . $i, true );
						$isWide = get_post_meta( $post->ID, 'Is_Wide_' . $i, true );
						
						if( !$image ) {
							continue;
						}
						
						array_push(
							$colabImages,
							array(
								'imageID' => $image,
								'position' => ( $position ) ? $position : 1,
								'isWide' => $isWide
							)
						);
					}
					
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
				<?php
				
				endif;
				
				if( !$wpQuery->posts && $wpQuery->is_search ) :
				?>
				<article>
					<h2><?php echo __( 'No results found for', 'DRKN' ) . " '". $wpQuery->query['s'] . "'"; ?></h2>
				</article>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<?php

get_template_part( 'parts/shared/footer' );
