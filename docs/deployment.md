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
| `omg-mega-menu` | Header navigation + Quick Quote | Custom plugin, bumped to **2.1.6** in this rebuild (large "Our Services" logo card removed). Config in the `omg_mm_opts` option / *Mega Menu* admin page. **Frontend CSS edited in this rebuild** — see *Mega-menu palette* below. |
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

## Mega-menu palette (plugin CSS edit)

The mega menu renders the same on every page, so it has to pick up
whichever service palette the current page uses. Two small edits make it
follow `--color-primary`:

1. **`omg-hybrid/assets/css/shell.css`** (theme, tracked) declares
   `--omg-primary`, `--omg-primary-dark`, `--omg-on-primary` on `<body>`,
   mapped to the service tokens. Because `.svc-*` also sits on `<body>`,
   these re-resolve per page; a direct `body` rule beats the fixed
   `:root` value the plugin prints inline in `wp_head`
   (`OMG_Mega_Menu::css_vars()`).
2. **`plugins/omg-mega-menu/assets/css/mega-menu-frontend.css`** (plugin,
   **not** under the theme repo — carry these hunks manually on deploy):
   - `.omg-backdrop` background `#bf2525ab` → `color-mix(... var(--omg-primary) 67%, transparent)`
   - `.omg-services-footer` / `.omg-footer-btn` text `#fff` → `var(--omg-on-primary, #fff)` (keeps the bar legible on the pale Props yellow)

The plugin's other frontend colours already used `var(--omg-primary, …)`,
so step 1 alone re-themes the panel headings, links and active markers.

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

## Security hardening (QA audit 2026-09-03)

A full QA / security audit was run against the local install. High-severity
fixes applied so far — **carry these to staging / production**:

### Web-root `.htaccess` (`C:\laragon\www\omg-hybrid\.htaccess`, not theme-tracked)

A `# BEGIN OMG Hybrid hardening` block was added **above** the WordPress
markers (so Permalinks re-saves don't wipe it):

- `Options -Indexes` — kills directory listing everywhere (was exposing
  `/wp-content/uploads/`, `/wp-includes/`, theme `/assets/`, …). *OMG-QA-002*
- `RewriteRule "(^|/)\.(?!well-known)" - [F,L]` — 403s any dot-file / dot-dir,
  so `/wp-content/themes/omg-hybrid/.git/…` is no longer downloadable.
  *OMG-QA-001*
- `<FilesMatch>` denies `.md .sql .log .bak .wpress …`, plugin/theme
  `readme.(html|txt)`, `changelog.txt`, `license.txt`, `wp-config-sample.php`,
  `master-prompt.md`, `composer.*`, `package*.json`. *OMG-QA-009*

The production host should enforce the equivalent in the server/vhost config
too (don't rely on `.htaccess` alone), and **deploy without the `.git`
directory** and without `docs/` / `README.md` / `master-prompt.md`.

### `wp-file-manager` — DEACTIVATED

`deactivate_plugins('wp-file-manager/file_folder_manager.php')` — active
plugin count 13 → 12. **Delete the plugin folder before production.**
*OMG-QA-003*

### Local Laragon environment (dev machine only — not part of the app)

- `etc/apache2/sites-enabled/00-default.conf` rewritten: the catch-all
  `_default_:80` vhost now points at an empty docroot with
  `Require all denied` instead of serving `C:\laragon\www` with indexing
  (unknown `Host:` headers were browsing every sibling project + archives).
  Stock file saved at `etc/apache2/_no-default-site/00-default.conf.bak`.
  **Needs an Apache reload to take effect.** *OMG-QA-004*
- `bin/mysql/mysql-8.4.3-winx64/my.ini` — added `bind-address=127.0.0.1`
  under `[mysqld]` (was `0.0.0.0:3306`, root / no password, LAN-reachable).
  **Needs a MySQL restart to take effect.** Also set a `root` password and a
  least-privilege WP DB user for any non-loopback scenario. *OMG-QA-005*

Still open (Medium+, not yet done): Host-header-derived `WP_HOME`/`WP_SITEURL`
in `wp-config.php`, user-enumeration lockdown, XML-RPC, pending plugin/core
updates, salts in `wp-config`, `DISALLOW_FILE_EDIT`, response headers. See the
audit report.

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
