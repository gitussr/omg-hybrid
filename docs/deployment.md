# OMG Hybrid — deployment & configuration notes

Configuration that lives in the **database / plugin settings**, not in theme
files. Recorded here so it can be reproduced on staging / production.

Last reviewed: Phase 7 (QA).

---

## Active theme

`wp_options.template` = `wp_options.stylesheet` = `omg-hybrid`.

On first activation the theme copies these from the old theme's mods
(`inc/migrate.php`, one-time, guarded by the `omg_hybrid_migrated` option):

- `nav_menu_locations` — `main-menu` → menu 2, `footer` → 5, `footer-other` → 4
  (the `main-menu` assignment only matters so the omg-mega-menu plugin's
  `wp_nav_menu` filter fires; the menu's contents are irrelevant).
- `custom_logo` — usually a no-op; the logo is the theme-independent
  `site_logo` option (attachment 917).

Rollback: set `template` and `stylesheet` back to `omg-jeff-demo`.

---

## Plugins

### Active (13)

| Plugin | Role | Notes |
|---|---|---|
| `secure-custom-fields` | Custom fields (ACF-compatible API) | Header/footer + all ported inner pages depend on it. Field groups are DB-only (no `acf-json/`). |
| `omg-mega-menu` | Header navigation + Quick Quote | Custom plugin, bumped to **2.1.6** in this rebuild (large "Our Services" logo card removed). Config in the `omg_mm_opts` option / *Mega Menu* admin page. |
| `gravityforms` (+ `gravityformszapier`, `gf-datetime-field-add-on`, `gf-google-address-autocomplete`) | Contact / Join / Partner forms | The Contact page uses GF form id 1. |
| `classic-editor` | Editor | Matches the non-block theme. |
| `litespeed-cache` | Page cache | The theme no longer fights it (Cloudflare no-cache headers removed — see below). |
| `simple-history` | Audit log | — |
| `fluent-smtp` | Outgoing mail (SMTP) | See **Mail** below. |
| `aam-wp-migration`, `better-search-replace` | Migration tooling | Dev/ops only. |
| `wp-file-manager` | In-dashboard file access | **Remove or lock down before production** — security risk. |

### Deactivated in Phase 7 (were unused)

`contact-form-7`, `contact-form-cfdb7`, `cf7-to-zapier`,
`select-multiselect-field-contact-form-7`.

CF7 had no shortcodes anywhere and no stored submissions; the Contact form
is Gravity Forms. The 3 CF7 form definitions remain in the DB (dormant) —
safe to hard-delete the plugins later.

---

## Mail (FluentSMTP)

`wp_mail()` is routed through FluentSMTP. Settings live in the
`fluentmail-settings` option (log table: `wp_fsmpt_email_logs` — note the
plugin's `fsmpt_` prefix typo).

**Local (Laragon):** configured to use Laragon's **Mailpit** catcher —
SMTP `127.0.0.1:1025`, no auth, no encryption; forced From
`OMG Entertainment <noreply@omg-hybrid.test>`. Mailpit web UI:
<http://localhost:8025>.

**Production TODO:** replace the connection with the real OMG mail provider
(SMTP host/port/user/pass, or an API provider) via *Settings → FluentSMTP*.

### Quick Quote recipient

`omg_mm_opts['quick_quote']['recipient']` = **`bookings@omggroup.com.au`**.

Both Quick Quote entry points (the footer floating panel and the
mega-menu modal) share `assets/js/book-wizard.js` and submit to the
`omg_mm_quote` AJAX action in the mega-menu plugin, which sends the mail.
If `recipient` is ever cleared it falls back to `admin_email`
(currently `dev@creativus-design.com` — change for production if desired).

Verified end-to-end in Phase 7: browser 6-step wizard → AJAX → `handle_quote()`
→ `wp_mail()` → FluentSMTP (`status: sent`) → delivered with all 14 fields,
Reply-To, and originating page URL.

---

## Theme-registered configuration

- **SCF options page** — `inc/theme-options.php` re-registers the
  "Theme Settings" page (menu slug `theme-general-settings`). The shared
  header/footer read these fields: `contact_details`, `header_stars`,
  `footer_title`, `cta_buttons`.
- **Removed:** the previous theme's ~18 Cloudflare / proxy cache-bypass
  response headers (`Cache-Control: no-store`, `Vary: *`, randomised
  `ETag`, …). They defeated page caching site-wide. If specific pages ever
  need to bypass cache, do it surgically, not globally.

---

## Service landing pages

| Page | Route | `_wp_page_template` | Palette body class |
|---|---|---|---|
| OMG Entertainment (home) | `/` | (front-page.php overrides) | `svc-entertainment` |
| OMG Entertainment (inner) | `/omg-entertainment/` | `template-omg-entertainment.php` | `svc-entertainment` |
| OMG Studio | `/omg-studio/` | `template-omg-studio.php` | `svc-studio` |
| OMG LiVE | `/omg-live/` | `template-omg-live.php` | `svc-live` |
| OMG Props & Theming | `/omg-props-theming/` | `template-omg-props-theming.php` | `svc-props` |

Landing-page body content is **static** (in the templates). The palette
is switched by the body class, set in `inc/services.php`.

Known: page 7 ("Home") still has a stale `_wp_page_template =
template-home.php` meta value (that file doesn't exist here). Harmless —
`front-page.php` wins — but wp-admin Page Attributes will show "Default".
