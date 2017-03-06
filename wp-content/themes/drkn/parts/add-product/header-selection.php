<?php

require_once Esc::directory() . '/modules/general.php';

if( isset( $selection[ 'items' ] ) && $selection[ 'items' ] ) :
?>
<ul class="u-cleanList selectedItems-list" data-url="<?php echo get_template_directory() . '/library/drkn.php'; ?>">
	<?php
	
	foreach( $selection[ 'items' ] as $key => $item ) :
		$attachment_ids = get_post_meta( $item[ 'post_id' ], 'attachment_ids', true );
	
		if( !$attachment_ids ) {
			$attachment_ids = array();
		}
		
		$attachment_id = array_shift( $attachment_ids );
	?>
	<li>
		<a class="selectedItems-imageCont" href="<?php echo get_permalink( $item[ 'post_id' ] ); ?>">
			<div style="width:60px;">
				<div class="square-container">
					<div class="square-inner"><?php responsive_img( $attachment_id, 'fill' ); ?></div>
				</div>
			</div>
		</a>
		
		<div class="selectedItems-info">
			<a href="<?php echo get_permalink( $item[ 'post_id' ] ); ?>">
				<h6><?php echo $item[ 'productName' ]; ?><span class="float-right"><?php echo $item[ 'priceEach' ]; ?></span></h6>
			</a>

			<div class="selectedItems-details">
				<span>Size: <?php echo $item[ 'size' ]; ?></span> <span>Qty: <?php echo $item[ 'quantity' ]; ?></span>
			</div>

			<div class="selectedItems-edit">
				<a href="<?php echo EscGeneral::getQueryAddProduct( $item ); ?>">+ Add</a>
				<a href="<?php echo EscGeneral::getQueryRemoveProduct( $item ); ?>">- Remove</a>
			</div>
		</div>
	</li>
	<?php endforeach; ?>
</ul>

<div class="selectedItems-subTotal">
	<h5>Sub Total <?php echo $selection[ 'totals' ][ 'itemsTotalPrice' ]; ?></h5>
	
	<a href="<?php get_bloginfo( 'url' ) ?>/selection" class="u-mainButton u-mainButton--small"><span>Checkout</span></a>
</div>
<?php endif;