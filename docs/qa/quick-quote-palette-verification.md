# Quick Quote form — palette verification

Date: 2026-09-03
Related commit: `2ecdfd8` — "Quick Quote form: follow the active service palette"

## What changed

The floating Quick Quote panel (`template-parts/quick-quote.php`) and the
omg-mega-menu Quick Quote modal share the `#book-now-*` / `.book-*` /
`.time-select-*` CSS in `assets/css/shell.css`. That block was ported from the
old theme using the legacy aliases `--primary-solid-color` / `--secondary-color`,
which are only defined once at `:root` (Entertainment red) and never re-mapped
per service palette — so the form stayed red on the cyan / purple / yellow pages.

The block now consumes the live palette tokens (`--color-primary`,
`--on-primary`), so it tracks whichever `.svc-*` class is on `<body>`:

- primary / submit buttons — `--color-primary` fill, `--on-primary` text
  (flips to dark on the light Studio / Props palettes), `brightness()` hover
- inputs / selects — palette-tinted resting border (`color-mix`),
  `--color-primary` focus border + focus ring
- back button — palette-tinted border and hover
- 30-minute time dropdown — caret, border, box-shadow, active/hover rows, scrollbar
- success icon and loading spinner
- error state stays `#B91C1C`

## Verified in-browser (Chrome DevTools, 1400×900)

| Page | `--color-primary` | Button fill | Button text | Result |
|------|-------------------|-------------|-------------|--------|
| `/omg-entertainment/` | `#BF2525` red    | `rgb(191, 37, 37)`   | white `#fff`       | pass |
| `/omg-studio/`        | `#33D5C6` cyan   | `rgb(51, 213, 198)`  | dark `rgb(6,48,44)`   | pass |
| `/omg-live/`          | `#BB44F0` purple | `rgb(187, 68, 240)`  | white `#fff`       | pass |
| `/omg-props-theming/` | `#DEDE6D` yellow | `rgb(222, 222, 109)` | dark `rgb(58,58,30)`  | pass |

Also checked on `/omg-live/`:

- **30-minute time dropdown** — purple border, purple box-shadow @ 18%, purple
  caret, purple active row with white text.
- **Mega-menu Quick Quote modal** (`.omg-qq-modal`, header trigger) — inherits
  the same tokens: purple button, purple-tinted inputs — matches the floating panel.
- **Floating trigger pill** (`#book-now-trigger`) — already palette-aware, matches.

No regression on the red default.

## Screenshots

| File | Context |
|------|---------|
| `quick-quote-entertainment.png`        | Entertainment (red), panel open, first field focused |
| `quick-quote-studio.png`               | Studio (cyan), panel open, first field focused |
| `quick-quote-live.png`                 | LiVE (purple), panel open, first field focused |
| `quick-quote-props.png`                | Props & Theming (yellow), panel open, first field focused |
| `quick-quote-time-dropdown-live.png`   | LiVE, step 4, 30-minute time dropdown open |
