<?php
/**
 * Default page template — used by any page with no specific template
 * assigned (Privacy Policy, etc.).
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<div class="oh-page">
	<div class="oh-wrap">
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class(); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="oh-page__thumb"><?php the_post_thumbnail( 'large' ); ?></div>
				<?php endif; ?>
				<h1 class="oh-page__title"><?php the_title(); ?></h1>
				<div class="oh-page__content">
					<?php
					the_content();
					wp_link_pages();
					?>
				</div>
			</article>
		<?php endwhile; ?>
	</div>
</div>
<?php
get_footer();
