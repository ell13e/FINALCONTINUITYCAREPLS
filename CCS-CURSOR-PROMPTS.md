# CCS WordPress Theme — Cursor AI Prompt Guide

> **24 sequential prompts to build the complete Continuity Care Services WordPress theme.**
> Each prompt is self-contained. Copy-paste them into Cursor in order.
> Working directory: `/developer/ccs2/`
> See **RELEVANT CURSOR SKILLS** below for which agent skills to use with each phase.

---

## RELEVANT CURSOR SKILLS

When working through these prompts in Cursor, the following skills apply. Use them so the agent follows the right patterns and conventions.

| Area | Skill to use | When |
|------|--------------|------|
| **WordPress theme / repo** | `wordpress-router` | Classifying the theme, routing to the correct workflow (blocks vs classic, theme.json vs PHP templates). |
| **Theme & plugin structure** | `wp-plugin-development` | Architecture in `inc/`, hooks, activation/deactivation, security (nonces, capabilities, sanitization, escaping), data storage. |
| **Block themes & theme.json** | `wp-block-themes` | Only if you add block theme support or theme.json; this guide is classic theme–first. |
| **REST API** | `wp-rest-api` | If you add or extend REST routes, e.g. for headless or custom endpoints. |
| **Static analysis** | `wp-phpstan` | Configuring or fixing PHPStan in the theme (phpstan.neon, baselines, WordPress typing). |
| **Performance** | `wp-performance` | Profiling, query optimisation, autoloaded options, object caching, cron, HTTP calls. |
| **WP-CLI & ops** | `wp-wpcli-and-ops` | Safe search-replace, db export/import, cache flush, scripting, theme activation. |
| **Schema markup** | `schema-markup` | PROMPT 7 (Schema Markup System): designing/validating schema.org JSON-LD, eligibility, correctness. |
| **SEO** | `seo-audit`, `seo-meta-optimizer`, `seo-structure-architect` | PROMPT 8 (SEO meta tags), meta titles/descriptions, on-page structure, internal linking. |
| **Accessibility** | `wcag-audit-patterns` or `accessibility-compliance-accessibility-audit` | POST-BUILD: WAVE check, focus states, contrast, keyboard nav, ARIA where needed. |
| **CSS / styling** | Workspace rule: `fix-dont-override` | No `!important`; fix specificity/cascade. Use design tokens (e.g. `--ccs-*`) and flat specificity. |
| **Security (forms, input)** | `cc-skill-security-review` or `backend-security-coder` | PROMPT 20 (Contact form handler): validation, sanitization, nonces, capability checks. |
| **Frontend / UI** | `frontend-design` | PROMPT 22 (CSS) and template parts: consistent, production-ready UI and components. |

**Quick reference**

- **Prompts 1–6 (foundation, CPTs, taxonomies, rewrites, nav, breadcrumbs):** `wordpress-router`, `wp-plugin-development`.
- **Prompts 7–8 (schema, SEO):** `schema-markup`, `seo-meta-optimizer`, `seo-structure-architect`.
- **Prompts 9–18 (templates, ACF):** `wp-plugin-development`, `frontend-design`.
- **Prompt 20 (form handler):** `wp-plugin-development`, `cc-skill-security-review` or `backend-security-coder`.
- **Prompt 22 (CSS):** `fix-dont-override` (workspace rule), `frontend-design`.
- **After build:** `wp-phpstan`, `wp-performance`, `wcag-audit-patterns`, `wp-wpcli-and-ops` for checks and ops.

---

## BEFORE YOU START

### Prerequisites
- Local WordPress install running (LocalWP, MAMP, etc.)
- Theme folder at `wp-content/themes/ccs-wp-theme/`
- ACF Pro installed and activated
- Classic Editor plugin installed (optional but recommended)

### Project Structure Target
```
ccs-wp-theme/
├── style.css
├── functions.php
├── screenshot.png
├── header.php
├── footer.php
├── front-page.php
├── page.php
├── single.php
├── index.php
├── 404.php
├── page-pricing.php
├── page-team.php
├── page-contact.php
├── page-about.php
├── single-service.php
├── single-condition.php
├── single-location.php
├── single-guide.php
├── single-process.php
├── single-career.php
├── inc/
│   ├── theme-setup.php
│   ├── theme-helpers.php
│   ├── post-types.php
│   ├── taxonomies.php
│   ├── custom-rewrites.php
│   ├── customizer.php
│   ├── nav-context.php
│   ├── breadcrumbs.php
│   ├── schema-output.php
│   ├── seo.php
│   ├── form-handler.php
│   └── admin-columns.php
├── template-parts/
│   ├── hero.php
│   ├── cta-block.php
│   ├── card-service.php
│   ├── card-condition.php
│   ├── card-team.php
│   ├── testimonial.php
│   ├── faq-item.php
│   └── cqc-widget.php
├── assets/
│   ├── css/
│   │   └── main.css
│   ├── js/
│   │   └── main.js
│   └── images/
└── acf-json/
    └── (ACF field group JSON exports)
```

---

## PROMPT 1: Theme Foundation & File Structure

**Skills:** `wordpress-router`, `wp-plugin-development`

```
Create the foundation files for a classic WordPress theme called "Continuity Care Services" in the current directory. This is a healthcare/home care provider based in Kent, UK.

BRAND REFERENCE:
- Site title: Continuity Care Services
- Tagline: Your Team, Your Time, Your Life
- Domain: continuitycareservices.co.uk
- Text domain: ccs-wp-theme
- Phone: 01622 809881
- Email: office@continuitycareservices.co.uk
- Address: The Maidstone Studios, New Cut Road, Maidstone, Kent ME14 5NZ
- CQC registration: 1-2624556588 (Rated Good)

COLOURS (CSS custom properties):
--ccs-primary: #564298 (purple — CTAs, links)
--ccs-primary-light: #7B63B8 (hover)
--ccs-primary-dark: #3F2F70 (active)
--ccs-secondary: #a8ddd4 (teal — cards, accents)
--ccs-secondary-light: #C5EAE4 (soft backgrounds)
--ccs-secondary-dark: #85C4B8 (hover, success)
--ccs-accent: #9b8fb5 (bullets, decorative)
--ccs-bg: #ffffff (cards, panels)
--ccs-bg-warm: #f6f5ef (page background, cream)
--ccs-text: #2e2e2e (body)
--ccs-text-light: #666666 (captions)
--ccs-border: #E0E0E0 (dividers)

TYPOGRAPHY:
- Headings: Poppins (600, 700)
- Body: Open Sans (400, 500, 600)

SOCIAL:
- Facebook Messenger: https://m.me/821174384562849
- Instagram: http://instagram.com/continuityofcareservices/
- LinkedIn: http://linkedin.com/company/continuitycareservices
- Threads: https://www.threads.com/@continuityofcareservices

Create these files:

1. style.css — Theme header only (name, URI, description, version 1.0.0, text domain, author). No actual styles here — we use assets/css/main.css.

2. functions.php — Define constants:
   - CCS_THEME_VERSION = '1.0.0'
   - CCS_THEME_DIR = get_template_directory()
   - CCS_THEME_URI = get_template_directory_uri()
   Then require_once each file in inc/ directory. Enqueue:
   - Google Fonts (Poppins 600,700 + Open Sans 400,500,600) via fonts.googleapis.com
   - assets/css/main.css (version CCS_THEME_VERSION)
   - assets/js/main.js (version CCS_THEME_VERSION, in_footer true, defer)

3. inc/theme-setup.php — after_setup_theme:
   - title-tag, post-thumbnails, responsive-embeds
   - html5 support (search-form, comment-form, comment-list, gallery, caption, style, script)
   - custom-logo (height 80, width 260, flex both)
   - Register nav menus: 'care' (Care Navigation), 'careers' (Careers Navigation), 'footer-care' (Footer Care Links), 'footer-careers' (Footer Career Links), 'legal' (Legal Links)
   - content_width 1280
   - Custom image sizes: 'card-thumb' (600x400 crop), 'hero' (1920x800 crop), 'team-portrait' (500x500 crop)
   - Excerpt length 25, excerpt more '…'
   - Relabel Posts as "News & Updates"

4. inc/theme-helpers.php — Helper functions:
   - ccs_asset($path) — returns CCS_THEME_URI . '/assets/' . $path
   - ccs_get_contact_info() — returns array with phone, phone_link (tel:), email, address, address_link (Google Maps URL), contact_url, social array (facebook, instagram, linkedin, threads). All values from Customizer with these defaults:
     Phone: 01622 809881
     Email: office@continuitycareservices.co.uk
     Address: The Maidstone Studios, New Cut Road, Maidstone, Kent ME14 5NZ
   - ccs_page_url($slug) — get URL for a page by slug, with home_url fallback
   - ccs_get_cqc_id() — returns '1-2624556588' (filterable)

5. inc/customizer.php — Customizer settings/controls for:
   - Section: Contact / Site info (phone, email, address, address_link, contact_page_slug)
   - Section: Social links (facebook, instagram, linkedin, threads)
   - Section: Integrations (hide_cqc_widget checkbox, cqc_provider_id, use_cvminder checkbox, cvminder_iframe_url with default https://cvminder.com/jobportal/index.php?gid=60&pk=2347289374823605326759060200713)

6. Create empty placeholder files for: header.php, footer.php, front-page.php, page.php, single.php, index.php, 404.php (just <?php get_header(); get_footer(); for now)

7. Create the directory structure:
   - inc/
   - template-parts/
   - assets/css/
   - assets/js/
   - assets/images/
   - acf-json/

8. assets/js/main.js — Empty file with 'use strict' and DOMContentLoaded listener ready.

Do NOT create the CSS file yet (that comes later).
All PHP files must start with the ABSPATH check: if ( ! defined( 'ABSPATH' ) ) { exit; }
Use 'ccs-wp-theme' as text domain everywhere.
Tab indentation, WordPress coding standards.
```

---

## PROMPT 2: Custom Post Types

**Skills:** `wordpress-router`, `wp-plugin-development`

```
Create inc/post-types.php for the CCS WordPress theme. Register these Custom Post Types:

1. SERVICE (ccs_service)
   - Label: Services
   - Public, has_archive false, show_in_rest true
   - Supports: title, editor, thumbnail, excerpt, revisions
   - Menu icon: dashicons-heart
   - Menu position: 5
   - Rewrite slug: 'services' (with_front false)
   - Has hierarchical FALSE

2. CONDITION (ccs_condition)
   - Label: Conditions
   - Public, has_archive false, show_in_rest true
   - Supports: title, editor, thumbnail, excerpt, revisions
   - Menu icon: dashicons-plus-alt
   - Menu position: 6
   - Rewrite slug: 'conditions' (with_front false)

3. LOCATION (ccs_location)
   - Label: Locations
   - Public, has_archive false, show_in_rest true
   - Supports: title, editor, thumbnail, revisions
   - Menu icon: dashicons-location
   - Menu position: 7
   - Rewrite slug: 'areas' (with_front false)
   - Hierarchical TRUE (allows county → town parent/child)

4. GUIDE (ccs_guide)
   - Label: Guides
   - Public, has_archive false, show_in_rest true
   - Supports: title, editor, thumbnail, excerpt, revisions
   - Menu icon: dashicons-book-alt
   - Menu position: 8
   - Rewrite slug: 'resources/guides' (with_front false)

5. PROCESS (ccs_process)
   - Label: How It Works
   - Public, has_archive false, show_in_rest true
   - Supports: title, editor, thumbnail, revisions
   - Menu icon: dashicons-editor-ol
   - Menu position: 9
   - Rewrite slug: 'how-it-works' (with_front false)

6. CAREER (ccs_career)
   - Label: Careers
   - Public, has_archive false, show_in_rest true
   - Supports: title, editor, thumbnail, revisions
   - Menu icon: dashicons-groups
   - Menu position: 10
   - Rewrite slug: 'careers' (with_front false)

7. TEAM MEMBER (ccs_team)
   - Label: Team
   - Public FALSE, publicly_queryable FALSE, show_ui TRUE
   - Supports: title, thumbnail
   - Menu icon: dashicons-admin-users
   - Menu position: 11
   - Rewrite: false (no frontend URLs — displayed via page-team.php template)

8. FORM SUBMISSION (form_submission) — keep from existing codebase:
   - Public FALSE, publicly_queryable FALSE, show_ui TRUE
   - Supports: title
   - Menu icon: dashicons-feedback
   - Menu position: 26
   - Capabilities: create_posts false (submissions created programmatically only)

Also add flush_rewrite_rules on theme activation via after_switch_theme hook.
All CPTs use 'ccs-wp-theme' text domain.
WordPress coding standards, tab indentation.
```

