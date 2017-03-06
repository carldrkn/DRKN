<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
$banner = CustomPostType::getInstance('banner')->getPost(array('displayed_in' => 'about'));

$country = $_SESSION['esc_store']['country'];
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php include 'parts/shared/banner.php'; ?>

<div class="container-fluid padding-top content-container">

	<?php include 'parts/about/sidebar.php'; ?>

	<div class="content has-sidebar">

		<?php if ( have_posts() ): ?>
			<ol class="col-md-10">
				<?php while ( have_posts() ) : the_post(); ?>
					<li>
						<article class="single-article">

							<h5>
								<a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
							</h5>

							<p class="author">
							</p>

							<div class="post-content">
								<?php the_content(); ?>
								<?php // SHOW GERMAN KLARNA PAYMENT TERMS ?>
								<?php if ( $post->ID == 153 && $country == 'DE' ): ?>
								<div>
									<p>KLARNA PAYMENT TERMS GERMANY</p>
									<p class="p1"><span class="s1">In Zusammenarbeit mit <a
												href="https://klarna.com/de"><span class="s2">Klarna</span></a> bieten wir die folgenden Zahlungsoptionen an. Die Zahlung erfolgt jeweils an Klarna:</span>
									</p>
									<ul class="ul1">
										<li class="li1"><span class="s1">Klarna Rechnung: Zahlbar innerhalb von 14 Tagen ab Rechnungsdatum. Die Rechnung wird bei Versand der Ware ausgestellt und per E-mail übersandt. Die Rechnungsbedingungen finden <a
													href="https://cdn.klarna.com/1.0/shared/content/legal/terms/38709/de_de/invoice?fee=0"><span
														class="s2">Sie hier</span></a>.</span></li>
									</ul>
									<ul class="ul1">
										<li class="li1"><span class="s1">Klarna Ratenkauf: Mit dem Finanzierungsservice von Klarna können Sie Ihren Einkauf flexibel in monatlichen Raten von mindestens 1/24 des Gesamtbetrages (mindestens jedoch 6,95 EUR) bezahlen. Weitere Informationen zum Klarna Ratenkauf einschließlich der Allgemeinen Geschäftsbedingungen und der europäischen Standardinformationen für Verbraucherkredite finden <a
													href="https://cdn.klarna.com/1.0/shared/content/legal/terms/38709/de_de/account"><span
														class="s2">Sie hier.</span></a>&nbsp;</span></li>
									</ul>
									<ul class="ul1">
										<li class="li1"><span class="s1">Sofortüberweisung</span></li>
									</ul>
									<ul class="ul1">
										<li class="li1"><span class="s1">Kreditkarte (Visa/ Mastercard)</span></li>
										<li class="li1"><span class="s1">Lastschrift</span></li>
									</ul>
									<p class="p1"><span class="s1">Die Zahlungsoptionen werden im Rahmen von Klarna Checkout angeboten. Nähere Informationen und die Nutzungsbedingungen für Klarna Checkout finden <a
												href="https://cdn.klarna.com/1.0/shared/content/legal/terms/38709/de_de/checkout"><span
													class="s2">Sie hier</span></a>. ( Allgemeine Informationen zu Klarna erhalten <a
												href="https://klarna.com/de"><span class="s2">Sie hier</span></a>. Ihre Personenangaben werden von Klarna in Übereinstimmung mit den geltenden Datenschutzbestimmungen und entsprechend den Angaben in <a
												href="https://cdn.klarna.com/1.0/shared/content/policy/data/de_at/data_protection.pdf"><span
													class="s2">Klarnas Datenschutzbestimmungen</span></a> behandelt.</span>
									</p>
								</div>
								<?php endif; ?>
							</div>


						</article>
						<br/>
						<br/>
					</li>
				<?php endwhile; ?>
			</ol>
		<?php else: ?>
			<h2>No posts to display</h2>
		<?php endif; ?>

	</div>

	<div class="clear-both"></div>

</div>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>
