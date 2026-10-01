/**
 * LEGACY — ported from the previous theme (omg-jeff-demo/assets/js/custom.js).
 *
 * Loaded ONLY on legacy page templates (body.oh-legacy). Contains the
 * widgets that still use the previous markup: StellarNav, the inner-page
 * hero Swiper, the testimonials Swiper, the counters and the logo marquee.
 *
 * The pieces that are shared with the new component system — the loader,
 * sticky header, back-to-top, circular emblem text, the Quick Quote panel
 * and the 30-minute time dropdown — were moved to assets/js/theme.js
 * (which loads on every page) so there is exactly one implementation.
 */
jQuery(document).ready(function ($) {

  // ======================
  // Navigation (StellarNav) — legacy mobile menu on inner pages
  // ======================
  if ($.fn.stellarNav) {
    $('.stellarnav').stellarNav({
      theme: 'dark',
      breakpoint: 991,
      menuLabel: '&nbsp',
      sticky: false,
      position: 'left',
      openingSpeed: 250,
      closingDelay: 250,
      showArrows: true,
      phoneBtn: '',
      phoneLabel: 'Call Us',
      locationBtn: '',
      locationLabel: 'Location',
      closeBtn: false,
      closeLabel: 'Close',
      mobileMode: false,
      scrollbarFix: false
    });
  }

  // ======================
  // Sub title center
  // ======================
  (() => {
    document.querySelectorAll('[class^="sub-title-"].text-center').forEach(el => {
      const wrapper = document.createElement('div');
      wrapper.className = 'd-flex justify-content-center';
      el.parentNode.insertBefore(wrapper, el);
      wrapper.appendChild(el);
    });
  })();

  // ======================
  // Swiper – inner-page hero
  // ======================
  (() => {
    const swiperEl = document.querySelector('.hero-section .mySwiper');
    if (!swiperEl || typeof Swiper === 'undefined') return;

    const swiper = new Swiper(swiperEl, {
      slidesPerView: 1,
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false
      },
      speed: 2000,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
        renderBullet: function (index, className) {
          const num = String(index + 1).padStart(2, '0');
          return `
            <span class="${className}">
              <span class="num">${num}</span>
              <span class="line"></span>
            </span>
          `;
        },
      },
    });

    swiperEl.addEventListener('mouseenter', () => swiper.autoplay.stop());
    swiperEl.addEventListener('mouseleave', () => swiper.autoplay.start());
  })();

  // ======================
  // Swiper – Testimonials
  // ======================
  (() => {
    if (!document.querySelector('.testimonials-section .mySwiper') || typeof Swiper === 'undefined') return;

    new Swiper('.testimonials-section .mySwiper', {
      slidesPerView: 1,
      loop: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
        renderBullet: function (index, className) {
          const num = String(index + 1).padStart(2, '0');
          return `
            <span class="${className}">
              <span class="num">${num}</span>
              <span class="line"></span>
            </span>
          `;
        },
      },
    });
  })();

  // ======================
  // Counter
  // ======================
  (() => {
    if (!document.querySelector('.counter-number')) return;

    const counters = document.querySelectorAll(".counter-number");

    const parseTarget = (el) => {
      const dt = el.getAttribute("data-target");
      if (!dt) return 0;

      const cleaned = dt.trim().toLowerCase();
      if (cleaned.includes("k")) {
        return Math.round(parseFloat(cleaned.replace(/[^0-9.]/g, "")) * 1000);
      }
      return parseInt(cleaned.replace(/[^\d-]/g, ""), 10) || 0;
    };

    const startCounter = (el) => {
      const target = parseTarget(el);
      let current = 0;
      const step = Math.max(1, Math.ceil(target / 120));

      const timer = setInterval(() => {
        current += step;
        if (current >= target) {
          el.textContent = target;
          clearInterval(timer);
        } else {
          el.textContent = current;
        }
      }, 16);
    };

    const observer = new IntersectionObserver((entries, obs) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          startCounter(entry.target);
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });

    counters.forEach(c => observer.observe(c));
  })();

  // ======================
  // Logo marquee
  // ======================
  if (typeof LogoMarquee !== 'undefined') {
    LogoMarquee.init([
      {
        selector: '.marque-1',
        direction: 'left',
        speed: 40,
      },
    ]);
  }


  // ======================
  // Contact form — one shared gold outline framing the 5 OMG division
  // fields as a group (client 2026-09-29), on top of each field's own
  // brand-coloured box (untouched). Positioned by JS, not layout, so the
  // fields keep Gravity Forms' own responsive grid unchanged.
  // ======================
  (function () {
    var ids = ['field_1_72', 'field_1_66', 'field_1_79', 'field_1_81', 'field_1_83'];
    var fields = ids.map(function (id) { return document.getElementById(id); }).filter(Boolean);
    if (fields.length !== ids.length) return;

    var container = fields[0].closest('.gform_fields') || fields[0].parentElement;
    if (!container) return;

    var frame = document.createElement('div');
    frame.className = 'oh-division-fields-frame';
    // Set position/border inline, not via the stylesheet class — Gravity
    // Forms' own theme-framework CSS resets child positioning with higher
    // specificity and was winning the cascade (client 2026-09-29).
    frame.style.position = 'absolute';
    frame.style.border = '1px solid #EECD92';
    frame.style.boxSizing = 'border-box';
    frame.style.borderRadius = '10px';
    frame.style.pointerEvents = 'none';
    if (getComputedStyle(container).position === 'static') {
      container.style.position = 'relative';
    }
    container.appendChild(frame);

    var PAD = 16;
    function updateFrame() {
      var cRect = container.getBoundingClientRect();
      var top = Infinity, left = Infinity, right = -Infinity, bottom = -Infinity;
      fields.forEach(function (f) {
        var r = f.getBoundingClientRect();
        top = Math.min(top, r.top);
        left = Math.min(left, r.left);
        right = Math.max(right, r.right);
        bottom = Math.max(bottom, r.bottom);
      });
      // Padding stays inside the container's own box — never pushes the
      // frame past it (client 2026-09-29, was overflowing left/right).
      var relTop = Math.max(0, top - cRect.top - PAD);
      var relLeft = Math.max(0, left - cRect.left - PAD);
      var relRight = Math.min(cRect.width, right - cRect.left + PAD);
      var relBottom = Math.min(cRect.height, bottom - cRect.top + PAD);
      frame.style.top = relTop + 'px';
      frame.style.left = relLeft + 'px';
      frame.style.width = (relRight - relLeft) + 'px';
      frame.style.height = (relBottom - relTop) + 'px';
    }

    updateFrame();
    window.addEventListener('load', updateFrame);
    var resizeTimer;
    window.addEventListener('resize', function () {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(updateFrame, 150);
    });
  })();

});