---

## PROMPT 3: Custom Taxonomies

**Skills:** `wordpress-router`, `wp-plugin-development`

```
Create inc/taxonomies.php for the CCS WordPress theme. Register these taxonomies:

1. SERVICE TYPE (ccs_service_type)
   - Applied to: ccs_service
   - Hierarchical: true (like categories)
   - Labels: Service Types / Service Type
   - Rewrite: false (we handle URLs with custom rewrites)
   - Show admin column: true
   - Default terms to create on theme activation:
     - Domiciliary Care (slug: domiciliary-care)
     - Complex Care (slug: complex-care)
     - Respite Care (slug: respite-care)

2. TOWN (ccs_town)
   - Applied to: ccs_service, ccs_location, ccs_team
   - Hierarchical: false (like tags)
   - Labels: Towns / Town
   - Rewrite: false
   - Show admin column: true
   - Default terms (slug in parentheses):
     - Maidstone (maidstone)
     - Tonbridge (tonbridge)
     - Royal Tunbridge Wells (royal-tunbridge-wells)
     - Sevenoaks (sevenoaks)
     - Ashford (ashford)
     - Canterbury (canterbury)
     - Medway (medway)
     - Bearsted (bearsted)
     - Loose (loose)
     - Penenden Heath (penenden-heath)

3. CONDITION TAG (ccs_condition_tag)
   - Applied to: ccs_service, ccs_condition
   - Hierarchical: false
   - Labels: Condition Tags / Condition Tag
   - Rewrite: false
   - Show admin column: true
   - Default terms:
     - Dementia (dementia)
     - Epilepsy (epilepsy)
     - Autism (autism)
     - Learning Disabilities (learning-disabilities)
     - Parkinson's Disease (parkinsons)
     - Stroke Recovery (stroke)
     - Physical Disabilities (physical-disabilities)

4. GUIDE CATEGORY (ccs_guide_cat)
   - Applied to: ccs_guide
   - Hierarchical: true
   - Labels: Guide Categories / Guide Category
   - Rewrite: false
   - Show admin column: true
   - Default terms:
     - Funding & Costs (funding-costs)
     - Getting Started (getting-started)
     - Family Advice (family-advice)
     - Condition Guides (condition-guides)

5. FORM TYPE (form_type)
   - Applied to: form_submission
   - Hierarchical: false
   - Show UI: true, show admin column: true
   - Rewrite: false

Create a function ccs_create_default_terms() that inserts the default terms above if they don't exist. Hook it to after_switch_theme so terms are created on theme activation.

WordPress coding standards, tab indentation.
```

---

## PROMPT 4: Custom URL Rewrites

**Skills:** `wordpress-router`, `wp-plugin-development`

```
Create inc/custom-rewrites.php for the CCS WordPress theme.

This is CRITICAL for SEO. We need custom URL rewrite rules to create the pattern:
/{service-type}/{town} → maps to a ccs_service post tagged with that service_type and town.

EXAMPLE URLs:
/domiciliary-care/maidstone → Service post with service_type=domiciliary-care AND town=maidstone
/complex-care/tonbridge → Service post with service_type=complex-care AND town=tonbridge
/respite-care/sevenoaks → Service post with service_type=respite-care AND town=sevenoaks

HOW IT WORKS:
1. Add rewrite rules on init that match patterns like: ^(domiciliary-care|complex-care|respite-care)/([^/]+)/?$
2. Map to: index.php?post_type=ccs_service&ccs_service_type=$matches[1]&ccs_town=$matches[2]
3. Add 'ccs_service_type' and 'ccs_town' as public query vars
4. Create a template redirect that:
   a. Checks if both query vars are set
   b. Queries for the ccs_service post that has BOTH the matching service_type term AND town term
   c. If found, loads single-service.php with that post set as the global $post
   d. If not found, triggers 404

ALSO add these rewrite rules:
- Enforce lowercase URLs (301 redirect any uppercase to lowercase)
- Enforce no trailing slashes on non-directory URLs (301 redirect trailing slash to non-slash)
- Redirect /services/{slug} to the correct single service URL

Create a helper function ccs_get_service_location_url($service_type_slug, $town_slug) that returns the URL like /domiciliary-care/maidstone — used in templates for linking.

Also create ccs_get_service_type_slugs() that returns array('domiciliary-care', 'complex-care', 'respite-care') — used in the rewrite regex. Make it filterable.

Add flush_rewrite_rules on theme activation.

IMPORTANT: The rewrite rules must be added with a high priority (top = true) so they match before WordPress default rules.

WordPress coding standards, tab indentation.
```

---

## PROMPT 5: Navigation Context Switching

**Skills:** `wordpress-router`, `wp-plugin-development`

```
Create inc/nav-context.php for the CCS WordPress theme.

This implements the dual-audience navigation system. The site has TWO distinct navigation experiences:

CARE CONTEXT (default):
- Shows the 'care' registered menu
- CTA button: "Looking for Work?" → links to /careers
- Phone CTA: "Book Consultation" with tel: link

CAREERS CONTEXT (when browsing /careers/* pages):
- Shows the 'careers' registered menu
- CTA button: "Need Care?" → links to /services
- Phone CTA: "Call to Discuss" with tel: link

Create these functions:

1. ccs_get_site_context() — Returns 'care' or 'careers'
   Detection logic (in order):
   a. If current URL starts with /careers → return 'careers'
   b. If current post type is ccs_career → return 'careers'
   c. If is_page() and page slug starts with 'careers' → return 'careers'
   d. Otherwise → return 'care'
   Make it filterable: apply_filters('ccs_site_context', $context)

2. ccs_get_nav_config() — Returns array based on context:
   For 'care':
   - menu_location: 'care'
   - switch_label: 'Looking for Work?'
   - switch_url: '/careers'
   - switch_icon: 'dashicons-groups' (or custom SVG)
   - phone_cta: 'Book Consultation'
   - phone_number: from ccs_get_contact_info()

   For 'careers':
   - menu_location: 'careers'
   - switch_label: 'Need Care?'
   - switch_url: '/services'
   - switch_icon: 'dashicons-heart'
   - phone_cta: 'Call to Discuss'
   - phone_number: from ccs_get_contact_info()

3. ccs_nav_switch_button() — Outputs the context switch button HTML:
   <a href="{switch_url}" class="nav-switch" data-context="{opposite context}">
     <span class="nav-switch__label">{switch_label}</span>
     <span class="nav-switch__arrow">→</span>
   </a>

4. ccs_phone_cta() — Outputs the phone CTA:
   <a href="tel:{phone_link}" class="nav-phone">
     <span class="nav-phone__icon">📞</span>
     <span class="nav-phone__number">{phone}</span>
     <span class="nav-phone__label">{phone_cta}</span>
   </a>

5. Add body_class filter:
   - Adds 'site-context--care' or 'site-context--careers' to body classes
   - This lets CSS target context-specific styling

WordPress coding standards, tab indentation.
```

---

## PROMPT 6: Breadcrumbs System

**Skills:** `wordpress-router`, `wp-plugin-development`

```
Create inc/breadcrumbs.php for the CCS WordPress theme.

Build a custom breadcrumb system (NO plugins). Must output both visible breadcrumbs AND BreadcrumbList JSON-LD schema.

Function: ccs_breadcrumbs()

OUTPUT FORMAT (visible):
<nav class="breadcrumbs" aria-label="Breadcrumb">
  <ol class="breadcrumbs__list" itemscope itemtype="https://schema.org/BreadcrumbList">
    <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
      <a href="/" itemprop="item"><span itemprop="name">Home</span></a>
      <meta itemprop="position" content="1" />
    </li>
    <li class="breadcrumbs__separator" aria-hidden="true">›</li>
    <!-- ... more items ... -->
    <li class="breadcrumbs__item breadcrumbs__item--current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
      <span itemprop="name" aria-current="page">{Current Page Title}</span>
      <meta itemprop="position" content="3" />
    </li>
  </ol>
</nav>

BREADCRUMB LOGIC BY PAGE TYPE:

Homepage: No breadcrumbs displayed.

Services (ccs_service pillar, e.g. /services/domiciliary-care):
Home › Services › Domiciliary Care

Service+Location (e.g. /domiciliary-care/maidstone):
Home › Services › Domiciliary Care › Maidstone

Conditions (ccs_condition):
Home › Conditions › Dementia Care

Locations (ccs_location):
Home › Areas We Cover › Kent (if county)
Home › Areas We Cover › Kent › Maidstone (if town, using parent hierarchy)

Guides (ccs_guide):
Home › Resources › Guides › {Guide Title}

Process (ccs_process):
Home › How It Works › {Step Title}

Careers (ccs_career):
Home › Careers › {Page Title}

Regular pages (page.php):
Home › {Page Title}
If page has parent: Home › {Parent} › {Page Title}

News posts (single.php):
Home › News › {Post Title}

News archive (index.php):
Home › News

404:
Home › Page Not Found

ALSO output JSON-LD BreadcrumbList schema in wp_head via a separate function ccs_breadcrumb_schema() hooked to wp_head. This mirrors the visible breadcrumb trail exactly.

Function ccs_get_breadcrumb_trail() returns the trail as an array of ['title' => '', 'url' => ''] items — used by both the visible breadcrumbs and the schema output.

The breadcrumbs should detect service+location pages using the query vars from custom-rewrites.php.

WordPress coding standards, tab indentation.
```

---

## PROMPT 7: Schema Markup System

**Skills:** `schema-markup`, `wp-plugin-development`

```
Create inc/schema-output.php for the CCS WordPress theme.

This outputs JSON-LD structured data in wp_head. Each page type gets specific schema. All schema uses the brand data from ccs_get_contact_info() and ccs_get_cqc_id().

Hook: add_action('wp_head', 'ccs_output_schema', 5);

SCHEMA BY PAGE TYPE:

1. ALL PAGES — Organization (as @graph item):
   @type: Organization
   @id: {site_url}#organization
   name: Continuity Care Services
   url: {site_url}
   telephone, email, address (PostalAddress with streetAddress, addressLocality: Maidstone, addressRegion: Kent, postalCode: ME14 5NZ, addressCountry: GB)
   logo: site icon URL
   sameAs: [facebook, instagram, linkedin, threads URLs]

2. HOMEPAGE — WebSite + LocalBusiness:
   WebSite: @id {site_url}#website, name, url, potentialAction SearchAction
   LocalBusiness:
     @type: HomeHealthCareService (subtype of LocalBusiness)
     @id: {site_url}#localbusiness
     name, url, telephone, email, address, geo (latitude: 51.2720, longitude: 0.5180)
     openingHours: Mo-Fr 08:00-18:00
     areaServed: [Maidstone, Kent, Tonbridge, etc.]
     priceRange: ££
     aggregateRating if available

3. SERVICE PAGES (ccs_service):
   Service schema:
     @type: Service
     name: {title}
     description: {excerpt}
     provider: {@id: #organization}
     areaServed: {town name if location-specific, otherwise "Kent"}
     serviceType: {service_type taxonomy term}
   
   If location-specific, ALSO add LocalBusiness:
     @type: HomeHealthCareService
     name: "{Service Type} in {Town}"
     address with town-specific info
     areaServed: {town}

4. CONDITION PAGES (ccs_condition):
   MedicalCondition schema:
     @type: MedicalCondition
     name: {title}
     description: {excerpt}
     relevantSpecialty: Geriatrics/Neurology (from ACF field)
   
   MedicalWebPage:
     @type: MedicalWebPage
     name: {title}
     lastReviewed: {ACF date field}
     about: {MedicalCondition reference}

5. LOCATION PAGES (ccs_location):
   LocalBusiness:
     @type: HomeHealthCareService
     name: "Home Care in {Location}"
     address: location-specific
     areaServed: {location name}
     geo: {coordinates from ACF if available}

6. GUIDE PAGES (ccs_guide):
   Article:
     @type: Article
     headline: {title}
     datePublished, dateModified
     author: {@type: Organization, name: Continuity Care Services}
     publisher: {@id: #organization}
     description: {excerpt}
   
   If FAQs present (ACF repeater), add FAQPage:
     @type: FAQPage
     mainEntity: array of Question/Answer pairs

7. PROCESS PAGES (ccs_process):
   HowTo:
     @type: HowTo
     name: {title}
     description: {excerpt}
     step: array of HowToStep (from ACF or child process pages)
     estimatedCost if pricing mentioned

8. CAREERS JOBS PAGE:
   JobPosting for each job in the ACF repeater:
     @type: JobPosting
     title, description, datePosted
     hiringOrganization: {@id: #organization}
     jobLocation: {PostalAddress}
     employmentType: FULL_TIME or PART_TIME
     baseSalary: if salary field populated

9. PRICING PAGE:
   Service array with Offer:
     @type: Service
     name: "{Service} Care"
     offers: { @type: Offer, priceSpecification with minPrice, maxPrice, priceCurrency: GBP, unitText: "per hour" }

Build a helper function ccs_build_schema_graph($items) that wraps items in:
{
  "@context": "https://schema.org",
  "@graph": [ ...items ]
}

Output with <script type="application/ld+json"> tag.

WordPress coding standards, tab indentation. Use get_field() for ACF data (check if function exists first for safety).
```

