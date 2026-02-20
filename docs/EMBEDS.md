# Third-party embeds

Reference for embedding external content: the CQC rating widget (homepage) and the CV Minder job portal (careers page).

---

## 1. CQC widget — homepage / trust section

Reference for the CQC (Care Quality Commission) section and rating widget.

### CQC IDs & URL

| Item | Value |
|------|--------|
| **Provider ID** | `1-2624556588` |
| **CQC profile URL** | `https://www.cqc.org.uk/provider/1-2624556588` |

Use the same ID in the profile link and in the widget script `data-id` parameter.

### Section copy

- **Heading (H2):** “Regulated, rated, and reliable home care across Maidstone & Kent”
- **Subheading:** “Proud to be rated 'Good' by the CQC”
- **Link text:** “View our CQC profile” (then arrow `→` for visual only, with `aria-hidden="true"`)

### Widget script

**URL pattern:**
```
https://www.cqc.org.uk/sites/all/modules/custom/cqc_widget/widget.js?data-id=1-2624556588&data-host=https://www.cqc.org.uk&type=location
```

- **Query params:** `data-id` = provider ID, `data-host=https://www.cqc.org.uk`, `type=location`
- **When to load:** Only inject the script when the widget is not hidden (e.g. “hide CQC widget” off).
- **Encoding:** Use `rawurlencode()` (or equivalent) on the `data-id` value in the URL.

### Markup

```html
<section class="home-cqc" aria-labelledby="home-cqc-heading">
	<div class="home-cqc__inner container container--lg">
		<h2 id="home-cqc-heading" class="home-cqc__heading">
			Regulated, rated, and reliable home care across Maidstone & Kent
		</h2>
		<p class="home-cqc__subheading">
			Proud to be rated 'Good' by the CQC
		</p>
		<p class="home-cqc__link-wrap">
			<a href="https://www.cqc.org.uk/provider/1-2624556588" class="home-cqc__link" target="_blank" rel="noopener noreferrer">
				View our CQC profile
				<span aria-hidden="true">&rarr;</span>
			</a>
		</p>
		<!-- Optional: only output when widget not hidden -->
		<script type="text/javascript" src="https://www.cqc.org.uk/sites/all/modules/custom/cqc_widget/widget.js?data-id=1-2624556588&data-host=https://www.cqc.org.uk&type=location"></script>
	</div>
</section>
```

- **Section:** `home-cqc`, `aria-labelledby="home-cqc-heading"`.
- **Link:** `target="_blank"` and `rel="noopener noreferrer"` for external CQC site.

### Behaviour

- **Profile link:** Always point to the CQC provider URL (can be overridden via constant or setting).
- **Widget:** Load the CQC script only when the “hide CQC widget” option is off; otherwise show heading, subheading, and link only.
- **Provider ID:** Default `1-2624556588`; allow override so the same template works for other locations if needed.

---

## 2. CV Minder embed — careers page

**CV Minder** is the software we use to display our **active job advertisements**. This section is the reference for embedding the CV Minder job portal on the careers page.

### Official embed (CV Minder code)

**Default iframe URL:**
```
https://cvminder.com/jobportal/index.php?gid=60&pk=2347289374823605326759060200713
```

**CSS (from CV Minder):**
```css
#cvm_content {
  position: relative;
  left: 0;
  bottom: 0;
  min-height: 5000px;
  width: 100%;
}
#cvm_content iframe {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  min-width: 250px;
  min-height: 100%;
  width: 100%;
}
```

**Markup + iframe onLoad:**
```html
<div id="cvm_content">
  <iframe id="cvm_jobframe" name="cvm_jobframe"
    src="https://cvminder.com/jobportal/index.php?gid=60&pk=2347289374823605326759060200713"
    allowtransparency="true" frameborder="0" marginwidth="0" marginheight="0"
    scrolling="auto"
    title="Jobs posted by CV Minder"
    onload="javascript:function adjustiframe(){var x=0;var y=0;if(document.cookie.indexOf('cvminder_iframe')==-1){self.scrollTo(0,0);document.cookie='cvminder_iframe=1';}else{self.scrollTo(x,y);}};adjustiframe();"
  ></iframe>
</div>
```

- **Query params:** `gid=60`, `pk=2347289374823605326759060200713` (keep when building the URL).
- **Title:** Use for accessibility (e.g. “Jobs posted by CV Minder”).
- **Theme:** Uses this structure and CSS in `page-cvminder-jobs.php` and `style.css`; iframe URL is configurable via Customizer.

### Fallback (when CV Minder is off)

When the embed is not used, show:

**Copy:**
- “View our current vacancies or contact us to find out about opportunities.”
- CTA: **Contact us** → `/contact-us/` (or Contact page URL).

**Markup:**
```html
<div class="cvm-fallback container container--lg">
	<p>View our current vacancies or contact us to find out about opportunities.</p>
	<p><a href="/contact-us/" class="button button--primary">Contact us</a></p>
</div>
```

### Behaviour

- **With embed:** Render the iframe inside `.cvm-embed#cvm_content`.
- **Without embed:** Render the fallback block with the CTA to the contact page.
- If you add a setting/toggle, store the iframe URL so it can be overridden (default above).
