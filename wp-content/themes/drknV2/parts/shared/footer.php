<?php $frontPageID = get_option( 'page_on_front' ); ?>
<div class="footer">
	<div class="container">
		<div class="row">
			<div class="footerText">
				<div class="col-md-4">
					<h3><?php echo get_post_meta( $frontPageID, 'shipping_title', true ); ?></h3>

					<p><?php echo get_post_meta( $frontPageID, 'shipping_text', true ); ?></p>

					<a href="<?php echo get_post_meta( $frontPageID, 'shipping_link', true ); ?>">
						<?php echo __( 'Read more', 'DRKN' ); ?>
					</a>
				</div>

				<div class="col-md-4">
					<h3><?php echo get_post_meta( $frontPageID, 'returns_title', true ); ?></h3>

					<p><?php echo get_post_meta( $frontPageID, 'returns_text', true ); ?></p>

					<a href="<?php echo get_post_meta( $frontPageID, 'returns_link', true ); ?>">
						<?php echo __( 'Read more', 'DRKN' ); ?>
					</a>
				</div>

				<div class="col-md-4">
					<h3><?php echo get_post_meta( $frontPageID, 'tac_title', true ); ?></h3>

					<p><?php echo get_post_meta( $frontPageID, 'tac_text', true ); ?></p>

					<a href="<?php echo get_post_meta( $frontPageID, 'tac_link', true ); ?>">
						<?php echo __( 'Read more', 'DRKN' ); ?>
					</a>
				</div>
			</div>

			<div class="col-md-8 col-md-offset-2">
				<div class="subscribe">
					<h3><?php echo __( 'Sign up for latest news and member privileges', 'DRKN' ); ?></h3>

					<div class="form-subscribe">
						<?php get_template_part( 'parts/shared/newsletter-form' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-menu col-md-12">
		<div class="row">
			<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'items_wrap' => '%3$s', 'container' => '' ) ); ?>
		</div>
	</div>
	<div class="f-social-media col-md-12">
		<div class="row">
			<?php wp_nav_menu( array( 'theme_location' => 'social-menu', 'items_wrap' => '%3$s', 'container' => '' ) ); ?>
		</div>
	</div>
	<div class="col-md-12">
		<span class="copy">© <?php echo date("Y") ?> DRKN Industries AB</span>
	</div>
</div>
<?php wp_footer(); ?>
    </body>
</html>
