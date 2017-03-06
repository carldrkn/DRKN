	</div>
	<footer>
		<div class="container-fluid">
			<div class="row">

				<div class="col-md-12">
					<?php /*
					<nav class="footer-menu float-left">
						<ul>
							<li><a href="">CONTACT</a></li>
							<li><a href="">SHIPPING</a></li>
							<li><a href="">RETURNS</a></li>
						</ul>
					</nav>
 					*/ ?>
					<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'footer-menu',  'container' => '' ) ) ?>

					<ul class="social float-right hidden-sm hidden-xs follow">
						<li>
							<a data-name="facebook" href="https://www.facebook.com/wearedrkn" target="_blank">
							</a>
						</li>
						<li>
							<a data-name="twitter" href="http://twitter.com/wearedrkn" target="_blank">
							</a>
						</li>
						<li>
							<a data-name="instagram" href="http://instagram.com/wearedrkn" target="_blank">
							</a>
						</li>
						<li>
							<a data-name="tumblr" href="http://wearedrkn.tumblr.com/" target="_blank">
							</a>
						</li>
					</ul>

					<div class="clearfix"></div>
				</div>

			</div>
		</div>
	</footer>
