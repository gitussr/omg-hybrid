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
				'variant'     => 'home',
				'eyebrow'     => 'OMG Entertainment',
				'title'       => 'Creating Unforgettable Event Experiences',
				'description' => 'Casino nights, race days, poker tables and showstopping performers &mdash; the entertainment that turns any event into the one people are still talking about.',
				'slides'      => array( omg_hybrid_lead_banner_slide(), array( 'type' => 'image', 'url' => $img . 'omg-entertainment-banner1.jpg' ) ),
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
				'variant'     => 'home',
				'eyebrow'     => 'OMG LiVE',
				'title'       => 'Read The Room. Keep It Moving.',
				'description' => 'Elite DJs, atmospheric lighting and unforgettable live bands &mdash; club-standard sound and production that reads the room and keeps it moving.',
				'slides'      => array( omg_hybrid_lead_banner_slide(), array( 'type' => 'image', 'url' => $img . 'omg-live-hero.jpg' ) ),
			),
			'rows' => array(
				array(
					'id'         => 'djs-dj-booth',
					'title'      => 'DJ &amp; DJ Booth',
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
				'variant'     => 'home',
				'eyebrow'     => 'OMG Props &amp; Theming',
				'title'       => 'Set The Scene Before A Single Guest Arrives',
				'description' => 'Casino props, grand entrances, theme walls, furniture and AV tech &mdash; the styling and equipment that sets the scene before a single guest arrives.',
				'slides'      => array( omg_hybrid_lead_banner_slide(), array( 'type' => 'image', 'url' => $img . 'props-custom-new.jpg' ) ),
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

/**
 * Testimonials slider content per brand — single source shared by each
 * brand landing page (via service-landing.php) and its "Our Services"
 * page (client task-011, 2026-10-01).
 *
 * Studio's set is also shown on /our-booths/ and /photography-videography/
 * (client task-012).
 *
 * @param string $brand 'studio' | 'live' | 'props'
 * @return array{emblem_text:string, items:array} or empty array.
 */
function omg_hybrid_brand_testimonials( $brand ) {
	$data = array(
		'studio' => array(
			'emblem_text' => 'HAPPY CUSTOMERS • HAPPY CUSTOMERS • ',
			'items' => array(
				array( 'quote' => 'The photo booth was an absolute hit! Everyone loved it. Angelique was our attendant and she was an absolute delight. I cannot recommend OMG Studio highly enough &mdash; so professional and friendly. A heartfelt THANK YOU!', 'cite' => '&mdash; Rana D., Seven Hills NSW' ),
				array( 'quote' => 'Photobooth was a hit at the party. Easy going, really professional and so much fun! Can&rsquo;t wait to use them again!', 'cite' => '&mdash; Khalehla S., Campbelltown NSW' ),
				array( 'quote' => 'From the initial planning to the final execution, their team was professional, attentive and truly brought our vision to life. Highly recommend their services for any occasion!', 'cite' => '&mdash; Sorted Photography &amp; Videography' ),
			),
		),
		'live'  => array(
			'emblem_text' => 'HAPPY CUSTOMERS • HAPPY CUSTOMERS • ',
			'items' => array(
				array( 'quote' => 'We hired the OMG group for our corporate Christmas party and let me tell you &mdash; everyone had the best night! The DJ read the room perfectly all night.', 'cite' => '&mdash; Elisa Chinnabootr' ),
				array( 'quote' => 'The lighting completely transformed the venue and the band kept the floor packed until the very end. Faultless from start to finish.', 'cite' => '&mdash; Corporate Event Manager, Sydney NSW' ),
				array( 'quote' => 'We hired OMG group for our mid-year office party and their service and quality was excellent.', 'cite' => '&mdash; Aarti Mehra' ),
			),
		),
		'props' => array(
			'emblem_text' => 'HAPPY CUSTOMERS • HAPPY CUSTOMERS • ',
			'items' => array(
				array( 'quote' => 'From the initial planning to the final execution, their team was professional, attentive and truly brought our vision to life. Highly recommend their services for any occasion!', 'cite' => '&mdash; Sorted Photography &amp; Videography' ),
				array( 'quote' => 'We hired the OMG group for our corporate Christmas party and let me tell you &mdash; everyone had the best night! The styling completely transformed the room.', 'cite' => '&mdash; Elisa Chinnabootr' ),
				array( 'quote' => 'We hired OMG group for our mid-year office party and their service and quality was excellent.', 'cite' => '&mdash; Aarti Mehra' ),
			),
		),
		// OMG Food & Beverage (task-019): group-wide quotes, verbatim from
		// the Entertainment / Studio sets, until F&B has its own reviews.
		'foodbeverage' => array(
			'emblem_text' => 'HAPPY CUSTOMERS • HAPPY CUSTOMERS • ',
			'items' => array(
				array( 'quote' => 'We hired the OMG group for our corporate Christmas party and let me tell you &mdash; everyone had the best night!', 'cite' => '&mdash; Elisa Chinnabootr' ),
				array( 'quote' => 'From the initial planning to the final execution, their team was professional, attentive and truly brought our vision to life. Highly recommend their services for any occasion!', 'cite' => '&mdash; Sorted Photography &amp; Videography' ),
				array( 'quote' => 'We hired OMG group for our mid-year office party and their service and quality was excellent.', 'cite' => '&mdash; Aarti Mehra' ),
			),
		),
	);

	return $data[ $brand ] ?? array();
}

/**
 * OMG Studio landing page content (/omg-studio/, template-omg-studio.php),
 * as the data bundle for template-parts/service-landing.php. Moved here
 * from the template on 2026-10-10 so /booth-sales/ (template-booth-sales.php)
 * can reuse the Studio banner and common sections without a copy.
 *
 * @return array
 */
function omg_hybrid_studio_landing_args() {
	$img     = OMG_HYBRID_URI . '/assets/images/';
	$uploads = home_url( '/wp-content/uploads' );

	return array(
		'hero' => array(
			'variant'     => 'home',
			'eyebrow'     => 'OMG Studio',
			'title'       => 'Ready? Set? Pose!',
			'description' => 'We bring the laughter, fun and excitement to every event &mdash; one click at a time. Photo booths, video booths, photography and videography, in whatever format suits your event best.',
			'cta'         => array( 'url' => home_url( '/contact/' ), 'label' => 'Get a Free Quote' ),
			'slides'      => array(
				// Client 2026-10-10: "5 Star Entertainment" banner leads the slider.
				omg_hybrid_lead_banner_slide(),
				// Studio client banner (task-018, 2026-10-05; slide 2 since 2026-10-10; from
				// omggroup.com.au uploads 2026/04). It carries its own text, so
				// no hero title / button or dark tint over it, as on home slide 1.
				array( 'type' => 'image', 'url' => $img . 'omg-studio-hero-banner-01.jpg', 'text' => false, 'overlay' => false ),
				array( 'type' => 'image', 'url' => $img . 'omg-studio-display.jpg' ),
				array( 'type' => 'image', 'url' => $img . 'hero-bg-4.jpg' ),
				array( 'type' => 'image', 'url' => $img . 'omg-studio-golden-bg-3.jpg' ),
			),
		),
		'welcome' => array(
			'heading'    => 'Welcome to OMG STUDIO',
			'heading_logo' => array( 'url' => $img . 'oos-logo-studio-lg.png', 'alt' => 'OMG Studio' ),
			'paragraphs' => array(
				'We believe every event deserves to be unforgettable. We specialise in <strong>Photobooth Hire/Sales, Photography, Video Guest Books, and Videography</strong> for weddings, corporate events, birthdays, and special celebrations.',
				'Our mission is simple: <strong>To create &ldquo;OMG&rdquo; moments and fun experiences that your guests will remember forever.</strong>',
				'What makes OMG Studio different is our commitment to <strong>quality, reliability, and customer experience</strong>. We don&rsquo;t just provide services&mdash;we create <strong>memories that last a lifetime.</strong>',
			),
			'buttons'    => omg_hybrid_cta_buttons(),
			'image'      => $img . 'welcome-studio-filmstrip.png',
			'image_alt'  => 'OMG Studio photo booth prints from weddings and events',
			'decor'      => array(
				'script' => $img . 'welcome-script-elegance.png',
				// Spinning "OMG STUDIO" circular-text badge on the filmstrip's
				// bottom-right corner (client 2026-09-14).
				'badge'  => $img . 'circular-text.png',
			),
		),
		'cards_heading' => 'Our Products',
		'cards_intro' => '<strong>Your event, in the spotlight</strong>. Snap It, Spin It, Film It and Keep It Forever. <p>Find your favourite way to capture the fun below, and let\'s make your event shine.</p>',
		'cards' => array(
			array(
				'icon'        => $img . 'studio-svc-photobooths.png',
				'title'       => 'Photo Booths',
				'description' => 'From the compact Mini-Studio Booth to the DSLR-powered Studio Deluxe &mdash; crisp instant prints and digital sharing for every guest.',
				'url'         => home_url( '/our-booths/#booth-0' ),
				'link_label'  => 'VISIT US',
			),
			array(
				'icon'        => $img . 'studio-svc-video-phone.png',
				'title'       => 'Video Phone-Booth',
				'description' => 'A retro-cool alternative to the guestbook &mdash; guests pick up the receiver and record a video message worth keeping.',
				'url'         => home_url( '/our-booths/#booth-2' ),
				'link_label'  => 'VISIT US',
			),
			array(
				'icon'        => $img . 'studio-svc-360.png',
				'title'       => '360 Video Booth',
				'description' => 'Step on, spin around and go viral with immersive slow-motion HD video, captured from every angle and ready to share.',
				'url'         => home_url( '/our-booths/#booth-3' ),
				'link_label'  => 'VISIT US',
			),
			array(
				'icon'        => $img . 'studio-svc-photography.png',
				'title'       => 'Photography',
				'description' => 'Premium and roaming photographers who skip the forced poses and capture your event as it really happens.',
				'url'         => home_url( '/photography-videography/#main-block-0' ),
				'link_label'  => 'VISIT US',
			),
			array(
				'icon'        => $img . 'studio-svc-videography.png',
				'title'       => 'Videography',
				'description' => 'A cinematic eye on every frame &mdash; highlight reels, wedding films and social-ready cuts that tell the story.',
				'url'         => home_url( '/photography-videography/#main-block-2' ),
				'link_label'  => 'VISIT US',
			),
			array(
				'icon'        => $img . 'studio-svc-booth-sales.png',
				'title'       => 'Booth Sales',
				'description' => 'Own a professional photo booth, with full setup and ongoing support included.',
				'url'         => home_url( '/booth-sales/' ),
				'link_label'  => 'VISIT US',
			),
		),
		'rows' => array(
			array(
				'id'         => 'photo-booths',
				'ribbon'     => 'Photo Booths',
				'title'      => 'Photo Booths',
				'paragraph'  => 'From the compact, budget-friendly Mini-Studio Booth to the Studio Deluxe Booth &mdash; powered by a Canon DSLR camera and professional studio lighting &mdash; our photo booths deliver crisp, high-quality prints and instant digital sharing for guests of every event.',
				'bullets'    => array(
					'Mini-Studio Booth &mdash; maximum fun in a compact, budget-friendly setup',
					'Studio Deluxe Booth &mdash; Canon DSLR camera &amp; professional studio lighting',
					'Instant prints plus digital sharing for every guest',
				),
				'image'      => $img . 'omg-studio-booth-img-insta.jpg',
				'image_alt'  => 'Guests using an OMG Studio photo booth at an event',
				'link_url'   => home_url( '/our-booths/' ),
				'link_label' => 'Explore Our Photo Booths',
			),
			array(
				'id'         => 'video-phone-booth',
				'ribbon'     => 'Video Phone-Booth',
				'title'      => 'Video Phone-Booth',
				'paragraph'  => 'Step on screen, pick up the receiver and leave a message. Our retro-cool Video Phone-Booth ditches the traditional guestbook for an interactive experience that blends nostalgic charm with a genuinely memorable keepsake for guests.',
				'bullets'    => array(
					'A fresh, interactive alternative to the traditional guestbook',
					'Guests record video messages worth keeping',
					'Retro styling that suits weddings, parties &amp; corporate events',
				),
				'image'      => $img . 'omg-studio-video-phone-booth-img-insta.jpg',
				'image_alt'  => 'Guest recording a message at the OMG Studio Video Phone-Booth',
				'reverse'    => true,
				'link_url'   => home_url( '/our-booths/#booth-2' ),
				'link_label' => 'See The Video Phone-Booth',
			),
			array(
				'id'         => '360-video-booth',
				'ribbon'     => 'Studio 360 Video-Booth',
				'title'      => '360 Video Booth',
				'paragraph'  => 'Step on, spin around and go viral. The OMG Studio 360 Video-Booth is an immersive experience that captures high-energy, slow-motion HD video from every angle &mdash; perfect for guests who want to share the moment straight away.',
				'bullets'    => array(
					'Immersive, slow-motion HD video from every angle',
					'Instant, share-ready clips for social media',
					'A high-energy centrepiece for any event',
				),
				'image'      => $img . 'omg-studio-360-booth.jpg',
				'image_alt'  => 'Guest using the OMG Studio 360 Video-Booth',
				'link_url'   => home_url( '/our-booths/#booth-3' ),
				'link_label' => 'See The 360 Video-Booth',
			),
			array(
				'id'         => 'photography',
				'ribbon'     => 'Candid Moments, Premium Quality',
				'title'      => 'Photography',
				'paragraph'  => 'From premium event photography for corporate functions and galas to budget-friendly roaming photography for weddings and private parties, our photographers ditch the cheesy, forced poses and blend seamlessly into your event to capture it as it really happens.',
				'bullets'    => array(
					'Lead professional photographer for structured itineraries',
					'Roaming photography that captures authentic, candid reactions',
					'Fast turnaround, high-resolution galleries',
				),
				'image'      => $img . 'event-photography-thumbnail.jpg',
				'image_alt'  => 'OMG Studio photographer capturing guests at an event',
				'reverse'    => true,
				'link_url'   => home_url( '/photography-videography/#main-block-0' ),
				'link_label' => 'View Our Photography',
			),
			array(
				'id'         => 'videography',
				'ribbon'     => 'Your Event, Directed By The Best',
				'title'      => 'Videography',
				'paragraph'  => 'A cinematic eye on every frame, producing high-end visual stories from your event. From polished corporate highlight reels and brand launches to sentimental wedding films and quick-turnaround social media reels, we capture the story, not just the footage.',
				'bullets'    => array(
					'Cinematic highlight reels for corporate &amp; brand events',
					'Sentimental, story-led wedding films',
					'Social-first vertical cuts &amp; Instagram Reels, ready to post',
				),
				'image'      => $img . 'event-videography.jpg',
				'image_alt'  => 'OMG Studio videographer filming at an event',
				'link_url'   => home_url( '/photography-videography/#main-block-2' ),
				'link_label' => 'View Our Videography',
			),
		),
		'why' => array(
			'heading' => 'Why Choose OMG Studio?',
			'bullets' => array(
				'Premium photobooth experiences',
				'Professional photography &amp; videography',
				'High-end equipment &amp; lighting',
				'Friendly and experienced team',
				'Reliable service across Sydney &amp; Australia',
				'Fully insured $20 million public liability cover',
			),
			'body'    => 'Let OMG Studio turn your event into an unforgettable experience.',
			'buttons' => array(
				array( 'url' => 'tel:1300300664', 'label' => 'Call Us' ),
				array( 'url' => home_url( '/contact/' ), 'label' => 'Book an Event' ),
				array( 'url' => 'mailto:info@OMGent.com.au', 'label' => 'Email Us' ),
			),
		),
		// Quotes shared with /our-booths/ and /photography-videography/
		// (inc/brand-services.php).
		'testimonials' => omg_hybrid_brand_testimonials( 'studio' ),
		'other_heading' => 'Other Services',
		'other_description' => 'Why stop at the SnapShots? Round out the night with the full OMG Experience: Casino Tables, Race Nights and Poker, High-Energy DJs and Live Bands, Props and Theming, plus Food, Drinks and Professional Staff. It&rsquo;s everything your event needs, all under one roof.',
		'other' => array(
			array( 'image' => $img . 'omg-entertainment-banner1.jpg', 'logo' => $img . 'oos-logo-entertainment-lg.png', 'title' => 'OMG Entertainment', 'description' => omg_hybrid_division_blurb( 'entertainment' ), 'url' => home_url( '/omg-entertainment/' ), 'link_label' => 'Visit OMG Entertainment' ),
			array( 'image' => $img . 'omg-live-hero.jpg', 'logo' => $img . 'oos-logo-live-lg.png', 'title' => 'OMG LiVE', 'description' => omg_hybrid_division_blurb( 'live' ), 'url' => home_url( '/omg-live/' ), 'link_label' => 'Visit OMG LiVE' ),
			array( 'image' => $img . 'props-custom-new.jpg', 'logo' => $img . 'oos-logo-props-lg.png', 'title' => 'OMG Props &amp; Theming', 'description' => omg_hybrid_division_blurb( 'props' ), 'url' => home_url( '/omg-props-theming/' ), 'link_label' => 'Visit OMG Props &amp; Theming' ),
			array( 'logo' => $img . 'oos-logo-fnb-2026c.png', 'title' => 'OMG Food &amp; Beverage', 'description' => omg_hybrid_division_blurb( 'foodbeverage' ), 'url' => home_url( '/omg-food-beverage/' ), 'link_label' => 'Visit OMG Food &amp; Beverage' ),
		),
		'cta' => array(
			'title'    => 'Let&rsquo;s Capture Your Event Perfectly',
			'subtitle' => 'Booths, photography or videography &mdash; get in touch for a free, no-obligation quote.',
		),
		'marquee' => array(
			'title' => 'The Best BRANDS CHOOSE THE BEST BRAND',
			// Keep the 4-row logo slider on phones too, not the one-row strip
			// (client task-016, 2026-10-05).
			'hide_on_mobile' => false,
			'logos' => array(
				$uploads . '/2026/04/logo-1.jpg',  $uploads . '/2026/04/logo-2.jpg',  $uploads . '/2026/04/logo-3.jpg',
				$uploads . '/2026/04/logo-4.jpg',  $uploads . '/2026/04/logo-5.jpg',  $uploads . '/2026/04/logo-6.jpg',
				$uploads . '/2026/04/logo-7.jpg',  $uploads . '/2026/04/logo-8.jpg',  $uploads . '/2026/04/logo-9.jpg',
				$uploads . '/2026/04/logo-10.jpg', $uploads . '/2026/04/logo-11.jpg', $uploads . '/2026/04/logo-12.jpg',
				$uploads . '/2026/04/logo-13.jpg', $uploads . '/2026/04/logo-14.jpg', $uploads . '/2026/04/logo-15.jpg',
				$uploads . '/2026/04/logo-16.jpg', $uploads . '/2026/04/logo-17.jpg', $uploads . '/2026/04/logo-18.jpg',
				$uploads . '/2026/04/logo-19.jpg', $uploads . '/2026/04/logo-20.jpg', $uploads . '/2026/04/logo-21.jpg',
				$uploads . '/2026/04/logo-22.jpg',
			),
		),
	);
}
