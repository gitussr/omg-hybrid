<?php
/**
 * Mobile-only Call / Get Quote / Email row (client task-015, 2026-10-05).
 *
 * Rendered straight after a desktop Call / Book / Email button row. On
 * phones (<=767px) shell.css hides that row and shows this one instead: all
 * three buttons on one line, labelled "Call", "Get Quote" and "Email", each
 * with the arrow. On desktop this row is hidden and the original is untouched.
 *
 * $args:
 *   buttons   array of array{ url:string, label:string } — the row it
 *             stands in for. Phone and email links are picked out of it;
 *             nothing is rendered unless both are there.
 *   row_class string  the replaced row's wrapper class (e.g. "oh-btn-row",
 *             "btn-group"), so the section's own button colours apply.
 *   btn_class string  the replaced row's button class.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$buttons   = $args['buttons'] ?? array();
$row_class = $args['row_class'] ?? 'oh-btn-row';
$btn_class = $args['btn_class'] ?? 'oh-btn oh-btn--outline';

$tel  = '';
$mail = '';
foreach ( $buttons as $btn ) {
	$url = $btn['url'] ?? '';
	if ( ! $tel && 0 === strpos( $url, 'tel:' ) ) {
		$tel = $url;
	} elseif ( ! $mail && 0 === strpos( $url, 'mailto:' ) ) {
		$mail = $url;
	}
}

if ( ! $tel || ! $mail ) {
	return;
}

$items = array(
	array( 'url' => $tel, 'label' => __( 'Call', 'omg-hybrid' ) ),
	array( 'url' => home_url( '/contact/#leave-a-message' ), 'label' => __( 'Get Quote', 'omg-hybrid' ) ),
	array( 'url' => $mail, 'label' => __( 'Email', 'omg-hybrid' ) ),
);
?>
<div class="<?php echo esc_attr( trim( $row_class . ' oh-mcta' ) ); ?>">
	<?php foreach ( $items as $item ) : ?>
		<a class="<?php echo esc_attr( $btn_class . ' oh-mcta__btn' ); ?>" href="<?php echo esc_url( $item['url'] ); ?>">
			<?php echo esc_html( $item['label'] ); ?>
			<?php omg_hybrid_icon( 'fancy-right-arrow-icom' ); ?>
		</a>
	<?php endforeach; ?>
</div>
