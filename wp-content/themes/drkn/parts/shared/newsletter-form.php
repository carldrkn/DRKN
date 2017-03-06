
	<form method="POST" class="newsletter-form">
		<input type="hidden" name="esc_action" value="esc_submit_newsletter">
		<?php echo wp_nonce_field('silk_submit_newsletter'); ?>
		<input type="text" name="esc_email" placeholder="Enter E-mail"/>
		<p class="form-error">Invalid e-mail</p>
		<div class="button">
			<button type="submit" class="u-button button-title">Sign up</button>
		</div>
	</form>
