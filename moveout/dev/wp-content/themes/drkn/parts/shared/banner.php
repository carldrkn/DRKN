
<?php if ( isset($banner) && $banner ): ?>
<div class="banner hidden-xs">
	<a href="<?php echo $banner->banner_target_link ?>" class="">
		<?php responsive_img( $banner->banner_image ) ?>
	</a>
	<h6 class="banner-title">
		<a href="<?php echo $banner->banner_target_link ?>" class="">
			<?php if ( strlen($banner->banner_button_title) ): ?>
				<span class="banner-button"><?php echo $banner->banner_button_title ?></span>
			<?php endif; ?>
			<?php echo $banner->banner_title ?>
		</a>
	</h6>
</div>
<?php endif; ?>
