</main>

<footer class="site-footer" role="contentinfo">
    <div class="footer-top container">
        <div class="footer-brand">
            <a href="<?php ccs_url( '/' ); ?>" class="footer-logo" aria-label="Continuity of Care Services">
                <img src="<?php echo esc_url( ccs_logo_url() ); ?>" alt="Continuity of Care Services" width="220" height="auto" class="footer-logo-img" />
            </a>
            <p class="footer-tagline"><?php ccs_site_description(); ?></p>
        </div>
        <form class="footer-newsletter" action="<?php ccs_url( '/contact/' ); ?>" method="get" aria-label="Newsletter signup">
            <input type="hidden" name="source" value="footer-newsletter" />
            <label for="footer-newsletter-email" class="visually-hidden">Your email address</label>
            <input type="email" id="footer-newsletter-email" name="email" placeholder="Your email address" class="footer-newsletter-input" />
            <button type="submit" class="btn btn-primary footer-newsletter-btn">Subscribe</button>
        </form>
    </div>
    <div class="footer-grid container">
        <div class="footer-col footer-links">
            <h3 class="footer-heading">Links</h3>
            <ul>
                <li><a href="<?php ccs_url( '/about/' ); ?>">About Us</a></li>
                <li><a href="<?php ccs_url( '/resources/faqs/' ); ?>">FAQs</a></li>
                <li><a href="<?php ccs_url( '/blog/' ); ?>">Blog</a></li>
                <li><a href="<?php ccs_url( '/contact/' ); ?>">Contact</a></li>
            </ul>
        </div>
        <div class="footer-col footer-services">
            <h3 class="footer-heading">Care services</h3>
            <ul>
                <li><a href="<?php ccs_url( '/services/domiciliary-care/' ); ?>">Domiciliary Care</a></li>
                <li><a href="<?php ccs_url( '/services/complex-care/' ); ?>">Complex Care</a></li>
                <li><a href="<?php ccs_url( '/services/respite-care/' ); ?>">Respite Care</a></li>
                <li><a href="<?php ccs_url( '/conditions/' ); ?>">Care by Condition</a></li>
                <li><a href="<?php ccs_url( '/locations/' ); ?>">Areas We Cover</a></li>
            </ul>
        </div>
        <div class="footer-col footer-resources">
            <h3 class="footer-heading">Resources</h3>
            <ul>
                <li><a href="<?php ccs_url( '/resources/guides/' ); ?>">Care Guides</a></li>
                <li><a href="<?php ccs_url( '/resources/faqs/' ); ?>">FAQs</a></li>
                <li><a href="<?php ccs_url( '/pricing/' ); ?>">Pricing</a></li>
                <li><a href="<?php ccs_url( '/how-it-works/' ); ?>">How It Works</a></li>
            </ul>
        </div>
        <div class="footer-col footer-contact">
            <a href="https://www.cqc.org.uk/location/1-2624556588" target="_blank" rel="noopener noreferrer" class="footer-cqc-badge">CQC Rated: Good</a>
            <p><a href="tel:01622809881">01622 809881</a></p>
            <p><a href="mailto:office@continuitycareservices.co.uk">office@continuitycareservices.co.uk</a></p>
            <p class="footer-address">The Maidstone Studios, New Cut Road, Maidstone, Kent ME14 5NZ</p>
            <div class="footer-social">
                <a href="https://m.me/821174384562849" target="_blank" rel="noopener noreferrer" aria-label="Message Continuity on Facebook Messenger">Messenger</a>
                <a href="https://www.instagram.com/continuityofcareservices/" target="_blank" rel="noopener noreferrer" aria-label="Find Continuity on Instagram">Instagram</a>
                <a href="https://www.linkedin.com/company/continuitycareservices" target="_blank" rel="noopener noreferrer" aria-label="Find Continuity on LinkedIn">LinkedIn</a>
                <a href="https://www.threads.net/@continuityofcareservices" target="_blank" rel="noopener noreferrer" aria-label="Find Continuity on Threads">Threads</a>
            </div>
            <a href="<?php ccs_url( '/contact/' ); ?>" class="btn btn-primary">Book consultation</a>
        </div>
    </div>
    <div class="footer-bottom container">
        <p class="footer-copy">&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php ccs_site_name(); ?></p>
        <nav class="footer-legal" aria-label="Legal and policies">
            <a href="<?php ccs_url( '/privacy-policy/' ); ?>">Privacy</a>
            <a href="<?php ccs_url( '/cookies/' ); ?>">Cookies</a>
            <a href="<?php ccs_url( '/accessibility/' ); ?>">Accessibility</a>
            <a href="<?php ccs_url( '/complaints/' ); ?>">Complaints</a>
            <a href="<?php ccs_url( '/sitemap/' ); ?>">Sitemap</a>
        </nav>
        <a href="https://www.cqc.org.uk/location/1-2624556588" target="_blank" rel="noopener noreferrer" class="footer-cqc">CQC Rated: Good</a>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
