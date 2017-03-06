<?php

$items = wp_get_nav_menu_items('pages-menu');
?>

<div class="sidebar">
	<div class="col-md-12 no-padding-right">
		<ul class="first">
			<?php foreach ( $items as $item ): ?>
				<li><a href="<?php echo $item->url ?>">&gt; <?php echo $item->title ?></a></li>
			<?php endforeach; ?>
		</ul>

		</div>

	</div>
</div>