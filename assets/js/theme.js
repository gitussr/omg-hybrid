/**
 * OMG Hybrid — shared front-end behaviour.
 *
 * Loaded on every page. Owns the shared chrome (sticky header, loader,
 * back-to-top), the Quick Quote panel + wizard, the 30-minute time
 * dropdown, and the new component sliders (.oh-hero, .oh-testimonials).
 *
 * Legacy pages (body.oh-legacy) additionally load assets/js/legacy/custom.js
 * for the widgets that still use the previous markup.
 */
(function () {
	'use strict';

	var onReady = function (fn) {
		if (document.readyState !== 'loading') { fn(); }
		else { document.addEventListener('DOMContentLoaded', fn); }
	};

	/* ------------------------------------------------------------------ */
	/*  Loader                                                            */
	/*  Shown on first paint (CSS), faded out once the page has loaded,   */
	/*  then re-shown the instant an internal link is clicked so the page */
	/*  transition — and any open mega menu — is masked while the browser */
	/*  fetches the next page.                                            */
	/* ------------------------------------------------------------------ */
	(function () {
		var loader = document.getElementById('loader');
		if (!loader) { return; }

		var hideTimer;
		var hide = function () {
			window.clearTimeout(hideTimer);
			loader.style.transition = 'opacity .4s ease';
			loader.style.opacity = '0';
			hideTimer = window.setTimeout(function () { loader.style.display = 'none'; }, 400);
		};
		var show = function () {
			window.clearTimeout(hideTimer);
			window.clearTimeout(loader.__failSafe);
			loader.style.transition = 'opacity .12s ease';
			loader.style.display = 'flex';
			// force reflow so the fade-in actually runs from 0
			void loader.offsetWidth;
			loader.style.opacity = '1';
			// never trap the user if navigation is blocked or aborted
			loader.__failSafe = window.setTimeout(hide, 12000);
		};

		window.addEventListener('load', hide);
		// bfcache restore (back/forward) — the page comes back with the
		// loader still up; drop it.
		window.addEventListener('pageshow', function (e) { if (e.persisted) { hide(); } });

		onReady(function () {
			document.addEventListener('click', function (e) {
				if (e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) { return; }
				var a = e.target.closest && e.target.closest('a[href]');
				if (!a || (a.target && a.target !== '_self') || a.hasAttribute('download')) { return; }

				var href = a.getAttribute('href');
				if (!href || href.charAt(0) === '#') { return; }

				var url;
				try { url = new URL(a.href, window.location.href); } catch (err) { return; }
				if (url.origin !== window.location.origin) { return; }          // external site
				if (!/^https?:$/.test(url.protocol)) { return; }                // mailto:, tel:, javascript:
				if (url.href.split('#')[0] === window.location.href.split('#')[0]) { return; } // same page (hash only)

				show();
			});
		});
	})();

	/* ------------------------------------------------------------------ */
	/*  Sticky header                                                     */
	/* ------------------------------------------------------------------ */
	onReady(function () {
		var header = document.getElementById('siteHeader');
		if (!header) { return; }
		var trigger = header.offsetTop + 1;
		var onScroll = function () {
			header.classList.toggle('is-sticky', window.scrollY > trigger);
		};
		onScroll();
		window.addEventListener('scroll', onScroll, { passive: true });
	});

	/* ------------------------------------------------------------------ */
	/*  Back to top                                                       */
	/* ------------------------------------------------------------------ */
	onReady(function () {
		var btn = document.getElementById('back-to-top-button');
		if (!btn) { return; }
		window.addEventListener('scroll', function () {
			btn.classList.toggle('show', window.scrollY > 300);
		}, { passive: true });
		btn.addEventListener('click', function (e) {
			e.preventDefault();
			window.scrollTo({ top: 0, behavior: 'smooth' });
		});
	});

	/* ------------------------------------------------------------------ */
	/*  Circular rotating emblem text (.oh-emblem / legacy .emblem)       */
	/* ------------------------------------------------------------------ */
	onReady(function () {
		var emblems = document.querySelectorAll('.oh-emblem, .emblem');
		emblems.forEach(function (el) {
			if (el.dataset.emblemDone) { return; }
			el.dataset.emblemDone = '1';
			var text = el.textContent;
			el.innerHTML = '';
			[].forEach.call(text, function (char, i) {
				var span = document.createElement('span');
				span.textContent = char;
				span.style.transform = 'rotate(' + (360 / text.length) * i + 'deg)';
				el.appendChild(span);
			});
		});
	});

	/* ------------------------------------------------------------------ */
	/*  Sliders — new components only (.oh-hero, .oh-testimonials)        */
	/* ------------------------------------------------------------------ */
	onReady(function () {
		if (typeof Swiper === 'undefined') { return; }

		var numberedBullet = function (index, className) {
			var num = String(index + 1).padStart(2, '0');
			return '<span class="' + className + '"><span class="num">' + num + '</span><span class="line"></span></span>';
		};

		var heroEl = document.querySelector('.oh-hero .swiper');
		if (heroEl && !heroEl.classList.contains('swiper-initialized')) {
			var hero = new Swiper(heroEl, {
				slidesPerView: 1,
				// rewind, not loop: Swiper 12 loop mode locks up with only
				// 2 slides (the hero usually has 2). rewind wraps last->first
				// for autoplay, the clickable pagination and the arrows.
				rewind: true,
				autoplay: { delay: 5000, disableOnInteraction: false },
				speed: 900,
				pagination: {
					// pagination lives outside .swiper (as a direct child of
					// .oh-hero) so its click target isn't trapped under the
					// overlay / text column — look it up on the section.
					el: heroEl.closest('.oh-hero').querySelector('.swiper-pagination'),
					clickable: true,
					renderBullet: numberedBullet
				}
			});
			// Prev/next arrows (client 2026-10-04): replace the numbered
			// pagination on mobile only. Like the pagination they live outside
			// .swiper, as direct children of .oh-hero, so their click target
			// isn't trapped under the overlay / text column.
			var heroPrev = heroEl.closest('.oh-hero').querySelector('.oh-hero__nav--prev');
			var heroNext = heroEl.closest('.oh-hero').querySelector('.oh-hero__nav--next');
			if (heroPrev) { heroPrev.addEventListener('click', function () { hero.slidePrev(); }); }
			if (heroNext) { heroNext.addEventListener('click', function () { hero.slideNext(); }); }
			// Per-slide hero copy (client task-018, 2026-10-05): hero.php puts
			// each slide's title / text on-off / tint on-off in data-hero-*.
			// On a slide change the tint follows at once; a new title fades the
			// text out, swaps it, and fades it back in (straight in when the
			// text was hidden anyway). Runs before the slide-1 handler below so
			// it still sees whether the text was showing.
			// Per-slide button (client task-021, 2026-10-06): the button's
			// link, label and new-tab target come from data-hero-cta-* and
			// swap with the title; an empty title leaves the button alone.
			var perSlide = heroEl.closest('.oh-hero--per-slide');
			if (perSlide) {
				var heroH1 = perSlide.querySelector('.oh-hero__inner h1');
				var heroBtn = perSlide.querySelector('.oh-hero__inner .oh-btn');
				var swapTimer = null;
				// The label is the button's first non-blank text node (the
				// arrow icon after it is left untouched).
				var btnLabelNode = function () {
					if (!heroBtn) { return null; }
					for (var n = heroBtn.firstChild; n; n = n.nextSibling) {
						if (n.nodeType === 3 && n.nodeValue.trim() !== '') { return n; }
					}
					return null;
				};
				var sameCopy = function (slide) {
					var d = slide.dataset;
					if (heroH1 && heroH1.innerHTML !== d.heroTitle) { return false; }
					if (heroBtn && d.heroCtaUrl !== undefined) {
						var label = btnLabelNode();
						if (heroBtn.getAttribute('href') !== d.heroCtaUrl) { return false; }
						if (label && label.nodeValue.trim() !== d.heroCtaLabel) { return false; }
						if ((heroBtn.getAttribute('target') || '') !== (d.heroCtaTarget || '')) { return false; }
					}
					return true;
				};
				var applyCopy = function (slide) {
					var d = slide.dataset;
					if (heroH1) {
						heroH1.innerHTML = d.heroTitle;
						heroH1.style.display = d.heroTitle === '' ? 'none' : '';
					}
					if (heroBtn && d.heroCtaUrl !== undefined) {
						var label = btnLabelNode();
						heroBtn.style.display = (d.heroCtaUrl && d.heroCtaLabel) ? '' : 'none';
						heroBtn.setAttribute('href', d.heroCtaUrl);
						if (label) { label.nodeValue = ' ' + d.heroCtaLabel + ' '; }
						if (d.heroCtaTarget) {
							heroBtn.setAttribute('target', d.heroCtaTarget);
							heroBtn.setAttribute('rel', 'noopener');
						} else {
							heroBtn.removeAttribute('target');
							heroBtn.removeAttribute('rel');
						}
					}
				};
				var syncSlideCopy = function () {
					var slide = hero.slides[hero.activeIndex];
					if (!slide || slide.dataset.heroTitle === undefined) { return; }
					var wasHidden = perSlide.classList.contains('is-text-off') || perSlide.classList.contains('is-copy-off');
					var showText = slide.dataset.heroText !== '0';
					perSlide.classList.toggle('is-overlay-off', slide.dataset.heroOverlay === '0');
					window.clearTimeout(swapTimer);
					if (!showText) {
						perSlide.classList.add('is-copy-off');
						return;
					}
					if (sameCopy(slide)) {
						perSlide.classList.remove('is-copy-off');
					} else if (wasHidden) {
						applyCopy(slide);
						perSlide.classList.remove('is-copy-off');
					} else {
						perSlide.classList.add('is-copy-off');
						swapTimer = window.setTimeout(function () {
							applyCopy(slide);
							perSlide.classList.remove('is-copy-off');
						}, 450);
					}
				};
				hero.on('slideChange', syncSlideCopy);
				syncSlideCopy();
			}
			// Home hero (client 2026-10-01): the text overlay is hidden while the
			// first slide shows and fades in from slide 2. hero.php renders the
			// section with .is-text-off already set.
			var heroSection = heroEl.closest('.oh-hero');
			if (heroSection && heroSection.classList.contains('oh-hero--text-off-first')) {
				var syncHeroText = function () {
					heroSection.classList.toggle('is-text-off', hero.activeIndex === 0);
				};
				hero.on('slideChange', syncHeroText);
				syncHeroText();
			}
			heroEl.addEventListener('mouseenter', function () { hero.autoplay && hero.autoplay.stop(); });
			heroEl.addEventListener('mouseleave', function () { hero.autoplay && hero.autoplay.start(); });
		}

		/* Client-logo grid + one-row strip (marquee.php, logo-strip.php):
		   both glide on a pure CSS animation since 2026-10-05 (client
		   task-016), so there is no slider to boot here. A Swiper loop with
		   zero-delay autoplay was tried first that day and hitched at every
		   slide boundary. The only job left is loading: the logos glide in
		   from off-screen, and lazy ones would arrive as loading bars, so a
		   VISIBLE slider fetches them all up front. A slider hidden at the
		   current width (the grid on phones on inner pages, the strip on
		   desktop) has no offsetParent and keeps lazy loading, so it
		   downloads nothing. */
		document.querySelectorAll('.oh-logo-grid__slider.is-moving, .oh-logo-strip__slider.is-moving').forEach(function (el) {
			if (el.offsetParent === null) { return; }
			el.querySelectorAll('img[loading="lazy"]').forEach(function (img) { img.loading = 'eager'; });
		});

		document.querySelectorAll('.oh-testimonials .swiper').forEach(function (el) {
			if (el.classList.contains('swiper-initialized')) { return; }
			// No autoHeight (client 2026-10-01): it resized the section to
			// each quote, so the footer below jumped up and down as the
			// slides rotated. The slider now holds the tallest slide's
			// height at the current width (CSS in app.css).
			new Swiper(el, {
				slidesPerView: 1,
				loop: true,
				autoplay: { delay: 6000, disableOnInteraction: false },
				pagination: {
					el: el.querySelector('.swiper-pagination'),
					clickable: true,
					renderBullet: numberedBullet
				}
			});
		});
	});

	/* ------------------------------------------------------------------ */
	/*  Quick Quote — floating footer panel (#book-now-panel)             */
	/*  The mega-menu modal is handled by the omg-mega-menu plugin.       */
	/* ------------------------------------------------------------------ */
	onReady(function () {
		var panel = document.getElementById('book-now-panel');
		if (!panel) { return; }

		var closeBtn = document.getElementById('book-now-close');
		var triggers = document.querySelectorAll('#book-now-trigger, .book-now-header-btn');

		if (window.initOMGBookWizard) { window.initOMGBookWizard(panel); }

		var open = function () {
			panel.classList.add('is-open');
			panel.removeAttribute('aria-hidden');
			triggers.forEach(function (t) { t.setAttribute('aria-expanded', 'true'); });
			if (panel.__initAddressAutocomplete) { panel.__initAddressAutocomplete(); }
			setTimeout(function () {
				var first = panel.querySelector('select, input, textarea');
				if (first) { first.focus(); }
			}, 250);
		};
		var close = function () {
			panel.classList.remove('is-open');
			panel.setAttribute('aria-hidden', 'true');
			triggers.forEach(function (t) { t.setAttribute('aria-expanded', 'false'); });
		};

		triggers.forEach(function (t) {
			t.addEventListener('click', function () {
				panel.classList.contains('is-open') ? close() : open();
			});
		});
		if (closeBtn) { closeBtn.addEventListener('click', close); }
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && panel.classList.contains('is-open')) { close(); }
		});
	});

	/* ------------------------------------------------------------------ */
	/*  Quick Quote → contact form (client 2026-10-03)                    */
	/*  The footer Quick Quote (#book-now-trigger), the header "Start     */
	/*  Planning" button and the mega-menu plugin's mobile header Quick   */
	/*  Quote button no longer open a popup: they take the visitor to the */
	/*  "Leave us a message" form on /contact/ (or scroll to it when      */
	/*  already there). Both popups are left wired up but dormant — this  */
	/*  capture-phase listener runs before their click handlers and stops */
	/*  the click reaching them. Delete this block to bring them back.    */
	/* ------------------------------------------------------------------ */
	(function () {
		var SELECTOR = '#book-now-trigger, .book-now-header-btn, .omg-quick-quote-btn';

		// Lands the heading just below the sticky header. The header drops
		// its top bar once it sticks, so aim again after that has settled.
		var scrollToForm = function () {
			var target = document.getElementById('leave-a-message');
			if (!target) { return false; }
			var aim = function () {
				var header = document.getElementById('siteHeader');
				var offset = (header ? header.offsetHeight : 0) + 24;
				window.scrollTo({ top: target.getBoundingClientRect().top + window.scrollY - offset, behavior: 'instant' });
			};
			aim();
			window.setTimeout(aim, 400);
			return true;
		};

		document.addEventListener('click', function (e) {
			var btn = e.target.closest ? e.target.closest(SELECTOR) : null;
			if (!btn) { return; }
			var trigger = document.getElementById('book-now-trigger');
			var url = trigger && trigger.getAttribute('data-contact-url');
			if (!url) { return; }
			e.preventDefault();
			e.stopPropagation();
			if (scrollToForm()) { return; }
			window.location.href = url;
		}, true);

		// Arriving from another page: the browser's own jump to the hash
		// happens before the header and banner have their final heights.
		if (window.location.hash === '#leave-a-message') {
			window.addEventListener('load', scrollToForm);
		}
	})();

	/* ================================================================== */
	/*  30-minute time dropdown for .book-time-input and GF .native-time  */
	/*  fields. Ported verbatim from the previous theme's custom.js.      */
	/* ================================================================== */
	(function () {
		var TIME_OPTIONS = (function () {
			var list = [];
			for (var t = 0; t < 24 * 60; t += 30) {
				var h24 = Math.floor(t / 60), m = t % 60;
				var period = h24 < 12 ? 'AM' : 'PM';
				var h12 = h24 % 12; if (h12 === 0) { h12 = 12; }
				list.push(String(h12).padStart(2, '0') + ':' + String(m).padStart(2, '0') + ' ' + period);
			}
			return list;
		})();

		function initTimeSelect(input) {
			if (input.dataset.timeSelectInit) { return input._timeSelectApi; }
			input.dataset.timeSelectInit = '1';

			input.type = 'text';
			input.removeAttribute('step');

			var wrap = document.createElement('div');
			wrap.className = 'time-select-wrap gform-theme__disable-reset';
			input.parentNode.insertBefore(wrap, input);
			wrap.appendChild(input);

			var listboxId = (input.id || 'time-select') + '-listbox';

			input.classList.add('time-select-input');
			input.setAttribute('readonly', 'readonly');
			input.setAttribute('autocomplete', 'off');
			input.setAttribute('inputmode', 'none');
			if (!input.getAttribute('placeholder')) { input.setAttribute('placeholder', 'Select time'); }
			input.setAttribute('role', 'combobox');
			input.setAttribute('aria-haspopup', 'listbox');
			input.setAttribute('aria-expanded', 'false');
			input.setAttribute('aria-autocomplete', 'none');
			input.setAttribute('aria-controls', listboxId);

			var toggle = document.createElement('span');
			toggle.className = 'time-select-toggle';
			toggle.setAttribute('aria-hidden', 'true');
			toggle.innerHTML = '<svg viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"></polyline></svg>';
			wrap.appendChild(toggle);

			var list = document.createElement('ul');
			list.className = 'time-select-list';
			list.setAttribute('role', 'listbox');
			list.id = listboxId;
			document.body.appendChild(list);

			var options = TIME_OPTIONS.map(function (label, index) {
				var li = document.createElement('li');
				li.setAttribute('role', 'option');
				li.id = listboxId + '-option-' + index;
				li.setAttribute('tabindex', '-1');
				li.textContent = label;
				li.dataset.value = label;
				list.appendChild(li);
				return li;
			});

			var activeIndex = -1;

			function isOpen() { return wrap.classList.contains('is-open'); }
			function isDisabled(i) { return options[i].classList.contains('is-disabled'); }
			function firstEnabledIndex() { for (var i = 0; i < options.length; i++) { if (!isDisabled(i)) { return i; } } return -1; }
			function lastEnabledIndex() { for (var i = options.length - 1; i >= 0; i--) { if (!isDisabled(i)) { return i; } } return -1; }
			function nextEnabledIndex(from, dir) {
				var i = from;
				for (var s = 0; s < options.length; s++) {
					i += dir;
					if (i < 0 || i >= options.length) { return from; }
					if (!isDisabled(i)) { return i; }
				}
				return from;
			}
			function setActive(index) {
				if (index < 0 || index >= options.length || isDisabled(index)) { return; }
				if (activeIndex >= 0 && options[activeIndex]) { options[activeIndex].classList.remove('is-active'); }
				activeIndex = index;
				options[activeIndex].classList.add('is-active');
				input.setAttribute('aria-activedescendant', options[activeIndex].id);
				options[activeIndex].scrollIntoView({ block: 'nearest' });
			}
			function positionList() {
				var rect = input.getBoundingClientRect();
				var gap = 6, vh = window.innerHeight;
				var below = vh - rect.bottom - gap, above = rect.top - gap;
				var upward = below < 150 && above > below;
				list.style.left = Math.round(rect.left) + 'px';
				list.style.width = Math.round(rect.width) + 'px';
				if (upward) {
					list.style.top = '';
					list.style.bottom = Math.round(vh - rect.top + gap) + 'px';
					list.style.maxHeight = Math.round(Math.max(120, Math.min(250, above))) + 'px';
				} else {
					list.style.bottom = '';
					list.style.top = Math.round(rect.bottom + gap) + 'px';
					list.style.maxHeight = Math.round(Math.max(120, Math.min(250, below))) + 'px';
				}
			}
			function openList() {
				if (isOpen()) { return; }
				wrap.classList.add('is-open');
				list.classList.add('is-open');
				input.setAttribute('aria-expanded', 'true');
				positionList();
				var sel = TIME_OPTIONS.indexOf(input.value);
				var start = sel >= 0 && !isDisabled(sel) ? sel : firstEnabledIndex();
				if (start > -1) { setActive(start); }
				document.addEventListener('mousedown', handleOutsideClick);
				window.addEventListener('resize', positionList);
				document.addEventListener('scroll', positionList, true);
			}
			function closeList() {
				if (!isOpen()) { return; }
				wrap.classList.remove('is-open');
				list.classList.remove('is-open');
				input.setAttribute('aria-expanded', 'false');
				document.removeEventListener('mousedown', handleOutsideClick);
				window.removeEventListener('resize', positionList);
				document.removeEventListener('scroll', positionList, true);
			}
			function selectOption(index) {
				if (index < 0 || index >= options.length || isDisabled(index)) { return; }
				options.forEach(function (o) { o.classList.remove('is-selected'); });
				options[index].classList.add('is-selected');
				input.value = options[index].dataset.value;
				closeList();
				input.focus();
				input.dispatchEvent(new Event('input', { bubbles: true }));
				input.dispatchEvent(new Event('change', { bubbles: true }));
				input.dispatchEvent(new CustomEvent('time-select:change', { bubbles: true }));
			}
			function handleOutsideClick(e) {
				if (!wrap.contains(e.target) && !list.contains(e.target)) { closeList(); }
			}

			input.addEventListener('click', function () { isOpen() ? closeList() : openList(); });
			input.addEventListener('keydown', function (e) {
				switch (e.key) {
					case 'ArrowDown': e.preventDefault(); isOpen() ? setActive(nextEnabledIndex(activeIndex, 1)) : openList(); break;
					case 'ArrowUp': e.preventDefault(); isOpen() ? setActive(nextEnabledIndex(activeIndex, -1)) : openList(); break;
					case 'Home': if (isOpen()) { e.preventDefault(); setActive(firstEnabledIndex()); } break;
					case 'End': if (isOpen()) { e.preventDefault(); setActive(lastEnabledIndex()); } break;
					case 'Enter': case ' ': if (isOpen()) { e.preventDefault(); selectOption(activeIndex); } break;
					case 'Escape': if (isOpen()) { e.preventDefault(); closeList(); } break;
					case 'Tab': closeList(); break;
				}
			});
			options.forEach(function (li, index) {
				li.addEventListener('mousedown', function (e) { e.preventDefault(); });
				li.addEventListener('click', function () { selectOption(index); });
				li.addEventListener('mouseenter', function () { setActive(index); });
			});

			var api = {
				input: input,
				getSelectedIndex: function () { return TIME_OPTIONS.indexOf(input.value); },
				restrictBefore: function (minIndex) {
					options.forEach(function (li, idx) {
						var disabled = minIndex > -1 && idx <= minIndex;
						li.classList.toggle('is-disabled', disabled);
						li.setAttribute('aria-disabled', disabled ? 'true' : 'false');
					});
					var cur = TIME_OPTIONS.indexOf(input.value);
					if (cur > -1 && minIndex > -1 && cur <= minIndex) {
						input.value = '';
						options.forEach(function (o) { o.classList.remove('is-selected'); });
						input.dispatchEvent(new Event('input', { bubbles: true }));
						input.dispatchEvent(new Event('change', { bubbles: true }));
					}
				}
			};
			input._timeSelectApi = api;
			return api;
		}

		function fieldLabelMatches(input, regex) {
			var label = (input.labels && input.labels[0]) || null;
			if (!label) {
				var field = input.closest('.gfield') || input.closest('.book-field');
				label = field ? field.querySelector('label') : null;
			}
			return !!label && regex.test(label.textContent);
		}

		function linkStartEndFields(inputs) {
			var groups = [];
			inputs.forEach(function (input) {
				var container = input.closest('[role="dialog"]') || input.closest('form') || document.body;
				var entry = groups.filter(function (g) { return g.container === container; })[0];
				if (!entry) { entry = { container: container, inputs: [] }; groups.push(entry); }
				entry.inputs.push(input);
			});
			groups.forEach(function (group) {
				var startInput = group.inputs.filter(function (i) { return fieldLabelMatches(i, /start/i); })[0];
				var endInput = group.inputs.filter(function (i) { return fieldLabelMatches(i, /end/i); })[0];
				if (!startInput || !endInput || startInput === endInput || startInput.dataset.timeSyncLinked) { return; }
				startInput.dataset.timeSyncLinked = '1';
				var startApi = startInput._timeSelectApi, endApi = endInput._timeSelectApi;
				if (!startApi || !endApi) { return; }
				var apply = function () { endApi.restrictBefore(startApi.getSelectedIndex()); };
				startInput.addEventListener('time-select:change', apply);
				apply();
			});
		}

		function enhanceAndLink(selector) {
			var inputs = Array.prototype.slice.call(document.querySelectorAll(selector));
			inputs.forEach(initTimeSelect);
			linkStartEndFields(inputs);
		}

		document.addEventListener('gform/postRender', function () {
			enhanceAndLink('.native-time .ginput_container input[type="text"], .native-time .ginput_container input[type="time"]');
		});
		onReady(function () { enhanceAndLink('.book-time-input'); });
	})();

	/* ------------------------------------------------------------------ */
	/*  Contact form: Event Address autocomplete fills the fields below    */
	/* ------------------------------------------------------------------ */
	/* The GF Google Address Autocomplete plugin (pcafe) runs Event Address
	   (form 1, field 69) as a plain text field, so on its own it only writes
	   the full formatted address back into that one field. Wrapping its
	   get_location() hands us the parsed place: Suburb, Event State and
	   Postal Code are filled from it, and Event Address keeps just the street
	   (client 2026-10-01). The plugin writes the returned .address into the
	   field after get_location() returns, hence the street goes there. */
	onReady(function () {
		if (typeof PCAFE_AAC_Frontend !== 'function') { return; }

		var targets = {
			'1_69': { suburb: 'input_1_70', state: 'input_1_57', postcode: 'input_1_71' }
		};

		/* Enter picks the highlighted suggestion, but the browser also takes
		   it as "submit the form", and Gravity Forms posts the page before
		   Google has returned the place details. The form went off with the
		   raw suggestion text, the fields below empty, and GF's required-field
		   errors (client 2026-10-01). Enter has no other job in a single-line
		   address field, so its default is blocked there; the autocomplete
		   still gets the key and selects the place. */
		document.addEventListener('keydown', function (e) {
			if (e.key !== 'Enter' || !e.target || !e.target.id) { return; }
			if (targets[e.target.id.replace(/^input_/, '')]) { e.preventDefault(); }
		}, true);

		var fire = function (el) {
			el.dispatchEvent(new Event('input', { bubbles: true }));
			el.dispatchEvent(new Event('change', { bubbles: true }));
		};

		var setText = function (id, value) {
			var el = document.getElementById(id);
			if (!el) { return; }
			el.value = value || '';
			fire(el);
		};

		var setSelect = function (id, value) {
			var el = document.getElementById(id);
			if (!el || !value) { return; }
			var match = Array.prototype.filter.call(el.options, function (o) {
				return o.value.toUpperCase() === value.toUpperCase();
			})[0];
			if (!match) { return; }
			el.value = match.value;
			fire(el);
		};

		var component = function (place, type) {
			var found = (place.address_components || []).filter(function (c) {
				return c.types.indexOf(type) !== -1;
			})[0];
			return found ? found.long_name : '';
		};

		var proto = PCAFE_AAC_Frontend.prototype;
		var getLocation = proto.get_location;

		proto.get_location = function (place, formId, fieldId) {
			var data = getLocation.apply(this, arguments);
			var map = targets[formId + '_' + fieldId];
			if (!map) { return data; }

			setText(map.suburb, data.city || component(place, 'sublocality') || component(place, 'postal_town'));
			setSelect(map.state, data.region_code);
			setText(map.postcode, data.postal_code);

			if (data.street) { data.address = data.street; }
			return data;
		};
	});

	/* The new .oh-marquee component is pure CSS — no JS needed. The legacy
	   inner pages still use window.LogoMarquee via assets/js/legacy/custom.js. */

})();