---

## PROMPT 8: SEO Meta Tags

**Skills:** `seo-meta-optimizer`, `seo-structure-architect`, `wp-plugin-development`

```
Create inc/seo.php for the CCS WordPress theme.

Custom SEO meta output (no Yoast/RankMath dependency). Uses ACF fields for per-page overrides.

ACF FIELDS (register field group "SEO Settings" — shown on all post types and pages):
- ccs_meta_title (text) — Override <title> tag
- ccs_meta_description (textarea) — Meta description
- ccs_meta_robots (select: index/follow, noindex/follow, index/nofollow, noindex/nofollow) — default: index, follow
- ccs_canonical_url (url) — Override canonical (self-referencing by default)
- ccs_og_image (image) — Override OG image

FUNCTIONS:

1. ccs_document_title($title) — Filter 'pre_get_document_title':
   Priority: ACF ccs_meta_title > auto-generated
   Auto-generation pattern:
   - Homepage: "{Site Name} | {Tagline}"
   - Service: "{Title} | Home Care in Kent | {Site Name}"
   - Service+Location: "{Service Type} in {Town} | {Site Name}"
   - Condition: "{Condition} Care & Support | {Site Name}"
   - Location: "Home Care in {Location} | {Site Name}"
   - Other: "{Title} | {Site Name}"
   Max 60 chars — truncate intelligently (don't cut words).

2. ccs_meta_tags() — Hooked to wp_head, priority 1:
   Output:
   - <meta name="description" content="..."> (ACF override or auto from excerpt/content, max 160 chars)
   - <meta name="robots" content="..."> (ACF override or default index,follow)
   - <link rel="canonical" href="..."> (ACF override or self-referencing current URL, lowercase, no trailing slash)
   - Open Graph tags: og:title, og:description, og:url, og:type (website for homepage, article for others), og:image, og:site_name, og:locale (en_GB)
   - Twitter card: twitter:card (summary_large_image), twitter:title, twitter:description, twitter:image

3. ccs_enforce_lowercase_url() — Hooked to template_redirect:
   If current URL contains uppercase letters, 301 redirect to lowercase version.

4. ccs_enforce_no_trailing_slash() — Hooked to template_redirect:
   If current URL has trailing slash (except homepage), 301 redirect to non-slash version.
   Exception: Don't redirect admin, wp-login, or feed URLs.

Auto-description generation:
- If ACF field empty, use post excerpt (trimmed to 160 chars)
- If no excerpt, use first 160 chars of content (strip HTML, trim to word boundary)
- If still empty, use site tagline

WordPress coding standards, tab indentation.
```

---

## PROMPT 9: Header Template

**Skills:** `wp-plugin-development`, `frontend-design`

```
Create header.php for the CCS WordPress theme.

This is the context-aware header that switches between Care and Careers navigation.

STRUCTURE:
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main-content">Skip to content</a>

<!-- TOP BAR (thin bar above main nav) -->
<div class="top-bar">
  <div class="container">
    <div class="top-bar__left">
      <span class="top-bar__tagline">Your Team, Your Time, Your Life</span>
    </div>
    <div class="top-bar__right">
      <a href="tel:{phone_link}" class="top-bar__phone">{phone}</a>
      <a href="mailto:{email}" class="top-bar__email">{email}</a>
    </div>
  </div>
</div>

<!-- MAIN HEADER -->
<header class="site-header" role="banner">
  <div class="container">
    <div class="site-header__inner">
      
      <!-- Logo -->
      <a href="/" class="site-header__logo" aria-label="Continuity Care Services — Home">
        {custom_logo or fallback text "Continuity Care Services"}
      </a>
      
      <!-- Main Navigation (context-dependent) -->
      <nav class="site-nav" role="navigation" aria-label="Main navigation">
        <?php
        $nav_config = ccs_get_nav_config();
        wp_nav_menu(array(
          'theme_location' => $nav_config['menu_location'],
          'container' => false,
          'menu_class' => 'site-nav__list',
          'fallback_cb' => 'ccs_fallback_menu', // outputs hardcoded links if no menu assigned
          'depth' => 2,
        ));
        ?>
      </nav>
      
      <!-- Context Switch Button -->
      <div class="site-header__actions">
        <?php ccs_nav_switch_button(); ?>
        <?php ccs_phone_cta(); ?>
      </div>
      
      <!-- Mobile Menu Toggle -->
      <button class="site-header__burger" aria-label="Open menu" aria-expanded="false" aria-controls="mobile-menu">
        <span></span><span></span><span></span>
      </button>
      
    </div>
  </div>
</header>

<!-- MOBILE MENU (hidden by default, toggled by JS) -->
<div class="mobile-menu" id="mobile-menu" aria-hidden="true">
  <div class="mobile-menu__inner">
    <?php
    wp_nav_menu(array(
      'theme_location' => $nav_config['menu_location'],
      'container' => false,
      'menu_class' => 'mobile-menu__list',
      'depth' => 2,
    ));
    ?>
    <div class="mobile-menu__actions">
      <?php ccs_nav_switch_button(); ?>
      <a href="tel:{phone_link}" class="button button--primary mobile-menu__phone">{phone_cta}: {phone}</a>
    </div>
  </div>
</div>

<!-- BREADCRUMBS -->
<?php if (!is_front_page()) : ?>
<div class="breadcrumbs-bar">
  <div class="container">
    <?php ccs_breadcrumbs(); ?>
  </div>
</div>
<?php endif; ?>

<main id="main-content" class="site-main">

USE ccs_get_contact_info() for all contact data.
USE ccs_get_nav_config() for context-dependent navigation config.

Create ccs_fallback_menu() function that outputs hardcoded care nav links if no menu is assigned:
Services (/services), Pricing (/pricing), How It Works (/how-it-works), About (/about), Contact (/contact)

The header should be sticky (CSS handles this). Add data-context attribute to <header> with current context value for CSS/JS targeting.

WordPress coding standards, tab indentation.
```

---

## PROMPT 10: Footer Template

**Skills:** `wp-plugin-development`, `frontend-design`

```
Create footer.php for the CCS WordPress theme.

STRUCTURE:
</main><!-- #main-content -->

<footer class="site-footer" role="contentinfo">
  <div class="container">
    <div class="site-footer__grid">
    
      <!-- Column 1: About -->
      <div class="site-footer__col">
        <div class="site-footer__logo">
          {custom_logo or text}
        </div>
        <p class="site-footer__tagline">Your Team, Your Time, Your Life</p>
        <p class="site-footer__desc">CQC-registered domiciliary and complex care across Maidstone & Kent. Same carers, real continuity, no agency staff.</p>
        <div class="site-footer__social">
          <a href="{facebook}" aria-label="Message Continuity's Facebook" target="_blank" rel="noopener noreferrer">{FB icon}</a>
          <a href="{instagram}" aria-label="Find Continuity on Instagram" target="_blank" rel="noopener noreferrer">{IG icon}</a>
          <a href="{linkedin}" aria-label="Find Continuity on LinkedIn" target="_blank" rel="noopener noreferrer">{LI icon}</a>
          <a href="{threads}" aria-label="Find Continuity on Threads" target="_blank" rel="noopener noreferrer">{Threads icon}</a>
        </div>
      </div>
      
      <!-- Column 2: Care Services (wp_nav_menu 'footer-care') -->
      <div class="site-footer__col">
        <h3 class="site-footer__heading">Care Services</h3>
        <?php wp_nav_menu(array('theme_location' => 'footer-care', 'container' => false, 'menu_class' => 'site-footer__links', 'depth' => 1, 'fallback_cb' => false)); ?>
        <!-- Fallback if no menu: -->
        <!-- Services, Pricing, How It Works, Areas We Cover, Conditions -->
      </div>
      
      <!-- Column 3: Work With Us (wp_nav_menu 'footer-careers') -->
      <div class="site-footer__col">
        <h3 class="site-footer__heading">Work With Us</h3>
        <?php wp_nav_menu(array('theme_location' => 'footer-careers', 'container' => false, 'menu_class' => 'site-footer__links', 'depth' => 1, 'fallback_cb' => false)); ?>
        <!-- Fallback: Why Join Us, Current Jobs, Apply, Training -->
      </div>
      
      <!-- Column 4: Contact -->
      <div class="site-footer__col">
        <h3 class="site-footer__heading">Get in Touch</h3>
        <ul class="site-footer__contact">
          <li>
            <strong>Phone:</strong>
            <a href="tel:{phone_link}">{phone}</a>
          </li>
          <li>
            <strong>Email:</strong>
            <a href="mailto:{email}">{email}</a>
          </li>
          <li>
            <strong>Office:</strong>
            <a href="{address_link}" target="_blank" rel="noopener noreferrer">{address}</a>
          </li>
        </ul>
        <p class="site-footer__cqc">
          CQC Registered: <a href="https://www.cqc.org.uk/provider/{cqc_id}" target="_blank" rel="noopener noreferrer">View CQC Profile</a>
        </p>
      </div>
      
    </div>
  </div>
  
  <!-- BOTTOM BAR -->
  <div class="site-footer__bottom">
    <div class="container">
      <p class="site-footer__copyright">
        &copy; <?php echo date('Y'); ?> Continuity Care Services. All rights reserved.
      </p>
      <nav class="site-footer__legal" aria-label="Legal links">
        <?php wp_nav_menu(array('theme_location' => 'legal', 'container' => false, 'menu_class' => 'site-footer__legal-links', 'depth' => 1, 'fallback_cb' => false)); ?>
        <!-- Fallback: Privacy Policy, Cookie Policy, Terms, Accessibility -->
      </nav>
    </div>
  </div>
  
</footer>

<?php wp_footer(); ?>
</body>
</html>

USE ccs_get_contact_info() for all data.
USE ccs_get_cqc_id() for the CQC link.
Social icons: Use inline SVG (simple icons for Facebook, Instagram, LinkedIn, Threads). Keep them accessible with aria-label.
WordPress coding standards, tab indentation.
```

---

## PROMPT 11: Homepage Template

**Skills:** `wp-plugin-development`, `frontend-design`

