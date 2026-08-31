<?php
/**
 * Bottom call-to-action band.
 *
 * $args:
 *   title    string
 *   subtitle string
 *   buttons  array of array{ url:string, label:string }
 *            When omitted, falls back to Call / Book / Email built from the
 *            Theme Settings contact details.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$title    = $args['title'] ?? '';
$subtitle = $args['subtitle'] ?? '';
$buttons  = $args['buttons'] ?? array();

if ( ! $buttons ) {
	$contact = omg_hybrid_contact_details();
	$phone   = $contact['phone_number'] ?? '';
	$email   = $contact['email_address'] ?? '';
	if ( $phone ) {
		$buttons[] = array( 'url' => 'tel:' . preg_replace( '/[^\d+]/', '', $phone ), 'label' => __( 'Call Us', 'omg-hybrid' ) );
	}
	$buttons[] = array( 'url' => home_url( '/contact/' ), 'label' => __( 'Book an Event', 'omg-hybrid' ) );
	if ( $email ) {
		$buttons[] = array( 'url' => 'mailto:' . $email, 'label' => __( 'Email Us', 'omg-hybrid' ) );
	}
}
?>
<section class="oh-cta">
	<div class="oh-wrap">
		<?php if ( $title ) : ?><h2><?php echo wp_kses_post( $title ); ?></h2><?php endif; ?>
		<?php if ( $subtitle ) : ?><p><?php echo wp_kses_post( $subtitle ); ?></p><?php endif; ?>
		<div class="oh-btn-row">
			<?php foreach ( $buttons as $btn ) : ?>
				<a class="oh-btn oh-btn--outline" href="<?php echo esc_url( $btn['url'] ?? '#' ); ?>">
					<?php echo esc_html( $btn['label'] ?? '' ); ?>
					<?php omg_hybrid_icon( 'fancy-right-arrow-icom' ); ?>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
