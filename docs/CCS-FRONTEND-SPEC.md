# CCS theme — complete frontend spec (templates, copy, CSS, JS)

Reference for building the Continuity Care Services classic theme. **Phone number is 01622 809881** (tel: `01622809881`). Any other number in source material is wrong.

**Note:** Templates below reference `get_field()` / `the_field()` (ACF). This project is **no-plugins**; implement equivalent fields via theme post meta / options (see PROMPT-CCS-WORDPRESS-BUILD.md). Helper functions used: `ccs_breadcrumbs()`, `ccs_get_site_context()` — implement in theme `inc/`.

---

## 1. Master CSS (`style.css`)

Theme header and full styles: brand tokens, reset, typography, layout, header/nav, buttons, hero, cards, process steps, pricing, team grid, testimonials, forms, breadcrumbs, page CTA, footer, responsive, utilities. See original paste for full CSS block (or extract from CCS-CURSOR-PROMPTS.md if stored there). Use `--primary`, `--secondary`, `--background-warm`, etc. from BRAND-REFERENCE.md; no `!important`.

---

## 2. Header (`header.php`)

- DOCTYPE, `language_attributes()`, charset, viewport.
- Preconnect + Google Fonts: Open Sans (400,500,600,700), Pooppins (600,700).
- `wp_head()`.
- Sticky `.site-header`, `.header-inner` (logo + nav + CTA).
- **Context-switching nav** via `ccs_get_site_context()`:
  - **Care:** Services, Pricing, How It Works, Our Team, Resources, “Looking for Work?” → careers; CTA: **01622 809881** + Book Consultation.
  - **Careers:** Why Join Us, Typical Day, Training, Current Jobs, Apply, “Need Care?” → services; CTA: **01622 809881** + Apply Now.
- Mobile: `.menu-toggle` (aria-label “Toggle menu”), `.primary-nav.is-open` for open state.
- Close `<main id="main-content">` in header so footer only closes main.

**Phone in header:** `tel:01622809881`, display **01622 809881**.

---

## 3. Footer (`footer.php`)

- Close `</main>`.
- `.site-footer`, `.footer-grid` (4 columns): Services, Company, Resources, Get in Touch.
- **Get in Touch:** Phone **01622 809881** (`tel:01622809881`), email office@continuitycareservices.co.uk, address The Maidstone Studios, New Cut Road, Maidstone, Kent ME14 5NZ.
- Social: Facebook Messenger, Instagram, LinkedIn, Threads (ARIA labels per EXTRACTED-BRAND-DATA).
- Footer bottom: ©, legal links (Privacy, Cookies, Accessibility, Complaints, Sitemap), CQC “Rated: Good” link (1-2624556588).
- `wp_footer()`.
- Inline script: menu toggle (or enqueue `assets/js/main.js`).

**Phone in footer:** **01622 809881** / `tel:01622809881`.

---

## 4. Homepage (`front-page.php`)

- Hero: headline, lead, CTAs (Book Free Consultation, See What It Costs).
- How It Works: 4 process steps (Book Consultation, We Write the Plan, Meet Your Team, Care Begins); link to /how-it-works.
- What We Provide: 3 cards (Domiciliary £28–32/hr, Complex £32–38/hr, Respite from £28/hr); links to service URLs.
- Testimonials: two quote blocks.
- Dual CTA: Need Care? (Book Consultation, See Pricing) | Looking for Work? (See Jobs, Why Join Us).
- Quick contact form (name, phone, message) posting to /contact or AJAX; plus “Or call **01622 809881**”.

**Phone:** **01622 809881** / `tel:01622809881`.

---

## 5. Pricing page (`page-pricing.php`)

- Template Name: Pricing Page.
- `ccs_breadcrumbs()`.
- H1 “What It Costs”, lead re no hidden fees.
- **Hourly rates:** 3 cards — Domiciliary £28–32/hr, Complex £32–38/hr, Respite from £28/hr; bullet lists; min visit 30min / 1hr; overnight £120 (10pm–8am).
- **Where your money goes:** breakdown (carer wages 72%, insurance 12%, travel 8%, admin 8%).
- **How to pay:** Self-funding, Local Authority (KCC top-up £2–5/hr), NHS CHC, Attendance Allowance; links to guide URLs where given.
- **What’s not included:** assessments free, reviews free, no cancellation fee with 24h notice, no bank holiday surcharge, meds you buy.
- **Common questions:** rate variation, reduce hours, payment plans, cancel visit (24h = no charge; &lt;24h = half visit).
- CTA: “Book Free Consultation” + **Call 01622 809881**.

**Phone:** **01622 809881** / `tel:01622809881`.

---

## 6. Service page template (`single-service-location.php` or equivalent)

- For `location` (or service-by-location) CPT; uses ACF-style fields — replace with theme meta if no ACF.
- Fields: `pricing_range`, `section_what_it_is`, `section_who_its_for`, `section_typical_visit`, `section_scheduling`, `local_areas`, `local_partnerships`, `local_testimonials` (repeater: photo, quote, name), `section_pricing`.
- Taxonomy: `town` (e.g. `wp_get_post_terms(..., 'town')`).
- CTA: Book consultation, **Call 01622 809881**; links to how-it-works, team, resources/faqs.