```
Create front-page.php for the CCS WordPress theme.

This is the homepage — the MOST important page. It serves BOTH audiences (care seekers and job seekers) with clear pathways.

<?php get_header(); ?>

SECTION 1: HERO — Dual-Audience
<section class="hero hero--home" aria-label="Welcome">
  <div class="container">
    <div class="hero__content">
      <h1 class="hero__title">Home care that actually feels like home</h1>
      <p class="hero__subtitle">CQC-rated 'Good'. Same carers every visit. Real continuity across Maidstone & Kent.</p>
      <div class="hero__ctas">
        <a href="/services" class="button button--primary button--lg">Explore Our Care</a>
        <a href="/careers" class="button button--secondary button--lg">Join Our Team</a>
      </div>
    </div>
  </div>
</section>

SECTION 2: TRUST INDICATORS
<section class="home-trust" aria-label="Why families choose us">
  <div class="container">
    <div class="home-trust__grid">
      <!-- 4 icon cards -->
      <div class="icon-card">
        <div class="icon-card__icon">🏠</div>
        <h3 class="icon-card__title">Same Carers, Every Visit</h3>
        <p class="icon-card__text">Usually 2-3 people on rotation. Not a different face every week.</p>
      </div>
      <div class="icon-card">
        <div class="icon-card__icon">⏱️</div>
        <h3 class="icon-card__title">No 15-Minute Visits</h3>
        <p class="icon-card__text">Minimum 30 minutes. Enough time to actually help.</p>
      </div>
      <div class="icon-card">
        <div class="icon-card__icon">📋</div>
        <h3 class="icon-card__title">CQC Rated 'Good'</h3>
        <p class="icon-card__text">Regulated, inspected, and rated by the Care Quality Commission.</p>
      </div>
      <div class="icon-card">
        <div class="icon-card__icon">💷</div>
        <h3 class="icon-card__title">Transparent Pricing</h3>
        <p class="icon-card__text">From £28/hour. No hidden fees, no surprises. See our pricing.</p>
      </div>
    </div>
  </div>
</section>

SECTION 3: SERVICES OVERVIEW
<section class="home-services" aria-labelledby="home-services-heading">
  <div class="container">
    <h2 id="home-services-heading" class="section-heading">What we do</h2>
    <p class="section-subheading">Three types of care, all delivered by our directly-employed team.</p>
    <div class="card-grid card-grid--3">
      <!-- Query ccs_service posts where ACF 'is_pillar' is true, display as cards -->
      <!-- Each card: thumbnail, title, excerpt, "Learn more →" link -->
      <!-- Use template-parts/card-service.php -->
    </div>
  </div>
</section>

SECTION 4: CQC WIDGET (conditional)
<?php if (!get_theme_mod('ccs_hide_cqc_widget', false)) : ?>
<section class="home-cqc" aria-labelledby="home-cqc-heading">
  <div class="container">
    <h2 id="home-cqc-heading" class="home-cqc__heading">Regulated, rated, and reliable home care across Maidstone & Kent</h2>
    <p class="home-cqc__subheading">Proud to be rated 'Good' by the CQC</p>
    <p class="home-cqc__link-wrap">
      <a href="https://www.cqc.org.uk/provider/<?php echo esc_attr(ccs_get_cqc_id()); ?>" class="home-cqc__link" target="_blank" rel="noopener noreferrer">
        View our CQC profile <span aria-hidden="true">&rarr;</span>
      </a>
    </p>
    <script type="text/javascript" src="https://www.cqc.org.uk/sites/all/modules/custom/cqc_widget/widget.js?data-id=<?php echo rawurlencode(ccs_get_cqc_id()); ?>&data-host=https://www.cqc.org.uk&type=location"></script>
  </div>
</section>
<?php endif; ?>

SECTION 5: HOW IT WORKS (abbreviated)
<section class="home-process" aria-labelledby="home-process-heading">
  <div class="container">
    <h2 id="home-process-heading" class="section-heading">How it works</h2>
    <div class="process-steps">
      <!-- 4 numbered steps with icons -->
      <div class="process-step">
        <span class="process-step__number">1</span>
        <h3>You get in touch</h3>
        <p>Call, email, or fill in the form. No pressure, no hard sell.</p>
      </div>
      <!-- Steps 2-4: Assessment visit, Care plan, Care begins -->
    </div>
    <p class="text-center"><a href="/how-it-works" class="button button--outline">See the full process</a></p>
  </div>
</section>

SECTION 6: AREAS PREVIEW
<section class="home-areas" aria-labelledby="home-areas-heading">
  <div class="container">
    <h2 id="home-areas-heading" class="section-heading">Where we work</h2>
    <p class="section-subheading">Based in Maidstone, covering towns across Kent.</p>
    <!-- Grid of town links (from ccs_town taxonomy) -->
    <p class="text-center"><a href="/areas" class="button button--outline">See all areas</a></p>
  </div>
</section>

SECTION 7: CAREERS CTA (cross-sell to careers)
<section class="home-careers-cta" aria-labelledby="home-careers-heading">
  <div class="container">
    <div class="split-cta">
      <div class="split-cta__content">
        <h2 id="home-careers-heading">Looking for care work in Kent?</h2>
        <p>£13.50/hour minimum. Travel time paid. Permanent contracts. Same clients every week.</p>
        <a href="/careers" class="button button--primary">Find Out More</a>
      </div>
    </div>
  </div>
</section>

SECTION 8: CONTACT CTA (final)
<section class="home-contact-cta" aria-labelledby="home-contact-heading">
  <div class="container">
    <h2 id="home-contact-heading">Ready to talk about care?</h2>
    <p>Call us on <a href="tel:{phone_link}">{phone}</a> or <a href="/contact">send us a message</a>.</p>
  </div>
</section>

<?php get_footer(); ?>

Use the ACF-based approach: check for ACF fields first, fall back to hardcoded content if fields aren't populated yet (this allows the site to work before all content is entered).

Query ccs_service posts for the services section. Query ccs_town terms for the areas section.

WordPress coding standards, tab indentation.
```

---

## PROMPT 12: Service Page Templates

**Skills:** `wp-plugin-development`, `frontend-design`

```
Create TWO template files for the CCS WordPress theme:

FILE 1: single-service.php — For service pages

This template handles BOTH pillar pages (/services/domiciliary-care) AND location-specific pages (/domiciliary-care/maidstone). It detects which type using:
- ACF field 'is_pillar' (true/false)
- OR presence of ccs_town query var from custom rewrites

<?php get_header(); ?>

<?php
// Detect if this is a location-specific page
$is_location_page = get_query_var('ccs_town') ? true : false;
$is_pillar = get_field('is_pillar');
$town_slug = get_query_var('ccs_town');
$town_name = '';
if ($town_slug) {
    $town = get_term_by('slug', $town_slug, 'ccs_town');
    $town_name = $town ? $town->name : ucfirst($town_slug);
}
$service_type_terms = wp_get_post_terms(get_the_ID(), 'ccs_service_type');
$service_type = !empty($service_type_terms) ? $service_type_terms[0]->name : '';
?>

<!-- HERO -->
<section class="hero hero--service">
  <div class="container">
    <h1 class="hero__title">
      <?php if ($is_location_page) : ?>
        <?php echo esc_html($service_type); ?> in <?php echo esc_html($town_name); ?>
      <?php else : ?>
        <?php the_title(); ?>
      <?php endif; ?>
    </h1>
    <?php if ($is_location_page && $town_name) : ?>
      <p class="hero__subtitle">Professional home care from our <?php echo esc_html($town_name); ?>-area team.</p>
    <?php endif; ?>
  </div>
</section>

CONTENT SECTIONS (each conditional — only show if ACF field has content):

A) "What It Is" — get_field('section_what_is')
B) "Who It's For" — get_field('section_who_for')
C) "What a Visit Looks Like" — get_field('section_typical_visit')
D) "Scheduling" — get_field('section_scheduling')
E) "What It Costs" — get_field('section_costs')
   Include pricing range: get_field('pricing_range')

IF LOCATION PAGE, also show:
F) "Areas We Cover" — get_field('local_areas_served')
G) "Local Partnerships" — get_field('local_partnerships')
H) "What Our Clients Say" — get_field('local_testimonials') (ACF repeater)
   Loop through repeater: name, quote, photo

SIDEBAR/ASIDE (on pillar pages):
- Quick pricing card: "From £{price}/hour"
- "Book a consultation" CTA button
- Related conditions (from ccs_condition_tag taxonomy)
- Phone number CTA

SIDEBAR (on location pages):
- "Other services in {town}" — link to other service types for same town
- "Nearby areas" — link to same service in adjacent towns
- CTA: "Get a quote for {town}"

BOTTOM CTA:
<section class="page-cta">
  <div class="container">
    <h2>Ready to arrange {service_type} in {town/Kent}?</h2>
    <p>Call us on {phone} or fill in our quick form.</p>
    <a href="/contact" class="button button--primary">Get in Touch</a>
  </div>
</section>

<?php get_footer(); ?>

FILE 2: template-parts/card-service.php — Reusable service card
<article class="card card--service">
  <?php if (has_post_thumbnail()) : ?>
    <div class="card__image">
      <a href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail('card-thumb'); ?>
      </a>
    </div>
  <?php endif; ?>
  <div class="card__body">
    <h3 class="card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <?php if (get_field('pricing_range')) : ?>
      <p class="card__price">From <?php the_field('pricing_range'); ?></p>
    <?php endif; ?>
    <p class="card__excerpt"><?php the_excerpt(); ?></p>
    <a href="<?php the_permalink(); ?>" class="card__link">Learn more <span aria-hidden="true">→</span></a>
  </div>
</article>

WordPress coding standards, tab indentation.
```

---

## PROMPT 13: Condition Page Template

**Skills:** `wp-plugin-development`, `frontend-design`

```
Create single-condition.php and template-parts/card-condition.php for the CCS WordPress theme.

single-condition.php handles condition education pages like /conditions/dementia, /conditions/epilepsy etc.

These are IMPORTANT for E-E-A-T. They demonstrate expertise in specific conditions.

<?php get_header(); ?>

<!-- HERO -->
<section class="hero hero--condition">
  <div class="container">
    <h1 class="hero__title"><?php the_title(); ?> Care & Support</h1>
    <p class="hero__subtitle">Understanding <?php the_title(); ?> and how home care can help.</p>
  </div>
</section>

CONTENT SECTIONS (each conditional on ACF field having content):

A) "Understanding {Condition}" — get_field('section_what_is')
   Medical condition overview in plain language.

B) "How It Progresses" — get_field('section_progression')
   Honest information about condition trajectory.

C) "Daily Life with {Condition}" — get_field('section_daily_life')
   What day-to-day challenges look like.

D) "How Home Care Helps" — get_field('section_how_care_helps')
   Specific ways care supports someone with this condition.

E) "Our Approach" — get_field('section_our_approach')
   CCS-specific methodology and training.

F) "Our Training" — get_field('section_training')
   What training carers receive for this condition.

G) "Useful Resources" — get_field('external_resources') (ACF repeater)
   Loop: link_text, url, organization
   Output as list of external links (target="_blank", rel="noopener noreferrer")

SIDEBAR:
- "Related Services" — query ccs_service posts tagged with same ccs_condition_tag
- "Other Conditions We Support" — list other condition posts
- CTA: "Talk to us about {condition} care" with phone number

METADATA BAR (just below hero, subtle):
- Category: get_field('condition_category')
- Alternate names: get_field('alternate_names')
- Last reviewed: get_field('last_reviewed') or post modified date

BOTTOM CTA:
<section class="page-cta">
  <div class="container">
    <h2>Need {condition} care in Kent?</h2>
    <p>Our carers are trained specifically for {condition} support. Call {phone} to discuss your needs.</p>
    <a href="/contact" class="button button--primary">Arrange a Visit</a>
  </div>
</section>

<?php get_footer(); ?>

template-parts/card-condition.php:
<article class="card card--condition">
  <?php if (has_post_thumbnail()) : ?>
    <div class="card__image">
      <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('card-thumb'); ?></a>
    </div>
  <?php endif; ?>
  <div class="card__body">
    <h3 class="card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <p class="card__excerpt"><?php the_excerpt(); ?></p>
    <a href="<?php the_permalink(); ?>" class="card__link">Learn more <span aria-hidden="true">→</span></a>
  </div>
</article>

WordPress coding standards, tab indentation.
```

---

## PROMPT 14: Location Page Template

**Skills:** `wp-plugin-development`, `frontend-design`

