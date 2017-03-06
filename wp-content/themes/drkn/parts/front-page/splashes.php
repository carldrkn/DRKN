<div class="frontpage-splashes clearfix">
	<div class="frontpage-splash col-md-4 col-sm-4 no-padding first">
		<div class="square-container">
			<div class="square-inner">
				<h3 class="title-shop">
					<a href="<?php echo $splashes->splash_1_target_link ?>" class="">
						<span class="title-shop-title">
							<?php echo $splashes->splash_1_title ?>
						</span>
						<?php if ( strlen($splashes->splash_1_button_title) ): ?>
							<span class="shop-button"><?php echo $splashes->splash_1_button_title ?></span>
						<?php endif; ?>
					</a>
				</h3>
				
				<?php $hoverImage1 = wp_get_attachment_image_src( $splashes->splash_1_hover_image, array(750,750) ); ?>
				
				<a href="<?php echo $splashes->splash_1_target_link ?>" class="replace-img" data-second-image="<?php echo ( isset( $hoverImage1[0] ) ? $hoverImage1[0] : '' ); ?>">
					<?php responsive_img($splashes->splash_1_image, 'fill-image') ?>
				</a>
			</div>
		</div>
	</div>

	<div class="frontpage-splash col-md-4 col-sm-4 no-padding second">
		<div class="square-container">
			<div class="square-inner">
				<h3 class="title-shop">
					<a href="<?php echo $splashes->splash_2_target_link ?>" class="">
						<span class="title-shop-title">
							<?php echo $splashes->splash_2_title ?>
						</span>
						<?php if ( strlen($splashes->splash_2_button_title) ): ?>
							<span class="shop-button"><?php echo $splashes->splash_2_button_title ?></span>
						<?php endif; ?>
					</a>
				</h3>
				
				<?php $hoverImage2 = wp_get_attachment_image_src( $splashes->splash_2_hover_image, array(750,750) ); ?>

				<a href="<?php echo $splashes->splash_2_target_link ?>" class="replace-img" data-second-image="<?php echo ( isset( $hoverImage2[0] ) ? $hoverImage2[0] : '' ); ?>">
					<?php responsive_img($splashes->splash_2_image, 'fill-image') ?>
				</a>
			</div>
		</div>
	</div>

	<div class="frontpage-splash col-md-4 col-sm-4 no-padding third">
		<div class="square-container">
			<div class="square-inner">
				<h3 class="title-shop">
					<a href="<?php echo $splashes->splash_3_target_link ?>" class="">
						<span class="title-shop-title">
							<?php echo $splashes->splash_3_title ?>
						</span>
						<?php if ( strlen($splashes->splash_3_button_title) ): ?>
							<span class="shop-button"><?php echo $splashes->splash_3_button_title ?></span>
						<?php endif; ?>
					</a>
				</h3>
				
				<?php $hoverImage3 = wp_get_attachment_image_src( $splashes->splash_3_hover_image, array(750,750) ); ?>

				<a href="<?php echo $splashes->splash_3_target_link ?>" class="replace-img" data-second-image="<?php echo ( isset( $hoverImage3[0] ) ? $hoverImage3[0] : '' ); ?>">
					<?php responsive_img($splashes->splash_3_image, 'fill-image') ?>
				</a>
			</div>
		</div>
	</div>
</div>