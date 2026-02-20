# CCS theme — CPT & URL architecture (plugin-free)

Reference for the WordPress theme structure. **No plugins required**: all structured data uses theme meta boxes (`inc/meta-boxes-*.php`), theme mods (Customizer), and native CPT/taxonomies.

**Theme vs backend:** When the **ccs-theme** is active, the **theme** is the single source of truth for the `service` CPT (and for condition, location, guide, process, team). The ccs-backend plugin does *not* register `service` when the theme is active, to avoid duplicate registration. See `docs/THEME-BACKEND.md` for the full theme/backend boundary.

---

## Philosophy

- **Custom Post Types** for each major content category.
- **Section-by-section editing** via native meta boxes with `wp_editor()` (WYSIWYG) per section.
- **Custom taxonomies** for cross-referencing (towns, service types).
- **Clean URL rewrites** to match the SEO structure.
- **Careers** are Pages (e.g. `/careers/`, `/careers/jobs/`) with the **CV Minder** page template for the jobs listing — no career CPT.

---

## Custom Post Types (current)

| CPT        | Slug      | Archive/single URLs              | Hierarchical | Notes                    |
|-----------|-----------|-----------------------------------|-------------|--------------------------|
| Services  | `service` | `/services/{slug}`                | No          | Pillar/location via meta |
| Conditions| `condition` | `/conditions/{slug}`            | No          |                          |
| Locations | `location` | `/locations/{slug}`             | Yes         | County > town            |
| Guides    | `guide`   | `/guides/{slug}`                 | No          |                          |
| Process   | `process` | `/how-it-works/{slug}`           | No          | Step order via meta      |
| Team      | `team`    | `/team/{slug}` (single only)     | No          | No archive               |

**Careers:** Use **Pages** with slugs e.g. `careers`, `why-join-us`, `typical-day`, `training`, `jobs`, `apply`. Assign template **“CV Minder — Jobs”** to the Jobs page. See `CV-MINDER-EMBED.md` and `inc/customizer-cvminder.php`.

---

## Custom taxonomies

| Taxonomy     | Slug          | Object types   | Hierarchical | Use |
|-------------|---------------|----------------|--------------|-----|
| Towns       | `town`        | location, service, team | Yes | Area filtering, cross-linking |
| Service types | `service-type` | service      | Yes          | Domiciliary, Complex, Respite, Palliative |

All registered in `inc/taxonomy-registration.php`. No ACF — assign terms in the standard WP edit screen.

---

## URL rewrites (current)

Handled in `inc/custom-rewrites.php`:

- `^conditions/?$` → condition archive
- `^conditions/page/(n)/?$` → condition archive paged
- `^locations/?$` → location archive
- `^guides/?$` → guide archive  
- `^how-it-works/?$` → process archive

CPT `rewrite` in `cpt-registration.php` gives single URLs (e.g. `/services/domiciliary-care`, `/conditions/dementia`). **Careers** are normal Pages; use parent/child (e.g. parent “Careers”) to get `/careers/jobs/`.

**Optional future (no plugin):**  
- `/areas/{slug}` for locations (change CPT rewrite slug to `areas` and add rules if desired).  
- Service + location pattern `/{service-slug}/{town-slug}` would need custom rewrite rules and a dedicated template that queries by `post_type=service` + `town` term; possible with theme code only.

---

## Section meta keys (by CPT)

Stored as `_ccs_*`; edited via meta boxes. Use these in templates and schema.

**Service** (`meta-boxes-service.php`):  
`_ccs_is_pillar`, `_ccs_pricing_range`, `_ccs_section_what_it_is`, `_ccs_section_who_its_for`, `_ccs_section_typical_visit`

**Condition** (`meta-boxes-condition.php`):  
`_ccs_condition_category`, `_ccs_schema_code`, `_ccs_alt_names`,  
`_ccs_section_what_it_is`, `_ccs_section_progression`, `_ccs_section_daily_life`, `_ccs_section_how_care_helps`, `_ccs_section_our_approach`, `_ccs_section_training`,  
`_ccs_external_resources` (array: link_text, url, organization)

