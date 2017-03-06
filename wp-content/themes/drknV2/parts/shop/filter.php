<div class="filter-search hidden-md hidden-sm hidden-lg">

	<div class="select-option col-md-2 col-sm-3 col-xs-6 no-padding-right">
		<div class="select-container" data-title="A title">
			<select class="inverted category">
				<option value="*">COLLECTION</option>
				<?php foreach ( $master_categories as $category ) if ( $category->slug != 'all' ): ?>
					<option value="<?php echo get_category_link($category) ?>">
						<?php echo $category->name ?>
					</option>
				<?php endif; ?>
			</select>
		</div>
	</div>
	<div class="select-option col-md-2 col-sm-3 col-xs-6 no-padding-right">
		<div class="select-container" data-title="A title">
			<select class="inverted category">
				<option value="*">TYPE</option>
				<?php foreach ( $subcategories as $category ): ?>
					<option value="<?php echo get_category_link($category) ?>">
						<?php echo $category->name ?>
					</option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
</div>
<?php // Do not show on shop ladning ?>
<?php if ( !is_page() ): ?>
<?php
	$sizes = get_option('product_sizes', array());
	$colors = get_option('product_colors', array());
?>
<div class="filter-search">

	<div class="select-option col-md-2 col-sm-3 col-xs-6 no-padding-right">
		<div class="select-container" data-title="A title">
			<select class="inverted meta" name="product_color">
				<?php
				$has_selected = ( isset($_SESSION['product_color']) && '*' !== $_SESSION['product_color'] );
				?>
				<option value="*"><?php echo !$has_selected ? 'COLOR' : 'All colors' ?></option>
				<?php foreach ( $colors as $color ): ?>
					<?php
					$selected = ( isset($_SESSION['product_color']) && $color == $_SESSION['product_color'] );
					?>
					<option value="<?php echo $color ?>" <?php if ($selected) echo 'selected="SELECTED"' ?>>
						<?php echo $color ?>
					</option>
				<?php endforeach ?>
			</select>
		</div>
	</div>
	<div class="select-option col-md-2 col-sm-3 col-xs-6 no-padding-right">
		<div class="select-container" data-title="A title">
			<select class="inverted meta" name="product_size">
				<?php
				$has_selected = ( isset($_SESSION['product_size']) && '*' !== $_SESSION['product_size'] );
				?>
				<option value="*"><?php echo !$has_selected ? 'SIZE' : 'All sizes' ?></option>
				<?php foreach ( $sizes as $size ): ?>
					<?php
					$size_key = str_replace(' ', '', strtolower($size));
					$selected = ( isset($_SESSION['product_size']) && $size_key == $_SESSION['product_size'] );
					?>
					<option value="<?php echo $size_key ?>" <?php if ($selected) echo 'selected="SELECTED"' ?>>
						<?php echo $size ?>
					</option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
</div>
<?php endif; ?>