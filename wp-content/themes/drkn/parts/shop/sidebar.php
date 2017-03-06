<?php
/**
 * Created by PhpStorm.
 * User: vilhelm
 * Date: 08/05/15
 * Time: 03:18
 */

$categories = get_categories( array(
	'type'                     => 'silk_products',
	'child_of'                 => 0,
	'parent'                   => '',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'silk_category',
	'pad_counts'               => false
) );

$categories_indexed = index_objects( $categories, 'parent', INDEX_OBJECTS_MULTIPLE );

$master_categories = index_objects( isset($categories_indexed[0]) ? $categories_indexed[0] : array(), 'term_id' );
unset($categories_indexed[0]);

foreach ( $categories_indexed as $parent_id => $child_categories ) if ( isset($master_categories[$parent_id]) )
	$master_categories[$parent_id]->categories = $child_categories;

$subcategories = call_user_func_array( 'array_merge', objects_values($master_categories, 'categories', false) );

?>

<div class="sidebar shop-page col-md-2 col-sm-4 hidden-xs no-padding-right">
		<div class="col-md-12 no-padding-right">
			<ul class="first">
				<?php foreach ( $master_categories as $category ) if ( $category->slug != 'all' ): ?>
				<li><a href="<?php echo get_term_link($category) ?>">&gt; <?php echo $category->name ?></a></li>
				<?php endif;; ?>
			</ul>
			<div class="wrap-second">
				<h4>PRODUCTS</h4>

				<ul class="second">
					<li>&gt; <a href="<?php bloginfo('url') ?>/shop/all">All products</a></li>
					<?php foreach ( $subcategories as $category ): ?>
					<li><a href="<?php echo get_term_link($category) ?>">&gt; <?php echo $category->name ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
