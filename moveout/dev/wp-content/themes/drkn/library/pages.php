<?php
/**
 * Created by PhpStorm.
 * User: vilhelm
 * Date: 08/05/15
 * Time: 05:01
 */

// Checkbox Meta
add_action("admin_init", "drkn_checkbox_init");

function drkn_checkbox_init(){
	add_meta_box("checkbox", "Checkbox", "drkn_checkbox", "page", "normal", "high");
}

function drkn_checkbox(){
	global $post;
	$custom = get_post_custom($post->ID);
	$field_id = $custom["field_id"][0];
	?>

	<label>Has pages menu</label>
	<?php $field_id_value = get_post_meta($post->ID, 'field_id', true);
	if($field_id_value == "yes") $field_id_checked = 'checked="checked"'; ?>
	<input type="checkbox" name="field_id" value="yes" <?php echo $field_id_checked; ?> />
<?php

}

// Save Meta Details
add_action('save_post', 'save_details');

function save_details(){
	global $post;

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post->ID;
	}

	update_post_meta($post->ID, "field_id", $_POST["field_id"]);
}