# Plan: Align medcity (CCS) with FINALCTAIHOPE (CTA) structure and functionality

**Goal:** Follow CTA’s structure and functionality where it makes sense, tailored to CCS (home care provider). Not copying CTA’s domain (courses, events, resources); copying **patterns** (inc/ modularity, Customizer, legal pages, SEO, etc.).

---

## 1. CTA vs medcity at a glance

| Area | CTA (FINALCTAIHOPE) | medcity (CCS) |
|------|----------------------|----------------|
| **Root** | 404, coming-soon, front-page, home, index, page, search, searchform, single, single-course, single-course_event, archive-course, archive-course_event, robots-txt-config | 404, **coming-soon**, front-page, index, page, search, searchform, single |
| **inc/** | 50+ modules (theme-setup, nav-walkers, post-types, customizer, theme-options, admin, seo*, ajax-handlers, block-patterns, cache-helpers, etc.) | theme-setup, theme-helpers, customizer, block-patterns |
| **page-templates** | about, accessibility, contact, cookies, cqc-hub, downloadable-resources, faqs, group-training, news, privacy, search, terms, unsubscribe | about-us, **accessibility**, appointment, area-single, areas-we-cover, **cookies**, contact-us, faqs, our-services, our-team, pricing, **privacy**, service-single, team-member, **terms** |
| **template-parts** | breadcrumb, booking-modal, course-card, cqc-requirements-section, resource-download-modal, resource-unavailable-modal | breadcrumb only |
| **Contact/site config** | Customizer + theme-options | **Customizer** (Contact / Site info); `ccs_get_contact_info()` reads theme mods |
| **Block patterns** | inc/block-patterns.php (register_block_pattern) | **inc/block-patterns.php** (category `ccs-patterns`; patterns from patterns/*.php) |
| **SEO** | seo.php, seo-schema, seo-image-sitemap, seo-verification, seo-links-redirects, seo-admin, etc. | None |
| **Legal pages** | page-accessibility, page-cookies, page-privacy, page-terms, page-unsubscribe | **Done:** page-accessibility, page-cookies, page-privacy, page-terms (CTA UI, CCS content) |
| **Other** | coming-soon, robots-txt-config, src/ (Controllers, Repositories, Services), tests/ | **coming-soon.php** (done); robots-txt, src/, tests/ — not yet |

---

## 2. Gaps to resolve (prioritised)

### Phase 1 — Structure and config (high impact, low risk)

1. **Customizer for contact/site info** ✅ *Done*
   - **Was missing:** Contact details and social URLs were hardcoded in `inc/theme-helpers.php`.
   - **Done:** Added `inc/customizer.php` with section "Contact / Site info": phone, email, address (textarea), address/map link (URL), contact page slug, Facebook, Instagram, LinkedIn. `ccs_get_contact_info()` now reads from `get_theme_mod()` with the previous values as defaults; `phone_link` is derived from `phone`. `inc/customizer.php` is required from `functions.php`.

2. **inc/block-patterns.php** ✅ *Done*
   - **Was missing:** Block patterns lived in `patterns/*.php` but were not registered via a central inc file.
   - **Done:** Added `inc/block-patterns.php`: registers category `ccs-patterns` and the two existing patterns (CQC section, CV Minder careers) by reading markup from `patterns/*.php`. Required from `functions.php`.

3. **Legal and policy page templates** ✅ *Done*
   - **Was missing:** No Privacy, Terms, Cookies, or Accessibility templates.
   - **Done:** Added four page templates mirroring CTA’s UI (page-title + breadcrumb + “Last updated”, legal prose, CTA strip), content tailored to CCS (home care; no courses/newsletter):
     - `page-templates/page-privacy.php` — Privacy Policy (Data Controller, info we collect, legal basis, rights, cookies link, contact).
     - `page-templates/page-terms.php` — Terms of Use (about us, eligibility, use of site, no accounts, enquiries, no online purchase, IP, liability, data protection, cookies, governing law, contact).
     - `page-templates/page-cookies.php` — Cookie Policy (what cookies are, how we use them, types, managing cookies, link to Privacy).
     - `page-templates/page-accessibility.php` — Accessibility Statement (commitment, measures, conformance, feedback, EASS, updates).
   - **Remaining:** Create WordPress pages (e.g. Privacy Policy, Terms), assign these templates, and link from footer if desired. `.legal-content` spacing added in `assets/css/style.css`.

4. **coming-soon.php** ✅ *Done*
   - **Was missing:** No coming-soon or maintenance template.
   - **Done:** Added `coming-soon.php` — “We’re still working on this page!” with Back to home button; uses medcity’s 404-style layout. Optional theme mod can be added later if needed.

---

### Phase 2 — SEO and head (medium impact)

5. **Basic SEO (inc/seo.php + schema)**
   - **Missing:** No meta description, OG tags, or structured data.
   - **CTA pattern:** inc/seo.php (meta, OG, cleanup), inc/seo-schema.php (Organization, LocalBusiness, etc.).
   - **Action:** Add `inc/seo.php`: document title handling, meta description (from excerpt or post meta), basic OG tags. Add `inc/seo-schema.php`: JSON-LD for Organization and/or LocalBusiness (address, phone, name) using `ccs_get_contact_info()`. Enqueue from `functions.php`. No need for CTA’s full SEO admin/search console initially.

6. **robots.txt / sitemap (optional)**
   - **Missing:** CTA has robots-txt-config and sitemap tweaks.
   - **Action:** Only add if you need custom robots rules or sitemap behaviour; otherwise rely on WP core sitemaps.

---

### Phase 3 — Admin and forms (optional, tailor to need)

7. **Form submissions in admin**
   - **Missing:** Contact form posts to `assets/php/contact.php`; no dashboard view of submissions.
   - **CTA pattern:** inc/form-submissions-admin.php (list/store contact submissions).
   - **Action:** If you want submissions stored and viewable in wp-admin: add a simple “Contact submissions” screen (or use a plugin). Otherwise leave form as-is and document where emails go.

8. **AJAX handlers (inc/ajax-handlers.php)**
   - **Missing:** No central AJAX handler file.
   - **CTA pattern:** inc/ajax-handlers.php for nopriv and priv actions.
   - **Action:** Add `inc/ajax-handlers.php` only when you have an AJAX feature (e.g. contact form via AJAX, or a future “request callback” form). Stub or minimal file is enough until then.

9. **Theme options vs Customizer**
   - **CTA:** Has both customizer and theme-options (some API keys/settings in options).
   - **CCS:** After Phase 1, contact/social live in Customizer. Add a separate “Theme options” or “API keys” inc file only if you introduce e.g. reCAPTCHA keys, map API key, or similar; otherwise Customizer is enough.

---

### Phase 4 — Out of scope for CCS (do not copy)

- **Post types:** CTA has `course`, `course_event`. CCS uses pages + page templates; no need for these CPTs unless you later add “Service” or “Area” as CPTs.
- **Newsletter, resources, events, Eventbrite, AI, Facebook conversions, etc.** — CTA-specific; skip unless CCS gains those features.
- **src/ (Controllers, Repositories, Services):** Optional later refactor for form handling; not required for structure alignment.
- **tests/:** Add when you want automated tests; not a prerequisite for alignment.

---

## 3. File and folder changes summary

| Action | Item |
|--------|------|
| **Add** ✅ | `inc/customizer.php` (contact/social/site options) |
| **Add** ✅ | `inc/block-patterns.php` (category + register patterns from patterns/*.php) |
| **Add** | `inc/seo.php` (meta, OG), `inc/seo-schema.php` (Organization/LocalBusiness) |
| **Add** ✅ | `page-templates/page-privacy.php`, `page-templates/page-terms.php`, `page-templates/page-cookies.php`, `page-templates/page-accessibility.php` |
| **Add** ✅ | `coming-soon.php` |
| **Modify** ✅ | `assets/css/style.css` — `.legal-content` section spacing for legal pages |
| **Modify** ✅ | `functions.php` — require `inc/customizer.php` |
| **Modify** ✅ | `inc/theme-helpers.php` — `ccs_get_contact_info()` reads from Customizer (theme mods) with fallbacks |
| **Optional** | `inc/ajax-handlers.php` (stub), `inc/form-submissions-admin.php` (if you store submissions) |

---

## 4. Suggested order of work

1. ~~**Customizer**~~ ✅ **Done** — `inc/customizer.php` added; `ccs_get_contact_info()` reads theme mods.
2. ~~**Block patterns**~~ ✅ **Done** — `inc/block-patterns.php` added; category `ccs-patterns` and two patterns registered.
3. ~~**Legal templates**~~ ✅ **Done** — Privacy, Terms, Cookies, Accessibility added (CTA UI, CCS content). Create WP pages and assign templates; link from footer as needed.
4. ~~**coming-soon**~~ ✅ **Done** — `coming-soon.php` added.
5. **SEO** — add `inc/seo.php` and `inc/seo-schema.php` with minimal meta + schema.
6. **Optional** — robots-txt, form submissions admin, ajax-handlers when needed.

This gives you CTA-like structure (modular inc/, Customizer-driven contact, legal pages, basic SEO) without bringing over CTA’s course/event/newsletter stack.
