<?php
/**
 * 404.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main" class="oh-page">
	<div class="oh-wrap" style="text-align:center;">
		<h1 class="oh-page__title"><?php esc_html_e( 'Page not found', 'omg-hybrid' ); ?></h1>
		<p><?php esc_html_e( 'The page you were looking for isn’t here. Try the menu, or head back to the home page.', 'omg-hybrid' ); ?></p>
		<p><a class="oh-btn oh-btn--solid" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to home', 'omg-hybrid' ); ?></a></p>
	</div>
</main>
<?php
get_footer();
