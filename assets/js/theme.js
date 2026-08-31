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
	/* ------------------------------------------------------------------ */
	window.addEventListener('load', function () {
		var loader = document.getElementById('loader');
		if (!loader) { return; }
		loader.style.transition = 'opacity .4s ease';
		loader.style.opacity = '0';
		setTimeout(function () { loader.style.display = 'none'; }, 400);
	});

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
				loop: heroEl.querySelectorAll('.swiper-slide').length > 1,
				autoplay: { delay: 5000, disableOnInteraction: false },
				speed: 900,
				pagination: {
					el: heroEl.querySelector('.swiper-pagination'),
					clickable: true,
					renderBullet: numberedBullet
				}
			});
			heroEl.addEventListener('mouseenter', function () { hero.autoplay && hero.autoplay.stop(); });
			heroEl.addEventListener('mouseleave', function () { hero.autoplay && hero.autoplay.start(); });
		}

		document.querySelectorAll('.oh-testimonials .swiper').forEach(function (el) {
			if (el.classList.contains('swiper-initialized')) { return; }
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

	/* The new .oh-marquee component is pure CSS — no JS needed. The legacy
	   inner pages still use window.LogoMarquee via assets/js/legacy/custom.js. */

})();
