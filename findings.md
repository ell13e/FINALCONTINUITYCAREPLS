# Findings & Decisions

<!--
  WHAT: Knowledge base for tailoring the site to CCS brand and block theme work.
  WHEN: Update after discoveries; after every 2 view/browser/search operations (2-Action Rule).
-->

## Requirements

<!-- From user request: tailor website to brand + PHP following wp-block-themes -->

- **Tailor the Medcity template to become** the WordPress block theme (Medcity is the base to convert, not a separate option).
- Apply **CCS (Continuity Care Services) brand** (colours, typography, logos, contact, messaging).
- Use **PHP** and follow **wp-block-themes** practices (theme.json, templates, parts, patterns).
- Plan created using **planning-with-files** (task_plan.md, findings.md, progress.md in project).

## Project state (discovery)

- **No block theme present yet:** No `theme.json` in repo. No `templates/` or `parts/` for a block theme.
- **Existing assets (Medcity = base for conversion):**
  - **medcity/** — HTML/CSS/JS template to be converted into the block theme; many static HTML pages; PHP for contact form (PHPMailer in `medcity/assets/php/`). This directory is the theme base.
  - **Documentation/Documentation/** — **Keep.** Medcity template documentation (file structure, HTML/CSS/JS structure, change logo/colors/fonts etc.). Use as reference while converting Medcity to block theme.
  - **assets/logo/** — Canonical logos: `logo.svg`, `logo.png` (CCS branding).
- **Reference docs in project root:**
  - **BRAND-REFERENCE.md** — Contact (phone, email, address, CQC ID), social URLs + ARIA labels, colour palette (primary/secondary/accent/neutrals/semantic), typography (Poppins, Open Sans), key messaging.
  - **CQC-WIDGET.md** — CQC provider ID `1-2624556588`, profile URL, section copy, widget script URL pattern, markup.
  - **CV-MINDER-EMBED.md** — CV Minder iframe URL (gid/pk params), iframe markup, fallback copy and CTA to contact.
- **Block theme tooling in repo:** `.cursor/skills/wp-block-themes/scripts/detect_block_themes.mjs` and `.cursor/skills/wp-project-triage/scripts/detect_wp_project.mjs` exist; run once a WordPress/theme root is defined.

## Research Findings

- wp-block-themes skill: block theme = `theme.json` + `templates/` and/or `parts/`. Style order: core → theme.json → child → user. Patterns in `patterns/*.php`; style variations in `styles/*.json`.
- theme.json: use **settings** for presets (colours, typography); **styles** for default look. Minimum WP version drives schema version.
- CQC widget: script requires `data-id`, `data-host`, `type=location`; provider ID `1-2624556588` matches BRAND-REFERENCE CQC registration.
- CV Minder: single default iframe URL; fallback = “View our current vacancies…” + Contact us CTA.

## Technical Decisions

| Decision | Rationale |
|----------|-----------|
| Tailor Medcity template into the block theme (not build new theme from scratch) | User confirmed: "tailoring the medcity template to become a WordPress block theme". |
| Keep Documentation/ folder | It documents the Medcity template we're converting; reference for file structure, HTML/CSS/JS during conversion. |

## Issues Encountered

| Issue | Resolution |
|-------|------------|
| (None yet) | |

## Resources

- BRAND-REFERENCE.md (project root)
- CQC-WIDGET.md (project root)
- CV-MINDER-EMBED.md (project root)
- assets/logo/ (project root)
- **Documentation/Documentation/** — Medcity template docs (file structure, HTML/CSS/JS, change logo/colors etc.); keep and use during Medcity → block theme conversion.
- medcity/ — Theme base to convert into block theme.
- .cursor/skills/wp-block-themes/ (procedure, references: theme.json, templates-and-parts, patterns, debugging)
- .cursor/skills/wp-block-themes/scripts/detect_block_themes.mjs (run when theme root exists)
- .cursor/skills/wp-project-triage/scripts/detect_wp_project.mjs (run for WP project triage)

## Visual/Browser Findings

- (None yet; update after any browser/screenshot work.)

---
*Update after every 2 view/browser/search operations.*
