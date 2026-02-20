# CCS WordPress theme — classic, plugin-free build prompt

Use this prompt to brief an agent (or yourself) to build the **Continuity Care Services** WordPress theme: a **classic theme** (no block editor) with **no plugin dependency** — all CPTs, taxonomies, contact form, and logic live in the theme. Brand from BRAND-REFERENCE.md and EXTRACTED-BRAND-DATA.md.

---

## Copy-paste prompt

**Goal:** Build a WordPress **classic theme** (PHP, CSS, JS) for **Continuity Care Services** — a Kent-based home care provider offering disability and complex care services. The site must be **accessible (WCAG 2.1 AA)**, **on-brand**, and **fully self-contained in the theme** (no required plugins). **Gutenberg/block editor is disabled**; use classic editor and theme templates only. No `!important` or override layers; fix specificity and source order instead.

**Theme architecture:**

- **Classic theme:** `style.css` (theme header), `functions.php`, `header.php`, `footer.php`, `index.php`, `front-page.php`, `single.php`, `page.php`, `404.php`, plus `single-{post-type}.php` and `page-{slug}.php` as needed. Use `template-parts/` and `inc/` for reusable logic.
- **Gutenberg off:** Disable block editor for all posts and post types (`use_block_editor_for_post` and `use_block_editor_for_post_type` return false); dequeue block editor CSS on frontend.
- **No plugins:** All custom post types, taxonomies, contact form handling, enqueue, and optional Customizer/options are implemented in the theme. No dependency on ccs-backend or other plugins.

**Custom post types (registered in theme, e.g. `inc/cpt-registration.php`):**

1. **service** — Services (e.g. Domiciliary, Complex, Respite). Public; supports title, editor, excerpt, thumbnail, revisions; rewrite/slug as needed.
2. **condition** — Conditions we support. Public; supports title, editor, excerpt, thumbnail, revisions; rewrite slug e.g. `conditions`.
3. **location** — Areas we cover. Public, hierarchical; rewrite slug e.g. `areas`.
4. **guide** — Care guides / resources. Public, has_archive; supports title, editor, excerpt, thumbnail, author, revisions; rewrite slug e.g. `resources/guides` or `resources`.
5. **process** — How it works pages. Public, hierarchical; rewrite slug e.g. `how-it-works`.
6. **career** — Careers pages. Public, hierarchical; rewrite slug e.g. `careers`.
7. **team** — Team members. Public or show_ui only as desired; supports title, editor, thumbnail.

All CPTs: `show_in_rest => false` (block editor disabled). Use clear singular/plural labels and menu icons. Taxonomies (e.g. town, service-type, condition-tag, guide-category) registered in theme (e.g. `inc/taxonomy-registration.php`).

**Brand (strict):**

- **Site title:** Continuity Care Services  
- **Tagline:** Your Team, Your Time, Your Life  
- **Colours (CSS custom properties):**  
  - Primary `#564298` (one main CTA per view, links, focus ring, active nav); primary light `#7B63B8` (hover), primary dark `#3F2F70` (active).  
  - Secondary `#a8ddd4` (cards, accents, secondary buttons); secondary light `#C5EAE4`, secondary dark `#85C4B8` (hover/success).  
  - Accent `#9b8fb5` (bullets, tags only; not body text).  
  - Background `#ffffff`, background warm `#f6f5ef` (page/section cream).  
  - Text `#2e2e2e`, text light `#666666`, border `#E0E0E0`.  
  - Semantic: success `#85C4B8`, warning `#D4A843`, error `#C64B4B`, info `#2563eb`.  
