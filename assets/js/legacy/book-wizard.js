(function (window) {
	'use strict';

	// Drives the shared 6-step Quick Quote flow inside any panel that follows
	// the .book-step / [data-book-field] / [data-book-next] / [data-book-back]
	// convention. Used by both the footer floating panel and the mobile header
	// modal (omg-mega-menu plugin) so the two forms share one implementation.
	function initBookWizard(panel) {
		if (!panel || panel.__bookWizardInit) return;
		panel.__bookWizardInit = true;

		var success = panel.querySelector('.book-success-panel');
		var steps = Array.from(panel.querySelectorAll('.book-step')).filter(function (s) { return s !== success; });
		if (!steps.length) return;

		function showStep(index) {
			steps.forEach(function (s, i) { s.hidden = i !== index; });
			if (success) success.hidden = true;
			var first = steps[index].querySelector('select, input, textarea');
			if (first) first.focus();
		}

		function validateField(input) {
			var val = input.value.trim();
			var empty = !val;
			var badEmail = input.type === 'email' && val && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val);
			if (empty || badEmail) {
				input.classList.add('has-error');
				return false;
			}
			input.classList.remove('has-error');
			return true;
		}

		function validateStep(index) {
			return Array.from(steps[index].querySelectorAll('[required]'))
				.map(validateField)
				.every(Boolean);
		}

		function fieldEls() {
			return Array.from(panel.querySelectorAll('[data-book-field]'));
		}

		function collectPayload() {
			var payload = {};
			fieldEls().forEach(function (el) {
				payload[el.dataset.bookField] = el.value.trim();
			});
			return payload;
		}

		function resetFields() {
			fieldEls().forEach(function (el) {
				el.value = el.tagName === 'SELECT' ? el.options[0].value : '';
				el.classList.remove('has-error');
			});
		}

		function showSuccess() {
			steps.forEach(function (s) { s.hidden = true; });
			if (success) success.hidden = false;
		}

		function setSubmitting(btn, isSubmitting) {
			if (!btn) return;
			if (isSubmitting) {
				btn.dataset.bookOriginalLabel = btn.textContent;
				btn.disabled = true;
				btn.classList.add('is-loading');
				btn.innerHTML = '<span class="book-spinner" aria-hidden="true"></span><span>Submitting…</span>';
			} else {
				btn.disabled = false;
				btn.classList.remove('is-loading');
				btn.textContent = btn.dataset.bookOriginalLabel || 'Submit';
			}
		}

		function submitBooking(btn) {
			var payload = collectPayload();
			setSubmitting(btn, true);

			if (!(window.omgMM && window.omgMM.ajaxUrl)) {
				console.log('Book Now submission:', payload);
				resetFields();
				showSuccess();
				setSubmitting(btn, false);
				return;
			}

			var data = new FormData();
			data.append('action', 'omg_mm_quote');
			data.append('nonce', window.omgMM.nonce);
			Object.keys(payload).forEach(function (key) { data.append(key, payload[key]); });

			fetch(window.omgMM.ajaxUrl, { method: 'POST', body: data, credentials: 'same-origin' })
				.then(function (res) { return res.json(); })
				.then(function () {
					resetFields();
					showSuccess();
				})
				.catch(function () {
					resetFields();
					showSuccess();
				})
				.finally(function () {
					setSubmitting(btn, false);
				});
		}

		// Optional Google Places Autocomplete on the venue street address field.
		// Only activates once the Google Maps JS API (with Places library) is
		// enqueued elsewhere with a valid key — safe no-op until then.
		var addressAutocompleteInitialized = false;
		function initAddressAutocomplete() {
			if (addressAutocompleteInitialized) return;
			if (!window.google || !google.maps || !google.maps.places) return;

			var streetInput = panel.querySelector('[data-book-field="address_street"]');
			var suburbInput = panel.querySelector('[data-book-field="address_suburb"]');
			var zipInput = panel.querySelector('[data-book-field="address_zip"]');
			if (!streetInput) return;

			var autocomplete = new google.maps.places.Autocomplete(streetInput, {
				types: ['address'],
				componentRestrictions: { country: 'au' },
			});

			autocomplete.addListener('place_changed', function () {
				var place = autocomplete.getPlace();
				var components = place.address_components || [];

				function getComponent(type) {
					var match = components.find(function (c) { return c.types.includes(type); });
					return match ? match.long_name : '';
				}

				var streetNumber = getComponent('street_number');
				var route = getComponent('route');
				streetInput.value = [streetNumber, route].filter(Boolean).join(' ') || streetInput.value;

				if (suburbInput) {
					suburbInput.value = getComponent('locality') || getComponent('sublocality') || suburbInput.value;
				}
				if (zipInput) {
					zipInput.value = getComponent('postal_code') || zipInput.value;
				}
			});

			addressAutocompleteInitialized = true;
		}

		panel.addEventListener('click', function (e) {
			var nextBtn = e.target.closest('[data-book-next]');
			if (nextBtn) {
				if (nextBtn.disabled) return;
				var index = steps.indexOf(nextBtn.closest('.book-step'));
				if (index === -1 || !validateStep(index)) return;
				index === steps.length - 1 ? submitBooking(nextBtn) : showStep(index + 1);
				return;
			}

			var backBtn = e.target.closest('[data-book-back]');
			if (backBtn) {
				var backIndex = steps.indexOf(backBtn.closest('.book-step'));
				if (backIndex > 0) showStep(backIndex - 1);
			}
		});

		panel.addEventListener('input', function (e) {
			e.target.classList.remove('has-error');
		});

		initAddressAutocomplete();
		panel.__initAddressAutocomplete = initAddressAutocomplete;
	}

	window.initOMGBookWizard = initBookWizard;
})(window);
