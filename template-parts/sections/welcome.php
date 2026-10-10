<?php
/**
 * "Welcome to …" intro section.
 *
 * Eyebrow + heading + body copy (paragraphs and/or a labelled bullet
 * list) beside a supporting image, with a row of CTA buttons. Mirrors the
 * OMG Entertainment landing layout; used on all four service pages via
 * omg-entertainment/below-hero-1.php and template-parts/service-landing.php.
 *
 * $args:
 *   eyebrow     string    default 'Welcome'
 *   heading     string
 *   heading_logo array{ url:string, alt:string }  optional. Renders the
 *               brand logo inline after the heading text, i.e.
 *               "WELCOME TO [LOGO]" (client 2026-09-24). alt carries the
 *               brand name so the heading still reads in full.
 *   paragraphs  string[]  body paragraphs
 *   bullets     array of array{ label:string, text:string }   optional
 *   buttons     array of array{ url:string, label:string, solid?:bool }
 *   image       string
 *   image_alt   string
 *   image_style 'plain' (default, artwork/transparent PNG) | 'photo' (framed)
 *   decor       true | array{ badge?:string, script?:string }  optional.
 *               When truthy, the image is rendered as the oversized
 *               "breaks out of the column" figure from the original OMG
 *               sites. A `badge` / `script` image only renders if its URL
 *               is given in the array form.
 *   reverse     bool      image on the left when true
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$eyebrow    = $args['eyebrow'] ?? 'Welcome';
$heading    = $args['heading'] ?? '';
$head_logo  = $args['heading_logo'] ?? array();
$paragraphs = $args['paragraphs'] ?? array();
$bullets    = $args['bullets'] ?? array();
$buttons    = $args['buttons'] ?? array();
$image      = $args['image'] ?? '';
$image_alt  = $args['image_alt'] ?? '';
$is_photo   = ( $args['image_style'] ?? 'plain' ) === 'photo';

// $args['decor'] toggles the oversized "breaks out of the column" figure
// (true, or an array). Its optional badge / script images render only when
// their URL is supplied.
$decor        = ! empty( $args['decor'] );
$decor_badge  = is_array( $args['decor'] ?? null ) ? ( $args['decor']['badge']  ?? '' ) : '';
$decor_script = is_array( $args['decor'] ?? null ) ? ( $args['decor']['script'] ?? '' ) : '';

$reverse    = ! empty( $args['reverse'] );

/*
 * Heading logo DORMANT (client 2026-09-28): the "WELCOME TO [LOGO]" logo
 * is no longer shown on the four brand landing pages. The heading_logo
 * args stay in the templates; set this to false to bring the logo back.
 * Headings that relied on the logo for the brand name (LiVE / Props read
 * just "Welcome to") get the logo's alt text appended instead.
 */
$head_logo_dormant = true;
if ( $head_logo_dormant && ! empty( $head_logo['url'] ) ) {
	if ( preg_match( '/\bto\s*$/i', $heading ) && ! empty( $head_logo['alt'] ) ) {
		$heading = rtrim( $heading ) . ' ' . $head_logo['alt'];
	}
	$head_logo = array();
}

if ( ! $heading && ! $paragraphs && ! $bullets ) {
	return;
}
?>
<section class="oh-section oh-section--secondary<?php echo $is_photo ? ' oh-section--welcome-photo' : ''; ?>">
	<div class="oh-wrap oh-service-row<?php echo $reverse ? ' oh-service-row--reverse' : ''; ?>">
		<div class="oh-service-row__body">
			<?php /* Eyebrow ("Welcome") not rendered — removed per client request on the four service landing pages. */ ?>
			<?php if ( $heading && ! empty( $head_logo['url'] ) ) : ?>
				<h2 class="oh-section-title oh-welcome__title--logo">
					<span><?php echo esc_html( $heading ); ?></span>
					<img class="oh-welcome__title-logo" src="<?php echo esc_url( $head_logo['url'] ); ?>" alt="<?php echo esc_attr( $head_logo['alt'] ?? '' ); ?>">
				</h2>
			<?php elseif ( $heading ) : ?><h2 class="oh-section-title"><?php
				// The title is uppercased by CSS; the brand is spelt "LiVE" (client
				// 2026-09-28), so that word is wrapped to opt out of the transform.
				// Only the brand word "OMG" is bold (client task001, 2026-10-07).
				$heading_html = str_replace( 'LiVE', '<span class="oh-keep-case">LiVE</span>', esc_html( $heading ) );
				echo preg_replace( '/\bOMG\b/', '<strong class="oh-welcome__brand">OMG</strong>', $heading_html, 1 );
			?></h2><?php endif; ?>

			<?php foreach ( $paragraphs as $paragraph ) : ?>
				<p><?php echo wp_kses_post( $paragraph ); ?></p>
			<?php endforeach; ?>

			<?php if ( $bullets ) : ?>
				<ul class="oh-welcome__points">
					<?php foreach ( $bullets as $bullet ) : ?>
						<li>
							<?php if ( ! empty( $bullet['label'] ) ) : ?><strong><?php echo wp_kses_post( $bullet['label'] ); ?></strong><?php endif; ?>
							<?php echo wp_kses_post( $bullet['text'] ?? '' ); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<?php if ( $buttons ) : ?>
				<div class="oh-btn-row">
					<?php foreach ( $buttons as $button ) : ?>
						<a class="oh-btn <?php echo empty( $button['solid'] ) ? 'oh-btn--solid' : 'oh-btn--solid'; ?>" href="<?php echo esc_url( $button['url'] ?? '#' ); ?>">
							<?php echo esc_html( $button['label'] ?? '' ); ?>
							<?php omg_hybrid_icon( 'fancy-right-arrow-icom' ); ?>
						</a>
					<?php endforeach; ?>
				</div>
				<?php get_template_part( 'template-parts/sections/mobile-cta', null, array( 'buttons' => $buttons, 'btn_class' => 'oh-btn oh-btn--solid' ) ); ?>
			<?php endif; ?>
		</div>

		<?php if ( $image && $decor ) : ?>
			<div class="oh-service-row__media oh-service-row__media--decor">
				<div class="oh-welcome-figure">
					<img class="oh-welcome-figure__img" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" loading="lazy">
					<?php if ( $decor_script ) : ?>
						<img class="oh-welcome-figure__script" src="<?php echo esc_url( $decor_script ); ?>" alt="" aria-hidden="true" loading="lazy">
					<?php endif; ?>
					<?php if ( $decor_badge ) : ?>
						<img class="oh-welcome-figure__badge" src="<?php echo esc_url( $decor_badge ); ?>" alt="" aria-hidden="true" loading="lazy">
					<?php endif; ?>
				</div>
			</div>
		<?php elseif ( $image ) : ?>
			<div class="oh-service-row__media">
				<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" loading="lazy">
			</div>
		<?php endif; ?>
	</div>
</section>
