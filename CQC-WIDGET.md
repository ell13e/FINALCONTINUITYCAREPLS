# CQC widget — homepage / trust section

Reference for the CQC (Care Quality Commission) section and rating widget.

---

## CQC IDs & URL

| Item | Value |
|------|--------|
| **Provider ID** | `1-2624556588` |
| **CQC profile URL** | `https://www.cqc.org.uk/provider/1-2624556588` |

Use the same ID in the profile link and in the widget script `data-id` parameter.

---

## Section copy

- **Heading (H2):** “Regulated, rated, and reliable home care across Maidstone & Kent”
- **Subheading:** “Proud to be rated 'Good' by the CQC”
- **Link text:** “View our CQC profile” (then arrow `→` for visual only, with `aria-hidden="true"`)

---

## Widget script

**URL pattern:**
```
https://www.cqc.org.uk/sites/all/modules/custom/cqc_widget/widget.js?data-id=1-2624556588&data-host=https://www.cqc.org.uk&type=location
```

- **Query params:** `data-id` = provider ID, `data-host=https://www.cqc.org.uk`, `type=location`
- **When to load:** Only inject the script when the widget is not hidden (e.g. “hide CQC widget” off).
- **Encoding:** Use `rawurlencode()` (or equivalent) on the `data-id` value in the URL.

---

## Markup

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

---

## Behaviour

- **Profile link:** Always point to the CQC provider URL (can be overridden via constant or setting).
- **Widget:** Load the CQC script only when the “hide CQC widget” option is off; otherwise show heading, subheading, and link only.
- **Provider ID:** Default `1-2624556588`; allow override so the same template works for other locations if needed.
