<?php
/**
 * Fallback template — archives, blog, search.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<div class="oh-page">
	<div class="oh-wrap">

		<?php if ( have_posts() ) : ?>

			<header class="oh-page__header">
				<h1 class="oh-page__title">
					<?php
					if ( is_search() ) {
						printf( esc_html__( 'Search results for: %s', 'omg-hybrid' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
					} elseif ( is_archive() ) {
						the_archive_title();
					} else {
						echo esc_html( get_the_title( (int) get_option( 'page_for_posts' ) ) ?: __( 'Latest', 'omg-hybrid' ) );
					}
					?>
				</h1>
			</header>

			<div class="oh-post-list">
				<?php while ( have_posts() ) : the_post(); ?>
					<article <?php post_class( 'oh-post-list__item' ); ?>>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="oh-page__content"><?php the_excerpt(); ?></div>
					</article>
				<?php endwhile; ?>
			</div>

			<?php the_posts_pagination(); ?>

		<?php else : ?>
			<h1 class="oh-page__title"><?php esc_html_e( 'Nothing found', 'omg-hybrid' ); ?></h1>
			<p><?php esc_html_e( 'No content matched your request.', 'omg-hybrid' ); ?></p>
		<?php endif; ?>

	</div>
</div>
<?php
get_footer();
