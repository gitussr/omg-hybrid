# OMG Hybrid — Audit & Hardening Documentation / Learning Guide

**Purpose:** a plain-language record of every concept touched during the QA / security
audit and the fixes that followed, written so you can *learn* from it, not just apply it.

Each item uses the same three-part shape:

- **What I audited / tested / fixed** — the concrete thing, with the exact command,
  code or config from this project.
- **What problem it solves in a real-world application** — why a professional cares.
- **Learn this** — the search terms / topics to go deeper.

Findings are cross-referenced to the audit report (`OMG-QA-0xx`).

---

## PART 1 — WEB SERVER HARDENING (Apache)

### 1.1 Directory listing / auto-index  *(OMG-QA-002 — fixed)*

**What I audited/fixed:**
I requested folders that have no `index.php`/`index.html` and got a browsable file
list back:

```bash
curl -s http://omg-hybrid.test/wp-content/uploads/
# <title>Index of /wp-content/uploads</title> ... <li><a href="2026/">2026/</a></li> ...
```

Root cause: `httpd.conf` had `Options Indexes FollowSymLinks Includes ExecCGI` on the
main `<Directory>` block. `Indexes` = "if there's no index file, print the directory
contents". This leaked every uploaded file, every plugin/theme asset path, and the
WP-Staging logs.

Fix — one line in the site's `.htaccess`, above the WordPress block:

```apache
Options -Indexes
```

Verified: `curl -o /dev/null -w '%{http_code}' .../wp-content/uploads/` → `403`.

**Real-world problem it solves:**
An attacker's first move is *reconnaissance*. A directory listing hands them your
plugin inventory, backup filenames, customer-uploaded PDFs/CSVs, `.sql` dumps someone
forgot to delete, and internal folder structure — all without a single exploit. Turning
it off forces them to *guess* URLs instead of *reading* an index.

**Learn this:** Apache `mod_autoindex`, the `Options` directive (`+`/`-` prefixes and how
they merge across nested contexts), `IndexOptions`, nginx equivalent `autoindex off;`.

---

### 1.2 Version-control directory exposure (`.git/`)  *(OMG-QA-001 — fixed)*

**What I audited/fixed:**
```bash
curl http://omg-hybrid.test/wp-content/themes/omg-hybrid/.git/config
# [remote "origin"] url = https://github.com/gitussr/omg-hybrid.git   <-- real content
```
The theme was deployed with `git clone` / `git pull`, so its `.git/` folder shipped to
the web root. With `.git/` readable, tools like *git-dumper* reconstruct your **entire
source history** — including secrets that were committed and later "removed" (they stay
in history forever).

Fix — a rewrite rule that 403s any path segment starting with a dot, except
`/.well-known/` (needed for TLS certs / `security.txt`):

```apache
RewriteRule "(^|/)\.(?!well-known)" - [F,L]
```

This also covers `.env`, `.gitignore`, `.github/`, `.vscode/`, `.htpasswd`, etc.

**Real-world problem it solves:**
Leaked `.git` = leaked source + leaked history + leaked config. Even for a public repo
it confirms the exact commit running in production, so an attacker knows precisely which
vulnerabilities apply. The permanent fix is *deploy artifacts, not repos* — your CI
should copy files without `.git/`, `node_modules/`, `tests/`, `docs/`.

**Learn this:** "git-dumper", "exposed .git directory", "deployment artifacts vs
working tree", `git archive`, `.gitattributes export-ignore`, rsync `--exclude`.

---

### 1.3 Sensitive-file exposure (docs, samples, dumps)  *(OMG-QA-009 / 010 — fixed)*

**What I audited/fixed:**
```
200  /master-prompt.md          <- the entire internal project brief
200  /wp-content/themes/omg-hybrid/docs/deployment.md   <- names every plugin + the weak one
200  /readme.html               <- WordPress version disclosure
200  /wp-config-sample.php
200  /wp-content/uploads/wp-staging/logs/2026_06_03.log
```

Fix — deny by filename/extension:

```apache
<FilesMatch "(?i)\.(md|markdown|log|inc)$">
    Require all denied
</FilesMatch>
<FilesMatch "(?i)^(readme\.(html|txt)|changelog\.txt|license\.txt|wp-config-sample\.php|master-prompt\.md|composer\.(json|lock)|package(-lock)?\.json|Dockerfile|docker-compose\.ya?ml)$">
    Require all denied
</FilesMatch>
```

Plus a *scoped* rule for dumps/backups so it doesn't break the migration plugin
(see 1.5):

```apache
RewriteCond %{REQUEST_URI} !^/wp-content/ai1wm-backups/
RewriteRule "(?i)\.(sql|sqlite|db|bak|old|orig|save|swp|swo|dist|wpress)$" - [F,L]
```

**Real-world problem it solves:**
`deployment.md` literally said *"wp-file-manager — remove before production, security
risk"*. That's a map with an X on it. `readme.html` tells a scanner your WordPress
version so it can match CVEs. A stray `db.sql` or editor swap file (`wp-config.php.swp`)
can contain live credentials. **Documentation and build files should never be web-served.**

**Learn this:** `FilesMatch` vs `Files` vs `LocationMatch`, "information disclosure"
(OWASP), editor swap/backup file leaks (`.php~`, `.php.bak`, `.php.swp`), why
`readme.html` removal is a standard WP hardening step.

---

### 1.4 `.htaccess`, `AllowOverride`, and *where* rules live

**What I audited/fixed:**
I checked whether `.htaccess` was even honored:

