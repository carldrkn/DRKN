<?php

$categories = get_categories( array(
	'type'                     => 'post',
	'child_of'                 => 0,
	'parent'                   => '',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'category',
	'pad_counts'               => false
) );

$tags = get_tags();
?>

<div class="sidebar">
	<div class="col-md-12 no-padding-right">
		<ul class="first">
			<?php foreach ( $categories as $category ): ?>
			<li><a href="<?php echo get_term_link($category) ?>">&gt; <?php echo $category->name ?></a></li>
			<?php endforeach; ?>
		</ul>
		<div class="wrap-second">
			<h6>TAGS</h6>

			<div class="tags">
				<?php foreach ( $tags as $k => $tag ): ?>
					<a href="<?php echo get_tag_link($tag) ?>">
						<?php echo $tag->name ; ?>
					</a><?php if ( count($tags) - 1 !== $k ) echo ',' ?>
				<?php endforeach; ?>
			</div>

		</div>

	</div>
</div>