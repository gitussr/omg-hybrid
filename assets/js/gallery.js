/**
 * Lightbox for template-parts/sections/gallery.php (client 2026-10-15).
 *
 * Each .oh-gallery list is its own set. A link opens a native <dialog>
 * (focus trap, Esc to close and backdrop come free) showing the full
 * photo, with previous / next buttons, arrow keys, swipe on touch, and a
 * click outside the photo to close. Without JS the links still open the
 * full image. No dependencies.
 */
(function () {
	'use strict';

	var links = document.querySelectorAll('[data-oh-gallery]');
	if (!links.length || typeof HTMLDialogElement !== 'function') {
		return;
	}

	var dialog = document.createElement('dialog');
	dialog.className = 'oh-lightbox';
	dialog.setAttribute('aria-label', 'Photo viewer');
	dialog.innerHTML =
		'<figure class="oh-lightbox__figure"><img class="oh-lightbox__img" alt=""></figure>' +
		'<p class="oh-lightbox__count" aria-live="polite"></p>' +
		'<button type="button" class="oh-lightbox__btn oh-lightbox__close" aria-label="Close"><i class="bi bi-x-lg" aria-hidden="true"></i></button>' +
		'<button type="button" class="oh-lightbox__btn oh-lightbox__prev" aria-label="Previous photo"><i class="bi bi-chevron-left" aria-hidden="true"></i></button>' +
		'<button type="button" class="oh-lightbox__btn oh-lightbox__next" aria-label="Next photo"><i class="bi bi-chevron-right" aria-hidden="true"></i></button>';
	document.body.appendChild(dialog);

	var img = dialog.querySelector('.oh-lightbox__img');
	var count = dialog.querySelector('.oh-lightbox__count');
	var set = [];
	var index = 0;
	var opener = null;

	function show(i) {
		index = (i + set.length) % set.length;
		img.src = set[index].href;
		count.textContent = (index + 1) + ' / ' + set.length;
		dialog.classList.toggle('is-single', set.length < 2);
	}

	function open(link) {
		var list = link.closest('.oh-gallery');
		set = Array.prototype.slice.call((list || document).querySelectorAll('[data-oh-gallery]'));
		opener = link;
		show(set.indexOf(link));
		dialog.showModal();
		document.documentElement.classList.add('oh-lightbox-open');
	}

	Array.prototype.forEach.call(links, function (link) {
		link.addEventListener('click', function (e) {
			e.preventDefault();
			open(link);
		});
	});

	dialog.querySelector('.oh-lightbox__close').addEventListener('click', function () {
		dialog.close();
	});
	dialog.querySelector('.oh-lightbox__prev').addEventListener('click', function () {
		show(index - 1);
	});
	dialog.querySelector('.oh-lightbox__next').addEventListener('click', function () {
		show(index + 1);
	});

	// Click on the dark area (the dialog itself or the figure around the
	// photo) closes; clicks on the photo or the buttons don't.
	dialog.addEventListener('click', function (e) {
		if (e.target === dialog || e.target.classList.contains('oh-lightbox__figure')) {
			dialog.close();
		}
	});

	dialog.addEventListener('keydown', function (e) {
		if (e.key === 'ArrowLeft') {
			show(index - 1);
		} else if (e.key === 'ArrowRight') {
			show(index + 1);
		}
	});

	var touchX = null;
	dialog.addEventListener('touchstart', function (e) {
		touchX = e.touches[0].clientX;
	}, { passive: true });
	dialog.addEventListener('touchend', function (e) {
		if (touchX === null) {
			return;
		}
		var dx = e.changedTouches[0].clientX - touchX;
		touchX = null;
		if (Math.abs(dx) > 50) {
			show(index + (dx < 0 ? 1 : -1));
		}
	});

	dialog.addEventListener('close', function () {
		document.documentElement.classList.remove('oh-lightbox-open');
		img.removeAttribute('src');
		if (opener) {
			opener.focus();
		}
	});
})();