```bash
grep -nE "AllowOverride" .../httpd.conf   # showed "None" in the stock block...
cat .../sites-enabled/auto.omg-hybrid.test.conf
#   <Directory "C:/laragon/www/omg-hybrid">
#       AllowOverride All      <-- Laragon overrides it per-site
#       Require all granted
#   </Directory>
```

Because `AllowOverride All` is set for this site, `.htaccess` can use `Options`,
`RewriteRule`, `FilesMatch`, `Require` — so I put the hardening there (scoped to this
site, no Apache restart needed). I placed it **outside** the
`# BEGIN WordPress ... # END WordPress` markers, because WordPress *rewrites everything
between those markers* whenever you save Settings → Permalinks.

**Real-world problem it solves:**
`.htaccess` is a per-directory config file processed on *every request* (slower than
vhost config, but no reload). Knowing the difference between "config in `.htaccess`"
(portable, slow, overrideable) and "config in the vhost" (fast, requires reload,
authoritative) is fundamental to operating Apache. And knowing *which* file WordPress
manages stops you from losing your rules on the next permalink save.

**Learn this:** `AllowOverride` (`All`/`None`/`FileInfo`/`Options`/`Limit`), `.htaccess`
performance cost, `<Directory>` vs `<Location>` vs `.htaccess` merge order, Apache 2.4
`Require` (authz) vs 2.2 `Order/Allow/Deny`, the `[F]` / `[L]` / `[R]` RewriteRule flags,
`mod_rewrite` `RewriteCond` with `%{REQUEST_URI}` / `%{HTTP_HOST}` / `%{QUERY_STRING}`.

---

### 1.5 When a security rule breaks a feature — the `.wpress` incident

**What I fixed:**
My blanket `\.(sql|bak|wpress|...)$ → 403` rule was correct in spirit but broke a real
workflow: **All-in-One WP Migration** exports the site to
`/wp-content/ai1wm-backups/xxxx.wpress` and serves it as a **direct browser download**.
The 403 showed up in the browser as *"File wasn't available on site."*

The archive had been created fine (405 MB on disk) — only the *download* was blocked.
Fix: exclude that one plugin-managed folder from the backup-file rule (it already has
its own `-Indexes` and uses random filenames):

```apache
RewriteCond %{REQUEST_URI} !^/wp-content/ai1wm-backups/
RewriteRule "(?i)\.(sql|...|wpress)$" - [F,L]
```

**Real-world problem it solves:**
Security controls have *false positives*. A hardening rule that blocks a legitimate
admin function will get disabled wholesale by a frustrated team — worse than a scoped
rule. The lesson: **scope deny rules as narrowly as the feature allows**, test the
happy path after every hardening change, and document the carve-outs so the next person
understands why the exception exists.

**Learn this:** "defense in depth vs availability", change-testing / regression testing
after security changes, HTTP `Range`/`206 Partial Content` (how big-file downloads
resume), `Content-Disposition: attachment`.

---

### 1.6 Apache virtual hosts & the catch-all / default vhost  *(OMG-QA-004 — staged)*

**What I audited/fixed:**
```bash
curl -H "Host: anything.invalid" http://omg-hybrid.test/
# <title>Index of /</title>  --> a listing of C:\laragon\www:
#   07022026-omg-studio-template.rar   (12 MB, downloadable)
#   ahpl/  asianinteriors/  bosecreative/  ...  (every other client project)
```

Apache picks a vhost by matching the request's `Host:` header against each vhost's
`ServerName`/`ServerAlias`. **If nothing matches, the *first-listed* vhost wins** — here
that was `<VirtualHost _default_:80>` with `DocumentRoot C:/laragon/www` and `Indexes`
on. So any bogus Host header browsed the whole dev machine.

Fix (staged in `sites-enabled/00-default.conf`, needs an Apache reload):

```apache
<VirtualHost _default_:80>
    ServerName localhost.invalid
    DocumentRoot "C:/laragon/etc/apache2/_no-default-site"   # empty folder
    <Directory "C:/laragon/etc/apache2/_no-default-site">
        Options -Indexes -Includes -ExecCGI
        Require all denied
    </Directory>
</VirtualHost>
```

**Real-world problem it solves:**
On a shared server, one misconfigured catch-all vhost exposes *every* site on the box.
On a single-site server, the catch-all is what answers `http://<your-ip>/` and
`http://scanner-generated-hostname/` — bots hit it constantly. It should serve
**nothing** (403/444), not your app and definitely not a directory listing.

**Learn this:** name-based virtual hosting, `ServerName`/`ServerAlias`,
`_default_` vs `*:80`, vhost selection order, nginx `default_server` +
`server_name _;` + `return 444;`, "virtual host confusion" attacks.

---

## PART 2 — WORDPRESS-SPECIFIC SECURITY

### 2.1 `WP_HOME` / `WP_SITEURL` derived from the `Host:` header  *(OMG-QA-006 — not yet fixed)*

**What I audited:**
```php
// wp-config.php
define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
```
Two problems, both proven:
1. `php wp-cron.php` →
   `PHP Warning: Undefined array key "REQUEST_SCHEME"` / `"HTTP_HOST"` — those keys
   don't exist in CLI/cron context, and the site URL becomes `"://"`.
2. On a production **catch-all** vhost, `$_SERVER['HTTP_HOST']` is **attacker-controlled**.

**What problem it causes in real life — "Host header injection":**
WordPress builds the password-reset email link from the site URL. If that URL comes from
the request Host header, an attacker requests a reset for *your* account with
`Host: attacker.com`, you get an email with a link to
`https://attacker.com/wp-login.php?...&key=<valid-reset-token>`, you click it, and the
token is sent to the attacker. Same header also poisons cached pages (everyone gets
`<link rel=canonical href="//attacker.com">`), redirects, and `<script src>` URLs.

