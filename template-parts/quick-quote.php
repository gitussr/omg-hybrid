<?php
/**
 * Quick Quote — floating 6-step wizard panel.
 *
 * Markup ported verbatim from the previous theme's footer.php. Driven by
 * assets/js/book-wizard.js (shared with the omg-mega-menu plugin's modal)
 * and opened/closed by assets/js/theme.js. Submits to the plugin's
 * `omg_mm_quote` AJAX action.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;
?>

<button id="book-now-trigger" aria-label="Open booking form" aria-expanded="false" aria-controls="book-now-panel">
	Quick Quote
</button>

<div id="book-now-panel" role="dialog" aria-modal="true" aria-labelledby="book-panel-title" aria-hidden="true">
	<button id="book-now-close" aria-label="Close booking form">
		<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M1 1L13 13M13 1L1 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
		</svg>
	</button>

	<!-- Step 1: Contact details -->
	<div class="book-step" id="book-step-1">
		<h2 id="book-panel-title" class="book-panel-title">Your contact details</h2>

		<div class="book-field">
			<label for="book-first-name">First Name*</label>
			<input type="text" id="book-first-name" class="book-input" autocomplete="given-name" data-book-field="first_name" required />
		</div>

		<div class="book-field">
			<label for="book-last-name">Last Name*</label>
			<input type="text" id="book-last-name" class="book-input" autocomplete="family-name" data-book-field="last_name" required />
		</div>

		<div class="book-field">
			<label for="book-email">Email*</label>
			<input type="email" id="book-email" class="book-input" autocomplete="email" data-book-field="email" required />
		</div>

		<div class="book-field">
			<label for="book-phone">Contact Number*</label>
			<input type="tel" id="book-phone" class="book-input" autocomplete="tel" data-book-field="phone" required />
		</div>

		<input type="text" name="website" data-book-field="website" tabindex="-1" autocomplete="off" aria-hidden="true" style="position:absolute;left:-9999px;width:1px;height:1px;opacity:0;" />

		<button type="button" class="book-btn-primary" data-book-next>Next</button>
	</div>

	<!-- Step 2: Choose service -->
	<div class="book-step" id="book-step-2" hidden>
		<h2 class="book-panel-title">What are you planning?</h2>

		<div class="book-field">
			<label for="book-inquiry-type">Inquiry Type</label>
			<select id="book-inquiry-type" class="book-select" data-book-field="inquiry_type">
				<option value="Photo-Booths">Photo-Booths</option>
				<option value="Video Phone-Booth">Video Phone-Booth</option>
				<option value="360 Video-Booth">360 Video-Booth</option>
				<option value="Photography">Photography</option>
				<option value="Videography">Videography</option>
				<option value="Event &amp; Entertainment">Event &amp; Entertainment</option>
				<option value="DJ-Music-Lights">DJ-Music-Lights</option>
				<option value="Props &amp; Themeing">Props &amp; Theming</option>
			</select>
		</div>

		<div class="book-step2-actions">
			<button type="button" class="book-btn-back" data-book-back>Back</button>
			<button type="button" class="book-btn-submit" data-book-next>Next</button>
		</div>
	</div>

	<!-- Step 3: When & where -->
	<div class="book-step" id="book-step-3" hidden>
		<h2 class="book-panel-title">When &amp; Where?</h2>

		<div class="book-field">
			<label for="book-date">Event date</label>
			<input type="date" id="book-date" class="book-input" data-book-field="event_date" required />
		</div>

		<div class="book-field">
			<label for="book-state">Event State</label>
			<select id="book-state" class="book-select" data-book-field="event_state">
				<option value="NSW">NSW</option>
				<option value="ACT">ACT</option>
				<option value="QLD">QLD</option>
				<option value="WA">WA</option>
				<option value="SA">SA</option>
				<option value="VIC">VIC</option>
				<option value="NT">NT</option>
				<option value="TAS">TAS</option>
			</select>
		</div>

		<div class="book-step2-actions">
			<button type="button" class="book-btn-back" data-book-back>Back</button>
			<button type="button" class="book-btn-submit" data-book-next>Next</button>
		</div>
	</div>

	<!-- Step 4: Event time (optional) -->
	<div class="book-step" id="book-step-4" hidden>
		<h2 class="book-panel-title">Event Time (optional)</h2>

		<div class="book-field">
			<label for="book-start-time">Event start time</label>
			<input type="text" id="book-start-time" class="book-input book-time-input" data-book-field="start_time" placeholder="Select time" autocomplete="off" readonly />
		</div>

		<div class="book-field">
			<label for="book-end-time">Event end time</label>
			<input type="text" id="book-end-time" class="book-input book-time-input" data-book-field="end_time" placeholder="Select time" autocomplete="off" readonly />
		</div>

		<div class="book-step2-actions">
			<button type="button" class="book-btn-back" data-book-back>Back</button>
			<button type="button" class="book-btn-submit" data-book-next>Next</button>
		</div>
	</div>

	<!-- Step 5: Venue address -->
	<div class="book-step" id="book-step-5" hidden>
		<h2 class="book-panel-title">Venue address</h2>

		<div class="book-field">
			<label for="book-address-street">Street address</label>
			<input type="text" id="book-address-street" class="book-input" autocomplete="address-line1" data-book-field="address_street" />
		</div>

		<div class="book-field">
			<label for="book-address-suburb">Suburb</label>
			<input type="text" id="book-address-suburb" class="book-input" autocomplete="address-level2" data-book-field="address_suburb" />
		</div>

		<div class="book-field">
			<label for="book-address-zip">Postcode*</label>
			<input type="text" id="book-address-zip" class="book-input" autocomplete="postal-code" data-book-field="address_zip" required />
		</div>

		<div class="book-step2-actions">
			<button type="button" class="book-btn-back" data-book-back>Back</button>
			<button type="button" class="book-btn-submit" data-book-next>Next</button>
		</div>
	</div>

	<!-- Step 6: Additional information -->
	<div class="book-step" id="book-step-6" hidden>
		<h2 class="book-panel-title">Additional Information? (optional)</h2>

		<div class="book-field">
			<label for="book-company">Company name</label>
			<input type="text" id="book-company" class="book-input" autocomplete="organization" data-book-field="company" />
		</div>

		<div class="book-field">
			<label for="book-message">Message</label>
			<textarea id="book-message" class="book-input" rows="3" data-book-field="message"></textarea>
		</div>

		<div class="book-step2-actions">
			<button type="button" class="book-btn-back" data-book-back>Back</button>
			<button type="button" class="book-btn-submit" data-book-next>Submit</button>
		</div>
	</div>

	<!-- Success state -->
	<div class="book-step book-success-panel" id="book-success" hidden>
		<div class="book-success-content">
			<div class="book-success-icon">&#10003;</div>
			<h2 class="book-panel-title">Thank you!</h2>
			<p>We&rsquo;ve received your booking request and will be in touch soon.</p>
		</div>
	</div>
</div>
