<?php
/**
 * OMG Entertainment — testimonials slider content.
 *
 * Single source for the quotes. Rendered below the logo grid by
 * omg-entertainment-layout.php (home + /omg-entertainment/) and by the
 * casino / poker / horse racing templates (client task-009, 2026-10-01).
 * Legacy-layer styles for those three pages are at the end of
 * legacy-styles.css (app.css isn't loaded there).
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

get_template_part( 'template-parts/sections/testimonials', null, array(
	'emblem_text' => 'HAPPY CUSTOMERS • HAPPY CUSTOMERS • ',
	'items'       => array(
		array( 'quote' => 'We hired the OMG group for our corporate Christmas party and let me tell you &mdash; everyone had the best night!', 'cite' => '&mdash; Elisa Chinnabootr' ),
		array( 'quote' => 'Thank you for coming to my husband&rsquo;s 40th casino party. Pablo and the girls were fantastic and very entertaining, explaining everything to new punters. It was lots of fun and got everyone involved.', 'cite' => '&mdash; Jess S., Cobbitty NSW' ),
		array( 'quote' => 'I wish I could give 6 stars! Everyone had a great time and the party went off without a hitch. Our croupiers were friendly, knowledgeable and made sure even the inexperienced players had a great time.', 'cite' => '&mdash; Danielle G., Cabarita NSW' ),
		array( 'quote' => 'They were great to deal with all the way. We had the casino tables package for a bucks night and the boys had a great time &mdash; the staff were amazing on the night.', 'cite' => '&mdash; Veronica P., Leumeah NSW' ),
		array( 'quote' => 'We hired OMG group for our mid-year office party and their service and quality was excellent.', 'cite' => '&mdash; Aarti Mehra' ),
	),
) );
