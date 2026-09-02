<?php
/**
 * Brand "Our Services" page content.
 *
 * One dedicated services page per brand — /omg-{brand}/our-services/ —
 * rendering the brand's service rows (text-left / image-right, no zigzag)
 * behind a banner, closing with the brand's "Ready to…" CTA. The
 * mega-menu submenu items deep-link into these pages by #anchor.
 *
 * The row copy is the same static material the landing templates carry;
 * it lives here so the landing template and the services page share one
 * source. Rows are stored WITHOUT a `reverse` flag — every row renders
 * text-left / image-right.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

/**
 * The { hero, rows, cta } bundle for a brand's services page.
 *
 * @param string $brand 'entertainment' | 'live' | 'props'
 * @return array{hero:array,rows:array,cta:array}
 */
function omg_hybrid_brand_services( $brand ) {
	$img = OMG_HYBRID_URI . '/assets/images/';

	$data = array(

		'entertainment' => array(
			'hero' => array(
				'variant'     => 'inner',
				'eyebrow'     => 'OMG Entertainment',
				'title'       => 'Creating Unforgettable Event Experiences',
				'description' => 'Casino nights, race days, poker tables and showstopping performers &mdash; the entertainment that turns any event into the one people are still talking about.',
				'slides'      => array( array( 'type' => 'image', 'url' => $img . 'omg-entertainment-banner1.jpg' ) ),
			),
			'rows' => array(
				array(
					'id'         => 'casino-fun-nights',
					'title'      => 'Casino Fun Nights',
					'paragraph'  => 'Full-sized, professional casino tables and entertainment-skilled croupiers, straight to your venue. Blackjack, Roulette, Poker, Craps and the Money Wheel run on premium Australian-made equipment, with guests playing for fun on unlimited chips &mdash; zero real-money risk.',
					'bullets'    => array(
						'Full-sized tables: Blackjack, Roulette, Poker, Baccarat, Craps, Sic Bo &amp; Money Wheel',
						'Entertainment-skilled croupiers with 100+ years of combined experience',
						'Optional awards ceremony to crown your top players',
					),
					'image'      => $img . 'omg-entertainment-banner1.jpg',
					'image_alt'  => 'Guests celebrating at an OMG Entertainment casino night',
					'link_url'   => home_url( '/contact/' ),
					'link_label' => 'Enquire About Casino Fun Nights',
				),
				array(
					'id'         => 'horse-racing-fun-nights',
					'title'      => 'Horse Racing Fun Nights',
					'paragraph'  => 'Skip the racecourse and bring race-day atmosphere straight to your event. Live race simulations, a professional MC and your very own bookies make for a fully customisable, dress-up-friendly experience for guests of every age.',
					'bullets'    => array(
						'Live race simulations with a professional MC race caller',
						'Your own &ldquo;bookies&rdquo; with funny-money betting slips &amp; payouts',
						'Optional best-dressed &amp; King/Queen of the Track awards',
					),
					'image'      => $img . 'omg-studio-golden-bg-2.jpg',
					'image_alt'  => 'Gold sparkle backdrop styled for an OMG Entertainment race night',
					'link_url'   => home_url( '/contact/' ),
					'link_label' => 'Enquire About Race Nights',
				),
				array(
					'id'         => 'poker-tournaments',
					'title'      => 'Poker Tournaments',
					'paragraph'  => 'Check, raise or fold &mdash; from a casual social game to a full-scale professional tournament, we bring the tables, the cards and the atmosphere. Texas Hold&rsquo;Em is our signature game, with Omaha, 7 Card Stud and HORSE available on request.',
					'bullets'    => array(
						'Texas Hold&rsquo;Em plus Omaha, 7 Card Stud &amp; HORSE on request',
						'No limits on time or player numbers',
						'Professional dealers keep every table running smoothly',
					),
					'image'      => $img . 'events.jpg',
					'image_alt'  => 'OMG Entertainment poker table with chips and cards',
					'link_url'   => home_url( '/contact/' ),
					'link_label' => 'Enquire About Poker Tournaments',
				),
				array(
					'id'         => 'showgirls',
					'title'      => 'Showgirls',
					'paragraph'  => 'A polished, professional showtime energy for any event &mdash; from a glamorous guest welcome to a full choreographed floor show. Costuming and routines are tailored to your venue, theme and audience.',
					'bullets'    => array(
						'Professional, rehearsed choreography',
						'Dazzling costuming suited to your event&rsquo;s theme',
						'Pairs seamlessly with our Casino Fun Nights',
					),
					'image'      => $img . 'omg-studio-golden-bg-3.jpg',
					'image_alt'  => 'Glamorous performers at an OMG Entertainment event',
					'link_url'   => home_url( '/contact/' ),
					'link_label' => 'Enquire About Showgirls',
				),
				array(
					'id'         => 'magicians',
					'title'      => 'Magicians',
					'paragraph'  => 'Light-hearted, jaw-dropping magic that gets every guest talking &mdash; from table-to-table close-up tricks to a polished 30-minute stage show. Family-friendly and built around genuine guest interaction.',
					'bullets'    => array(
						'Roving close-up magic, perfect for mingling events',
						'A 30-minute magic stage show for the whole room',
						'Flexible booking, from one hour to a full evening',
					),
					'image'      => $img . 'omg-studio-golden-bg.jpg',
					'image_alt'  => 'Gold sparkle backdrop styled for an OMG Entertainment magic show',
					'link_url'   => home_url( '/contact/' ),
					'link_label' => 'Enquire About Magicians',
				),
				array(
					'id'         => 'elvis-mj-impersonators',
					'title'      => 'Elvis &amp; MJ Impersonators',
					'paragraph'  => 'Two of the world&rsquo;s most iconic performers, brought to life for your event. Our Elvis and Michael Jackson tribute performers deliver showstopping vocals, unmistakable costuming and choreography, tailored to your run sheet.',
					'bullets'    => array(
						'The Elvis Experience &mdash; classic costuming &amp; unmistakable vocals',
						'The Michael Jackson Experience &mdash; iconic choreography',
						'Sing-along &amp; interactive moments that get guests on the floor',
					),
					'image'      => $img . 'roaming-photography.jpg',
					'image_alt'  => 'Tribute performer greeting a guest at an OMG Entertainment event',
					'link_url'   => home_url( '/contact/' ),
					'link_label' => 'Enquire About Tribute Acts',
				),
			),
			'cta' => array(
				'title'    => 'Ready To Book Your Entertainment?',
				'subtitle' => 'Casino, races, poker or performers &mdash; get in touch for a free, no-obligation quote.',
			),
		),

		'live' => array(
			'hero' => array(
				'variant'     => 'inner',
				'eyebrow'     => 'OMG LiVE',
				'title'       => 'Read The Room. Keep It Moving.',
				'description' => 'Elite DJs, atmospheric lighting and unforgettable live bands &mdash; club-standard sound and production that reads the room and keeps it moving.',
				'slides'      => array( array( 'type' => 'image', 'url' => $img . 'omg-live-hero.jpg' ) ),
			),
			'rows' => array(
				array(
					'id'         => 'djs-dj-booth',
					'title'      => 'DJs &amp; DJ Booth',
					'paragraph'  => 'More than just a playlist &mdash; our open-format DJs master the art of reading the room, transitioning from sophisticated lounge and jazz during cocktails to energetic dance tracks when the party peaks, all through club-standard audio and a sleek, custom-designed booth.',
					'bullets'    => array(
						'High-fidelity, club-standard PA systems scaled to guest count',
						'Wireless microphones included for speeches and MC duties',
						'Sleek, custom-designed booths matching your event aesthetic',
					),
					'image'      => $img . 'dj-custom-new.jpg',
					'image_alt'  => 'DJ performing at an OMG LiVE event',
					'link_url'   => home_url( '/contact/' ),
					'link_label' => 'Enquire About DJ Hire',
				),
				array(
					'id'         => 'event-lighting-hire',
					'title'      => 'Event Lighting Hire',
					'paragraph'  => 'We focus on atmospheric lighting, not stadium-scale production &mdash; transforming ordinary venues into extraordinary spaces. From sophisticated warm tones for a formal gala to vibrant, colour-matched washes for a product launch, our clean, modern LED rigs run efficiently in any venue.',
					'bullets'    => array(
						'Wireless, cable-free LED uplighting for walls, pillars &amp; features',
						'Static and dynamic colour options, including custom colour matching',
						'Seamless compatibility with our DJ and live band services',
					),
					'image'      => $img . 'events-custom-new.jpg',
					'image_alt'  => 'Coloured LED lighting in use at an OMG LiVE event',
					'link_url'   => home_url( '/contact/' ),
					'link_label' => 'Request A Lighting Quote',
				),
				array(
					'id'         => 'live-bands',
					'title'      => 'Live Bands &amp; Musicians',
					'paragraph'  => 'Nothing replaces the energy of a live performance. Our roster of vetted, professional session musicians and powerhouse performers ranges from acoustic soloists and jazz ensembles to full party bands and specialty performers, suited to everything from intimate dinners to large corporate galas.',
					'bullets'    => array(
						'Acoustic soloists &amp; duos, jazz ensembles, full party bands &amp; specialty acts',
						'Vetted, seasoned professionals with corporate &amp; luxury event experience',
						'Versatile, customisable setlists matched to your guest list',
					),
					'image'      => $img . 'omg-entertainment-banner1.jpg',
					'image_alt'  => 'Guests enjoying live entertainment at an OMG LiVE event',
					'link_url'   => home_url( '/contact/' ),
					'link_label' => 'Check Artist Availability',
				),
			),
			'cta' => array(
				'title'    => 'Ready To Get The Room Moving?',
				'subtitle' => 'DJs, lighting or live music &mdash; get in touch for a free, no-obligation quote.',
			),
		),

		'props' => array(
			'hero' => array(
				'variant'     => 'inner',
				'eyebrow'     => 'OMG Props &amp; Theming',
				'title'       => 'Set The Scene Before A Single Guest Arrives',
				'description' => 'Casino props, grand entrances, theme walls, furniture and AV tech &mdash; the styling and equipment that sets the scene before a single guest arrives.',
				'slides'      => array( array( 'type' => 'image', 'url' => $img . 'props-custom-new.jpg' ) ),
			),
			'rows' => array(
				array(
					'id'         => 'casino-props',
					'title'      => 'Casino Props',
					'paragraph'  => 'Decorative and entertainment props that set the scene for any casino-themed event &mdash; from illuminated marquee letters and a programmable Welcome to Vegas LED sign to oversized dice and full themed package bundles pairing a red carpet, theme wall and playing-card stand-ups.',
					'bullets'    => array(
						'Light-up marquee letters &amp; programmable Vegas LED signage',
						'Giant dice and card-suit props in James Bond, Gatsby &amp; Vegas themes',
						'Themed package bundles combining carpet, wall &amp; stand-ups',
					),
					'image'      => $img . 'events-custom-new.jpg',
					'image_alt'  => 'Casino-themed event styled with OMG props',
					'link_url'   => home_url( '/contact/' ),
					'link_label' => 'Enquire About Casino Props',
				),
				array(
					'id'         => 'grand-entrance-themes',
					'title'      => 'Grand Entrance Themes',
					'paragraph'  => 'First impressions set the tone. A red carpet and bollards, a custom entrance sign in a Vegas, James Bond or Gatsby theme, or a directional cinema-style marquee &mdash; each one styled to give your guests an upscale arrival experience from the moment they walk in.',
					'bullets'    => array(
						'Red carpet &amp; bollards, in plain or OMG-branded finishes',
						'Vegas, James Bond &amp; Gatsby themed entrance signage',
						'Customisable cinema-style marquee signs',
					),
					'image'      => $img . 'omg-studio-golden-bg-3.jpg',
					'image_alt'  => 'Illuminated themed entrance styling for an OMG event',
					'link_url'   => home_url( '/contact/' ),
					'link_label' => 'Enquire About Grand Entrances',
				),
				array(
					'id'         => 'theme-walls',
					'title'      => 'Theme Walls',
					'paragraph'  => 'Backlit LED Maxi and Mini theme walls or standard backdrop panels, styled in Casino Royale, 1920s Gatsby, Las Vegas, Moulin Rouge or Hollywood themes &mdash; the perfect statement backdrop for photos, staging or a full room transformation.',
					'bullets'    => array(
						'LED Maxi (6m) &amp; Mini (1.4m) backlit theme walls',
						'Standard backdrop panels in five signature themes',
						'A ready-made, photo-worthy focal point for any event',
					),
					'image'      => $img . 'props-detail.jpg',
					'image_alt'  => 'Las Vegas themed backdrop wall with props styled for an event',
					'link_url'   => home_url( '/contact/' ),
					'link_label' => 'Enquire About Theme Walls',
				),
				array(
					'id'         => 'furniture',
					'title'      => 'Furniture',
					'paragraph'  => 'Lounge and cocktail furniture, styling props and display tables that tie your event styling together &mdash; delivered and set up around your chosen theme, whether that&rsquo;s a casino night, a corporate gala or a themed celebration.',
					'bullets'    => array(
						'Lounge &amp; cocktail furniture styled to your event theme',
						'Display and prop tables for casino games or photo areas',
						'Delivered, set up and styled as part of your package',
					),
					'image'      => $img . 'our-booth-img-1.jpg',
					'image_alt'  => 'Styled event setup with themed props and furniture',
					'link_url'   => home_url( '/contact/' ),
					'link_label' => 'Enquire About Furniture',
				),
				array(
					'id'         => 'audio-visual-tech',
					'title'      => 'Audio / Visual Tech',
					'paragraph'  => 'Clean, reliable sound and screen equipment to back up your event styling &mdash; PA systems, microphones and display screens that integrate seamlessly with our DJ, lighting and live entertainment services for a fully coordinated event.',
					'bullets'    => array(
						'PA systems and wireless microphones for speeches &amp; MCs',
						'Display screens available for presentations or branding',
						'Coordinates seamlessly with OMG LiVE sound &amp; lighting',
					),
					'image'      => $img . 'events-custom-new.jpg',
					'image_alt'  => 'AV and lighting equipment set up at a styled OMG event',
					'link_url'   => home_url( '/contact/' ),
					'link_label' => 'Enquire About AV Tech',
				),
			),
			'cta' => array(
				'title'    => 'Ready To Style Your Event?',
				'subtitle' => 'Props, theming, furniture or AV &mdash; get in touch for a free, no-obligation quote.',
			),
		),

	);

	return $data[ $brand ] ?? array();
}