```
Create single-location.php for the CCS WordPress theme.

This handles location hub pages like /areas/kent (county), /areas/maidstone (town).

<?php get_header(); ?>

<?php
$location_type = get_field('location_type'); // county, town, or neighborhood
$is_county = ($location_type === 'county');
?>

<!-- HERO -->
<section class="hero hero--location">
  <div class="container">
    <h1 class="hero__title">Home Care in <?php the_title(); ?></h1>
    <?php if ($is_county) : ?>
      <p class="hero__subtitle">CQC-registered domiciliary and complex care across <?php the_title(); ?>. Based in Maidstone, covering towns from Tonbridge to Canterbury.</p>
    <?php else : ?>
      <p class="hero__subtitle">Professional home care from our local <?php the_title(); ?> team. Same carers, every visit.</p>
    <?php endif; ?>
  </div>
</section>

CONTENT SECTIONS:

A) "Introduction" — get_field('section_introduction')
   or the_content() as fallback

B) "Areas We Cover" — get_field('section_areas_covered')
   For county page: list of towns with links to their location pages
   For town page: list of neighborhoods/postcodes

C) "Our Services in {Location}" — get_field('section_services')
   Query ccs_service posts tagged with this town's ccs_town term
   Display as card grid using template-parts/card-service.php
   For county page: display pillar services only

D) "Local Context" — get_field('section_local_context')
   Why we work in this area, local partnerships, nearby facilities

E) "Why Choose Local Care" — get_field('section_why_local')

F) MAP (conditional)
   <?php if (get_field('show_map') && get_field('map_embed_code')) : ?>
     <div class="location-map"><?php echo get_field('map_embed_code'); ?></div>
   <?php endif; ?>

IF COUNTY PAGE — show child locations:
Query child ccs_location posts (where parent is current page, since locations are hierarchical).
Display as grid of linked cards.

IF TOWN PAGE — show services available here:
For each service type (domiciliary, complex, respite), check if a service+location page exists and link to it:
/domiciliary-care/{town-slug}
/complex-care/{town-slug}
/respite-care/{town-slug}

SIDEBAR:
- Quick pricing: "Care in {town} from £28/hour"
- Phone CTA
- Related locations (sibling towns)

BOTTOM CTA:
<section class="page-cta">
  <div class="container">
    <h2>Need care in <?php the_title(); ?>?</h2>
    <p>We cover <?php the_title(); ?> and surrounding areas. Call {phone} for a free, no-pressure chat.</p>
    <a href="/contact" class="button button--primary">Get in Touch</a>
  </div>
</section>

<?php get_footer(); ?>

WordPress coding standards, tab indentation.
```

---

## PROMPT 15: Pricing Page Template

**Skills:** `wp-plugin-development`, `frontend-design`

```
Create page-pricing.php for the CCS WordPress theme.

Template Name: Pricing

This is a CRITICAL transparency page. CCS differentiates by being upfront about costs.

<?php
/* Template Name: Pricing */
get_header();
?>

<!-- HERO -->
<section class="hero hero--pricing">
  <div class="container">
    <h1 class="hero__title">What Home Care Costs</h1>
    <p class="hero__subtitle">Real prices. No hidden fees. No "contact us to find out."</p>
  </div>
</section>

SECTION 1: PRICING CARDS
<section class="pricing-cards" aria-labelledby="pricing-heading">
  <div class="container">
    <h2 id="pricing-heading" class="section-heading">Our hourly rates</h2>
    <div class="card-grid card-grid--3">
    
      <div class="pricing-card">
        <h3 class="pricing-card__title">Domiciliary Care</h3>
        <div class="pricing-card__price">£28–32<span>/hour</span></div>
        <ul class="pricing-card__features">
          <li>Personal care (washing, dressing)</li>
          <li>Meals & medication</li>
          <li>Companionship</li>
          <li>Minimum 30-minute visits</li>
        </ul>
        <a href="/services/domiciliary-care" class="button button--outline">Learn More</a>
      </div>
      
      <div class="pricing-card pricing-card--featured">
        <h3 class="pricing-card__title">Complex Care</h3>
        <div class="pricing-card__price">£32–38<span>/hour</span></div>
        <ul class="pricing-card__features">
          <li>One-to-one dedicated care</li>
          <li>Epilepsy, autism, learning disabilities</li>
          <li>Tube feeding, stoma care</li>
          <li>Specialist trained carers</li>
        </ul>
        <a href="/services/complex-care" class="button button--primary">Learn More</a>
      </div>
      
      <div class="pricing-card">
        <h3 class="pricing-card__title">Respite Care</h3>
        <div class="pricing-card__price">From £28<span>/hour</span></div>
        <ul class="pricing-card__features">
          <li>Same rates as regular care</li>
          <li>Flexible duration</li>
          <li>Short notice where possible</li>
          <li>Give yourself a break</li>
        </ul>
        <a href="/services/respite-care" class="button button--outline">Learn More</a>
      </div>
      
    </div>
    
    <div class="pricing-note">
      <p><strong>Overnight care:</strong> £120 (10pm–8am, carer sleeps on-site)</p>
      <p><strong>Early mornings</strong> (before 7am) or <strong>late evenings</strong> (after 9pm) cost £2/hour more.</p>
      <p><strong>Two-person visits</strong> cost double the hourly rate.</p>
    </div>
  </div>
</section>

SECTION 2: WHERE YOUR MONEY GOES
<section class="pricing-breakdown" aria-labelledby="pricing-breakdown-heading">
  <div class="container">
    <h2 id="pricing-breakdown-heading" class="section-heading">Where your money goes</h2>
    <p class="section-subheading">We're transparent about this because you deserve to know.</p>
    <div class="breakdown-bars">
      <!-- Visual horizontal bars showing percentages -->
      <div class="breakdown-bar">
        <span class="breakdown-bar__label">Carer wages</span>
        <div class="breakdown-bar__fill" style="width: 72%"><span>72%</span></div>
      </div>
      <div class="breakdown-bar">
        <span class="breakdown-bar__label">Insurance</span>
        <div class="breakdown-bar__fill" style="width: 12%"><span>12%</span></div>
      </div>
      <div class="breakdown-bar">
        <span class="breakdown-bar__label">Travel time & mileage</span>
        <div class="breakdown-bar__fill" style="width: 8%"><span>8%</span></div>
      </div>
      <div class="breakdown-bar">
        <span class="breakdown-bar__label">Admin & training</span>
        <div class="breakdown-bar__fill" style="width: 8%"><span>8%</span></div>
      </div>
    </div>
  </div>
</section>

SECTION 3: FUNDING OPTIONS
<section class="pricing-funding" aria-labelledby="pricing-funding-heading">
  <div class="container">
    <h2 id="pricing-funding-heading" class="section-heading">Ways to pay for care</h2>
    <div class="card-grid card-grid--2">
      <!-- 4 funding option cards: Self-Funding, Local Authority, NHS CHC, Attendance Allowance -->
      <!-- Each with title, description, and key details -->
      <!-- Use ACF fields if populated, otherwise hardcoded content -->
    </div>
  </div>
</section>

SECTION 4: LOCATION-SPECIFIC PRICING
<section class="pricing-locations" aria-labelledby="pricing-locations-heading">
  <div class="container">
    <h2 id="pricing-locations-heading" class="section-heading">Pricing by area</h2>
    <p>Rates vary slightly by location — distance from our Maidstone office affects pricing.</p>
    <!-- Table or grid showing price ranges by town -->
    <!-- Query ccs_town terms and display with price ranges -->
  </div>
</section>

BOTTOM CTA:
<section class="page-cta">
  <div class="container">
    <h2>Want an exact quote?</h2>
    <p>Every care package is different. Call {phone} and we'll give you an honest quote — no obligation, no pressure.</p>
    <a href="/contact" class="button button--primary">Get a Quote</a>
  </div>
</section>

<?php get_footer(); ?>

Allow ACF overrides for all pricing figures (so they can be updated without code changes). Fall back to hardcoded values above.

WordPress coding standards, tab indentation.
```

---

## PROMPT 16: Team Page Template

**Skills:** `wp-plugin-development`, `frontend-design`

```
Create page-team.php for the CCS WordPress theme.

Template Name: Our Team

Displays team members from the ccs_team CPT. Team posts are NOT publicly queryable — they're only shown here.

<?php
/* Template Name: Our Team */
get_header();
?>

<!-- HERO -->
<section class="hero hero--team">
  <div class="container">
    <h1 class="hero__title">Meet Our Team</h1>
    <p class="hero__subtitle">These are the people who actually visit. We employ all our carers directly — no agency staff.</p>
  </div>
</section>

SECTION 1: TEAM STATS
<section class="team-stats" aria-label="Team statistics">
  <div class="container">
    <div class="stat-grid">
      <div class="stat">
        <span class="stat__number">3.5</span>
        <span class="stat__label">Average years with us</span>
      </div>
      <div class="stat">
        <span class="stat__number">100%</span>
        <span class="stat__label">Directly employed</span>
      </div>
      <div class="stat">
        <span class="stat__number">0</span>
        <span class="stat__label">Agency staff used</span>
      </div>
    </div>
  </div>
</section>

SECTION 2: WHAT WE LOOK FOR
<section class="team-values" aria-labelledby="team-values-heading">
  <div class="container">
    <h2 id="team-values-heading" class="section-heading">What we look for</h2>
    <div class="card-grid card-grid--3">
      <div class="icon-card">
        <h3>You Don't Need Experience</h3>
        <p>We train you. Most of our best carers came from retail, hospitality, admin.</p>
      </div>
      <div class="icon-card">
        <h3>You Need to Give a Damn</h3>
        <p>If you're rushing through visits, this isn't for you.</p>
      </div>
      <div class="icon-card">
        <h3>You Need to Be Reliable</h3>
        <p>Show up when you say you will. That's non-negotiable.</p>
      </div>
    </div>
  </div>
</section>

SECTION 3: TEAM GRID
<section class="team-grid-section" aria-labelledby="team-grid-heading">
  <div class="container">
    <h2 id="team-grid-heading" class="section-heading">Our carers</h2>
    
    <?php
    $team = new WP_Query(array(
      'post_type' => 'ccs_team',
      'posts_per_page' => -1,
      'orderby' => 'menu_order',
      'order' => 'ASC',
    ));
    
    if ($team->have_posts()) : ?>
    <div class="team-grid">
      <?php while ($team->have_posts()) : $team->the_post(); ?>
        <?php get_template_part('template-parts/card-team'); ?>
      <?php endwhile; ?>
    </div>
    <?php wp_reset_postdata(); endif; ?>
    
  </div>
</section>

BOTTOM CTA (careers cross-sell):
<section class="page-cta page-cta--careers">
  <div class="container">
    <h2>Want to join this team?</h2>
    <p>£13.50/hour minimum. Travel time paid. Permanent contracts.</p>
    <a href="/careers" class="button button--primary">See Career Opportunities</a>
  </div>
</section>

<?php get_footer(); ?>

Also create template-parts/card-team.php:
<article class="card card--team">
  <div class="card__image">
    <?php if (has_post_thumbnail()) : ?>
      <?php the_post_thumbnail('team-portrait'); ?>
    <?php else : ?>
      <div class="card__image-placeholder" style="background-color: var(--ccs-secondary-light);"></div>
    <?php endif; ?>
  </div>
  <div class="card__body">
    <h3 class="card__title"><?php echo esc_html(get_field('first_name') ?: get_the_title()); ?></h3>
    <?php if (get_field('role')) : ?>
      <p class="card__role"><?php the_field('role'); ?></p>
    <?php endif; ?>
    <?php if (get_field('tenure_years')) : ?>
      <p class="card__tenure"><?php the_field('tenure_years'); ?> years with us</p>
    <?php endif; ?>
    <?php if (get_field('specialisms')) : ?>
      <div class="card__tags">
        <?php foreach (get_field('specialisms') as $spec) : ?>
          <span class="tag"><?php echo esc_html($spec); ?></span>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</article>

WordPress coding standards, tab indentation.
```

---

## PROMPT 17: Careers Section Templates

**Skills:** `wp-plugin-development`, `frontend-design`

