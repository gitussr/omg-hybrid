<?php
/**
 * Single post.
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
				<h1 class="oh-page__title"><?php the_title(); ?></h1>
				<div class="oh-page__meta"><?php echo esc_html( get_the_date() ); ?></div>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="oh-page__thumb"><?php the_post_thumbnail( 'large' ); ?></div>
				<?php endif; ?>
				<div class="oh-page__content">
					<?php
					the_content();
					wp_link_pages();
					?>
				</div>
			</article>

			<?php
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			?>
		<?php endwhile; ?>
	</div>
</div>
<?php
get_footer();