**Location** (`meta-boxes-location.php`):  
`_ccs_location_type`, `_ccs_coordinates`, `_ccs_postal_codes`,  
`_ccs_section_intro`, `_ccs_section_areas_covered`, `_ccs_section_services`, `_ccs_section_local_context`, `_ccs_section_why_local`,  
`_ccs_show_map`, `_ccs_map_embed`

**Guide** (`meta-boxes-guide.php`):  
`_ccs_reading_time`, `_ccs_last_reviewed`, `_ccs_author_credentials`,  
`_ccs_section_intro`, `_ccs_section_main`, `_ccs_section_takeaways`, `_ccs_section_next_steps`,  
`_ccs_faqs` (array: question, answer — used for FAQPage schema)

**Process** (`meta-boxes-process.php`):  
`_ccs_step_number`, `_ccs_is_hub`, `_ccs_duration`,  
`_ccs_section_overview`, `_ccs_section_what_happens`, `_ccs_section_what_you_need`, `_ccs_section_how_long`, `_ccs_section_what_next`

**Team** (`meta-boxes-team.php`):  
`_ccs_first_name`, `_ccs_role`, `_ccs_tenure_years`, `_ccs_qualifications`, `_ccs_specialisms` (array)

---

## Template hierarchy (theme)

- **Service:** `single-service.php` → `single.php`
- **Condition:** `single-condition.php` → `single.php`
- **Location:** `single-location.php` → `single.php`
- **Guide:** `single-guide.php` → `single.php`
- **Process:** `single-process.php` → `single.php`
- **Team:** `page-team.php` (page template that lists team); single: `single-team.php` if present → `single.php`
- **Careers / Jobs:** Page with template **“CV Minder — Jobs”** → `page-cvminder-jobs.php` → `page.php`
- **Static:** `page-pricing.php`, `page-about.php`, etc. → `page.php`

Schema is output in `inc/schema-output.php` from the same meta (no plugin).

---

## Navigation context (dual “site”)

Header/footer switch between **Care** and **Careers** context. Implemented in `inc/navigation.php` via `ccs_get_site_context()`.

- **Careers:** when the current **page slug** is one of: `careers`, `why-join-us`, `typical-day`, `training`, `jobs`, `apply`.
- **Care:** everywhere else.

No CPT check for careers (no career CPT). Use slug-based detection only. In `header.php` / `footer.php`, call `ccs_get_site_context()` and branch nav/CTA (e.g. “Apply now” vs “Book consultation”).

---

## Theme folder structure (relevant)

```
ccs-theme/
├── functions.php
├── header.php, footer.php, index.php, front-page.php
├── page.php, single.php
├── page-cvminder-jobs.php    (CV Minder — Jobs template)
├── page-team.php
├── single-service.php, single-condition.php, single-location.php,
├── single-guide.php, single-process.php, single-team.php
├── inc/
│   ├── cpt-registration.php
│   ├── taxonomy-registration.php
│   ├── custom-rewrites.php
│   ├── customizer-cvminder.php
│   ├── schema-output.php
│   ├── navigation.php
│   ├── meta-boxes-service.php, meta-boxes-condition.php,
│   ├── meta-boxes-location.php, meta-boxes-guide.php,
│   ├── meta-boxes-process.php, meta-boxes-team.php
│   └── ...
└── assets/
```

---

## What this gives you (without plugins)

- Section-by-section editing via native meta boxes and `wp_editor()`.
- Clean URLs for CPTs and careers (Pages + CV Minder).
- Schema from theme meta in `schema-output.php`.
- Taxonomies for towns and service types; cross-reference in templates with `wp_get_post_terms()` / relationship by post ID if needed.
- One place to look for CPT/taxonomy/URL/section naming when adding or changing templates and meta boxes.

**Excluded from this doc:** ACF, Classic Editor plugin, form plugins, SEO plugins, and any other plugin-dependent architecture. The theme achieves the same structure with core WordPress and theme code only.
