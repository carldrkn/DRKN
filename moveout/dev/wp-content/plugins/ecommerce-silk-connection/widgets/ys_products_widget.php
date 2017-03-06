<?php
class ys_products_widget extends WP_Widget {
	/** constructor */
	function ys_products_widget() {
		parent::WP_Widget(false, $name = "(YS) Products", array("description" => "Add products to other pages."));
	}

	function products($post_id) {
		//Loop through products
		$args = array('post_type' => 'silk_products', 'posts_per_page' => -1);
		$loop = new WP_Query($args);
		$options = '<option value="">Select a product</option>';

		while ($loop->have_posts()) {
			$loop->the_post();
			if($loop->post->post_name === 'retrieve-prods') continue;
			$options .= '<option '.($post_id == $loop->post->ID?'selected="selected" ':'').'value="'.$loop->post->ID.'">'.$loop->post->post_title.'</option>';
		}
		return $options;
	}

	function widget($args, $instance) {

		//$loop = new WP_Query(array('post_type' => 'silk_products', 'post__in' => array( $instance['silk_product_1'], $instance['silk_product_2'], $instance['silk_product_3'],$instance['silk_product_4'])));
		$loop = new WP_Query(array('post_type' => 'silk_products', 'post__in' => array( $instance['silk_product_1'], $instance['silk_product_2'], $instance['silk_product_3'])));
?>		
		<div class="related-prods">
			<?php //echo '<h2>'.$instance['title'].'</h2>'; ?>
			<ul class="inline-list">
<?
			while ($loop->have_posts()) {
				$loop->the_post();
				$jsonParams = json_decode(get_post_meta( $loop->post->ID, 'json', true ), true);
				$img = $jsonParams['media'][0]['sources']['litomove-listing'];
				
				$availability = esc_get_availability($jsonParams);
				if(empty($availability)) continue;
			  
			  ?><li>
					<a href="<?php the_field('page_category', get_the_ID());?>#product-<?=get_the_ID()?>" class="product-images <?=the_title()?>">
						<?php 
							$titleSplit = get_the_title();
							$title = explode(" ", $titleSplit); 
						?>
						<div class="product-title">
							<p><?=$title[0]?><br />
								<strong><?=$title[1]?> <?=$title[2]?> <?=$title[3]?> <?=$title[4]?></strong><br />
								<?=($availability['price']?$availability['price']:'')?>
							</p>
						</div>
						<img src="<?=$img['url']?>" />
					</a>
					<a href="<?php the_field('page_category', get_the_ID());?>#product-<?=get_the_ID()?>" class="lito-rm">Mer Info <span class="icon"></span></a>
				</li><?
			}
?>
			</ul>
		</div>
<?php

	}

	//@see WP_Widget::update
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	//@see WP_Widget::form 
	function form($instance) {
		if(isset($instance["title"])) $title = esc_attr($instance["title"]);
		if(isset($instance["silk_product_1"])) $silk_product_1 = esc_attr($instance["silk_product_1"]);
		if(isset($instance["silk_product_2"])) $silk_product_2 = esc_attr($instance["silk_product_2"]);
		if(isset($instance["silk_product_3"])) $silk_product_3 = esc_attr($instance["silk_product_3"]);
		if(isset($instance["silk_product_4"])) $silk_product_4 = esc_attr($instance["silk_product_4"]);

?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('silk_product_1'); ?>">Product 1</label>
				<select size="1" class="widefat" id="<?php echo $this->get_field_id('silk_product_1'); ?>" name="<?php echo $this->get_field_name('silk_product_1'); ?>">
				<?=$this->products($silk_product_1)?>
				</select>
			</p>
			<p><label for="<?php echo $this->get_field_id('silk_product_2'); ?>">Product 2</label>
				<select size="1" class="widefat" id="<?php echo $this->get_field_id('silk_product_2'); ?>" name="<?php echo $this->get_field_name('silk_product_2'); ?>">
				<?=$this->products($silk_product_2)?>
				</select>
			</p>
			<p><label for="<?php echo $this->get_field_id('silk_product_3'); ?>">Product 3</label>
				<select size="1" class="widefat" id="<?php echo $this->get_field_id('silk_product_3'); ?>" name="<?php echo $this->get_field_name('silk_product_3'); ?>">
				<?=$this->products($silk_product_3)?>
				</select>
			</p>
			<p><label for="<?php echo $this->get_field_id('silk_product_4'); ?>">Product 4</label>
				<select size="1" class="widefat" id="<?php echo $this->get_field_id('silk_product_4'); ?>" name="<?php echo $this->get_field_name('silk_product_4'); ?>">
				<?=$this->products($silk_product_4)?>
				</select>
			</p>
<?php
	} // form
}

add_action('widgets_init', create_function('', 'return register_widget("ys_products_widget");'));