```
Create single-career.php for the CCS WordPress theme.

This is a SMART template that handles ALL careers section pages using the ACF 'page_type' field.

Page types: hub, why-join-us, typical-day, training, jobs, apply

<?php get_header(); ?>

<?php
$page_type = get_field('page_type') ?: 'hub';
$is_hub = get_field('is_hub');
?>

<!-- HERO (all career pages) -->
<section class="hero hero--careers">
  <div class="container">
    <?php if ($is_hub || $page_type === 'hub') : ?>
      <h1 class="hero__title">Care Work That Actually Works For You</h1>
      <p class="hero__subtitle">£13.50/hour minimum. Travel time paid. Permanent contracts. Not running around Kent seeing 12 people for 15 minutes each.</p>
    <?php else : ?>
      <h1 class="hero__title"><?php the_title(); ?></h1>
      <?php if (get_the_excerpt()) : ?>
        <p class="hero__subtitle"><?php the_excerpt(); ?></p>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</section>

<?php if ($is_hub || $page_type === 'hub') : ?>

  <!-- CAREERS HUB PAGE -->
  
  SECTION: Pay & Benefits
  <section class="careers-pay" aria-labelledby="careers-pay-heading">
    <div class="container">
      <h2 id="careers-pay-heading" class="section-heading">What you actually get</h2>
      <div class="card-grid card-grid--3">
        <div class="pricing-card">
          <h3>Pay</h3>
          <div class="pricing-card__price">£13.50+<span>/hour</span></div>
          <ul>
            <li>Travel time paid</li>
            <li>Mileage at 45p/mile</li>
            <li>Weekend enhanced rates</li>
          </ul>
        </div>
        <div class="pricing-card">
          <h3>Contract</h3>
          <div class="pricing-card__price">Permanent</div>
          <ul>
            <li>No zero-hours</li>
            <li>Hours confirmed monthly</li>
            <li>28 days holiday</li>
          </ul>
        </div>
        <div class="pricing-card">
          <h3>Support</h3>
          <div class="pricing-card__price">Full</div>
          <ul>
            <li>Paid training (in-house)</li>
            <li>NVQ/Diploma support</li>
            <li>Regular supervisions</li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  
  SECTION: Quick links to sub-pages
  - Why Join Us → /careers/why-join-us
  - What a Typical Day Looks Like → /careers/typical-day
  - Training & Development → /careers/training
  - Current Jobs → /careers/jobs
  - Apply Now → /careers/apply

  SECTION: "You're More Ready Than You Think"
  Two-column: "Never done care work?" vs "Experienced carer?"
  Both lead to /careers/apply

<?php elseif ($page_type === 'jobs') : ?>

  <!-- JOBS PAGE -->
  
  SECTION: CV Minder embed OR manual job listings
  <?php if (get_theme_mod('ccs_use_cvminder', false)) : ?>
    <section class="careers-jobs">
      <div class="container">
        <h2 class="section-heading">Current Vacancies</h2>
        <div class="cvm-embed" id="cvm_content">
          <iframe
            id="cvm_jobframe"
            name="cvm_jobframe"
            src="<?php echo esc_url(get_theme_mod('ccs_cvminder_url', 'https://cvminder.com/jobportal/index.php?gid=60&pk=2347289374823605326759060200713')); ?>"
            allowtransparency="true"
            frameborder="0"
            marginwidth="0"
            marginheight="0"
            scrolling="auto"
            title="Jobs posted by CV Minder"
            style="width: 100%; min-height: 600px;"
          ></iframe>
        </div>
      </div>
    </section>
  <?php else : ?>
    <!-- Manual job listings from ACF repeater -->
    <?php if (have_rows('current_jobs')) : ?>
      <section class="careers-jobs">
        <div class="container">
          <h2 class="section-heading">Current Vacancies</h2>
          <?php while (have_rows('current_jobs')) : the_row(); ?>
            <div class="job-card">
              <h3 class="job-card__title"><?php echo esc_html(get_sub_field('job_title')); ?></h3>
              <div class="job-card__meta">
                <?php if (get_sub_field('location')) : ?><span>📍 <?php echo esc_html(get_sub_field('location')); ?></span><?php endif; ?>
                <?php if (get_sub_field('hours')) : ?><span>⏰ <?php echo esc_html(get_sub_field('hours')); ?></span><?php endif; ?>
                <?php if (get_sub_field('salary')) : ?><span>💰 <?php echo esc_html(get_sub_field('salary')); ?></span><?php endif; ?>
              </div>
              <div class="job-card__description"><?php echo wp_kses_post(get_sub_field('description')); ?></div>
              <a href="/careers/apply" class="button button--primary">Apply for this role</a>
            </div>
          <?php endwhile; ?>
        </div>
      </section>
    <?php else : ?>
      <!-- No current vacancies fallback -->
      <section class="careers-jobs">
        <div class="container">
          <h2 class="section-heading">Current Vacancies</h2>
          <p>We don't have specific vacancies listed right now, but we're always interested in hearing from good people.</p>
          <a href="/careers/apply" class="button button--primary">Send us your details</a>
          <a href="/contact" class="button button--outline">Or get in touch</a>
        </div>
      </section>
    <?php endif; ?>
  <?php endif; ?>

<?php else : ?>

  <!-- ALL OTHER CAREER PAGES (why-join-us, typical-day, training, apply) -->
  <section class="careers-content">
    <div class="container">
      <?php the_content(); ?>
    </div>
  </section>
  
  <?php
  // ACF sections if populated
  if (get_field('section_hero_content')) : ?>
    <section class="careers-section"><div class="container"><?php the_field('section_hero_content'); ?></div></section>
  <?php endif;
  
  if (get_field('section_main_content')) : ?>
    <section class="careers-section"><div class="container"><?php the_field('section_main_content'); ?></div></section>
  <?php endif;
  ?>

<?php endif; ?>

<!-- BOTTOM CTA (all career pages) -->
<section class="page-cta">
  <div class="container">
    <h2>Ready to find out more?</h2>
    <p>Call <?php echo esc_html(ccs_get_contact_info()['phone']); ?> for an informal chat, or apply online.</p>
    <a href="/careers/apply" class="button button--primary">Apply Now</a>
    <a href="tel:<?php echo esc_attr(ccs_get_contact_info()['phone_link']); ?>" class="button button--outline">Call Us</a>
  </div>
</section>

<?php get_footer(); ?>

WordPress coding standards, tab indentation.
```

---

## PROMPT 18: Process, Guide & Remaining Templates

**Skills:** `wp-plugin-development`, `frontend-design`

```
Create these template files for the CCS WordPress theme:

FILE 1: single-process.php — How It Works pages

<?php get_header(); ?>

<?php
$is_hub = get_field('is_hub');
$step_number = get_field('step_number');
?>

<?php if ($is_hub) : ?>

  <!-- HUB PAGE: How It Works overview -->
  <section class="hero hero--process">
    <div class="container">
      <h1 class="hero__title">How It Works</h1>
      <p class="hero__subtitle">From first call to first visit — usually 7-10 days. Here's what happens.</p>
    </div>
  </section>
  
  <section class="process-timeline">
    <div class="container">
      <?php
      // Query all process posts ordered by step_number
      $steps = new WP_Query(array(
        'post_type' => 'ccs_process',
        'posts_per_page' => -1,
        'meta_key' => 'step_number',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array(
          array('key' => 'is_hub', 'value' => '1', 'compare' => '!='),
        ),
      ));
      
      if ($steps->have_posts()) : while ($steps->have_posts()) : $steps->the_post(); ?>
        <div class="timeline-step">
          <span class="timeline-step__number"><?php the_field('step_number'); ?></span>
          <div class="timeline-step__content">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p><?php the_excerpt(); ?></p>
            <?php if (get_field('estimated_duration')) : ?>
              <span class="timeline-step__duration"><?php the_field('estimated_duration'); ?></span>
            <?php endif; ?>
          </div>
        </div>
      <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>
  </section>

<?php else : ?>

  <!-- INDIVIDUAL STEP PAGE -->
  <section class="hero hero--process">
    <div class="container">
      <?php if ($step_number) : ?><span class="hero__step-badge">Step <?php echo esc_html($step_number); ?></span><?php endif; ?>
      <h1 class="hero__title"><?php the_title(); ?></h1>
      <?php if (get_field('estimated_duration')) : ?>
        <p class="hero__subtitle"><?php the_field('estimated_duration'); ?></p>
      <?php endif; ?>
    </div>
  </section>
  
  <!-- Content sections from ACF: overview, what_happens, what_you_need, how_long, whats_next -->
  <div class="container process-content">
    <?php foreach (['section_overview', 'section_what_happens', 'section_what_you_need', 'section_how_long', 'section_whats_next'] as $field) : ?>
      <?php if (get_field($field)) : ?>
        <section class="content-section">
          <?php the_field($field); ?>
        </section>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
  
  <!-- Prev/Next step navigation -->
  <nav class="step-nav">
    <div class="container">
      <!-- Query previous and next process posts by step_number -->
    </div>
  </nav>

<?php endif; ?>

<section class="page-cta">
  <div class="container">
    <h2>Ready to get started?</h2>
    <p>The first step is a quick phone call. No obligation, no pressure.</p>
    <a href="/contact" class="button button--primary">Get in Touch</a>
  </div>
</section>

<?php get_footer(); ?>


FILE 2: single-guide.php — Resource guides

<?php get_header(); ?>

<article class="guide-article">

  <section class="hero hero--guide">
    <div class="container">
      <h1 class="hero__title"><?php the_title(); ?></h1>
      <div class="guide-meta">
        <?php if (get_field('reading_time')) : ?>
          <span class="guide-meta__item">📖 <?php the_field('reading_time'); ?> min read</span>
        <?php endif; ?>
        <?php if (get_field('last_reviewed')) : ?>
          <span class="guide-meta__item">Last reviewed: <?php the_field('last_reviewed'); ?></span>
        <?php endif; ?>
        <?php if (get_field('author_credentials')) : ?>
          <span class="guide-meta__item"><?php the_field('author_credentials'); ?></span>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <div class="container guide-layout">
    <div class="guide-layout__content">
      <!-- ACF sections or main content -->
      <?php the_content(); ?>
      
      <?php if (get_field('section_key_takeaways')) : ?>
        <div class="guide-takeaways">
          <h2>Key Takeaways</h2>
          <?php the_field('section_key_takeaways'); ?>
        </div>
      <?php endif; ?>
      
      <?php if (get_field('section_next_steps')) : ?>
        <div class="guide-next-steps">
          <h2>Next Steps</h2>
          <?php the_field('section_next_steps'); ?>
        </div>
      <?php endif; ?>
      
      <!-- FAQs (ACF repeater) -->
      <?php if (have_rows('faqs')) : ?>
        <div class="guide-faqs">
          <h2>Frequently Asked Questions</h2>
          <?php while (have_rows('faqs')) : the_row(); ?>
            <?php get_template_part('template-parts/faq-item'); ?>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </div>
    
    <aside class="guide-layout__sidebar">
      <!-- Related guides -->
      <!-- CTA: Need help? Call us -->
    </aside>
  </div>

</article>

<section class="page-cta">
  <div class="container">
    <h2>Need more help?</h2>
    <p>Our team can answer your questions. Call <?php echo esc_html(ccs_get_contact_info()['phone']); ?>.</p>
    <a href="/contact" class="button button--primary">Contact Us</a>
  </div>
</section>

<?php get_footer(); ?>


FILE 3: template-parts/faq-item.php
<details class="faq-item">
  <summary class="faq-item__question"><?php echo esc_html(get_sub_field('question')); ?></summary>
  <div class="faq-item__answer"><?php echo wp_kses_post(get_sub_field('answer')); ?></div>
</details>


FILE 4: page-contact.php (Template Name: Contact)
Standard contact page with:
- Contact form (name, email, phone, message, service interest dropdown)
- Sidebar with phone, email, address, map
- Form submits via AJAX to form_submission CPT


FILE 5: page-about.php (Template Name: About Us)  
Standard about page using the_content() with optional ACF sections.


FILE 6: page.php — Default page template
Simple: hero with title, then the_content(), then page CTA.


FILE 7: single.php — Single news/blog post
Standard blog post layout with featured image, date, content, prev/next.


FILE 8: index.php — Blog archive / fallback
News & Updates listing with card grid, pagination.


FILE 9: 404.php — 404 page
Friendly "Page not found" with:
- Search form
- Links to key pages (Services, Pricing, Contact, Careers)
- Phone number CTA

WordPress coding standards, tab indentation.
```

---

## PROMPT 19: ACF Field Groups (JSON Export)

**Skills:** `wp-plugin-development`

