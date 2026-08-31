<?php
/**
 * Site header.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$contact  = omg_hybrid_contact_details();
$phone    = $contact['phone_number'] ?? '';
$whatsapp = $contact['whatsapp_link'] ?? '';
$stars    = omg_hybrid_option( 'header_stars' );
$favicon  = get_option( 'omg_favicon' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone=no">
	<?php if ( $favicon ) : ?>
		<link rel="shortcut icon" href="<?php echo esc_url( $favicon ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="oh-skip-link oh-sr-only" href="#main-content"><?php esc_html_e( 'Skip to content', 'omg-hybrid' ); ?></a>

<div id="loader"><div class="spinner"></div></div>

<header id="siteHeader" class="oh-header">

	<div class="oh-header__top">
		<div class="oh-wrap">
			<?php if ( $stars ) :
				$count      = isset( $stars['stars'] ) ? (int) $stars['stars'] : 5;
				$stars_text = $stars['stars_text'] ?? '';
				$link_url   = $stars['link_url'] ?? '';
				$link_text  = $stars['link_text'] ?? '';
				?>
				<div class="oh-header__rating">
					<span class="oh-stars">
						<?php for ( $i = 0; $i < $count; $i++ ) : ?>
							<?php omg_hybrid_icon( 'start-icon' ); ?>
						<?php endfor; ?>
					</span>
					<?php if ( $stars_text || $link_text ) : ?>
						<span class="oh-rating-text">
							<?php echo esc_html( $stars_text ); ?>
							<?php if ( $link_url && $link_text ) : ?>
								<a href="<?php echo esc_url( $link_url ); ?>"><?php echo esc_html( $link_text ); ?></a>
							<?php endif; ?>
						</span>
					<?php endif; ?>
				</div>
			<?php else : ?>
				<span></span>
			<?php endif; ?>

			<div class="oh-header__top-actions">
				<?php if ( $whatsapp ) : ?>
					<a href="<?php echo esc_url( $whatsapp ); ?>" target="_blank" rel="noopener" class="oh-whatsapp">
						<?php omg_hybrid_icon( 'whatsapp-omg' ); ?><span>WhatsApp</span>
					</a>
				<?php endif; ?>
				<?php if ( $phone ) : ?>
					<a href="tel:<?php echo esc_attr( preg_replace( '/[^\d+]/', '', $phone ) ); ?>" class="oh-call">
						<?php omg_hybrid_icon( 'Phone-icon' ); ?><span>Call: <?php echo esc_html( $phone ); ?></span>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="oh-header__bar">
		<div class="oh-wrap">
			<div class="oh-header__brand">
				<?php
				if ( has_custom_logo() ) {
					the_custom_logo();
				} else {
					printf(
						'<a href="%s"><img src="%s" alt="%s"></a>',
						esc_url( home_url( '/' ) ),
						esc_url( OMG_HYBRID_URI . '/assets/images/logo.png' ),
						esc_attr( get_bloginfo( 'name' ) )
					);
				}
				?>
			</div>

			<button class="book-now-header-btn" aria-label="Open the Quick Quote form" aria-expanded="false" aria-controls="book-now-panel">
				Start Planning
			</button>

			<nav class="oh-header__nav menu-block" aria-label="<?php esc_attr_e( 'Primary', 'omg-hybrid' ); ?>">
				<?php
				// The omg-mega-menu plugin replaces wp_nav_menu('main-menu')
				// output entirely and expects its markup inside a .stellarnav
				// container (it forces that element position:relative for its
				// absolutely-positioned hamburger).
				?>
				<div class="stellarnav">
					<?php omg_hybrid_header_nav(); ?>
				</div>
			</nav>
		</div>
	</div>

</header>

<main id="main-content">
