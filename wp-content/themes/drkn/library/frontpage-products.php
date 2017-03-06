<?php
/**
 * Created by PhpStorm.
 * User: vilhelm
 * Date: 15/05/15
 * Time: 20:52
 */

class FrontpageProducts {

	public function __construct() {

		add_action('admin_menu', array($this, 'registerAdminMenu'));

	}

	function registerAdminMenu() {

		$templates = new WP_Query(
			array(
				'post_type' => 'page',
				'posts_per_page' => -1,
				'meta_key' => '_wp_page_template',
				'meta_value' => 'frontpage.php',
				'orderby' => 'date',
				'order' => 'ASC'
			)
		);

		if ( $templates->have_posts() ) {
			global $post;
			while( $templates->have_posts() ) {
				$templates->the_post();

				add_submenu_page('edit.php?post_type=silk_products', '', ucfirst(str_replace('-', ' ', $post->post_name)) .' products', 'edit_posts', $post->post_name, array($this, 'settingsPage'));
			}
			wp_reset_postdata();
		}

	}

	function settingsPage() {

		$opt_id = str_replace('-', '_', $_GET['page']);

		if (isset($_POST[$opt_id . '_ids']) )
			update_option($opt_id . '_products', explode(',', $_POST[$opt_id . '_ids']));

		$frontpage_ids = get_option($opt_id . '_products');

		if ( !$frontpage_ids )
			$frontpage_ids = array();

		$products = get_posts(array(
			'numberposts' => -1,
			'post_type' => 'silk_products'
		));

		$products_indexed = index_objects($products, 'ID');
		$frontpage_products = array();
		foreach ( $frontpage_ids as $id ) if ( isset($products_indexed[$id]) )
			$frontpage_products[] = $products_indexed[$id];

		?>

		<h2><?php echo ucfirst(str_replace('-', ' ', $_GET['page'])); ?> products</h2>
		<form action="" method="post">
			<input type="hidden" id="frontpage-ids" name="<?php echo $opt_id . '_ids'; ?>" value="<?php echo implode(',', $frontpage_ids) ?>"/>
			<input type="submit" class="button" value="Save"/>
		</form>

		<p>On frontpage:</p>
		<table class="wp-list-table widefat fixed pages frontpage-products-table">
			<tbody class="frontpage-products-active-tbody">
				<?php foreach ( $frontpage_products as $product ): ?>
				<tr data-id="<?php echo $product->ID ?>">
					<td><?php echo $product->post_title ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<p>Not on frontpage:</p>
		<table class="wp-list-table widefat fixed pages frontpage-products-table frontpage-products-inactive">
			<tbody>
				<?php foreach ( $products as $product ) if ( !in_array($product->ID, $frontpage_ids) ): ?>
				<tr data-id="<?php echo $product->ID ?>">
					<td><?php echo $product->post_title ?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>

		<style>
			.frontpage-products-table tbody.empty {
				display: block;
				min-height: 50px;
			}
			.frontpage-products-table tr {
				cursor: pointer;
			}
			.frontpage-products-table tr:nth-child(2n) td {
				background-color: #f9f9f9;
			}
		</style>

		<script>
			jQuery(function($){
				var fix_empty = function(){
					$('.frontpage-products-table tbody').each(function(){
						$(this)[ !$(this).find('tr').length ? 'addClass' : 'removeClass' ]('empty');

					});
				};
				fix_empty();
				$('.frontpage-products-table tbody').sortable({
					connectWith: '.frontpage-products-table tbody',
					update: function(){
						fix_empty();
						var ids = [];
						$('.frontpage-products-active-tbody tr').each(function(){
							ids.push($(this).data('id'));
						});
						console.log('ids', ids);
						$('#frontpage-ids').val(ids.join(','));
					}
				})
			});
		</script>
		<?php
	}

}

function get_frontpage_products($pagename) {
	$pagename = str_replace('-', '_', $pagename);
	$frontpage_ids = get_option($pagename.'_products');
	$drkn_options = get_option('drkn_theme_options');
	$display_num_products = isset($drkn_options['drkn_theme_products_on_start']) && $drkn_options['drkn_theme_products_on_start'] !== '' ? intval($drkn_options['drkn_theme_products_on_start']) : 6;

	if ( !is_array($frontpage_ids) )
		$frontpage_ids = array();

	$products_indexed = index_objects(get_posts(array(
		'numberposts' => $display_num_products,
		'post_type' => 'silk_products',
		'post__in' => $frontpage_ids
	)), 'ID');

	$products = array();
	foreach ( $frontpage_ids as $id ) if ( $products_indexed[$id] )
		$products[] = $products_indexed[$id];

	/*
	if ( count($products) < $display_num_products )
		$products = array_merge($products, get_posts(array(
			'post_type' => 'silk_products',
			'numberposts' => $display_num_products - count($products),
			'post__not_in' => $frontpage_ids
		)));
	*/

	return $products;

}

new FrontpageProducts();
