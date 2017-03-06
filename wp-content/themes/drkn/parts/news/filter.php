<div class="filter-search hidden-md hidden-sm hidden-lg">

	<div class="select-option col-md-2 col-sm-3 col-xs-6 no-padding-right">
		<div class="select-container" data-title="A title">
			<select class="inverted category">
				<option value="*">CATEGORY</option>
				<?php foreach ( $categories as $category ): ?>
					<option value="<?php echo get_term_link($category) ?>">
						<?php echo $category->name ?>
					</option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
	<div class="select-option col-md-2 col-sm-3 col-xs-6 no-padding-right">
		<div class="select-container" data-title="A title">
			<select class="inverted category">
				<option value="*">TAG</option>
				<?php foreach ( $tags as $tag ): ?>
					<option value="<?php echo get_tag_link($tag) ?>">
						<?php echo $tag->name ?>
					</option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
	<br/>
	<br/>
</div>
