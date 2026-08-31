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

});
