<?php
/**
 * Title: CCS CQC section
 * Slug: medcity/ccs-cqc-section
 * Description: CQC rating section — heading, subheading, profile link, and optional CQC widget script.
 * Categories: featured, text
 */
?>
<!-- wp:group {"tagName":"section","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"backgroundColor":"secondary-light","layout":{"type":"constrained"}}} -->
<section class="wp-block-group has-secondary-light-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)" aria-labelledby="home-cqc-heading">
	<div class="wp-block-group__inner-container">
		<!-- wp:heading {"level":2,"textAlign":"center","style":{"typography":{"fontFamily":"var:preset|font-family|heading"}},"fontSize":"large"} -->
		<h2 class="wp-block-heading has-text-align-center has-large-font-size" id="home-cqc-heading" style="font-family:var(--wp--preset--font-family--heading)">Regulated, rated, and reliable home care across Maidstone &amp; Kent</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center"} -->
		<p class="has-text-align-center">Proud to be rated 'Good' by the CQC</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"align":"center"} -->
		<p class="has-text-align-center"><a href="https://www.cqc.org.uk/provider/1-2624556588" target="_blank" rel="noopener noreferrer">View our CQC profile<span aria-hidden="true"> →</span></a></p>
		<!-- /wp:paragraph -->

		<!-- wp:html -->
		<script type="text/javascript" src="https://www.cqc.org.uk/sites/all/modules/custom/cqc_widget/widget.js?data-id=1-2624556588&amp;data-host=https://www.cqc.org.uk&amp;type=location"></script>
		<!-- /wp:html -->
	</div>
</section>
<!-- /wp:group -->