- **Contrast:** All text ≥4.5:1 (WCAG 2.1 AA). Purple for one primary CTA per view; teal and cream carry the layout.  
- **Typography:** Headings **Poppins** (weights 600, 700); body **Open Sans** (400, 500, 600). Enqueue 400, 500, 600, 700 for both.  
- **Contact (hardcode in theme or optional Customizer/theme options, fallback here):** Phone **01622 809881**, email office@continuitycareservices.co.uk, address The Maidstone Studios, New Cut Road, Maidstone, Kent, ME14 5NZ. CQC 1-2624556588 (Rated: Good).  
- **Social (ARIA labels as in EXTRACTED-BRAND-DATA):** Facebook Messenger (Message Continuity's Facebook), Instagram (Find Continuity on Instagram), LinkedIn (Find Continuity on Linkedin), Threads (Find Continuity on Threads).  
- **Canonical:** https://www.continuitycareservices.co.uk  

**Contact form (in theme):**

- Register AJAX handler in theme (e.g. `wp_ajax_*` and `wp_ajax_nopriv_*` for same action).
- Nonce: `wp_create_nonce( 'ccs_contact_form' )` in a hidden field; verify in handler with `wp_verify_nonce( ..., 'ccs_contact_form' )`.
- POST fields: e.g. `contact-name`, `contact-email`, `contact-phone`, `contact-subject`, `contact-message`, `page_url`; optional UTM/referrer. Validate, sanitize, send email (e.g. `wp_mail` to theme option or hardcoded), optionally save to a custom table or post type if desired.
- Response: JSON `success: true/false`, `data.message` or `data.errors`. Front-end: fetch/XHR to `admin-ajax.php` with action and nonce; accessible labels, error association, focus management.

**Technical stack:**

- **WordPress:** Classic theme. No theme.json required; all styles in `style.css` (or compiled CSS). Templates: PHP only.
- **PHP:** Template logic and `inc/` files (CPT, taxonomy, rewrites, breadcrumbs, schema, form handler). Sanitize/escape all output; nonces on forms.
- **CSS:** Custom properties for all brand tokens; flat specificity; no `!important`.
- **JS:** Vanilla or minimal dependency; contact form submit via fetch/XHR to `admin-ajax.php`. Accessible forms: labels, error association, no JS-only validation as sole check.

**Accessibility & care sector:**

- Semantic HTML (nav, main, section, article, headings hierarchy).  
- Focus visible (primary colour ring), skip link, keyboard navigable.  
- Forms: `<label>`, `aria-describedby` for errors, `aria-invalid` when invalid.  
- Images: meaningful `alt`; decorative `alt=""`.  
- Copy and UI: clear, calm, appropriate for families and people seeking disability/complex care; avoid jargon.

**Skills to use (from docs/AGENT-SKILLS-REFERENCE.md):**

- **wordpress-router** — Classify the repo as classic theme (not block/FSE) and route to the correct workflow; use when starting or when the codebase mixes themes/plugins.
- **wp-plugin-development** — CPT/taxonomy registration, hooks, activation-safe logic, admin UI, nonces, capabilities, sanitization/escaping, and release-safe patterns; theme `inc/` follows the same security and structure patterns as plugins.
- **wp-performance** — Profiling and measurement (WP-CLI profile/doctor, Server-Timing, Query Monitor), database/query optimization, autoloaded options, object caching, cron, and HTTP calls; use when tuning queries or front-end performance.
- **wp-wpcli-and-ops** — WP-CLI for safe search-replace, db export/import, theme/content management, cron, cache flushing, and scripting (e.g. wp-cli.yml).
- **wp-project-triage** — When you need a deterministic inspection of the theme (or repo) and a structured JSON report for tooling, tests, and guardrails.
- **wp-phpstan** — When configuring or running PHPStan for the theme (phpstan.neon, baselines, WordPress stubs); use for static analysis and type safety.
- **wp-rest-api** — Only if exposing custom REST routes or fields beyond core; CPTs here use `show_in_rest => false`.
- **frontend-security-coder** — XSS prevention, output escaping, nonce usage, and secure form handling in templates and `inc/` code.
- **accessibility-compliance-accessibility-audit** — WCAG compliance, inclusive design, and assistive technology; use for audits and remediation guidance.
- **wcag-audit-patterns** — WCAG 2.2 audits with automated and manual checks and remediation patterns; use when auditing or fixing accessibility.

Do **not** use **wp-block-themes** or **wp-block-development** for this build (classic theme, Gutenberg off). Use **wp-interactivity-api** only if adding `data-wp-*` or @wordpress/interactivity to the contact form or UI.

**Deliverables:**

1. Classic theme with `style.css` (theme headers, variables, reset, typography, layout, header/footer, buttons, forms, cards, hero, CTA, footer, responsive, utilities).  
2. Gutenberg disabled; classic editor only.  
3. All 7 CPTs and required taxonomies registered in theme.  
4. Home, Services (archive/single), Conditions, Areas we cover (locations), Guides/Resources, How it works (process), Careers, Team, Contact, and legal/accessibility pages as needed.  
5. Header/footer with contact and social; phone **01622 809881** and email/address as above.  
6. Contact form (markup + JS + theme AJAX handler) with nonce and accessible behaviour.  
7. Responsive layout; no overrides or !important; contrast and focus states verified.

**Out of scope:** Block theme (FSE); reliance on ccs-backend or other plugins for CPTs or form handling. No third-party page builders unless specified.

---

## Reference summary

| Source | Use in prompt |
|--------|----------------|
| BRAND-REFERENCE.md | Colours, typography, contact (01622 809881), social, tagline, contrast rule |
| EXTRACTED-BRAND-DATA.md | CSS variable roles, ARIA labels for social, enqueue weights |
| docs/CCS-FRONTEND-SPEC.md | **Canonical frontend:** page templates (pricing, service, team, careers hub, about, contact, 404), header/footer, homepage, CSS structure, JS (mobile menu), helper stubs (`ccs_breadcrumbs`, `ccs_get_site_context`). All phone numbers 01622 809881. ACF-style fields → implement as theme meta/options. |
| docs/AGENT-SKILLS-REFERENCE.md | WordPress, frontend, and accessibility skills; when to use each (wordpress-router, wp-plugin-development, wp-performance, wp-wpcli-and-ops, wp-project-triage, wp-phpstan, wp-rest-api, frontend-security-coder, accessibility-compliance-accessibility-audit, wcag-audit-patterns) |
| Theme `inc/` | CPT registration, taxonomy registration, custom rewrites (if any), navigation, breadcrumbs, schema, contact form handler |

---

*Prompt version: 2.0. Classic theme, Gutenberg off, 7 CPTs (service, condition, location, guide, process, career, team), no plugins, phone 01622 809881.*
