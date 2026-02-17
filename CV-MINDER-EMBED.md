# CV Minder embed — careers page

Reference for embedding the CV Minder job portal on the careers page.

---

## Iframe (when “Use CV Minder” is on)

**Default iframe URL:**
```
https://cvminder.com/jobportal/index.php?gid=60&pk=2347289374823605326759060200713
```

**Markup:**
```html
<div class="cvm-embed" id="cvm_content">
	<iframe
		id="cvm_jobframe"
		name="cvm_jobframe"
		src="https://cvminder.com/jobportal/index.php?gid=60&pk=2347289374823605326759060200713"
		allowtransparency="true"
		frameborder="0"
		marginwidth="0"
		marginheight="0"
		scrolling="auto"
		title="Jobs posted by CV Minder"
	></iframe>
</div>
```

- **Query params:** `gid=60`, `pk=2347289374823605326759060200713` (keep these when building the URL).
- **Title:** Use for accessibility (e.g. “Jobs posted by CV Minder” or “Current vacancies”).

---

## Fallback (when CV Minder is off)

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

---

## Behaviour

- **With embed:** Render the iframe inside `.cvm-embed#cvm_content`.
- **Without embed:** Render the fallback block with the CTA to the contact page.
- If you add a setting/toggle, store the iframe URL so it can be overridden (default above).
