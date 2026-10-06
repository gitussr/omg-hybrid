<?php
/**
 * Site footer.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$contact       = omg_hybrid_contact_details();
$phone         = $contact['phone_number'] ?? '';
$email         = $contact['email_address'] ?? '';
$facebook      = $contact['facebook_link'] ?? '';
$instagram     = $contact['instagram_link'] ?? '';
$whatsapp_link = $contact['whatsapp_link'] ?? '';
$whatsapp_num  = $contact['whatsapp_number'] ?? '';

$footer_title = omg_hybrid_option( 'footer_title' );
$cta_buttons  = omg_hybrid_option( 'cta_buttons' );

// DORMANT on the four brand landing pages (client 2026-09-24): the footer's
// Call Us / Book an Event / Email Us buttons are hidden there, because
// each of those pages now ends on its own CTA band right above the footer.
// The buttons stay in Theme Settings and still render everywhere else —
// remove a template from this list to bring them back on that page.
if ( is_page_template( array(
	'template-omg-entertainment.php',
	'template-omg-studio.php',
	'template-omg-live.php',
	'template-omg-props-theming.php',
	'template-omg-food-beverage.php', // task-019
) ) ) {
	$cta_buttons = array();
}
?>

</main>

<footer class="oh-footer">

	<?php if ( $footer_title || $cta_buttons ) : ?>
		<div class="oh-footer__cta oh-wrap">
			<?php if ( $footer_title ) : ?>
				<h2><?php echo esc_html( $footer_title ); ?></h2>
			<?php endif; ?>
			<?php if ( $cta_buttons ) : ?>
				<div class="oh-footer__cta-buttons">
					<?php foreach ( $cta_buttons as $row ) :
						$button = $row['button'] ?? null;
						if ( ! $button || empty( $button['url'] ) ) {
							continue;
						}
						?>
						<a <?php echo srDev_link_validation( $button['url'] ); // phpcs:ignore ?> class="oh-btn oh-btn--solid">
							<?php echo esc_html( $button['title'] ?? '' ); ?>
							<?php omg_hybrid_icon( 'fancy-right-arrow-icom' ); ?>
						</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="oh-footer__grid oh-wrap">
		<!-- COL 1 -->
		<div class="oh-footer__col">
			<h3><?php esc_html_e( 'OMG Group Services', 'omg-hybrid' ); ?></h3>
			<?php
			// Extra "Photo-Booth & Photography" quick link in the footer services
			// menu, placed right after "Props & Theming" and linking the OMG
			// Studio page (client 2026-09-19). Falls back to the end of the
			// menu if that item is ever renamed or removed.
			$omg_footer_studio_link = static function ( $items, $args ) {
				if ( ! isset( $args->theme_location ) || 'footer' !== $args->theme_location ) {
					return $items;
				}
				$link  = '<li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="' . esc_url( home_url( '/omg-studio/' ) ) . '">' . esc_html__( 'Photo-Booth & Photography', 'omg-hybrid' ) . '</a></li>';
				$props = strpos( $items, '>Props &#038; Theming</a>' );
				$close = ( false !== $props ) ? strpos( $items, '</li>', $props ) : false;
				if ( false === $close ) {
					return $items . $link;
				}
				$close += strlen( '</li>' );
				return substr( $items, 0, $close ) . "\n" . $link . substr( $items, $close );
			};
			add_filter( 'wp_nav_menu_items', $omg_footer_studio_link, 10, 2 );
			omg_hybrid_footer_menu( 'footer' );
			remove_filter( 'wp_nav_menu_items', $omg_footer_studio_link, 10 );
			?>
			<?php omg_hybrid_footer_menu( 'footer-other' ); ?>
		</div>
		
		<!-- COL 2 -->
		<div class="oh-footer__col oh-footer__social">
			<h3><?php esc_html_e( 'OMG! Let’s Get Social', 'omg-hybrid' ); ?></h3>
			<?php
			/*
			 * Vertical "[glyph] Facebook" list restored (client 2026-09-22),
			 * replacing the horizontal row of full-colour 3D PNG tiles added
			 * 2026-09-21. The glyphs are inline SVG again so they pick up
			 * shell.css's .oh-footer__social svg treatment - faint translucent
			 * disc, theme-coloured glyph - i.e. exactly the WhatsApp icon in
			 * the Contact Us column, which the client gave as the reference.
			 *
			 * On tablet and below (<=991px, where the footer grid drops from
			 * 4 columns to 2) the labels are hidden and the list lays out as
			 * a horizontal row of icons - see .oh-social-list in shell.css.
			 *
			 * WhatsApp stays out of this column (client 2026-09-21): it lives
			 * in Contact Us where it carries the actual number. The 3D tiles
			 * remain on the server at assets/images/social/ if ever wanted back.
			 */
			?>
			<ul class="oh-social-list">
				<?php if ( $facebook ) : ?>
					<li>
						<a href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener">
							<?php omg_hybrid_icon( 'facebook-icon' ); ?>
							<span class="oh-social-label"><?php esc_html_e( 'Facebook', 'omg-hybrid' ); ?></span>
						</a>
					</li>
				<?php endif; ?>
				<?php if ( $instagram ) : ?>
					<?php // Inline glyph with no hard-coded fill, so the CSS fill (theme colour) applies - same as YouTube below. ?>
					<li>
						<a href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="m17 2h-10c-2.76 0-5 2.24-5 5v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5v-10c0-2.76-2.24-5-5-5zm-5 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm5.35-9.38c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z"/><circle cx="12" cy="12" r="3"/></svg>
							<span class="oh-social-label"><?php esc_html_e( 'Instagram', 'omg-hybrid' ); ?></span>
						</a>
					</li>
				<?php endif; ?>
				<li>
					<a href="https://www.youtube.com/@OmggamingAu247" target="_blank" rel="noopener">
						<svg width="24" height="24" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" focusable="false"><path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"/></svg>
						<span class="oh-social-label"><?php esc_html_e( 'YouTube', 'omg-hybrid' ); ?></span>
					</a>
				</li>
			</ul>
		</div>

		<!-- COL 3 -->
		
		<div class="oh-footer__col oh-footer__contact">
			<h3><?php esc_html_e( 'Contact Us', 'omg-hybrid' ); ?></h3>
			<ul>
				<?php // Links to this site's home page (client 2026-09-25; was omggroup.com.au "OMG Entertainment website"). ?>
				<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank" rel="noopener">OMG Entertainment</a></li>
				<?php // HQ 1300 number, shown in "1300 300 664 (OMG)" format (client 2026-09-19). ?>
				<li><a href="tel:1300300664"><strong>1300 300 664 (OMG)</strong></a></li>
				<?php if ( $phone && '1300300664' !== preg_replace( '/\D/', '', $phone ) ) : ?>
					<li><a href="tel:<?php echo esc_attr( preg_replace( '/[^\d+]/', '', $phone ) ); ?>"><strong><?php echo esc_html( $phone ); ?></strong></a></li>
				<?php endif; ?>
				<?php // Footer-only email (client 2026-09-19); the Theme Settings email is unchanged elsewhere. ?>
				<li><a href="mailto:info@OMGent.com.au">info@OMGent.com.au</a></li>
				<?php if ( $whatsapp_link ) : ?>
					<li>
						<a href="<?php echo esc_url( $whatsapp_link ); ?>" target="_blank" rel="noopener" class="oh-footer__social">
							<?php omg_hybrid_icon( 'whatsapp-omg' ); ?>
							<?php echo esc_html( $whatsapp_num ?: 'WhatsApp' ); ?>
						</a>
					</li>
				<?php endif; ?>
			</ul>
		</div>

		<!-- COL 4 -->

		<div class="oh-footer__col oh-footer__brand">
			<h3><?php esc_html_e( 'Visit our HQ', 'omg-hybrid' ); ?></h3>
			<?php
			// "Visit our HQ" mark: the OMG Group lockup pulled from
			// omggroup.com.au (client 2026-09-22), replacing both the gold-only
			// mark that svc-group used and the per-template
			// footer-logo-omg-entertainment.png the Entertainment / LiVE pages
			// used. Same "OMG Entertainment Group" logo as the home page on
			// every page (client 2026-09-25) — Studio, Props and Food &
			// Beverage previously swapped in the dark-subtitle
			// logo-omg-on-light.png ("Entertainment", no "Group") for their
			// bright footer bands.
			// The /omg-studio/ and /omg-props-theming/ landing pages, plus the
			// Studio pages /our-booths/ and /photography-videography/, use the
			// client's dark-subtitle version of the same lockup
			// (footer-logo-omg-hq-on-light.png, client 2026-09-25) on their
			// bright cyan / amber footer bands.
			$footer_logo = is_page( array( 'omg-studio', 'omg-props-theming', 'our-booths', 'photography-videography' ) )
				? 'footer-logo-omg-hq-on-light.png'
				: 'footer-logo-omg-hq.png';
			// Logo links to the OMG Group HQ site on every page (client 2026-09-14).
			printf(
				'<a href="%s"><img src="%s" alt="%s"></a>',
				esc_url( 'https://omggroup.com.au/' ),
				esc_url( OMG_HYBRID_URI . '/assets/images/' . $footer_logo ),
				esc_attr( get_bloginfo( 'name' ) )
			);
			?>
		</div>

	</div>

	<div class="oh-footer__copyright">
		<?php // Copyright links to the OMG Group site (client 2026-09-19). ?>
		<a href="<?php echo esc_url( 'https://omggroup.com.au/' ); ?>" target="_blank" rel="noopener">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> OMG Entertainment Group</a>
	</div>

</footer>

<a id="back-to-top-button" role="button" aria-label="<?php esc_attr_e( 'Back to top', 'omg-hybrid' ); ?>">
	<?php omg_hybrid_icon( 'fancy-right-arrow-icom' ); ?>
	<span><?php esc_html_e( 'Back to', 'omg-hybrid' ); ?><br><?php esc_html_e( 'top', 'omg-hybrid' ); ?></span>
</a>

<?php get_template_part( 'template-parts/quick-quote' ); ?>

<?php wp_footer(); ?>
</body>
</html>
