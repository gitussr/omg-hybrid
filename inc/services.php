<?php
/**
 * Service registry — the single source of truth for the four service
 * contexts and their colour palettes.
 *
 * One theme, four content contexts, four colour themes. Components never
 * hard-code a service colour; they consume --color-primary / -secondary /
 * -muted, which are switched by the body class listed here.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

/**
 * @return array<string,array{label:string,body_class:string,template:string,palette:array{primary:string,secondary:string,muted:string}}>
 */
function omg_hybrid_services() {
	return array(
		'entertainment' => array(
			'label'      => 'OMG Entertainment',
			'body_class' => 'svc-entertainment',
			'template'   => 'template-omg-entertainment.php',
			'palette'    => array( 'primary' => '#BF2525', 'secondary' => '#FFF1F1', 'muted' => '#FFF9F9' ),
		),
		'studio' => array(
			'label'      => 'OMG Studio',
			'body_class' => 'svc-studio',
			'template'   => 'template-omg-studio.php',
			'palette'    => array( 'primary' => '#33D5C6', 'secondary' => '#E7FFFF', 'muted' => '#F2FFFF' ),
		),
		'live' => array(
			'label'      => 'OMG LiVE',
			'body_class' => 'svc-live',
			'template'   => 'template-omg-live.php',
			'palette'    => array( 'primary' => '#BB44F0', 'secondary' => '#ECE1FF', 'muted' => '#F6F1FF' ),
		),
		'props' => array(
			'label'      => 'OMG Props & Theming',
			'body_class' => 'svc-props',
			'template'   => 'template-omg-props-theming.php',
			'palette'    => array( 'primary' => '#DEDE6D', 'secondary' => '#FFFFCA', 'muted' => '#FFFFEB' ),
		),
	);
}

/**
 * Cross-brand "group" pages that use the slate/gold palette (svc-group)
 * rather than any single service colour: the home page plus these slugs.
 *
 * @return string[]
 */
function omg_hybrid_group_page_slugs() {
	return array( 'contact', 'print-templates' );
}

/**
 * The service body class for the current request, or '' when the page has
 * no service context.
 *
 * The home page and the pages in omg_hybrid_group_page_slugs() resolve to
 * 'svc-group'; the four landing templates resolve to their own class.
 */
function omg_hybrid_current_service_class() {
	$services = omg_hybrid_services();

	if ( is_front_page() ) {
		return 'svc-group';
	}

	if ( is_page() ) {
		$obj = get_queried_object();
		if ( $obj instanceof WP_Post && in_array( $obj->post_name, omg_hybrid_group_page_slugs(), true ) ) {
			return 'svc-group';
		}

		$template = get_page_template_slug( get_queried_object_id() );
		foreach ( $services as $service ) {
			if ( $service['template'] === $template ) {
				return $service['body_class'];
			}
		}
	}

	return '';
}
