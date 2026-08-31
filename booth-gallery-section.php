<style>
  /* ============================================================
     FONT SETUP
     'Beautique Display' is a licensed/paid display face and is
     not distributed on Google Fonts or any open CDN. Drop the
     licensed font files into ./fonts/ and uncomment the
     @font-face block below to activate it. Until then, the
     stack falls back to a similar high-contrast serif so the
     layout previews correctly.
     ============================================================ */

  /*
  @font-face {
    font-family: 'Beautique Display';
    src: url('fonts/BeautiqueDisplay-Regular.woff2') format('woff2');
    font-weight: 400;
    font-display: swap;
  }
  @font-face {
    font-family: 'Beautique Display';
    src: url('fonts/BeautiqueDisplay-Light.woff2') format('woff2');
    font-weight: 300;
    font-display: swap;
  }
  */

  :root {
    --teal: #BF2525;
    --black: #000000;
    --white: #ffffff;

    /* black tinted at a few opacities, used for hairlines/secondary text
       so we stay inside the brief's two-color palette */
    --black-70: rgba(0, 0, 0, 0.7);
    --black-45: rgba(0, 0, 0, 0.45);
    --black-20: rgba(0, 0, 0, 0.16);
    --white-70: rgba(255, 255, 255, 0.7);
    --white-25: rgba(255, 255, 255, 0.25);

    --font-display: 'Beautique Display', 'Cormorant Garamond', Georgia, 'Times New Roman', serif;
    --font-body: 'Barlow', 'Helvetica Neue', Arial, sans-serif;

    --container: 1480px;
    --gutter: clamp(24px, 5vw, 80px);
  }

  button {
    font-family: inherit;
  }

  a {
    color: inherit;
    text-decoration: none;
  }

  :focus-visible {
    outline: 3px solid var(--black);
    outline-offset: 3px;
  }

  /* ============================================================
     HERO
     ============================================================ */
  .hero {
    color: #fff;
    position: relative;
    background: var(--teal);
    overflow: hidden;
    padding: clamp(40px, 6vw, 70px) 0 clamp(48px, 7vw, 70px);
  }

  /* faint decorative arc + dot grid, echoes the reference comp */
  .hero__deco-arc {
    position: absolute;
    top: -28%;
    left: 38%;
    width: 90%;
    height: 160%;
/*     border: 1.5px solid rgba(255, 255, 255, 0.35); */
    border-radius: 50%;
    pointer-events: none;
  }

  .hero__deco-dots {
    position: absolute;
    top: 6%;
    right: 0;
    width: min(34%, 460px);
    height: 70%;
    background-image: radial-gradient(rgba(255, 255, 255, 0.55) 1.4px, transparent 1.4px);
    background-size: 16px 16px;
    -webkit-mask-image: linear-gradient(to left, rgba(0, 0, 0, 0.9), transparent 92%);
    mask-image: linear-gradient(to left, rgba(0, 0, 0, 0.9), transparent 92%);
    pointer-events: none;
  }

  .hero__inner {
    position: relative;
    z-index: 2;
    max-width: var(--container);
    margin: 0 auto;
    padding: 0 var(--gutter);
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(0, 1.02fr);
    gap: clamp(32px, 5vw, 64px);
    align-items: center;
  }

  /* ---------- left column ---------- */
  .hero__copy {
    min-width: 0;
  }

  .logo {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    margin: 0 0 clamp(20px, 3vw, 32px);
    width: 135px;
  }

  .hero__title {
    font-family: var(--font-display);
    font-weight: 500;
    line-height: 1.05;
    letter-spacing: -0.01em;
    margin: 0 0 clamp(20px, 3vw, 28px);
    font-size: clamp(36px, 5.2vw, 64px);
  }

  .hero__title span {
    display: block;
  }

  .hero__title .is-black {
    color: var(--white);
  }

  .hero__title .is-white {
    color: var(--white);
  }

  .hero__sub {
    font-size: clamp(16px, 1.6vw, 19px);
    line-height: 1.5;
    color: var(--white);
    max-width: 46ch;
    margin: 0 0 clamp(28px, 4vw, 40px);
    font-weight: 400;
  }

  .hero__sub strong {
    font-weight: 700;
    color: var(--white);
  }

  /* feature trio */
  .features {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: clamp(18px, 2.4vw, 28px);
    padding-bottom: clamp(28px, 4vw, 40px);
    margin-bottom: clamp(28px, 4vw, 40px);
    border-bottom: 1px solid var(--black-20);
  }

  .feature {
    position: relative;
    padding-left: clamp(14px, 2vw, 22px);
  }

  .feature+.feature {
    border-left: 1px solid var(--white-20);
  }

  .feature__icon {
    width: 40px;
    height: 40px;
    margin-bottom: 12px;
    color: var(--white);
    display: block;
  }

  .feature__icon svg {
    width: 100%;
    height: 100%;
    display: block;
  }

  .feature h3 {
    font-family: var(--font-body);
    font-size: clamp(15px, 1.6vw, 17px);
    font-weight: 700;
    margin: 0 0 6px;
    color: var(--white);
  }

  .feature p {
    font-size: clamp(13.5px, 1.3vw, 14.5px);
    line-height: 1.45;
    color: var(--white-45);
    margin: 0;
    font-weight: 400;
  }

  /* CTA row */
  .cta-row {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: clamp(20px, 3vw, 36px);
  }

  .btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 14px;
    background: var(--black);
    color: var(--white);
    border: none;
    padding: 17px 26px;
    border-radius: 10px;
    font-family: var(--font-body);
    font-size: 13.5px;
    font-weight: 700;
    letter-spacing: 0.09em;
    text-transform: uppercase;
    cursor: pointer;
    white-space: nowrap;
    transition: transform 0.18s ease, opacity 0.18s ease;
  }

  .btn-primary:hover {
    opacity: 0.86;
  }

  .btn-primary:active {
    transform: scale(0.98);
  }

  .btn-primary svg {
    width: 18px;
    height: 18px;
    flex-shrink: 0;
  }

  .meta-list {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: clamp(18px, 2.6vw, 30px);
    margin: 0;
    padding: 0;
    list-style: none;
  }

  .meta-list li {
    display: flex;
    align-items: center;
    gap: 9px;
    font-size: 13.5px;
    line-height: 1.3;
    font-weight: 600;
    color: var(--white);
  }

  .meta-list li+li {
    padding-left: clamp(18px, 2.6vw, 30px);
    border-left: 1px solid var(--black-20);
  }

  .meta-list svg {
    width: 19px;
    height: 19px;
    flex-shrink: 0;
    color: var(--black);
  }

  /* ---------- right column: photo / device collage ---------- */
  .hero__visual {
    position: relative;
    min-width: 0;
    display: flex;
    justify-content: center;
  }

  .hero__visual img {
    width: 100%;
    max-width: 720px;
    height: auto;
  }

  /* ============================================================
     BOTTOM CATEGORY BAR
     ============================================================ */
  .category-bar {
    background: var(--black);
    color: var(--white);
  }

  .category-bar__inner {
    max-width: var(--container);
    margin: 0 auto;
    padding: 0 var(--gutter);
    display: grid;
    grid-template-columns: repeat(5, 1fr);
  }

  .category-bar__item {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 22px 14px;
    font-size: 14.5px;
    font-weight: 600;
    white-space: nowrap;
    border-left: 1px solid var(--white-25);
  }

  .category-bar__item:first-child {
    border-left: none;
  }

  .category-bar__item svg {
    width: 21px;
    height: 21px;
    flex-shrink: 0;
  }

  /* ============================================================
     RESPONSIVE
     ============================================================ */

  @media (max-width: 1100px) {
    .hero__inner {
      grid-template-columns: 1fr;
    }

    .hero__visual {
      order: 2;
      margin-top: 8px;
    }

    .hero__copy {
      order: 1;
    }

    .hero__visual img {
      max-width: 560px;
    }

    .hero__deco-dots {
      display: none;
    }
  }

  @media (max-width: 760px) {
    .features {
      grid-template-columns: 1fr;
      gap: 18px;
    }

    .feature {
      padding-left: 0;
      padding-top: 16px;
    }

    .feature:first-child {
      padding-top: 0;
    }

    .feature+.feature {
      border-left: none;
      border-top: 1px solid var(--black-20);
    }

    .cta-row {
      flex-direction: column;
      align-items: flex-start;
      gap: 22px;
    }

    .btn-primary {
      width: 100%;
      justify-content: center;
    }

    .meta-list {
      gap: 14px 22px;
    }

    .meta-list li+li {
      padding-left: 0;
      border-left: none;
    }

    .category-bar__inner {
      grid-template-columns: repeat(2, 1fr);
    }

    .category-bar__item {
      justify-content: flex-start;
      border-left: none !important;
      border-top: 1px solid var(--white-25);
      padding: 16px 4px;
      font-size: 13.5px;
    }

    .category-bar__item:nth-child(-n+2) {
      border-top: none;
    }

    .category-bar__item:last-child {
      grid-column: 1 / -1;
      justify-content: flex-start;
    }
  }

  @media (max-width: 480px) {
    .logo__text {
      font-size: 28px;
    }

    .hero__sub {
      max-width: none;
    }

    .category-bar__inner {
      grid-template-columns: 1fr;
    }

    .category-bar__item {
      border-top: 1px solid var(--white-25) !important;
    }

    .category-bar__item:first-child {
      border-top: none !important;
    }

    .category-bar__item:last-child {
      grid-column: auto;
    }
  }

  @media (max-width: 450px) {

    .cta-row .btn-group {
      width: 100%;
      display: grid!important;
      grid-template-columns: max-content;
      justify-content: center;
      gap: clamp(14px, 1.042vw, 20px) !important;
    }

    .cta-row .btn-group.d-flex.flex-wrap.gap-3 a {
      display: block;
      text-align: center;
      margin-block: 0;
      display: inline-flex;
      justify-content: center;
      align-items: center;
    }

    .meta-list li {
      width: 100%;
    }
  }

  @media (prefers-reduced-motion: reduce) {
    .btn-primary {
      transition: none;
    }
  }