```
Create ACF Pro field group JSON files in the acf-json/ directory. These will be auto-synced by ACF when placed in this folder.

Create these field groups as PHP registration using acf_add_local_field_group() in a new file inc/acf-fields.php (this is more reliable than JSON for version control and works without the acf-json folder):

FIELD GROUP 1: "Service Details" — Show on: ccs_service post type
Fields:
- is_pillar (true_false, label: "Is Pillar Page?", default: 0)
- parent_service (post_object, label: "Parent Service", post_type: ccs_service, conditional: is_pillar == 0)
- pricing_range (text, label: "Pricing Range", placeholder: "£28-32/hour")
- section_what_is (wysiwyg, label: "What It Is", tabs: all, media_upload: yes)
- section_who_for (wysiwyg, label: "Who It's For")
- section_typical_visit (wysiwyg, label: "What a Visit Looks Like")
- section_scheduling (wysiwyg, label: "Scheduling")
- section_costs (wysiwyg, label: "What It Costs")
- local_areas_served (textarea, label: "Local Areas Served", conditional: is_pillar == 0)
- local_partnerships (wysiwyg, label: "Local Partnerships", conditional: is_pillar == 0)
- local_testimonials (repeater, label: "Local Testimonials", conditional: is_pillar == 0):
  - testimonial_name (text)
  - testimonial_quote (textarea)
  - testimonial_photo (image, return: url, preview: thumbnail)

FIELD GROUP 2: "Condition Details" — Show on: ccs_condition
Fields:
- condition_category (select: Neurological, Physical, Developmental, Progressive, Other)
- medical_code (text, label: "ICD-10 Code")
- alternate_names (text, label: "Alternate Names")
- last_reviewed (date_picker, label: "Last Reviewed")
- section_what_is (wysiwyg)
- section_progression (wysiwyg, label: "How It Progresses")
- section_daily_life (wysiwyg, label: "Daily Life")
- section_how_care_helps (wysiwyg, label: "How Care Helps")
- section_our_approach (wysiwyg, label: "Our Approach")
- section_training (wysiwyg, label: "Our Training")
- external_resources (repeater):
  - link_text (text)
  - url (url)
  - organization (text)

FIELD GROUP 3: "Location Details" — Show on: ccs_location
Fields:
- location_type (select: county, town, neighborhood)
- coordinates (text, placeholder: "51.2720, 0.5180")
- postal_codes (textarea, label: "Postal Codes Covered")
- section_introduction (wysiwyg)
- section_areas_covered (wysiwyg)
- section_services (wysiwyg)
- section_local_context (wysiwyg)
- section_why_local (wysiwyg)
- show_map (true_false, label: "Show Map?")
- map_embed_code (textarea, label: "Map Embed Code", conditional: show_map == 1)

FIELD GROUP 4: "Guide Details" — Show on: ccs_guide
Fields:
- reading_time (number, label: "Reading Time (minutes)")
- last_reviewed (date_picker)
- author_credentials (text)
- section_introduction (wysiwyg)
- section_key_takeaways (wysiwyg)
- section_next_steps (wysiwyg)
- faqs (repeater):
  - question (text)
  - answer (wysiwyg)

FIELD GROUP 5: "Process Details" — Show on: ccs_process
Fields:
- is_hub (true_false)
- step_number (number, conditional: is_hub == 0)
- estimated_duration (text, conditional: is_hub == 0)
- section_overview (wysiwyg)
- section_what_happens (wysiwyg)
- section_what_you_need (wysiwyg)
- section_how_long (wysiwyg)
- section_whats_next (wysiwyg)

FIELD GROUP 6: "Career Details" — Show on: ccs_career
Fields:
- is_hub (true_false)
- page_type (select: hub, why-join-us, typical-day, training, jobs, apply)
- section_hero_content (wysiwyg)
- section_main_content (wysiwyg)
- section_pay_benefits (wysiwyg)
- current_jobs (repeater, conditional: page_type == jobs):
  - job_title (text)
  - location (text)
  - hours (text)
  - salary (text)
  - description (wysiwyg)

FIELD GROUP 7: "Team Member" — Show on: ccs_team
Fields:
- first_name (text)
- role (select: Carer, Senior Carer, Team Leader, Care Coordinator, Registered Manager, Admin)
- tenure_years (number)
- qualifications (textarea)
- specialisms (checkbox: Dementia, Epilepsy, Autism, Learning Disabilities, Parkinson's, Stroke, Physical Disabilities, Mental Health, End of Life)

FIELD GROUP 8: "SEO Settings" — Show on: all post types and pages
Fields:
- ccs_meta_title (text, label: "SEO Title Override", placeholder: "Leave blank for auto-generated")
- ccs_meta_description (textarea, label: "Meta Description", maxlength: 160)
- ccs_meta_robots (select: index follow, noindex follow, index nofollow, noindex nofollow, default: index follow)
- ccs_canonical_url (url, label: "Canonical URL Override")
- ccs_og_image (image, label: "Social Share Image")

Register all field groups using acf_add_local_field_group() with proper keys (group_ccs_service_details, etc.). 
Include if (function_exists('acf_add_local_field_group')) check.
WordPress coding standards, tab indentation.
```

---

## PROMPT 20: Contact Form Handler

**Skills:** `wp-plugin-development`, `backend-security-coder`

```
Create inc/form-handler.php for the CCS WordPress theme.

This handles the contact form submission on page-contact.php. No plugin needed — custom AJAX handler that saves to the form_submission CPT.

FUNCTIONS:

1. ccs_register_form_scripts() — Enqueue form JS only on contact page
   Localize with: ajax_url, nonce, success_message, error_message

2. ccs_handle_contact_form() — AJAX handler (wp_ajax and wp_ajax_nopriv)
   - Verify nonce
   - Sanitize inputs: name, email, phone, message, service_interest
   - Validate: name required, email required + valid, message required
   - Create form_submission post:
     Title: "[Name] — [Date]"
     Post meta: _form_name, _form_email, _form_phone, _form_message, _form_service, _form_ip, _form_user_agent
   - Assign form_type taxonomy: 'contact'
   - Send notification email to office@continuitycareservices.co.uk (or from Customizer)
   - Return JSON success/error response

3. Email notification format:
   Subject: "New contact form submission from {name}"
   Body: Plain text with all form fields
   From: noreply@{domain}
   Reply-To: {submitted email}

4. GDPR: Store IP and user agent but include a note in the form about data processing.

5. Rate limiting: Store a transient keyed by IP, limit to 5 submissions per hour.

Also create the contact form HTML for page-contact.php as a template part (template-parts/contact-form.php):
- Name (text, required)
- Email (email, required)
- Phone (tel, optional)
- Service interest (select: Domiciliary Care, Complex Care, Respite Care, General Enquiry, Careers Query)
- Message (textarea, required)
- Consent checkbox: "I consent to CCS storing this information to respond to my enquiry. See our Privacy Policy."
- Submit button: "Send Message"
- Honeypot field (hidden, for spam)

All validation both client-side (HTML5 + JS) and server-side (PHP).

WordPress coding standards, tab indentation.
```

---

## PROMPT 21: Admin Columns & Dashboard

**Skills:** `wp-plugin-development`

```
Create inc/admin-columns.php for the CCS WordPress theme.

Add custom admin columns to make the WordPress admin more usable for non-technical staff.

1. SERVICES admin columns:
   - Title (default)
   - Service Type (taxonomy)
   - Towns (taxonomy)
   - Is Pillar? (ACF field — show ✓ or —)
   - Pricing Range (ACF field)
   Make sortable by Service Type.

2. CONDITIONS admin columns:
   - Title
   - Category (ACF field)
   - Last Reviewed (ACF field)

3. LOCATIONS admin columns:
   - Title
   - Location Type (ACF field)
   - Parent (hierarchical parent)

4. TEAM admin columns:
   - Name (title)
   - Role (ACF)
   - Years (ACF tenure)
   - Specialisms (ACF)
   - Photo (thumbnail)

5. CAREERS admin columns:
   - Title
   - Page Type (ACF)
   - Is Hub? (ACF)

6. FORM SUBMISSIONS admin columns:
   - Date
   - Name (from meta _form_name)
   - Email (from meta _form_email)
   - Service Interest (from meta _form_service)
   - Message Preview (first 50 chars of _form_message)

Also add a simple dashboard widget (ccs_dashboard_widget) showing:
- Recent form submissions (last 5)
- Quick links: Add Service, Add Condition, Add Guide, View Team
- Site context reminder: "Your site has TWO navigation modes: Care and Careers"

WordPress coding standards, tab indentation.
```

---

## PROMPT 22: Complete CSS Stylesheet

**Skills:** `frontend-design`, `web-performance-optimization`

