<?php
/**
 * Alternating image/text service rows.
 *
 * $args:
 *   heading   string  optional section heading
 *   intro     string  optional lead paragraph under the heading
 *   rows      array of array{
 *               id?:string, ribbon?:string, title:string, paragraph:string,
 *               bullets?:string[], content_html?:string, image:string,
 *               image_alt?:string, reverse?:bool, link_url?:string,
 *               link_label?:string
 *             }
 *             `content_html` is a pre-formatted WYSIWYG blob (e.g. from an
 *             SCF field) rendered in place of `paragraph` + `bullets`.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$heading = $args['heading'] ?? '';
$intro   = $args['intro'] ?? '';
$rows    = $args['rows'] ?? array();

if ( ! $rows ) {
	return;
}
?>
<section class="oh-services">
	<div class="oh-wrap">
		<?php if ( $heading || $intro ) : ?>
			<div class="oh-services__heading">
				<?php if ( $heading ) : ?><h2 class="oh-section-title"><?php echo esc_html( $heading ); ?></h2><?php endif; ?>
				<?php if ( $intro ) : ?><p><?php echo wp_kses_post( $intro ); ?></p><?php endif; ?>
			</div>
		<?php endif; ?>

		<?php foreach ( $rows as $row ) :
			$row_id  = $row['id'] ?? '';
			$reverse = ! empty( $row['reverse'] );
			?>
			<div class="oh-service-row<?php echo $reverse ? ' oh-service-row--reverse' : ''; ?>"
				<?php if ( $row_id ) : ?>id="<?php echo esc_attr( $row_id ); ?>" style="scroll-margin-top:160px;"<?php endif; ?>>

				<div class="oh-service-row__body">
					<?php if ( ! empty( $row['ribbon'] ) ) : ?>
						<span class="oh-ribbon"><?php echo esc_html( $row['ribbon'] ); ?></span>
					<?php endif; ?>
					<h2><?php echo wp_kses_post( $row['title'] ?? '' ); ?></h2>
					<?php if ( ! empty( $row['content_html'] ) ) : ?>
						<div class="oh-service-row__rte"><?php echo wp_kses_post( $row['content_html'] ); ?></div>
					<?php else : ?>
						<?php if ( ! empty( $row['paragraph'] ) ) : ?>
							<p><?php echo wp_kses_post( $row['paragraph'] ); ?></p>
						<?php endif; ?>
						<?php if ( ! empty( $row['bullets'] ) ) : ?>
							<ul>
								<?php foreach ( $row['bullets'] as $bullet ) : ?>
									<li><?php echo wp_kses_post( $bullet ); ?></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					<?php endif; ?>
					<?php if ( ! empty( $row['link_url'] ) && ! empty( $row['link_label'] ) ) : ?>
						<a class="oh-btn oh-btn--solid" href="<?php echo esc_url( $row['link_url'] ); ?>">
							<?php echo esc_html( $row['link_label'] ); ?>
							<?php omg_hybrid_icon( 'fancy-right-arrow-icom' ); ?>
						</a>
					<?php endif; ?>
				</div>

				<div class="oh-service-row__media">
					<?php if ( ! empty( $row['image'] ) ) : ?>
						<img src="<?php echo esc_url( $row['image'] ); ?>" alt="<?php echo esc_attr( $row['image_alt'] ?? '' ); ?>" loading="lazy">
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
