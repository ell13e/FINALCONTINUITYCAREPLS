# Optimised prompt: CCS WordPress disability & complex care website

Use this prompt to brief an agent (or yourself) to build the **Continuity Care Services** WordPress theme and front end: a PHP, CSS, and JS site for **disability and complex care services** that integrates with the **ccs-backend** plugin. It encodes brand (BRAND-REFERENCE.md, EXTRACTED-BRAND-DATA.md), skills routing (docs/AGENT-SKILLS-REFERENCE.md), and backend contract (ccs-backend).

---

## Copy-paste prompt (optimised)

**Goal:** Build a WordPress **block theme** (PHP, CSS, JS) for **Continuity Care Services** — a Kent-based home care provider offering disability and complex care services. The site must be **accessible (WCAG 2.1 AA)**, **on-brand**, and **integrate with the existing ccs-backend plugin** (CPTs, contact form AJAX, Customizer, theme options, block patterns). No `!important` or override layers; fix specificity and source order instead.

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
- **Contact (use from Customizer/options, fallback here):** Phone 01622 809881, email office@continuitycareservices.co.uk, address The Maidstone Studios, New Cut Road, Maidstone, Kent, ME14 5NZ. CQC 1-2624556588 (Rated: Good).  
- **Social (ARIA labels as in EXTRACTED-BRAND-DATA):** Facebook Messenger (Message Continuity's Facebook), Instagram (Find Continuity on Instagram), LinkedIn (Find Continuity on Linkedin), Threads (Find Continuity on Threads).  
- **Canonical:** https://www.continuitycareservices.co.uk  

**Backend integration (ccs-backend plugin):**

- **CPTs (show_in_rest):** `service` (slug `services`), `team_member` (slug `team`), `area` (areas we cover), `resource` + taxonomy `resource_type`. Use for Services, Team, Areas we cover, Resources (e.g. guides).  
- **Contact form AJAX:**  
  - Action: `ccs_contact_form`.  
  - Nonce: `wp_create_nonce('ccs_contact_form')` (POST as `nonce`).  
  - POST fields: `contact-name`, `contact-email`, `contact-phone`, `contact-subject` (one of `care-enquiry` | `general` | `request-callback` | `other`), `contact-message`, `page_url`; optional `utm_*`, `referrer`, `lead_source`, `marketing_consent`.  
  - Response: JSON `success: true/false`, `data.message`, `data.errors` (field keys) on validation error.  
  - Enqueue and localize script with `ajax_url` (admin_url('admin-ajax.php')) and nonce.  
- **Theme/Customizer:** Use `ccs_contact_phone`, `ccs_contact_email`, `ccs_contact_address`, `ccs_contact_address_link`, `ccs_contact_page_slug`; social URLs from Customizer.  
- **Theme options:** e.g. `ccs_enquiries_email` for form recipient; use helpers like `ccs_get_enquiries_email()` if present.  
- **Block patterns:** Backend registers category and patterns; theme should use or extend them, not duplicate.  
- **SEO:** Backend outputs meta and schema; theme must not break `wp_head` order or duplicate meta.  

**Technical stack:**

- **WordPress:** Block theme (FSE). theme.json for global settings/styles, templates, template parts, patterns.  
- **PHP:** Template logic, block render callbacks if needed, no business logic in templates; sanitize/escape all output.  
- **CSS:** Custom properties for all brand tokens; flat specificity; no `!important`. Prefer theme.json and block-level styles.  
- **JS:** Vanilla or minimal dependency; contact form submit via fetch/XHR to admin-ajax.php (action `ccs_contact_form`), nonce and field names as above. Accessible forms: labels, error association, focus management, no JS-only validation as sole check.  

**Accessibility & care sector:**

- Semantic HTML (nav, main, section, article, headings hierarchy).  
- Focus visible (primary colour ring), skip link, keyboard navigable.  
- Forms: `<label>`, `aria-describedby` for errors, `aria-invalid` when invalid.  
- Images: meaningful `alt`; decorative images `alt=""`.  
- Copy and UI: clear, calm, appropriate for families and people seeking disability/complex care; avoid jargon.  
- Reference **wcag-audit-patterns** and **accessibility-compliance-accessibility-audit** for audits and remediation.  

**Skills to use (from AGENT-SKILLS-REFERENCE):**

- **wordpress-router** — Classify repo and route to blocks vs theme.json vs REST.  
- **wp-block-themes** — theme.json, templates, template parts, patterns, style hierarchy.  
- **wp-block-development** — Block markup, block.json, attributes, render.php/render_callback if custom blocks.  
- **wp-rest-api** — Only if exposing extra REST; CPTs already in REST via show_in_rest.  
- **wp-plugin-development** — If adding theme companion plugin; otherwise theme only.  
- **wp-interactivity-api** — If using `data-wp-*` and @wordpress/interactivity for contact form or UI.  
- **wp-performance** — Query/cache and front-end performance.  
- **frontend-security-coder** — XSS prevention, escaping, nonce usage.  
- **accessibility-compliance-accessibility-audit** / **wcag-audit-patterns** — WCAG 2.2 audit and fixes.  

**Deliverables:**

1. Block theme (theme.json, templates, template parts, patterns) with full CCS brand tokens and typography.  
2. Home, Services (archive/single from CPT), Team (archive/single), Areas we cover (archive/single), Resources (archive/single), Contact, and any legal/accessibility pages as needed.  
3. Header/footer using Customizer contact and social; one primary CTA per view (purple).  
4. Contact form (PHP + JS) posting to `ccs_contact_form` with correct nonce and field names; success/error UI and accessibility.  
5. Responsive layout (teal and cream); no overrides or !important; contrast and focus states verified.  
6. Integration checklist: CPTs visible, form saves and emails via backend, contact/social from Customizer, SEO untouched.  

**Out of scope:** Reimplementing backend logic (form handling, CPTs, SEO) in the theme; use ccs-backend only. No third-party page builders unless specified; stick to block theme and patterns.

---

## Reference summary

| Source | Use in prompt |
|--------|----------------|
| BRAND-REFERENCE.md | Colours, typography, contact, social, tagline, contrast rule |
| EXTRACTED-BRAND-DATA.md | CSS variable roles, ARIA labels for social, enqueue weights |
| AGENT-SKILLS-REFERENCE.md | WordPress + frontend + a11y skills and when to use them |
| ccs-backend/ccs-backend.php | Plugin entry; inc files (CPTs, AJAX, Customizer, SEO, patterns) |
| ccs-backend/inc/ajax-handlers.php | Contact form action, nonce, POST keys, response shape |
| ccs-backend/inc/cpt-content.php | service, team_member, area, resource (+ resource_type) |
| ccs-backend/inc/customizer.php | Contact/social settings keys |

---

*Prompt version: 1.0. Optimised for PHP/CSS/JS WordPress block theme + ccs-backend integration and disability/complex care positioning.*
