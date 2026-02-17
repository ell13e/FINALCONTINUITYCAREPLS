# Task Plan: Tailor website to CCS brand + WordPress block theme (PHP)

<!--
  WHAT: Roadmap for branding the site and building/adapting a block theme.
  WHY: Keeps goals and phases visible across many tool calls.
  WHEN: Update after each phase completes. Re-read before major decisions.
-->

## Goal

Tailor the **Medcity template** into a WordPress block theme and brand it for Continuity Care Services (colours, typography, logos, contact, messaging). The Medcity HTML theme is the base to convert; deliver a block theme (theme.json, templates, parts, patterns) in PHP following wp-block-themes practices.

## Current Phase

Phase 3: Block theme implementation (foundation in place)

## Phases

### Phase 1: Requirements & Discovery
- [x] Confirm scope: **tailor Medcity template to become** the WordPress block theme (not from scratch)
- [x] Run WP project triage and block-theme detection (detect_wp_project.mjs, detect_block_themes.mjs) once WordPress/theme root is defined
- [x] Inventory brand assets: BRAND-REFERENCE.md, assets/logo, CQC-WIDGET.md, CV-MINDER-EMBED.md
- [x] Use **Documentation/** as reference for Medcity file structure, HTML/CSS/JS (needed for conversion)
- [ ] Document target WordPress version for theme.json schema
- [x] Document findings in findings.md
- **Status:** done

### Phase 2: Planning & Structure
- [x] Define theme root: Medcity directory as base for block theme conversion (add theme.json, templates/, parts/, patterns/)
- [x] Define theme.json version and presets (colours from BRAND-REFERENCE, typography Poppins/Open Sans)
- [x] Plan templates/ (index, front-page, single, page) and parts/ (header, footer)
- [x] Plan patterns: CQC section (CQC-WIDGET.md), Careers/CV Minder embed (CV-MINDER-EMBED.md), hero, contact
- [x] Align with wp-block-themes references (theme.json, templates-and-parts, patterns, debugging)
- **Status:** done

### Phase 3: Block theme implementation
- [x] Add theme.json to (Medcity-based) theme root with CCS palette and typography presets
- [x] Add style.css (theme header) and templates/index.html, parts/header.html, parts/footer.html
- [x] Add patterns/ for CQC widget (ccs-cqc-section.php) and CV Minder careers block (ccs-cv-minder-careers.php)
- [ ] Integrate assets/logo (logo.svg, logo.png) into theme assets and reference in parts
- [x] Implement CQC section (script URL, provider ID 1-2624556588, copy from CQC-WIDGET.md)
- [x] Implement Careers page pattern with CV Minder iframe (CV-MINDER-EMBED.md)
- [x] Apply brand copy in footer (tagline, contact) and patterns from BRAND-REFERENCE
- **Status:** in_progress

### Phase 4: Testing & Verification
- [x] Verify theme detection (detect_block_themes.mjs) and theme.json validity
- [ ] Check Site Editor: presets, styles, templates, patterns in inserter
- [ ] Check front-end: colours, fonts, CQC widget, CV Minder embed (or fallback)
- [ ] Document test results in progress.md; fix issues
- **Status:** pending

### Phase 5: Delivery
- [ ] Review all theme files and reference docs
- [ ] Ensure BRAND-REFERENCE, CQC-WIDGET, CV-MINDER-EMBED are sufficient for future edits
- [ ] Hand off theme and any setup notes to user
- **Status:** pending

## Key Questions

1. ~~New block theme vs convert Medcity?~~ **Answered:** Tailor **Medcity template** to become the block theme.
2. Which WordPress version (or range) should the theme support? (Affects theme.json schema.)
3. Where will the theme run: local only, existing WP install, or new install?
4. Should CQC widget and CV Minder be pattern-only (user inserts) or built into specific templates (e.g. front-page, careers)?

## Decisions Made

| Decision | Rationale |
|----------|-----------|
| Medcity template is the base to convert into the block theme | User confirmed: tailoring Medcity to become the WordPress block theme, not building a new theme from scratch. |

## Errors Encountered

| Error | Attempt | Resolution |
|-------|---------|------------|
| (None yet) | | |

## Notes

- Brand source of truth: **BRAND-REFERENCE.md** (contact, colours, typography, messaging).
- Embed references: **CQC-WIDGET.md** (CQC section + widget script), **CV-MINDER-EMBED.md** (careers iframe + fallback).
- Logos: **assets/logo/logo.svg**, **assets/logo/logo.png** (canonical); theme should reference or copy into theme assets.
- **Documentation/** documents the Medcity template (file structure, HTML/CSS/JS, how to change logo/colors etc.) — **keep it**; use as reference while converting Medcity to block theme.
- Re-read this plan before defining theme root and before adding theme.json presets.
- Follow wp-block-themes skill: theme.json, templates/, parts/, patterns/; run detection scripts when WP/theme exists.