```
Create assets/css/main.css for the CCS WordPress theme.

This is the COMPLETE stylesheet. Mobile-first responsive design.

DESIGN PRINCIPLES:
- Clean, warm, professional. Not clinical.
- Purple (#564298) used SPARINGLY — one primary CTA per view
- Teal (#a8ddd4) and cream (#f6f5ef) carry most of the layout
- Plenty of whitespace
- WCAG 2.1 AA contrast ratios (minimum 4.5:1)
- No harsh shadows — subtle, warm

CSS CUSTOM PROPERTIES (at :root):
All the colour variables from BRAND REFERENCE above, plus:
--ccs-font-heading: 'Poppins', sans-serif
--ccs-font-body: 'Open Sans', sans-serif
--ccs-radius: 8px
--ccs-radius-lg: 12px
--ccs-shadow: 0 2px 8px rgba(0, 0, 0, 0.08)
--ccs-shadow-hover: 0 4px 16px rgba(0, 0, 0, 0.12)
--ccs-container: 1200px
--ccs-container-lg: 1400px
--ccs-space-xs: 0.5rem
--ccs-space-sm: 1rem
--ccs-space-md: 2rem
--ccs-space-lg: 4rem
--ccs-space-xl: 6rem
--ccs-transition: 0.2s ease

SECTIONS TO STYLE (in order):

1. RESET & BASE
   - Box-sizing border-box
   - Smooth scrolling (prefers-reduced-motion: reduce turns off)
   - Body: font-family var(--ccs-font-body), color var(--ccs-text), bg var(--ccs-bg-warm), font-size 16px, line-height 1.6

2. TYPOGRAPHY
   - h1: 2.5rem, Poppins 700, line-height 1.2
   - h2: 2rem, Poppins 600
   - h3: 1.5rem, Poppins 600
   - h4: 1.25rem, Poppins 600
   - p: 1rem, margin-bottom 1rem
   - a: color var(--ccs-primary), underline on hover
   - .section-heading: centered, with subtle bottom border accent
   - .section-subheading: text-light, centered

3. LAYOUT
   - .container: max-width var(--ccs-container), margin auto, padding 0 1.5rem
   - .container--lg: max-width var(--ccs-container-lg)
   - Section padding: var(--ccs-space-lg) 0

4. SKIP LINK & SCREEN READER
   - .skip-link: offscreen, visible on focus
   - .screen-reader-text: sr-only pattern

5. TOP BAR
   - Background: var(--ccs-primary-dark)
   - Text: white
   - Font size: 0.85rem
   - Flexbox: space-between
   - Hide on mobile (display none below 768px)

6. SITE HEADER
   - Background: white
   - Sticky: position sticky, top 0, z-index 100
   - Box shadow on scroll (via JS adding .scrolled class)
   - Flexbox inner: logo left, nav center, actions right
   - Logo max-height: 60px

7. NAVIGATION
   - .site-nav__list: flexbox, gap 0
   - .site-nav__list a: padding 0.75rem 1rem, font-weight 500, no underline
   - Hover: color var(--ccs-primary), bottom border accent
   - Current page: bold, bottom border var(--ccs-primary)
   - Dropdown: absolute, white bg, shadow, border-radius

8. NAV SWITCH BUTTON
   - .nav-switch: background var(--ccs-secondary), color var(--ccs-text), padding, border-radius pill
   - Hover: background var(--ccs-secondary-dark)
   - In careers context: background var(--ccs-primary), color white

9. PHONE CTA (header)
   - .nav-phone: no underline, font-weight 600
   - Number in var(--ccs-primary), label smaller text

10. MOBILE MENU
    - Hidden by default (transform translateX(100%))
    - Full screen overlay on mobile
    - .mobile-menu--open: transform translateX(0)
    - Burger icon: 3 lines → X animation

11. BREADCRUMBS
    - .breadcrumbs-bar: bg var(--ccs-bg-warm), padding var(--ccs-space-xs) 0
    - Font size 0.85rem, color var(--ccs-text-light)
    - Separators: ›

12. BUTTONS
    - .button: inline-flex, padding 0.75rem 1.5rem, border-radius var(--ccs-radius), font-weight 600, transition
    - .button--primary: bg var(--ccs-primary), color white. Hover: bg var(--ccs-primary-light)
    - .button--secondary: bg var(--ccs-secondary), color var(--ccs-text). Hover: bg var(--ccs-secondary-dark)
    - .button--outline: border 2px solid var(--ccs-primary), color var(--ccs-primary), bg transparent. Hover: bg var(--ccs-primary), color white
    - .button--lg: larger padding, font-size 1.1rem
    - .button--sm: smaller padding, font-size 0.85rem

13. HERO SECTIONS
    - .hero: padding var(--ccs-space-xl) 0, bg var(--ccs-bg-warm)
    - .hero--home: larger padding, centered text
    - .hero__title: h1 styling
    - .hero__subtitle: text-light, max-width 600px
    - .hero__ctas: flex gap

14. CARDS
    - .card: bg white, border-radius var(--ccs-radius-lg), shadow, overflow hidden, transition
    - .card:hover: shadow-hover, slight translateY(-2px)
    - .card__image: aspect-ratio 3/2, overflow hidden
    - .card__body: padding var(--ccs-space-md)
    - .card__title: h3, no margin-top
    - .card__excerpt: text-light
    - .card__link: color var(--ccs-primary), font-weight 600
    - .card-grid: CSS Grid
    - .card-grid--2: 2 columns
    - .card-grid--3: 3 columns
    - .card-grid--4: 4 columns
    - All collapse to 1 column on mobile

15. ICON CARDS
    - .icon-card: text-center, padding var(--ccs-space-md)
    - .icon-card__icon: large font size, color var(--ccs-primary)

16. PRICING CARDS
    - .pricing-card: border, padding, text-center
    - .pricing-card--featured: border-color var(--ccs-primary), shadow, scale(1.02)
    - .pricing-card__price: font-size 2.5rem, color var(--ccs-primary), Poppins 700
    - .pricing-card__price span: font-size 1rem, color text-light

17. PROCESS STEPS
    - .process-steps: flexbox or grid, 4 columns
    - .process-step__number: circle, 50px, bg var(--ccs-primary), color white, centered number
    - Connected by dashed line between steps

18. BREAKDOWN BARS (pricing page)
    - .breakdown-bar: flexbox
    - .breakdown-bar__fill: bg gradient from var(--ccs-primary) to var(--ccs-secondary), height 40px, border-radius
    - Percentage text inside bar

19. TEAM GRID
    - .team-grid: CSS Grid, auto-fill minmax(250px, 1fr)
    - .card--team image: aspect-ratio 1/1, object-fit cover
    - .card__role: text-light, font-style italic
    - .tag: small pill, bg var(--ccs-secondary-light), color text

20. STAT GRID
    - .stat-grid: flexbox, centered
    - .stat__number: font-size 3rem, color var(--ccs-primary), Poppins 700
    - .stat__label: text-light

21. TIMELINE (process hub)
    - .timeline-step: flex, with left border line
    - .timeline-step__number: circle on the line

22. JOB CARDS
    - .job-card: border-left 4px solid var(--ccs-primary), padding, margin-bottom
    - .job-card__meta: flex gap, smaller text, icons

23. GUIDE LAYOUT
    - .guide-layout: grid, 2fr 1fr (content + sidebar)
    - .guide-meta: flex gap, small text, top of article

24. FAQ ITEMS
    - details/summary pattern
    - .faq-item: border-bottom
    - summary: cursor pointer, padding, font-weight 600
    - summary::marker or ::-webkit-details-marker styled
    - Open state: subtle bg

25. FORMS
    - input, textarea, select: width 100%, padding 0.75rem, border 1px solid var(--ccs-border), border-radius var(--ccs-radius), font-family inherit
    - Focus: border-color var(--ccs-primary), box-shadow 0 0 0 3px rgba(86,66,152,0.15)
    - Labels: font-weight 500, margin-bottom 0.25rem
    - Error state: border-color var(--ccs-urgent)

26. PAGE CTA SECTION
    - .page-cta: bg var(--ccs-primary), color white, text-center, padding var(--ccs-space-lg) 0
    - .page-cta h2: color white
    - .page-cta .button--primary: bg white, color var(--ccs-primary) (inverted)
    - .page-cta--careers: bg var(--ccs-secondary) instead

27. FOOTER
    - .site-footer: bg var(--ccs-text), color white, padding var(--ccs-space-lg) 0
    - .site-footer__grid: CSS Grid, 4 columns
    - Links: color rgba(255,255,255,0.8), hover white
    - .site-footer__heading: font-size 1.1rem, margin-bottom 1rem, color white
    - .site-footer__social a: inline-flex, 40px circle, bg rgba(255,255,255,0.1), hover bg primary
    - .site-footer__bottom: border-top rgba(255,255,255,0.1), padding-top 1.5rem, flex space-between
    - Footer collapses to 1 column on mobile

28. CQC WIDGET SECTION
    - .home-cqc: bg white, text-center, padding
    - Heading: section-heading style

29. CV MINDER EMBED
    - .cvm-embed iframe: width 100%, min-height 600px, border none

30. UTILITY CLASSES
    - .text-center, .text-left, .text-right
    - .visually-hidden (sr-only)
    - .mb-0, .mt-0, .py-lg, etc.

31. RESPONSIVE BREAKPOINTS
    - Mobile first (base styles = mobile)
    - @media (min-width: 768px) — tablet
    - @media (min-width: 1024px) — desktop
    - Key responsive changes: nav horizontal, grids expand, hero padding increases, footer grid, sidebar appears

32. PRINT STYLES
    - @media print: hide header, footer, nav, buttons. Clean typography.

33. REDUCED MOTION
    - @media (prefers-reduced-motion: reduce): disable transitions, smooth scroll

This CSS should be COMPLETE and production-ready. Use the exact colour values from the brand reference. The overall feel should be warm, trustworthy, and professional — like a calm, reassuring neighbour, not a corporate healthcare company.
```

---

## PROMPT 23: JavaScript Functionality

**Skills:** `frontend-design`, `modern-javascript-patterns`

```
Create assets/js/main.js for the CCS WordPress theme.

'use strict';

FUNCTIONALITY:

1. MOBILE MENU TOGGLE
   - Burger button toggles .mobile-menu--open on #mobile-menu
   - Update aria-expanded on button
   - Update aria-hidden on menu
   - Close menu on Escape key
   - Close menu when clicking outside
   - Lock body scroll when menu open (add .menu-open to body)
   - Trap focus within mobile menu when open

2. STICKY HEADER
   - Add .scrolled class to .site-header when scrolled > 50px
   - Use requestAnimationFrame or passive scroll listener for performance

3. SMOOTH SCROLL
   - For anchor links (href starting with #)
   - Account for sticky header height offset
   - Respect prefers-reduced-motion

4. DROPDOWN MENUS (desktop)
   - On hover/focus: show sub-menu
   - Keyboard accessible: arrow keys navigate
   - Close on Escape
   - Close when focus leaves

5. FAQ ACCORDION (details/summary)
   - Optional: close other FAQs when one opens (accordion behaviour)
   - Add smooth open/close animation with CSS

6. HEADER SCROLL BEHAVIOUR
   - Shrink header slightly on scroll
   - Show/hide header on scroll direction (hide on scroll down, show on scroll up)
   - Always show on hover

7. CONTEXT SWITCH ANIMATION
   - When clicking nav switch button, add brief transition class

8. FORM VALIDATION (for contact form)
   - Client-side validation before AJAX submit
   - Show inline error messages
   - Disable submit button during AJAX request
   - Show success/error message after submission
   - Clear form on success

9. LAZY LOADING ENHANCEMENT
   - Add loading="lazy" to images not in viewport
   - Intersection Observer for any custom lazy-load needs

10. EXTERNAL LINKS
    - Auto-add target="_blank" and rel="noopener noreferrer" to external links
    - Add visual indicator (small icon)

11. PHONE NUMBER FORMATTING
    - Ensure tel: links work on mobile
    - Track phone clicks as events (if analytics present)

Keep it vanilla JS — no jQuery dependency.
Use event delegation where possible.
All event listeners added in DOMContentLoaded.
```

---

## PROMPT 24: Template Parts & Final Polish

**Skills:** `wp-plugin-development`, `frontend-design`, `readme`

```
Create the remaining template parts and do final integration for the CCS WordPress theme.

TEMPLATE PARTS:

1. template-parts/hero.php — Reusable hero section
   Parameters via set_query_var/get_query_var or $args:
   - title (required)
   - subtitle (optional)
   - class modifier (optional)
   - show_ctas (optional, boolean)
   
2. template-parts/cta-block.php — Reusable page CTA
   Parameters:
   - heading
   - text
   - button_text
   - button_url
   - style ('default' = purple bg, 'careers' = teal bg, 'light' = cream bg)

3. template-parts/testimonial.php — Single testimonial display
   Uses $args or get_sub_field():
   - name
   - quote
   - photo (optional)

4. template-parts/cqc-widget.php — CQC section
   Conditional on !get_theme_mod('ccs_hide_cqc_widget')
   Uses ccs_get_cqc_id()
   Exact markup from CQC-WIDGET.md reference

5. template-parts/card-service.php — already created, verify it exists
6. template-parts/card-condition.php — already created, verify
7. template-parts/card-team.php — already created, verify
8. template-parts/faq-item.php — already created, verify

FINAL INTEGRATION:

9. Update functions.php to require all inc/ files in correct order:
   - theme-setup.php
   - theme-helpers.php
   - customizer.php
   - post-types.php
   - taxonomies.php
   - custom-rewrites.php
   - nav-context.php
   - breadcrumbs.php
   - schema-output.php
   - seo.php
   - acf-fields.php
   - form-handler.php
   - admin-columns.php

10. Verify all template files reference the correct ACF field names consistently.

11. Add theme screenshot.png placeholder (just create a simple one or add a comment about it).

12. Add theme activation hook that:
    - Flushes rewrite rules
    - Creates default taxonomy terms
    - Creates a "Home" page (if not exists) and sets it as front page
    - Creates key pages: Services, Pricing, How It Works, About, Contact, Team, Careers
    - Sets permalink structure to /%postname%/

13. Add a README.md in the theme root with:
    - Setup instructions
    - Required plugins (ACF Pro)
    - Theme structure overview
    - How the dual navigation works
    - How to add new services, locations, conditions
    - How to manage careers/jobs

WordPress coding standards, tab indentation.
Make sure everything is wired up and ready to activate.
```

---

## POST-BUILD CHECKLIST

After running all 24 prompts, verify:

- [ ] Theme activates without errors
- [ ] ACF field groups appear in admin
- [ ] CPTs show in admin sidebar
- [ ] Taxonomies show in admin
- [ ] Homepage loads with dual CTAs
- [ ] Navigation switches between care/careers context
- [ ] Breadcrumbs display correctly
- [ ] Schema markup outputs in page source (check with Google's Rich Results Test)
- [ ] URLs: /services/domiciliary-care loads correctly
- [ ] URLs: /domiciliary-care/maidstone loads (after creating content)
- [ ] Pricing page displays pricing cards
- [ ] Contact form submits and creates form_submission post
- [ ] CQC widget loads on homepage
- [ ] CV Minder iframe loads on careers/jobs page
- [ ] Mobile menu opens/closes
- [ ] Site passes WAVE accessibility check (basic)
- [ ] Lighthouse score > 90 on performance

---

## CONTENT ENTRY ORDER (after theme is built)

1. Create pillar service posts: Domiciliary Care, Complex Care, Respite Care
2. Create the How It Works hub + 4 step pages
3. Create the Careers hub + sub-pages
4. Create location: Kent (county), Maidstone (town)
5. Create location-specific services: domiciliary-care/maidstone, etc.
6. Create condition pages: Dementia, Epilepsy, Autism
7. Add team members
8. Create first guide: "How to Arrange Home Care in Kent"
9. Expand to additional towns
10. Expand to additional conditions
