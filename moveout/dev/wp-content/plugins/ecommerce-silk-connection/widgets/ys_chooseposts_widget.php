<?php
class ys_chooseposts_widget extends WP_Widget {
	/** constructor */
	function ys_chooseposts_widget() {
		parent::WP_Widget(false, $name = "(YS) Choose Posts", array("description" => "Add posts to the bottom of the product page."));
	}

	function esc_posts($post_id) {
		//Loop through products
		$args = array('post_type' => 'post', 'posts_per_page' => -1);
		$loop = new WP_Query($args);
		$options = '<option value="">Select a post</option>';

		while ($loop->have_posts()) {
			$loop->the_post();
			$options .= '<option '.($post_id == $loop->post->ID?'selected="selected" ':'').'value="'.$loop->post->ID.'">'.$loop->post->post_title.'</option>';
		}
		return $options;
	}

	function widget($args, $instance) {

		$loop = new WP_Query(array('post_type' => 'post', 'post__in' => array( $instance['choosen_post_1'], $instance['choosen_post_2'], $instance['choosen_post_3'])));

?>		
		<div class="related-posts">
			<h2 class="spacing"><?=$instance['title']?></h2>
			<ul class="inline-list">
<?
			while ($loop->have_posts()) {
				$loop->the_post();
			  
			  ?><li>
					<a href="<?=the_permalink()?>">
						<h4><?=the_title()?></h4>
						<?=the_excerpt()?>
					</a>
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
		if(isset($instance["choosen_post_1"])) $choosen_post_1 = esc_attr($instance["choosen_post_1"]);
		if(isset($instance["choosen_post_2"])) $choosen_post_2 = esc_attr($instance["choosen_post_2"]);
		if(isset($instance["choosen_post_3"])) $choosen_post_3 = esc_attr($instance["choosen_post_3"]);

?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('choosen_post_1'); ?>">Chosen Post 1</label>
				<select size="1" class="widefat" id="<?php echo $this->get_field_id('choosen_post_1'); ?>" name="<?php echo $this->get_field_name('choosen_post_1'); ?>">
				<?=$this->esc_posts($choosen_post_1)?>
				</select>
			</p>
			<p><label for="<?php echo $this->get_field_id('choosen_post_2'); ?>">Chosen Post 2</label>
				<select size="1" class="widefat" id="<?php echo $this->get_field_id('choosen_post_2'); ?>" name="<?php echo $this->get_field_name('choosen_post_2'); ?>">
				<?=$this->esc_posts($choosen_post_2)?>
				</select>
			</p>
			<p><label for="<?php echo $this->get_field_id('choosen_post_3'); ?>">Chosen Post 3</label>
				<select size="1" class="widefat" id="<?php echo $this->get_field_id('choosen_post_3'); ?>" name="<?php echo $this->get_field_name('choosen_post_3'); ?>">
				<?=$this->esc_posts($choosen_post_3)?>
				</select>
			</p>
<?php
	} // form
}

add_action('widgets_init', create_function('', 'return register_widget("ys_chooseposts_widget");'));