**Recommended fix:** hardcode it for production —
`define('WP_HOME','https://www.omggroup.com.au'); define('WP_SITEURL', WP_HOME);` — or,
if you must be dynamic, validate `HTTP_HOST` against an allow-list first.

**Learn this:** "WordPress host header injection", "password reset poisoning",
`$_SERVER` trust boundaries (`HTTP_HOST` and `X-Forwarded-*` are user input,
`SERVER_NAME` can be too), cache poisoning, why reverse proxies set `Host` explicitly.

---

### 2.2 User enumeration  *(OMG-QA-007 — not yet fixed)*

**What I audited:**
```bash
curl -sI 'http://omg-hybrid.test/?author=1'      # 301 -> /author/admin/   (reveals login name)
curl -s  'http://omg-hybrid.test/wp-json/wp/v2/users'   # [{"id":1,"slug":"admin",...}]
```
Both leak that the admin's **login name is `admin`** (the classic default). There are
also users `CDAdmin` (admin) and `Anthony` (editor).

**What problem it solves in real life:**
A login form needs *username + password*. Enumeration gives away half of it for free,
turning "brute force" (guess both) into "password spray" (guess one). `admin` is the
single most-tried username on earth. Combined with no rate-limiting and XML-RPC
`system.multicall` (2.3), that's a realistic account-takeover path.

**Recommended fix:** rename `admin` to a non-obvious login; block `?author=<n>` and
`/wp-json/wp/v2/users` for anonymous requests (a security plugin or a small mu-plugin
filtering `rest_endpoints`); enforce strong passwords + 2FA on all admin accounts;
add login rate-limiting (Limit Login Attempts / fail2ban / WAF).

**Learn this:** "WordPress user enumeration", `rest_endpoints` filter,
`redirect_canonical` + `author` query var, credential stuffing vs brute force vs
password spraying, `oembed`/`author sitemap` as secondary enumeration vectors.

---

### 2.3 XML-RPC / pingback  *(OMG-QA-008 — not yet fixed)*

**What I audited:**
```bash
curl -X POST http://omg-hybrid.test/xmlrpc.php \
  -d '<methodCall><methodName>system.listMethods</methodName></methodCall>'
# returns: pingback.ping, system.multicall, mt.*, ...
```

Two abuse cases:
- `system.multicall` — bundle hundreds of `wp.getUsersBlogs` (login) attempts into one
  HTTP request → brute-force **amplification** that flies under per-request rate limits.
- `pingback.ping` — you tell the server "notify URL X that I linked to it"; the server
  makes an outbound request to X. Attackers use thousands of WordPress sites as a
  **reflected DDoS** cannon, or to probe internal URLs (**SSRF**).

**What problem it solves in real life:**
Almost nothing legitimately needs XML-RPC anymore (the Jetpack/mobile-app use case moved
to the REST API). Leaving it on is free attack surface. Disable it, or at minimum kill
`pingback.ping` and `system.multicall`.

**Learn this:** `xmlrpc_enabled` / `xmlrpc_methods` filters, "WordPress pingback DDoS",
SSRF, reflection/amplification attacks, why the REST API replaced XML-RPC.

---

### 2.4 Security keys & salts  *(OMG-QA-017 — recommended)*

**What I audited:**
`wp-config.php` has an **empty** `AUTH_KEY … NONCE_SALT` block. WordPress noticed and
auto-generated random values, storing them in the `wp_options` table
(`auth_key`, `auth_salt`, `nonce_salt`, …). So they're random (good) but:
- they live in the database, so any DB-read (SQLi, a leaked dump, the open MySQL port
  in 4.2) exposes them;
- you can't *rotate* them by editing a file — you'd have to delete the options.

**What they do:**
Salts + keys are the secret ingredients that (a) sign auth cookies so they can't be
forged, and (b) seed nonces (CSRF tokens). If an attacker has your salts *and* a copy of
a logged-in cookie's structure, they can mint valid admin cookies offline.

