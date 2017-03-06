<form method="POST" class="newsletter-form" action="/">
	<div class="nl-wrapper clearfix">
		<label>E-mail:</label>
		
		<input type="hidden" name="esc_action" value="esc_submit_newsletter">
		<input type="email" name="esc_email" placeholder=""/>
		
		<?php echo wp_nonce_field( 'silk_submit_newsletter' ); ?>

		<input type="submit" value="Sign up" name="submit" class="hidden">

	</div>
	
	<p class="form-error">Invalid e-mail</p>
</form>
