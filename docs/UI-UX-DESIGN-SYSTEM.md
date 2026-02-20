# CCS theme — UI/UX design system (UI/UX Pro Max)

Reference from the UI/UX Pro Max design-system run for **Continuity Care Services**. Used to keep the theme accessible, consistent, and on-pattern.

---

## Design system output (healthcare / care services / accessible)

### Pattern
- **Name:** Trust & Authority + Accessible
- **CTA placement:** Above fold
- **Sections:** Hero > Features > CTA

### Style
- **Name:** Accessible & Ethical
- **Keywords:** High contrast, large text (16px+), keyboard navigation, screen reader friendly, WCAG compliant, focus state, semantic
- **Best for:** Government, healthcare, education, inclusive products, public
- **Accessibility:** WCAG AAA target

### Pro Max colour suggestion (reference only)
| Role       | Hex       |
|-----------|-----------|
| Primary   | #0F172A   |
| CTA       | #0369A1   |
| Background| #F8FAFC   |

**Theme decision:** We keep **BRAND-REFERENCE.md** colours (primary `#564298`, secondary teal, background warm) for brand consistency. Contrast is maintained to ≥4.5:1 for text (WCAG AA).

### Pro Max typography suggestion (reference only)
- **Heading:** Figtree | **Body:** Noto Sans

**Theme decision:** We keep **Poppins** (headings) and **Open Sans** (body) per BRAND-REFERENCE.md and CCS-FRONTEND-SPEC.md.

### Effects to apply
- Clear focus rings (2–4px), ARIA labels, skip links, responsive design, reduced motion, 44×44px touch targets.

### Avoid (anti-patterns)
- Small text (body minimum 16px)
- Complex navigation (keep nav simple and contextual)
- AI purple/pink gradients (use brand purple/teal)

---

## Pre-delivery checklist (applied in theme)

- [x] No emojis as icons (use SVG or text)
- [x] `cursor: pointer` on buttons and clickable controls
- [x] Hover states with smooth transitions (150–300ms)
- [x] Light mode text contrast ≥4.5:1
- [x] Focus states visible for keyboard nav (`:focus-visible`)
- [x] `prefers-reduced-motion` respected
- [x] Responsive breakpoints considered (375, 768, 1024, 1440)
- [x] Form inputs have visible labels and `for`/`id` association
- [x] Icon-only buttons have `aria-label` (e.g. menu toggle)
- [x] Fixed nav has explicit z-index

---

## UX guidelines (from Pro Max ux domain)

- **Form labels:** Use `<label for="id">` or wrap input; no placeholder-only labels.
- **Focus states:** Visible focus ring on interactive elements; no `outline: none` without replacement.
- **ARIA:** `aria-label` for icon-only buttons (e.g. “Toggle menu”).
- **Submit feedback:** Show loading/success/error after form submit.

---

## Visual appeal (Pro Max depth & rhythm)

Applied in `style.css` using **brand colours only**; no palette changes.

- **Depth:** `--shadow-card` and `--shadow-card-hover` for cards, pricing cards, dual-cta blocks, testimonials, FAQ details, page-cta, and where-money-goes. Subtle neutral shadows; no layout shift on hover.
- **Hero:** Gradient from `--background` to `--background-warm`; increased vertical padding at 768px and 1024px.
- **Sections:** Increased section padding at 1024px for rhythm.
- **Headings:** Slight letter-spacing on h1/h2 for presence (0.02em / 0.01em).
- **Reduced motion:** All new box-shadow transitions included in `prefers-reduced-motion` block.

### Aims-style components (inspo applied)

- **Radius tokens:** `--radius-sm` (4px), `--radius-md` (8px), `--radius-lg` (12px). Cards and blocks use `--radius-lg`; images and small controls use `--radius-md`.
- **Section label:** Small uppercase label above a section h2. Use class `.section-label` (e.g. “WHY CONTINUITY CARE” or “◆ OUR STORY”). Optional diamond in markup.
- **Heading accent:** Italic phrase inside headlines. Use `<em>` inside h1/h2 or class `.heading-accent`; styled with primary colour and italic (e.g. “Care that fits *your life*”).
- **Pill CTA:** Header phone/CTA buttons use `border-radius: 2rem`. Optional `.btn-pill` for other pill-shaped buttons.
- **Pill/tag:** `.pill` or `.tag` for category badges, “CQC Registered”, etc. Variants: `.tag--primary`, `.tag--secondary`.
- **Stat block:** `.stat-card` with `.stat-number` (large primary-colour number) and `.stat-label` for “500+ Areas”, “20+ Years” style blocks.
- **Image rounding:** `.card img` and `.featured-image img` use `--radius-md` for soft corners.

---

## Stack (html-tailwind-style) notes

- **Responsive padding:** Container padding scales by breakpoint (e.g. 1rem → 1.5rem → 2rem).
- **Z-index:** Fixed nav and overlays use explicit z-index (e.g. header 100).
- **Images:** Use `srcset`/`sizes` where applicable.

---

## Best practices audit (theme code)

**Checked:** No `!important`; PHP escaping in templates; CSS specificity; script dependencies.

**Fixed:**
- **Hero classes:** CSS updated to target `.hero-lead` and `.hero-ctas` to match `front-page.php` (hero lead and CTAs now styled correctly).
- **Escaping:** All `bloginfo()` output in HTML contexts now uses `esc_html(get_bloginfo(…, 'display'))` in `header.php`, `front-page.php`, and `footer.php`.
- **Scripts:** `main.js` enqueued without jQuery dependency (vanilla JS).

**Optional tech debt:** Admin meta-boxes (`inc/meta-boxes-*.php`) use inline styles; could be moved to a small admin stylesheet and classes later.

*Generated from UI/UX Pro Max `--design-system` and ux/stack searches. Theme implementation in `ccs-theme/style.css`, templates, and `header.php`/`footer.php`.*