**Recommended fix:** paste fresh values from
`https://api.wordpress.org/secret-key/1.1/salt/` into `wp-config.php` as real `define()`
constants for production. Changing them later force-logs-out everyone (that's the point —
it's your "invalidate all sessions" button).

**Learn this:** `wp_salt()`, HMAC cookie authentication in WP, `wp_create_nonce` /
`wp_verify_nonce`, difference between a *key* and a *salt*, secret rotation.

---

### 2.5 Dashboard file/code editing  *(OMG-QA-018 — recommended)*

**What I audited:** `DISALLOW_FILE_EDIT` is **not** set → Appearance → Theme File Editor
and Plugins → Plugin File Editor are active. Any admin (or any *stolen* admin session)
can paste PHP into `functions.php` from the browser and get instant remote code
execution.

**Recommended fix:**
```php
define( 'DISALLOW_FILE_EDIT', true );          // hides the editors
define( 'DISALLOW_FILE_MODS', true );          // also blocks plugin/theme install/update via UI (stricter)
```

**What problem it solves in real life:**
It shrinks the blast radius of a compromised admin account from "edit some content" to
"…and that's mostly it". Most breaches escalate through exactly this editor. Serious
sites deploy code via git/CI only, so the editor is pure downside.

**Learn this:** WordPress "constants" (`wp-config.php` `define()`s), principle of least
functionality, `FS_METHOD`, immutable/read-only deployments.

---

### 2.6 High-risk plugins & attack surface  *(OMG-QA-003 — fixed; OMG-QA-011 — partly)*

**What I fixed:** deactivated **wp-file-manager** (via `deactivate_plugins()` — which
fires the plugin's cleanup hooks and rewrites the `active_plugins` option correctly,
13 → 12 plugins).

**Why that plugin specifically:**
- It bundles *elFinder* and exposes a filesystem browser in wp-admin. Historically:
  `CVE-2020-25213` (unauthenticated RCE — thousands of sites defaced), plus later
  path-traversal / auth-bypass issues.
- Even fully patched, it turns "compromised admin session" into "read/write/upload
  anywhere on the server".
- It's a *convenience* tool. Convenience tools with filesystem power are the first thing
  to remove before production.

Similar reasoning flagged **All-in-One WP Migration** (`aam-wp-migration`) — its
export/import AJAX is a full site+DB dump/restore surface. Keep it deactivated unless
you're actively migrating, and **delete `.wpress` archives after downloading**.

**What problem it solves in real life:**
Every active plugin is code running on every request with full DB + filesystem access.
"Attack surface" = the sum of all that code. Auditing = "does the value justify the
surface?" A file manager and a migration tool rarely do, on production.

**Learn this:** "WordPress plugin CVE" / wpscan / Patchstack / WPScan DB, "attack
surface reduction", `deactivate_plugins()` vs deleting, supply-chain risk in the plugin
ecosystem, "least plugins" principle.

---

### 2.7 Patch management  *(OMG-QA-011 — recommended)*

**What I audited:** the `_site_transient_update_plugins` option lists **7 plugin
updates**, and `_site_transient_update_core` / `_..._themes` are also populated → a
WordPress core update and theme updates are pending. Simple History confirmed
*"Found an update to plugin"*.

**What problem it solves in real life:**
The overwhelming majority of WordPress hacks exploit a *known, patched* vulnerability in
an out-of-date plugin — often within 24–48h of the fix being published (attackers diff
the patch to build the exploit). "Keep everything updated" is boring and it is the
single highest-value security practice.

**Learn this:** "n-day vulnerability", coordinated disclosure, staging→prod update
workflow, `WP_AUTO_UPDATE_CORE`, dependency pinning, why you test updates in staging
first (updates also break things).

---

### 2.8 Capability / role model  *(OMG-QA-021 — recommended)*

**What I audited:**
```php
acf_add_options_page( array( ... 'capability' => 'edit_posts', ... ) );
```
The theme's "Theme Settings" page (phone numbers, header rating, footer CTA buttons) is
gated by `edit_posts` — which **Editors and Authors** have. So `Anthony` (an Editor) can
change site-wide contact details.

**What problem it solves in real life:**
WordPress authorization is capability-based: every action checks
`current_user_can('some_capability')`. Settings that affect the whole site belong behind
`manage_options` (Administrators) or at least `edit_theme_options`. Using `edit_posts`
for site config means a lower-trust role — or a compromised Author account — can alter
what customers see (e.g. swap your phone number for theirs).

**Learn this:** WordPress roles vs capabilities, `manage_options` /
`edit_theme_options` / `edit_posts` / `unfiltered_html`, `map_meta_cap`, custom
capabilities, principle of least privilege.

---

## PART 3 — APPLICATION CODE SECURITY (things that were *already correct*)

These weren't bugs — I reviewed them and they held up. Knowing *why* they're right is
the point.

### 3.1 AJAX endpoint security (the Quick Quote handler)

**What I audited:** `OMG_Mega_Menu::handle_quote()` — the public form → email path.
Checklist it passes:

```php
check_ajax_referer( 'omg_mm_quote', 'nonce' );          // 1. CSRF nonce, verified first
if ( ! empty( $_POST['website'] ) ) wp_send_json_success(); // 2. honeypot (bots fill hidden fields)
$f['email'] = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );  // 3. sanitize every input
if ( ! is_email( $f['email'] ) ) wp_send_json_error(..., 400);        // 4. validate required fields
$to = sanitize_email( $qq['recipient'] ?? '' ) ?: get_option('admin_email'); // 5. recipient not from user
```

I tested the guard from outside:
```bash
curl -X POST .../admin-ajax.php -d "action=omg_mm_quote"           # -> 403
curl -X POST .../admin-ajax.php -d "action=omg_mm_quote&nonce=bad" # -> 403
```

**What problem each step solves:**
1. **Nonce** — stops Cross-Site Request Forgery: another site can't make *your* logged-in
   browser silently submit this form, because it can't read your nonce.
2. **Honeypot** — cheap bot filter: a field hidden with CSS that only scripts fill.
3. **Sanitize on input, escape on output** — `sanitize_email()` / `sanitize_text_field()`
   strip control characters, tags, newlines.
4. **Validate** — reject empty/malformed before doing work.
5. **Recipient from config, never from the request** — otherwise the form becomes an
   open relay ("send this email to anyone").

**Learn this:** WordPress nonces (`wp_nonce_field`, `check_ajax_referer`,
`wp_verify_nonce`), `admin-ajax.php` vs REST API, `wp_ajax_` vs `wp_ajax_nopriv_`,
the sanitize/validate/escape trio, honeypot vs CAPTCHA vs rate-limit.

---

### 3.2 Email header injection (the `Reply-To` line)

**What I audited:**
```php
$headers = [ 'Reply-To: ' . $f['first_name'] . ' ' . $f['last_name'] . ' <' . $f['email'] . '>' ];
```
Building an email header by concatenating user input *looks* dangerous. It's safe **here**
because `first_name`/`last_name` went through `sanitize_text_field()` (which removes
`\r` and `\n`) and `email` through `sanitize_email()` + `is_email()`.

**What problem it solves in real life — "email/SMTP header injection":**
If a user could put a newline in a name, they could inject extra headers:
`John\r\nBcc: everyone@victim.com\r\nSubject: Spam` — turning your contact form into a
spam cannon and getting your domain blacklisted. The defense is: **never let CR/LF from
user input reach a header**. WordPress's `sanitize_*` functions do this; raw `mail()`
concatenation does not.

**Learn this:** "email header injection", CRLF injection (also applies to HTTP headers,
log injection), `wp_mail()` internals, SPF/DKIM/DMARC and why a compromised form hurts
deliverability.

---

### 3.3 Output escaping / XSS (template review)

**What I audited:** every `echo` in the new template parts. Examples of *correct* usage:

```php
<a href="<?php echo esc_url( $url ); ?>">                <!-- URLs -->
<h3><?php echo esc_html( $card['title'] ); ?></h3>       <!-- plain text -->
<div class="<?php echo esc_attr( $class ); ?>">          <!-- attribute values -->
<p><?php echo wp_kses_post( $card['content'] ); ?></p>   <!-- text that may contain safe HTML -->
```

One pattern that *looks* wrong but isn't: `echo $feature['icon']` in `booth-showcase.php`
outputs raw `<svg>…</svg>`. Safe because the value is a **hardcoded literal in the PHP
file**, not user/database input.

**What problem it solves in real life — Cross-Site Scripting:**
If attacker-controlled text reaches the page without escaping, they inject
`<script>` that runs in your visitors' browsers (steal sessions, deface, keylog). The
rule: **escape at the point of output, matched to the context** — `esc_html` for text,
`esc_attr` inside attributes, `esc_url` for links/src, `wp_kses` when you must allow
*some* tags. "Sanitize on the way in, escape on the way out" — do both.

**Learn this:** OWASP XSS (reflected / stored / DOM), context-aware escaping,
`esc_html` vs `esc_attr` vs `esc_js` vs `esc_url` vs `wp_kses_post`, `wp_kses`
allowed-HTML arrays, Content-Security-Policy as a second layer.

---

### 3.4 Admin settings save (the mega-menu admin page)

**What I audited:** `OMG_Mega_Menu_Admin::save_settings()`:
```php
if ( ! current_user_can( 'manage_options' ) ) wp_die( 'Unauthorized' );  // authz
check_admin_referer( 'omg_mm_save' );                                     // CSRF
$opts['primary_color'] = sanitize_hex_color( $_POST['primary_color'] ?? '#33D5C6' ) ?: '#33D5C6';
$opts['phone_url']     = esc_url_raw( $_POST['phone_url'] ?? '' );
```
Capability check **and** nonce check **and** per-field sanitization. This is the
textbook shape for a settings form.

**Learn this:** `check_admin_referer` vs `check_ajax_referer` vs `wp_verify_nonce`,
`sanitize_hex_color`, `esc_url_raw` (for storing) vs `esc_url` (for printing),
`current_user_can` before every state change, `wp_die()` for hard stops.

---

## PART 4 — INFRASTRUCTURE & DEV ENVIRONMENT

### 4.1 Database network exposure  *(OMG-QA-005 — staged)*

**What I audited:**
```bash
netstat -an | grep 3306
#   TCP    0.0.0.0:3306    LISTENING      <-- ALL network interfaces
grep bind-address my.ini    # (nothing)  <-- defaults to 0.0.0.0
```
`wp-config.php` uses `DB_USER=root` with **no password**. So: anyone who can route a
packet to this machine on port 3306 gets `root` on every database.

Fix (staged in `my.ini`, needs a MySQL restart):
```ini
[mysqld]
bind-address=127.0.0.1
```

**What problem it solves in real life:**
"Listening on `0.0.0.0`" means *every* network interface — LAN, VPN, and if the machine
has a public IP, the internet. A database should almost never be reachable off-box. The
app connects over `localhost`; nothing else should connect at all. `bind-address` is the
network boundary; a strong `root` password + a least-privilege per-app user
(`GRANT SELECT,INSERT,UPDATE,DELETE ON omg_hybrid.* TO 'wp_omg'@'localhost'`) is the
identity boundary. You want both.

**Learn this:** `bind-address` / `skip-networking`, `0.0.0.0` vs `127.0.0.1` vs a specific
IP, MySQL user@host grant model, `secure-file-priv` (I noticed it's `""` — that lets
`SELECT … INTO OUTFILE` write anywhere; set it to the data dir), Shodan (search engine
for exposed services), defense in depth.

---

### 4.2 Port / service audit

**What I audited:**
```bash
netstat -an | grep LISTEN
#   0.0.0.0:80    Apache        -- needed, but all-interfaces
#   0.0.0.0:443   Apache
#   0.0.0.0:3306  MySQL         -- see 4.1
#   0.0.0.0:8025  Mailpit UI    -- no auth! readable email on the LAN
#   127.0.0.1:1025 Mailpit SMTP -- correctly localhost-only
```

**What problem it solves in real life:**
Every listening port is a door. The audit question isn't "is this port a vulnerability?"
— it's "**does this service need to be reachable from where it's reachable?**" Mailpit's
SMTP port got it right (`127.0.0.1`); its web UI got it wrong (`0.0.0.0`, no login) — and
that UI shows every intercepted email including password-reset links.

**Learn this:** `netstat` / `ss` / `lsof -i`, "bind address", host firewall
(Windows Defender Firewall / `ufw` / `iptables`), the difference between "firewalled" and
"not listening", `nmap` for auditing your own boxes.

---

### 4.3 Mail catchers in development (Mailpit / MailHog)

**What I used:** verified the Quick Quote form end-to-end by reading the delivered
message out of Mailpit's API:
```bash
curl -s "http://localhost:8025/api/v1/messages?limit=3"
# "Quick Quote request — QA Tester (Photo-Booths)"  ->  bookings@omggroup.com.au
```

**What problem it solves in real life:**
In dev you must *not* send real email (you'd spam customers with test data). A catcher
intercepts everything SMTP and gives you a web inbox + an API. It's how you test
"did the form actually send, with the right fields, to the right address?" without
touching a real mail provider. **For production**, that catcher connection must be
swapped for real SMTP/API credentials (FluentSMTP settings here).

**Learn this:** Mailpit / MailHog / Mailtrap, SMTP basics (envelope vs headers,
`MAIL FROM` vs `From:`), transactional email providers (SES, Postmark, SendGrid),
`wp_mail` + PHPMailer, why `From:` should be a domain you control (SPF/DKIM).

---

### 4.4 Domain migration & serialized data  *(OMG-QA-014 — recommended)*

**What I audited:** the mega-menu options store absolute local URLs:
```
photobooth_templates_url = http://omg-hybrid.test/print-templates/
contact_url              = http://omg-hybrid.test/contact/
```
These will 404 on the production domain.

**What problem it solves in real life:**
WordPress stores lots of absolute URLs (in `wp_options`, `wp_postmeta`, serialized
arrays inside post content). A naive `sed` find-replace on a DB dump **corrupts
serialized data** because PHP serialization encodes string *lengths*
(`s:21:"http://old.test/page/"` → the `21` is now wrong). You need a serialization-aware
tool: **Better Search Replace** (already installed), WP-CLI `wp search-replace`, or
`srdb`. Do it at cutover, then re-check `siteurl`/`home`.

**Learn this:** PHP `serialize()`/`unserialize()` format, "serialized data corruption",
`wp search-replace --dry-run`, why you avoid absolute URLs in content where possible,
`home_url()` / `site_url()` / `content_url()` helpers.

---

### 4.5 PHP error handling: dev vs production  *(context for OMG-QA-012)*

**What I audited:**
- `wp-config.php`: `WP_DEBUG = false` (good for prod).
- The theme's `inc/security.php` forces `display_errors=0` for logged-out visitors, so
  notices never render on the page — I confirmed by crawling all 24 routes
  (`grep -c "Warning:|Fatal"` → 0).
- But `log_errors=On` writes to `C:\laragon\tmp\php_errors.log`, which is where I found
  the `wp-config.php` `REQUEST_SCHEME` warnings and *stale* warnings from an old version
  of `template-photography-and-videography.php` (the current file is clean — I proved it
  by watching the log stay silent on fresh requests).

**What problem it solves in real life:**
- **Never show PHP errors to visitors** — stack traces leak absolute paths, DB details,
  plugin internals, and look broken.
- **Always log them somewhere you read** — silent warnings are how "it works" becomes
  "it's been throwing 10k warnings/day and nobody noticed" and then a fatal in an edge
  case.
- The right prod config: `display_errors=Off`, `log_errors=On`,
  `WP_DEBUG=true` + `WP_DEBUG_LOG=true` + `WP_DEBUG_DISPLAY=false` on staging.

**Learn this:** `display_errors` / `log_errors` / `error_reporting` / `error_log`,
`WP_DEBUG` / `WP_DEBUG_LOG` / `WP_DEBUG_DISPLAY` / `SCRIPT_DEBUG`, log rotation,
`@ini_set` at runtime vs `php.ini`, structured logging.

---

## PART 5 — FRONT-END QUALITY

### 5.1 Cumulative Layout Shift (CLS) & image dimensions  *(OMG-QA-015 — recommended)*

**What I audited:** Chrome DevTools reported
*"Lazy-loaded images should have explicit dimensions (count: 48–51)"* on multiple pages.
The theme's component `<img>` tags have `loading="lazy"` but no `width`/`height`.

**What problem it solves in real life:**
Without dimensions, the browser doesn't know how tall an image will be until it loads,
so it renders text first, then *shoves it down* when the image arrives. That jump is
**CLS** — one of Google's Core Web Vitals, a ranking signal, and genuinely infuriating
(you go to tap a button and it moves). Fix: set `width`/`height` attributes (the browser
computes the aspect ratio and reserves space) or CSS `aspect-ratio`.

**Learn this:** Core Web Vitals (LCP / CLS / INP), `aspect-ratio` CSS, `width`/`height`
attributes vs CSS sizing, `content-visibility`, why `loading="lazy"` needs known
dimensions to be safe.

---

### 5.2 LCP, `fetchpriority`, and lazy vs eager (from the hero slider work)

**What I fixed earlier this session:** the hero slider `<img>` markup:
```php
<img class="oh-hero__media" src="<?php echo esc_url($url); ?>" alt="" loading="eager"
     <?php if ($first) : ?>fetchpriority="high"<?php endif; ?>>
```
Only the **first** slide gets `fetchpriority="high"` — the others don't compete with it
for bandwidth during initial load.

**What problem it solves in real life:**
The hero image is almost always the **Largest Contentful Paint** element — the thing
Google measures as "the page looks loaded". You want it to download *first*.
`fetchpriority="high"` tells the browser "this matters"; putting it on all 3 slides would
split priority 3 ways and slow the visible one. `loading="eager"` (not `lazy`) on the
hero because lazy-loading your LCP image is a classic self-inflicted slowdown.

**Learn this:** LCP optimization, `fetchpriority`, `<link rel=preload>`,
`loading=eager|lazy`, resource priorities in the browser, why "lazy load everything"
is wrong for above-the-fold content.

---

### 5.3 Carousel / Swiper `loop` configuration  *(OMG-QA-016 — recommended)*

**What I audited:** console warning on legacy pages —
*"Swiper Loop Warning: The number of slides is not enough for loop mode."*
The legacy `custom.js` initializes Swiper with `loop: true` on heroes that have only
**one** slide.

**What problem it solves in real life:**
Loop mode works by *cloning* slides so the carousel can wrap seamlessly. With 1 slide
there's nothing to loop, so Swiper complains (and can misbehave). The fix is a guard:
`loop: el.querySelectorAll('.swiper-slide').length > 1` — which is exactly what the
*new* `theme.js` already does. Console warnings are not "just noise": they're the
library telling you a config doesn't match the content.

**Learn this:** how carousel libraries implement infinite loop (slide cloning),
progressive enhancement (does it still work with JS off / 1 item?), reading and acting on
console warnings.

---

### 5.4 CSS custom properties as design tokens (the 4-palette system)

**What I audited & verified:** the theme runs one component set in four brand colours by
defining tokens and switching them with a body class:
```css
:root                { --color-primary:#BF2525; --on-primary:#fff; }   /* Entertainment */
.svc-studio          { --color-primary:#33D5C6; --on-primary:#06302c; } /* cyan, dark text */
.svc-live            { --color-primary:#BB44F0; --on-primary:#fff; }
.svc-props           { --color-primary:#DEDE6D; --on-primary:#3a3a1e; }
```
Components only ever use `var(--color-primary)` etc. I verified no colour "leaks" between
services by reading the computed value per page.

**The `--on-primary` detail:** white text is readable on the red/purple primaries but
**not** on the pale cyan/yellow ones — so `--on-primary` carries the *correct* text
colour for each palette. That's a real accessibility (contrast) decision encoded as a
token.

**What problem it solves in real life:**
Without tokens you'd fork the CSS four times and every future change happens four times
(and drifts). Tokens = one source of truth, themeable at runtime, and the contrast
problem is solved once per palette instead of per component.

**Learn this:** CSS custom properties (cascade, inheritance, `var()` fallbacks),
design tokens / theming, `color-mix()` (used in the Quick Quote fix for tinted borders),
`:where()` for zero-specificity resets, WCAG contrast ratios (4.5:1 body text).

---

### 5.5 Cache-busting with `filemtime()`

**What I audited:** `inc/enqueue.php`:
```php
$v = fn( $rel ) => file_exists($dir.$rel) ? (string) filemtime($dir.$rel) : OMG_HYBRID_VERSION;
wp_enqueue_style( 'omg-hybrid-shell', $uri.'/assets/css/shell.css', [...], $v('/assets/css/shell.css') );
```
The stylesheet URL gets `?ver=<file-modification-timestamp>`, so every time you edit
`shell.css`, the URL changes and browsers/CDNs fetch the new copy — automatically, with
no manual version bumping.

**What problem it solves in real life:**
"It works on my machine / after a hard refresh" is almost always a stale cache. Static
assets are cached aggressively (that's good for speed). Cache-busting via a content- or
mtime-based query string (or hashed filenames) means users *always* get your latest CSS
the moment you ship it, while still caching hard between releases.

**Learn this:** HTTP caching (`Cache-Control`, `ETag`, `Last-Modified`), cache-busting
strategies (query string vs hashed filename), `wp_enqueue_script/style` `$ver` param,
asset build pipelines (the hashed-filename approach).

---

### 5.6 Accessibility details  *(OMG-QA-020 — recommended)*

**What I audited** (via the DevTools accessibility tree, not screenshots):

| Checked | State | Note |
|---|---|---|
| Skip-to-content link | ✅ present | keyboard users bypass the nav |
| One `<h1>`, ordered `<h2>`/`<h3>` | ✅ | screen-reader users navigate by heading |
| `<main>` landmark, single | ✅ | |
| Quick Quote modal | `role="dialog"` `aria-modal` `aria-labelledby` ✅ | but `aria-labelledby` points at the **step-1** title for all 6 steps → the dialog's name never updates |
| "Why choose" checkmarks | ⚠️ literal `✓` text, not `aria-hidden` | announced "check mark" 6× |
| Footer WhatsApp link | ⚠️ text is `" +61…"` (leading space) | |

**What problem it solves in real life:**
~15–20% of users rely on assistive tech, keyboard-only navigation, or high-contrast
modes at some point. Landmarks + headings + proper dialog semantics are the difference
between "usable with a screen reader" and "unusable". It's also a legal requirement in
many jurisdictions (ADA / EN 301 549 / WCAG 2.1 AA) and overlaps heavily with SEO
(semantic HTML) and general robustness.

**Learn this:** WCAG 2.1 (Perceivable/Operable/Understandable/Robust), ARIA authoring
practices for dialogs (focus trap, `Esc` to close, return focus), landmark roles,
`aria-hidden` vs `role="presentation"`, the accessibility tree, keyboard-only testing,
screen readers (NVDA is free).

---

## PART 6 — QA / AUDIT METHODOLOGY

### 6.1 Evidence-based testing (test, don't assume)

**What I did:** for every claim, I produced a reproducible check:
- "pages have no PHP errors" → crawled all 24 routes and grepped the HTML *and* watched
  the error log for new lines on fresh requests.
- "the form works" → drove the 6-step wizard with real clicks and then read the
  delivered email from Mailpit's API.
- "`.git` is exposed" → `curl` returned the actual file contents, quoted in the report.
- "the fix works" → re-ran the exact same `curl` and got `403`, then re-crawled every
  page to confirm nothing else broke.

**What problem it solves in real life:**
"I think it's fine" and "I tested X, here's the output" are worlds apart. A finding
without evidence gets argued away; a finding with a one-line repro gets fixed. And
*re-testing after the fix* (plus regression-testing the surroundings) is what stops
"the fix broke something else" — which is exactly what happened with the `.wpress`
download, caught because I re-crawled.

**Learn this:** black-box vs white-box vs grey-box testing, reproducible bug reports
(steps / expected / actual / evidence), regression testing, "definition of done" =
fixed **and** verified **and** no new breakage.

---

### 6.2 Severity classification (don't inflate)

**What I did:** every finding got Critical / High / Medium / Low / Info based on
*realistic impact × exploitability*, not on how scary it sounds. Example:
- `.git` exposed → **High** (full source/history) — but *not* Critical, because the repo
  is already public on GitHub, so the marginal loss is "confirms exact version".
- Missing `X-Frame-Options` → **Low** — real, but clickjacking a brochure site is low
  value and there's no sensitive state-changing UI to frame.
- MySQL root/no-password on `0.0.0.0` → **High/Critical (environment)** — trivially
  exploitable, total compromise, but scoped to "if the network isn't trusted".

**What problem it solves in real life:**
A report where everything is "CRITICAL!!!" gets ignored. Accurate severity lets the team
fix in the right order and lets management make an informed risk call. The brief for
this audit explicitly said "do not inflate severity" — that's a mature ask.

**Learn this:** CVSS (base/temporal/environmental metrics), likelihood × impact risk
matrices, "exploitability" vs "impact", why context changes severity, OWASP Risk Rating.

---

### 6.3 Tooling used (and what each is for)

| Tool | Used for |
|---|---|
| `curl` | HTTP probing — status codes, headers, spoofed `Host:`, POST to `xmlrpc.php`/`admin-ajax.php` |
| `netstat` / `tasklist` / PowerShell `Get-CimInstance` | which ports listen, on which interface; which process; its command line |
| MySQL CLI | reading `wp_options` (`active_plugins`, `omg_mm_opts`, update transients), `wp_users`, roles |
| Chrome DevTools (via MCP) | console errors, network waterfall (404s / blocked resources), the accessibility tree, driving the form, responsive checks, screenshots |
| PHP CLI | bootstrapping WordPress (`require 'wp-load.php'`) to call `deactivate_plugins()` safely, and triggering `wp-cron.php` to surface the `REQUEST_SCHEME` warnings |
| `git` | reading the theme's own history; committing the doc updates |
| the PHP error log | ground truth for warnings visitors never see |
| Mailpit API | confirming email delivery + contents |

**Learn this:** `curl` flags (`-I`, `-s`, `-o /dev/null -w`, `-H`, `-X`, `-r` for ranges),
browser DevTools (Network, Console, Lighthouse, the Issues tab, the a11y pane),
`wp-cli` (the proper tool for scripted WP admin — not installed here, which is why I used
raw PHP), reading server logs.

---

## APPENDIX — SUGGESTED LEARNING ORDER

If you want to turn this into a study plan, roughly in dependency order:

1. **HTTP fundamentals** — methods, status codes, headers, how a request/response
   actually flows; `curl` as your microscope.
2. **How a web server works** — Apache/nginx, virtual hosts, `DocumentRoot`,
   `.htaccess` vs main config, `mod_rewrite`, MIME types, directory indexing.
3. **The `$_SERVER` trust boundary** — which values are user-controlled (`HTTP_HOST`,
   `HTTP_*`, `REQUEST_URI`, `QUERY_STRING`) and which aren't; why this causes Host-header
   and CRLF injection.
4. **OWASP Top 10** — especially Injection (SQLi/XSS/CRLF), Broken Access Control,
   Security Misconfiguration, Vulnerable Components. Do a couple of *PortSwigger Web
   Security Academy* labs — they're free and hands-on.
5. **WordPress security model** — nonces, capabilities/roles, `sanitize_*` / `esc_*` /
   `wp_kses`, `wp-config.php` constants, the update lifecycle, plugin attack surface.
6. **Defense in depth** — network (bind address, firewall), server (headers, no
   indexing, no dotfiles), app (validate/escape/authz), and *why you want all four
   even though each alone "would be enough"*.
7. **Operations** — staging→prod workflow, backups you actually test-restore,
   log monitoring, least-privilege DB users, secret management & rotation.
8. **Front-end quality** — Core Web Vitals (LCP/CLS/INP), semantic HTML + ARIA,
   progressive enhancement, caching & cache-busting.
9. **QA discipline** — reproducible bug reports, severity rating, regression testing,
   "test before you fix, re-test after."

Free, high-quality starting points: **PortSwigger Web Security Academy**,
**OWASP Cheat Sheet Series**, **MDN Web Docs** (HTTP, security headers, ARIA),
**web.dev** (Core Web Vitals), the **WordPress Plugin Handbook → Security** chapter,
**Apache httpd docs** (the `mod_rewrite` and `<Directory>` pages).

---

*Generated from the OMG Hybrid QA / security audit, 2026-09-03. Cross-reference the
findings list in the full audit report for status and fix order.*
