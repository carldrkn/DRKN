<?php

global $post;

for( $i = 1; $i <= 3; $i++ ) :
	$imageID = get_post_meta( $post->ID, 'Image_' . $i, true );
	$image = wp_get_attachment_url( $imageID );
	$position = get_post_meta( $post->ID, 'Position_' . $i, true );
	$isWide = get_post_meta( $post->ID, 'Is_Wide_' . $i, true );
?>
<div id="ImageContainer_<?php echo $i; ?>" class="image-container">
	<div class="acf-field acf-field-text" data-type="image">
		<div class="acf-label">
			<label for="Image_<?php echo $i; ?>">Image <?php echo $i; ?></label>
		</div>

		<div class="acf-input">
			<div class="acf-input-wrap">
				<input type="hidden" name="Image_<?php echo $i; ?>" id="Image_<?php echo $i; ?>" class="meta-image" data-src="<?php echo $image; ?>" value="<?php echo ( isset ( $imageID ) ) ? $imageID : ''; ?>" />
				<input type="button" id="MetaImageButton_<?php echo $i; ?>" class="button meta-image-btn" value="Choose or Upload an Image" />
			</div>

			<br/>

			<div class="acf-input-wrap image-wrapper" style="display: none;">
				<img src="" alt="<?php echo $image; ?>" id="MetaImageTag_<?php echo $i; ?>" class="img-responsive meta-image-tag" style="max-width: 100%; width: auto; height: auto;" />

				<br/>

				<a href="#" id="DeleteImage_<?php echo $i; ?>" class="meta-image-del">Delete</a>
			</div>
		</div>
	</div>

	<div class="acf-field acf-field-text" data-type="option">
		<div class="acf-label">
			<label for="Position_<?php echo $i; ?>">Position</label>
		</div>

		<div class="acf-input">
			<div class="acf-input-wrap">
				<select name="Position_<?php echo $i; ?>" id="Position_<?php echo $i; ?>">
					<option value="">Please select</option>
					<?php for( $j = 1; $j <= 20; $j++ ) : ?>
					<option value="<?php echo $j; ?>" <?php echo ( $position == $j ) ? 'selected="selected"' : ''; ?>><?php echo $j; ?></option>
					<?php endfor; ?>
				</select>
			</div>
		</div>
	</div>

	<div class="acf-field acf-field-text" data-type="checkbox">
		<div class="acf-label">
			<label for="Is_Wide_<?php echo $i; ?>">Is Wide?</label>
		</div>

		<div class="acf-input">
			<div class="acf-input-wrap">
				<input type="checkbox" name="Is_Wide_<?php echo $i; ?>" id="Is_Wide_<?php echo $i; ?>" value="1" <?php echo ( $isWide ) ? 'checked="checked"' : ''; ?> />
			</div>
		</div>
	</div>
</div>
<?php

	echo ( $i < 3 ) ? '<br><hr><br>' : '';
endfor;