</style>
</head>

<body>

  <section class="hero">
    <div class="hero__deco-arc" aria-hidden="true"></div>
    <div class="hero__deco-dots" aria-hidden="true"></div>

    <div class="hero__inner">

      <div class="hero__copy">

        <!--       <div class="logo">
		<img src="<?php // echo get_home_url()
              ?>/wp-content/uploads/2026/05/omg-studio.png" alt="OMG Studio" class="img-fluid" />
      </div> -->

        <h1 class="hero__title">
          <span class="is-black">Unforgettable Moments.</span>
          <span class="is-white">Made Effortless.</span>
        </h1>

        <p class="hero__sub">
          Premium PhotoBooths, 360 Video&#8209;Booths &amp; Video Guest&#8209;Books for <strong>Corporate</strong> and <strong>Private</strong> Events.
        </p>

        <div class="features">
          <div class="feature">
            <span class="feature__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 8.5h2.6l1.1-1.8h8.6l1.1 1.8H20a1 1 0 0 1 1 1V18a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5a1 1 0 0 1 1-1Z" />
                <circle cx="12" cy="13" r="3.4" />
              </svg>
            </span>
            <h3>PhotoBooth</h3>
            <p>Capture stunning photos with custom overlays.</p>
          </div>
          <div class="feature">
            <span class="feature__icon">

              <svg height="512pt" viewBox="0 -66 512.001 512" width="512pt" xmlns="http://www.w3.org/2000/svg" fill="#fff">
                <path d="m322.285156 335.644531c-7.441406 0-13.898437-5.53125-14.863281-13.105469-1.042969-8.21875 4.769531-15.726562 12.984375-16.773437 47.398438-6.039063 89.84375-18.882813 119.515625-36.171875 27.136719-15.808594 42.078125-34.394531 42.078125-52.332031 0-19.769531-17.484375-35.945313-32.15625-46.039063-6.824219-4.695312-8.550781-14.03125-3.855469-20.859375 4.695313-6.824219 14.035157-8.550781 20.859375-3.855469 29.539063 20.320313 45.152344 44.785157 45.152344 70.757813 0 29.476563-19.699219 56.535156-56.972656 78.25-33.550782 19.546875-78.789063 33.382813-130.828125 40.011719-.644531.078125-1.285157.117187-1.914063.117187zm0 0" />
                <path d="m252.34375 314.15625-40-40c-5.859375-5.859375-15.355469-5.859375-21.214844 0-5.855468 5.855469-5.855468 15.355469 0 21.210938l11.6875 11.6875c-44.8125-4.628907-85.523437-15.0625-117.046875-30.222657-35.441406-17.042969-55.769531-38.757812-55.769531-59.570312 0-17.652344 14.554688-36 40.980469-51.664063 7.128906-4.222656 9.480469-13.425781 5.257812-20.550781-4.226562-7.128906-13.429687-9.480469-20.554687-5.257813-46.023438 27.28125-55.683594 57.1875-55.683594 77.472657 0 33.28125 25.84375 64.039062 72.769531 86.609375 36.421875 17.511718 83.535157 29.242187 134.863281 33.78125l-16.503906 16.503906c-5.855468 5.855469-5.855468 15.355469 0 21.214844 2.929688 2.925781 6.769532 4.390625 10.609375 4.390625 3.835938 0 7.675781-1.464844 10.605469-4.390625l40-40c5.855469-5.859375 5.855469-15.359375 0-21.214844zm0 0" />
                <path d="m157.097656 187.222656v-3.609375c0-12.730469-7.792968-15.199219-18.242187-15.199219-6.460938 0-8.550781-5.699218-8.550781-11.398437 0-5.703125 2.089843-11.402344 8.550781-11.402344 7.21875 0 14.820312-.949219 14.820312-16.339843 0-11.019532-6.269531-13.679688-14.0625-13.679688-9.308593 0-14.058593 2.28125-14.058593 9.691406 0 6.457032-2.851563 10.828125-13.871094 10.828125-13.679688 0-15.386719-2.851562-15.386719-11.972656 0-14.816406 10.636719-34.007813 43.316406-34.007813 24.132813 0 42.371094 8.738282 42.371094 34.390626 0 13.867187-5.128906 26.789062-14.628906 31.160156 11.210937 4.179687 19.378906 12.539062 19.378906 27.929687v3.609375c0 31.160156-21.46875 42.941406-48.070313 42.941406-32.679687 0-45.21875-19.949218-45.21875-35.910156 0-8.550781 3.609376-10.832031 14.058594-10.832031 12.160156 0 15.199219 2.660156 15.199219 9.882813 0 8.929687 8.363281 11.019531 16.910156 11.019531 12.921875 0 17.484375-4.75 17.484375-17.101563zm0 0" />
                <path d="m302.066406 183.613281v1.710938c0 32.679687-20.332031 44.839843-46.550781 44.839843s-46.742187-12.160156-46.742187-44.839843v-50.351563c0-32.679687 21.089843-44.839844 48.453124-44.839844 32.109376 0 44.839844 19.949219 44.839844 35.71875 0 9.121094-4.371094 11.96875-13.871094 11.96875-8.167968 0-15.390624-2.089843-15.390624-10.828124 0-7.21875-7.597657-11.019532-16.527344-11.019532-11.210938 0-17.863282 5.890625-17.863282 19v17.097656c6.082032-6.648437 14.632813-8.359374 23.753907-8.359374 21.65625 0 39.898437 9.5 39.898437 39.902343zm-63.652344 3.800781c0 13.109376 6.460938 18.808594 17.101563 18.808594s16.910156-5.699218 16.910156-18.808594v-1.710937c0-13.871094-6.269531-19.191406-17.101562-19.191406-10.257813 0-16.910157 4.941406-16.910157 17.480469zm0 0" />
                <path d="m325.054688 185.324219v-50.351563c0-32.679687 20.328124-44.839844 46.550781-44.839844 26.21875 0 46.738281 12.160157 46.738281 44.839844v50.351563c0 32.679687-20.519531 44.839843-46.738281 44.839843-26.222657 0-46.550781-12.160156-46.550781-44.839843zm63.648437-50.351563c0-13.109375-6.457031-19-17.097656-19s-16.910157 5.890625-16.910157 19v50.351563c0 13.109375 6.269532 19 16.910157 19s17.097656-5.890625 17.097656-19zm0 0" />
                <path d="m454.351562 90c-24.816406 0-45-20.1875-45-45s20.183594-45 45-45c24.8125 0 45 20.1875 45 45s-20.1875 45-45 45zm0-60c-8.273437 0-15 6.730469-15 15 0 8.273438 6.726563 15 15 15 8.269532 0 15-6.726562 15-15 0-8.269531-6.730468-15-15-15zm0 0" />
              </svg>
            </span>
            <h3>360 Video&#8209;Booth</h3>
            <p>Create shareable 360&deg; videos that wow.</p>
          </div>
          <div class="feature">
            <span class="feature__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="6" width="13" height="12" rx="2" />
                <path d="M16 10.4 21 7.5v9L16 13.6" />
              </svg>
            </span>
            <h3>Video Guest&#8209;Book</h3>
            <p>Collect heartfelt messages your way.</p>
          </div>
        </div>

        <div class="cta-row">
          <div class="btn-group d-flex flex-wrap gap-3">
            <a href="tel:1300300664" class="primary-btn-outline">
              call Us
              <svg class="srdev-icon">
                <use href="<?php echo get_home_url()?>/wp-content/themes/omg-jeff-demo/assets/icons.svg#fancy-right-arrow-icom"></use>
              </svg>
            </a>
            <a href="<?php echo get_home_url()?>/contact/" class="primary-btn-outline">
              Book an Event
              <svg class="srdev-icon">
                <use href="<?php echo get_home_url()?>/wp-content/themes/omg-jeff-demo/assets/icons.svg#fancy-right-arrow-icom"></use>
              </svg>
            </a>
            <a href="mailto:info@OMGgroup.com.au" class="primary-btn-outline">
              Email Us
              <svg class="srdev-icon">
                <use href="<?php echo get_home_url()?>/wp-content/themes/omg-jeff-demo/assets/icons.svg#fancy-right-arrow-icom"></use>
              </svg>
            </a>
          </div>

          <ul class="meta-list">
            <li>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="9" cy="8" r="2.6" />
                <path d="M3.6 18c.5-2.8 2.6-4.4 5.4-4.4S14.3 15.2 14.8 18" />
                <circle cx="17" cy="9" r="2" />
                <path d="M15.8 13.4c2 .2 3.4 1.6 3.8 3.9" />
              </svg>
              Corporate &amp; Private Events
            </li>
            <li>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 3.5l2.4 5 5.4.6-4 3.8.9 5.4L12 15.8l-4.7 2.5.9-5.4-4-3.8 5.4-.6Z" />
              </svg>
              Premium Experience
            </li>
            <li>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="6" cy="12" r="2.2" />
                <circle cx="17.5" cy="6" r="2.2" />
                <circle cx="17.5" cy="18" r="2.2" />
                <path d="M7.9 10.8 15.7 7M7.9 13.2l7.8 3.8" />
              </svg>
              Instant Share &amp; Prints
            </li>
          </ul>
        </div>

      </div>

      <div class="hero__visual">
        <img src="<?php echo get_home_url()?>/wp-content/uploads/2026/08/magnific_img1extend-the-image-as-i_y6lJzVoPW9.jpg" alt="OMG photo booth device beside a collage of guests posing at weddings and events" loading="eager" class="img-fluid" />
      </div>

    </div>
  </section>

  <nav class="category-bar" aria-label="Event categories">
    <div class="category-bar__inner">
      <div class="category-bar__item">
        <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3.5" y="5" width="17" height="15" rx="2" />
          <path d="M3.5 9.5h17M8 3v3.4M16 3v3.4" />
        </svg>
        Weddings
      </div>
      <div class="category-bar__item">
        <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3.5" y="7.5" width="17" height="12" rx="2" />
          <path d="M8.5 7.5V6a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v1.5M3.5 13h17" />
        </svg>
        Corporate Events
      </div>
      <div class="category-bar__item">
        <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 20 14 4M4 20 9 5M4 20l11-7" />
          <circle cx="17" cy="5" r="1.2" fill="#fff" stroke="none" />
          <circle cx="20" cy="9" r="1" fill="#fff" stroke="none" />
          <circle cx="13" cy="3" r="0.9" fill="#fff" stroke="none" />
        </svg>
        Parties &amp; Celebrations
      </div>
      <div class="category-bar__item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="8.5" r="4.5" />
          <path d="M9 12.4 7.4 21l4.6-2.4 4.6 2.4-1.6-8.6" />
        </svg>
        Product Launches
      </div>
      <div class="category-bar__item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="8" cy="9" r="2.6" />
          <path d="M3 18c.4-2.6 2.3-4 5-4s4.6 1.4 5 4" />
          <circle cx="17" cy="9.5" r="2" />
          <path d="M15.6 14.2c1.9.3 3.2 1.6 3.5 3.8" />
        </svg>
        And More
      </div>
    </div>
  </nav>

</body>

</html>