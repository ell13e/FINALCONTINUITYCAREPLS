# CCS dual-site architecture (implementation reference)

One domain, **two context-aware experiences**: **Care** (people seeking care) and **Careers** (people seeking jobs). Navigation and CTAs switch by context. Plugin-free; implemented in theme via `inc/navigation.php` and templates.

---

## Dual-site navigation concept

**Care context** (default): Services, Pricing, How It Works, Who We Are, Resources; CTA “Book consultation”; prominent link **“Looking for Work?”** → Careers.

**Careers context**: Why Join Us, Typical Day, Training, Current Jobs, Apply; CTA “Apply now” / “Call to discuss”; prominent link **“Need Care?”** → Services.

**Switching:** User on a Care page sees Care nav + “Looking for Work?”. Clicking it goes to `/careers` and nav switches to Careers. User on a Careers page sees Careers nav + “Need Care?”. Clicking it goes to `/services` and nav switches to Care. Homepage offers both entry points.

**Implementation:** `ccs_get_site_context()` in `inc/navigation.php` returns `'care'` or `'careers'` based on **current page slug**. Careers = one of: `careers`, `why-join-us`, `typical-day`, `training`, `jobs`, `apply`. Care = everything else. Header/footer call this and render the appropriate menu + CTA. See `docs/CPT-ARCHITECTURE.md` for slug-based logic.

---

## Navigation structure (target)

### Care (desktop)

- **Logo**
- **Services** (dropdown): Domiciliary Care, Complex Care, Respite Care; “Care by Condition” → conditions; “Areas We Cover” → locations
- **Pricing**
- **How It Works**
- **Who We Are** (dropdown): About Us, Our Team, News
- **Resources** (dropdown): Care Guides, FAQs, For Professionals
- **“Looking for Work?”** (button/link → Careers)
- **Phone** | **Book consultation**

### Careers (desktop)

- **Logo**
- **Why Join Us** | **Typical Day** | **Training** | **Current Jobs** | **Apply**
- **“Need Care?”** (button/link → Services)
- **Phone** | **Call to discuss**

### Footer (both contexts)

- **Column 1 – Services:** Domiciliary Care, Complex Care, Respite Care, All Conditions, Areas We Cover  
- **Column 2 – Company:** About Us, Our Team, Careers, News, Contact  
- **Column 3 – Resources:** Care Guides, FAQs, Pricing, How It Works, For Professionals  
- **Column 4 – Get in touch:** Phone, Email, WhatsApp (optional), Address, Book consultation CTA  
- **Bottom bar:** ©, Privacy | Cookies | Accessibility | Complaints | Terms | Sitemap; CQC link; homecare.co.uk reviews link

---

## URL structure principles

- **Subdirectories** (no subdomains).
- **Lowercase only** (301 redirect uppercase).
- **Hyphens** for word separation (no underscores).
- **No trailing slashes** (e.g. `/page` not `/page/`).
- **Max 3-level depth** for revenue pages.
- **Service-first pattern** for local: `/[service]/[town]` (when implemented).
- **Self-referencing canonicals** on all pages.
- **BreadcrumbList** schema on all pages.

**Breadcrumbs vs URLs:** Breadcrumbs show **logical navigation**; URLs can differ for SEO. Example: URL `/domiciliary-care/maidstone`, breadcrumb “Home > Our Services > Domiciliary Care > Maidstone”. Per Google, breadcrumbs should represent a typical user path; final item (current page) omits the `item` property in BreadcrumbList schema.

---

## URL patterns (alignment with theme)

| Section        | Hub / pattern              | Singles / children                    | Notes |
|----------------|----------------------------|--------------------------------------|-------|
| Services       | `/services`                | `/services/{service-slug}`           | CPT `service`; rewrites in CPT-ARCHITECTURE |
| Locations      | `/locations` or `/areas`   | `/locations/{slug}` or `/areas/{slug}` | CPT `location`; optional `areas` rewrite |
| Conditions     | `/conditions`             | `/conditions/{slug}`                | CPT `condition` |
| How it works   | `/how-it-works`            | `/how-it-works/{slug}`              | CPT `process` |
| Team           | `/team`                    | `/team/{slug}` (single)             | CPT `team` |
| Careers        | `/careers`                 | `/careers/why-join-us`, `/careers/jobs`, etc. | **Pages** (parent Careers); Jobs = CV Minder template |
| Resources      | `/resources`               | `/resources/guides/{slug}`, `/resources/faqs`, etc. | Guides = CPT `guide`; see CPT-ARCHITECTURE |
| News           | `/news`                    | `/news/{slug}`                      | Post type or CPT as chosen |
| Legal / footer | —                          | `/contact`, `/privacy-policy`, `/accessibility-statement`, etc. | Pages |

Exact CPT slugs and rewrites: **`docs/CPT-ARCHITECTURE.md`**.

---

## Schema (by section)

- **All pages:** BreadcrumbList.
- **Homepage:** Organization, LocalBusiness (aggregate).
- **Service pillar / location service:** Service, LocalBusiness (or MedicalBusiness where appropriate).
- **County/town hubs:** LocalBusiness; county page uses `areaServed` for towns.
- **Conditions:** MedicalCondition, MedicalWebPage.
- **Pricing:** Product, Offer.
- **How it works:** HowTo (hub), HowToStep (steps).
- **Team:** Person per member.
- **Careers / Jobs:** JobPosting (aggregate on hub and jobs page).
- **Guides:** Article; FAQPage when FAQs present.
- **FAQs page:** FAQPage.
- **Contact:** ContactPage.

Implemented in `inc/schema-output.php` from theme meta; no plugin.

---

## 404 and technical

- **404 page:** Helpful message, links to main services, Areas, Contact, Home, phone number. No `noindex` on paginated archives; use `rel="prev"` / `rel="next"` on pagination (e.g. `/news/page/2`).

---

## What this doc is for

- **Theme:** Implements context via `ccs_get_site_context()`, two nav variants, and switcher CTAs. URL and schema details live in CPT-ARCHITECTURE and `schema-output.php`.
- **Content/SEO:** Full sitemap, migration, phasing, keyword mapping, and content briefs are strategy/planning and are not duplicated here.

**See also:** `docs/CPT-ARCHITECTURE.md`, `CV-MINDER-EMBED.md`, `inc/navigation.php`, `inc/schema-output.php`, `inc/custom-rewrites.php`.
