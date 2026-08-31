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
?>

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
						<a <?php echo srDev_link_validation( $button['url'] ); // phpcs:ignore ?> class="oh-btn oh-btn--outline">
							<?php echo esc_html( $button['title'] ?? '' ); ?>
							<?php omg_hybrid_icon( 'fancy-right-arrow-icom' ); ?>
						</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="oh-footer__grid oh-wrap">

		<div class="oh-footer__col">
			<h3><?php esc_html_e( 'OMG Group Services', 'omg-hybrid' ); ?></h3>
			<?php omg_hybrid_footer_menu( 'footer' ); ?>
			<?php omg_hybrid_footer_menu( 'footer-other' ); ?>
		</div>

		<div class="oh-footer__col oh-footer__contact">
			<h3><?php esc_html_e( 'Contact Us', 'omg-hybrid' ); ?></h3>
			<ul>
				<li><a href="https://omggroup.com.au" target="_blank" rel="noopener">OMG Entertainment Group (HQ)</a></li>
				<?php if ( $phone ) : ?>
					<li><a href="tel:<?php echo esc_attr( preg_replace( '/[^\d+]/', '', $phone ) ); ?>"><strong><?php echo esc_html( $phone ); ?></strong></a></li>
				<?php endif; ?>
				<?php if ( $email ) : ?>
					<li><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></li>
				<?php endif; ?>
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

		<div class="oh-footer__col oh-footer__social">
			<h3><?php esc_html_e( 'OMG! Let’s Get Social', 'omg-hybrid' ); ?></h3>
			<ul>
				<?php if ( $facebook ) : ?>
					<li><a href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener"><?php omg_hybrid_icon( 'facebook-icon' ); ?> Facebook</a></li>
				<?php endif; ?>
				<?php if ( $instagram ) : ?>
					<li><a href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener"><?php omg_hybrid_icon( 'instagram-icon' ); ?> Instagram</a></li>
				<?php endif; ?>
				<li>
					<a href="https://www.youtube.com/@OmggamingAu247" target="_blank" rel="noopener">
						<svg width="24" height="24" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"><path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"/></svg>
						YouTube
					</a>
				</li>
			</ul>
		</div>

		<div class="oh-footer__col oh-footer__brand">
			<?php
			if ( has_custom_logo() ) {
				the_custom_logo();
			} else {
				printf( '<img src="%s" alt="%s">', esc_url( OMG_HYBRID_URI . '/assets/images/logo-2.png' ), esc_attr( get_bloginfo( 'name' ) ) );
			}
			?>
		</div>

	</div>

	<div class="oh-footer__copyright">
		&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> OMG Entertainment Group
	</div>

</footer>

<a id="back-to-top-button" role="button" aria-label="<?php esc_attr_e( 'Back to top', 'omg-hybrid' ); ?>">
	<span><?php omg_hybrid_icon( 'fancy-right-arrow-icom' ); ?><br><?php esc_html_e( 'back to top', 'omg-hybrid' ); ?></span>
</a>

<?php get_template_part( 'template-parts/quick-quote' ); ?>

<?php wp_footer(); ?>
</body>
</html>
