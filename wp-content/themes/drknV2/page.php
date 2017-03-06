<?php
// $banner = CustomPostType::getInstance('banner')->getPost(array('displayed_in' => 'about'));

// $country = $_SESSION['esc_store']['country'];
?>


<?php get_template_part( 'parts/shared/header' ); ?>
<?php get_template_part( 'parts/shared/header-nav-bar' ); ?>
	<div class="wrapper">
		<div class="container-fluid sticky-menu">
			<div class="row">
				<div class="col-md-3 col-sm-3 sidebar-menu">
					<div class="list-nav">
						<div class="nav-sticky">
							<div class="nav-sbmenu hidden-xs">
								<?php wp_nav_menu( array( 'theme_location' => 'pages-menu' ) ); ?>
							</div>
						</div>
						<div class="nav-menuselect non-product visible-xs">
							<select></select>
						</div>
					</div>
				</div>
				<div class="col-md-9 col-sm-9 default-page">
					<?php if ( have_posts() ): ?>
						<?php while ( have_posts() ) : the_post(); ?>
						<div class="content">
							<h1><?php the_title(); ?></h1>
							<?php the_content(); ?>
							<?php // SHOW GERMAN KLARNA PAYMENT TERMS ?>
							<?php if ( $post->ID == 153 && $country == 'DE' ): ?>
							<div>
								<p>KLARNA PAYMENT TERMS GERMANY</p>
								<p class="p1">
									<span class="s1">In Zusammenarbeit mit <a href="https://klarna.com/de"><span class="s2">Klarna</span></a> bieten wir die folgenden Zahlungsoptionen an. Die Zahlung erfolgt jeweils an Klarna:</span>
								</p>
								<ul class="ul1">
									<li class="li1">
										<span class="s1">Klarna Rechnung: Zahlbar innerhalb von 14 Tagen ab Rechnungsdatum. Die Rechnung wird bei Versand der Ware ausgestellt und per E-mail übersandt. Die Rechnungsbedingungen finden
											<a href="https://cdn.klarna.com/1.0/shared/content/legal/terms/38709/de_de/invoice?fee=0"><span class="s2">Sie hier</span></a>.
										</span>
									</li>
								</ul>
								<ul class="ul1">
									<li class="li1">
										<span class="s1">Klarna Ratenkauf: Mit dem Finanzierungsservice von Klarna können Sie Ihren Einkauf flexibel in monatlichen Raten von mindestens 1/24 des Gesamtbetrages (mindestens jedoch 6,95 EUR) bezahlen. Weitere Informationen zum Klarna Ratenkauf einschließlich der Allgemeinen Geschäftsbedingungen und der europäischen Standardinformationen für Verbraucherkredite finden <a href="https://cdn.klarna.com/1.0/shared/content/legal/terms/38709/de_de/account"><spanclass="s2">Sie hier.</span></a>&nbsp;</span>
									</li>
								</ul>
								<ul class="ul1">
									<li class="li1"><span class="s1">Sofortüberweisung</span></li>
								</ul>
								<ul class="ul1">
									<li class="li1"><span class="s1">Kreditkarte (Visa/ Mastercard)</span></li>
									<li class="li1"><span class="s1">Lastschrift</span></li>
								</ul>
								<p class="p1">
									<span class="s1">Die Zahlungsoptionen werden im Rahmen von Klarna Checkout angeboten. Nähere Informationen und die Nutzungsbedingungen für Klarna Checkout finden
									<a href="https://cdn.klarna.com/1.0/shared/content/legal/terms/38709/de_de/checkout"><span class="s2">Sie hier</span></a>. ( Allgemeine Informationen zu Klarna erhalten
									<a href="https://klarna.com/de"><span class="s2">Sie hier</span></a>. Ihre Personenangaben werden von Klarna in Übereinstimmung mit den geltenden Datenschutzbestimmungen und entsprechend den Angaben in <a href="https://cdn.klarna.com/1.0/shared/content/policy/data/de_at/data_protection.pdf"><span class="s2">Klarnas Datenschutzbestimmungen</span></a> behandelt.</span>
								</p>
							</div>
							<?php endif; ?>
						</div>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
<?php get_template_part( 'parts/shared/footer' ); ?>
