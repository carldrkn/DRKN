	</div>
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-2 col-md-offset-1 col-sm-6 col-xs-6">
					<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'footer-menu',  'container' => '', 'menu_item_start' => 1, 'menu_item_end' => 5 ) ) ?>
				</div>
				<div class="col-md-2 col-sm-6 col-xs-6">
					<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'footer-menu',  'container' => '', 'menu_item_start' => 6, 'menu_item_end' => 10 ) ) ?>
				</div>
				<div class="col-md-2 col-sm-6 col-xs-6">
					<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'footer-menu',  'container' => '', 'menu_item_start' => 11, 'menu_item_end' => 15 ) ) ?>
				</div>
				<div class="col-md-4 col-md-offset-1 col-sm-6 col-xs-6">
					<ul class="social hidden-sm hidden-xs follow">
						<?php wp_nav_menu( array( 'theme_location' => 'social-menu', 'items_wrap' => '%3$s', 'container' => '' ) ); ?>
						<?php /*
						<li class="social-twitter"><a href="#">twitter</a></li>
						<li class="social-instagram"><a href="#">instagram</a></li>
						<li class="social-facebook"><a href="#">facebook</a></li>
						<li class="social-vk"><a href="#">vk</a></li>
						<li class="social-tumblr"><a href="#">tumblr</a></li>
						<li class="social-youtube"><a href="#">youtube</a></li>
						*/ ?>
					</ul>
					<div class="subscribe">
						<h3>Join the Drkn Army</h3>
						<div class="form-subscribe">
							<form method="POST" class="newsletter-form">	
								<div class="nl-wrapper clearfix">
									<input type="hidden" name="esc_action" value="esc_submit_newsletter">
									<?php echo wp_nonce_field('silk_submit_newsletter'); ?>
									<input type="text" name="esc_email" placeholder="Enter E-mail"/>
									<div class="button">		
										<button type="submit" class="u-button button-title">Sign up</button>
									</div>
								</div>
								<p class="form-error">Invalid e-mail</p>
							</form>
						</div>
					</div>
					<span class="copy">© 2016 DRKN Industries AB</span>
					<div class="clearfix"></div>
				</div>

			</div>
		</div>
	</footer>