**Phone:** **01622 809881** / `tel:01622809881`.

---

## 7. Example service copy (Domiciliary Care Maidstone)

Use for first location/service entry. Sections: What It Is, Who It’s For, What a Visit Looks Like, How We Schedule Visits, What It Costs (location-specific), Local Areas Served, Local Partnerships, Local Testimonials. Copy is in original spec; keep tone and structure.

---

## 8. Team page (`page-team.php`)

- Template Name: Team Page.
- H1 “Who You’ll Meet”, lead.
- Loop `team` CPT: `first_name`, `role`, `tenure_years`, `qualifications`, `specialisms` (array), taxonomy `town`; post content = bio; thumbnail.
- “What We Look For” cards: You Don’t Need Experience, You Need to Give a Damn, You Need to Be Reliable.
- CTA: See Current Jobs, Why Work Here (links to /careers/jobs, /careers).

No phone on this page in spec; add **01622 809881** to CTA if desired.

---

## 9. Careers hub (`single-career.php` with hub logic)

- `get_field('is_hub')` differentiates hub vs sub-page (replace with theme meta).
- **Hub:** H1 “Care Jobs in Maidstone & Kent”, hero-dual (Never Done Care Work? | Experienced Carer?), “What You’d Actually Be Doing”, “What We Pay” (Care Assistant £13.50, Experienced £14–15, Senior £15.50–17), “Why Carers Stay” cards, CTA See Jobs / Apply + **01622 689 047** → **use 01622 809881**.
- **Sub-pages:** `section_hero`, `section_main`, `page_type` (Jobs | Why Join Us | Apply). Jobs: `current_jobs` repeater (job_title, job_location, job_hours, job_salary, job_description). Apply: form or email office@continuitycareservices.co.uk.

**Phone in careers:** **01622 809881** / `tel:01622809881`.

---

## 10. About page (`page-about.php`)

- Template Name: About Page.
- Sections: How We Started, What We Do Differently (no 15-min visits, same carers, pay travel time, no jargon), Our Numbers (80+ clients, 45 carers, 3.5 years tenure, CQC Good), CQC rating + link, Who Runs It (Rachel Thompson, James Patel), Our Values.
- CTA: Book Consultation, See Careers.

No phone in spec; add **01622 809881** if desired.

---

## 11. Contact page (`page-contact.php`)

- Template Name: Contact Page.
- H1 “Get in Touch”, lead.
- Two columns: Contact details | Form.
- **Contact:** Phone **01622 809881** (Mon–Fri 8–6, Sat 9–1, Sun closed), email office@continuitycareservices.co.uk, address The Maidstone Studios, social links (ARIA labels).
- Form: name, phone, email (optional), location, enquiry_type (care_consultation, care_question, career, professional, other), message; submit. Use theme AJAX handler and nonce per PROMPT-CCS-WORDPRESS-BUILD.md.
- “What Happens Next?”: 4 steps (We Call You, Book Consultation, We Write the Plan, Care Starts).

**Phone:** **01622 809881** / `tel:01622809881`.

---

## 12. 404 (`404.php`)

- H1 404, “Page Not Found”, lead.
- Card grid: Need Care? (Services), Looking for Work? (Careers), Have a Question? (Contact).
- “Or call **01622 809881**”.

**Phone:** **01622 809881** / `tel:01622809881`.

---

## 13. Mobile menu JS (`assets/js/main.js`)

- On DOMContentLoaded: `.menu-toggle` toggles `.primary-nav.is-open`; set `aria-expanded` on toggle; swap icon (☰ / ✕).
- Close menu when clicking outside.
- Smooth scroll for `a[href^="#"]`.

No phone in JS.

---

## Phone number summary

| Location        | Use this           | tel link        |
|----------------|--------------------|-----------------|
| All pages/CTAs | 01622 809881       | tel:01622809881 |

Replace any occurrence of 01622 689 047 or 01622689047 with the above.

---

## URLs to support (from templates)

- `/` (front)
- `/services`, `/services/domiciliary-care`, `/services/complex-care`, `/services/respite-care` (or by location slug)
- `/pricing`, `/contact`, `/about`, `/team`, `/how-it-works`
- `/careers`, `/careers/why-join-us`, `/careers/typical-day`, `/careers/training`, `/careers/jobs`, `/careers/apply`
- `/conditions`, `/areas`, `/resources`, `/resources/guides`, `/resources/faqs`, `/resources/referrals`
- Guide URLs e.g. `/resources/guides/nhs-chc-funding-kent`, `/resources/guides/attendance-allowance-guide`
- Legal: `/privacy-policy`, `/cookie-policy`, `/accessibility-statement`, `/complaints-procedure`, `/sitemap`

---

## Helpers to implement in theme

- `ccs_breadcrumbs()` — output breadcrumb list (schema-friendly if desired).
- `ccs_get_site_context()` — return `'care'` or `'careers'` (e.g. by current URL path or option) for header nav switching.

---

*Source: user-provided “EVERYTHING” frontend package. Phone corrected to 01622 809881 throughout.*
