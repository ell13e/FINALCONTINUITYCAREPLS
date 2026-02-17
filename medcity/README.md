# Continuity Care Services (CCS) — Classic theme (Medcity UI)

Classic PHP theme, CTA-style: **front-page.php** drives the homepage with a pre-built layout. No blocks required. Medcity design (header, footer, slider, sections).

## How it works (like CTA)

1. **Homepage**: WordPress uses **front-page.php** when you set a static front page.
   - Go to **Settings → Reading** → “Your homepage displays” = **A static page**.
   - Choose the page to use as “Homepage” (e.g. “Home”) and save.
   - The **content** of that page is ignored for the front; the theme outputs the Medcity homepage sections (slider, contact strips, about, notes) from **template-parts/front-page-content.php**.

2. **Other pages**: **page.php** (and **single.php** for posts) use `get_header()` / `get_footer()` and show the page/post content in the Medcity wrapper.

3. **Menus**: **Appearance → Menus** → assign a menu to **Primary menu** to replace the default Home / About Us / Our Services / Contact links in the header.

## Files (classic structure)

- `front-page.php` — Homepage (pre-built sections).
- `header.php` — Medcity topbar + navbar, wrapper + preloader.
- `footer.php` — Medcity footer, then `wp_footer()` and close wrapper/body/html.
- `page.php` — Default page layout.
- `single.php` — Single post layout.
- `index.php` — Blog listing.
- `template-parts/front-page-content.php` — Homepage sections (slider, contact-info, about, notes).

Assets (CSS/JS) are enqueued in **functions.php**; primary menu is registered there too.

## If the homepage doesn’t update

- **Settings → Reading**: Static page must be set and the chosen page published.
- **Settings → Permalinks**: Click Save to refresh rewrite rules.
- Clear any caches (plugin or host).
