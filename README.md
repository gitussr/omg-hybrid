# OMG Hybrid

One self-contained WordPress theme powering the OMG Entertainment site and its
four service brands — **OMG Entertainment**, **OMG Studio**, **OMG LiVE** and
**OMG Props & Theming** — from a single install. Shared components, one
colour-token system, four palettes.

> **Self-contained by design.** Every asset, template, function, style and
> script the site needs lives inside this theme. It keeps working with all
> existing functionality even after the previous themes (`omg-jeff-demo`, `omg`)
> are deleted.

---

## Requirements

- WordPress ≥ 6.0, PHP ≥ 7.4
- Plugins (the theme degrades gracefully if one is missing, but the site
  expects them):
  - **Secure Custom Fields** (ACF-compatible API) — header/footer option
    fields, legacy page content
  - **omg-mega-menu** (custom) — replaces `wp_nav_menu('main-menu')`; its JS
    depends on the theme script handle `book-wizard` and reuses the
    `.book-*` classes
  - **Gravity Forms** (+ Zapier, Date/Time, Google Address add-ons) — the
    Contact form
  - `classic-editor`, `litespeed-cache`, `fluent-smtp`, `simple-history`

Configuration that lives in the **database / plugin settings** (active theme,
nav-menu locations, SMTP routing, quote-form recipient, etc.) is documented in
[`docs/deployment.md`](docs/deployment.md).

## Install

1. Copy this folder to `wp-content/themes/omg-hybrid/`.
2. Activate it. On first run `inc/migrate.php` copies `nav_menu_locations`
   from the old theme's mods (one-time, guarded by the `omg_hybrid_migrated`
   option) so the mega-menu plugin's `wp_nav_menu` filter fires.

---

## Architecture

### Two asset layers, chosen per request

`inc/enqueue.php` decides which layer a page gets from
`omg_hybrid_is_legacy_template()` (`inc/template-legacy.php`):

| | `body.oh-theme` — **new** pages | `body.oh-legacy` — **ported** pages |
|---|---|---|
| CSS | `shell.css` + `app.css` | `shell.css` + `legacy/*` bundle + FontAwesome 6 |
| JS | `theme.js` | `theme.js` + `legacy/*` (bootstrap, stellarnav, trimmed custom.js) |
| Markup | `template-parts/sections/*.php` components taking `$args` bundles | the 14 previous-theme templates, ported verbatim at the theme root |

`shell.css` and `theme.js` load **everywhere** — design tokens, the four
palettes, the shared header / footer / loader / back-to-top, `.oh-btn*`, and
the floating Quick Quote panel (`#book-now-*` / `.book-*` / `.time-select-*`).
Load order matters on legacy pages: vendor Bootstrap loads *before*
`legacy-base.css` so the theme's reset wins.

### Colour palettes

Custom properties `--color-primary` / `-secondary` / `-muted` / `--on-primary`,
switched by a body class set in `inc/services.php` from a template → service
map:

| Body class | Context | Primary |
|---|---|---|
| `.svc-entertainment` | `/omg-entertainment/` | `#BF2525` |
| `.svc-studio` | `/omg-studio/` | `#33D5C6` |
| `.svc-live` | `/omg-live/` | `#BB44F0` |
| `.svc-props` | `/omg-props-theming/` | `#DEDE6D` |
| `.svc-group` | home, `/contact/`, `/print-templates/` | `#4B6587` (slate + gold) |

Components only ever read `var(--color-*)` — they never reference a service
colour directly. `--on-primary` is the readable text/icon colour on the
primary (dark for studio/props/group, white for entertainment/live).

---

## Layout

```
functions.php            requires inc/{helpers,migrate,setup,services,
                                       template-legacy,enqueue,nav-menus,
                                       theme-options,security}.php
header.php / footer.php   shared chrome (+ #loader, back-to-top, Quick Quote)

front-page.php ─┐
template-omg-entertainment.php ─┴─> template-parts/omg-entertainment-layout.php
template-omg-{studio,live,props-theming}.php ─> template-parts/service-landing.php

template-parts/
  sections/               hero, welcome, service-cards, service-rows,
                          why-choose, testimonials, other-services, cta, marquee
  omg-entertainment/      below-hero-1 (Welcome), below-hero-2 (Our Services),
                          home-divisions (home only)
  quick-quote.php         footer Quick Quote panel markup

template-{our-booths,photography,videography,print-templates,contact,
          casino-fun-nights, …}.php   ported legacy templates (filenames kept
                                      so existing _wp_page_template meta resolves)

assets/
  css/   shell.css, app.css, swiper.css, legacy-*.css
  js/    theme.js, book-wizard.js (do NOT rename this handle), swiper.js, legacy/
  icons.svg   sprite — inline with omg_hybrid_icon($id)
  fonts/  Beautique Display (display) + Barlow (body), local
```

## Conventions

- All new markup uses **`oh-`** prefixed classes (never the legacy
  `primary-btn` / `title-` / `sub-title-`).
- Script handle **`book-wizard`** must keep that exact name — the omg-mega-menu
  plugin enqueues against it and reuses `.book-step` / `.book-input` /
  `.book-panel-title`.
- jQuery = WordPress core (not deregistered).
- Theme Settings option fields (`theme-general-settings`, registered in
  `inc/theme-options.php`): `contact_details`, `header_stars`, `footer_title`,
  `cta_buttons`.
- Icons: `omg_hybrid_icon('id')` inlines a `<symbol>` from `assets/icons.svg`
  (class `.srdev-icon`).
- Standard CTAs: `omg_hybrid_cta_buttons()` → Call Us / Book an Event / Email Us.

---

## Local development

Built on Laragon (`http://omg-hybrid.test`). There is no build step — CSS/JS are
authored directly in `assets/` and cache-busted by file mtime in
`inc/enqueue.php`.
