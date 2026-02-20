<?php
/**
 * Front Page Template
 * Aims-style layout: hero, Why Continuity, The Difference, Our Services (two blocks), Care Journey, Testimonials, Areas, CTA form, FAQs.
 * Phone: 01622 809881 (tel:01622809881).
 */
get_header();
?>

<div class="front-page">

    <?php
    $hero_image_id = get_theme_mod( 'ccs_hero_background_image', 0 );
    $hero_classes  = array( 'hero', 'hero--brand' );
    if ( $hero_image_id ) {
        $hero_classes[] = 'hero--has-bg';
    }
    ?>
    <section class="<?php echo esc_attr( implode( ' ', $hero_classes ) ); ?>"<?php echo $hero_image_id ? ' style="--hero-bg-image: url(' . esc_url( wp_get_attachment_image_url( $hero_image_id, 'full' ) ) . ');"' : ''; ?>>
        <div class="hero-overlay" aria-hidden="true"></div>
        <div class="container hero-container">
            <div class="hero-content">
                <a href="https://www.cqc.org.uk/location/1-2624556588" class="hero-badge" target="_blank" rel="noopener noreferrer">
                    <span class="hero-badge-star" aria-hidden="true">★</span> CQC Rated Good
                </a>
                <h1 class="hero-headline">Supporting you with <em>dignity</em>, respect & warmth</h1>
                <p class="hero-tagline">Your Team, Your Time, <em>Your Life</em></p>
                <p class="hero-lead"><?php ccs_site_description(); ?></p>
                <div class="hero-ctas">
                    <a href="<?php ccs_url( '/contact/' ); ?>" class="btn btn-primary btn-pill">Book a free consultation</a>
                    <a href="<?php ccs_url( '/services/' ); ?>" class="btn btn-secondary btn-pill">View our services</a>
                </div>
                <div class="hero-trust-strip">
                    <span class="hero-trust-cqc">CQC Regulated</span>
                    <span class="hero-trust-stars" aria-hidden="true">★★★★★</span>
                    <span class="hero-trust-copy">Trusted by families across Kent</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Continuity (Aims-style feature cards) -->
    <section class="why-continuity section" aria-labelledby="why-heading">
        <div class="container">
            <span class="section-label">Why Continuity Care</span>
            <h2 id="why-heading">Why families <em>choose us</em></h2>
            <p class="section-lead">Person-centred home care across Kent. Same carers, every time — so you and your family can get on with life.</p>
            <div class="feature-cards">
                <div class="card feature-card">
                    <span class="feature-card-icon" aria-hidden="true">24/7</span>
                    <h3>Person-centred support</h3>
                    <p>We build your care plan around you. Regular visits or live-in options, with the same team whenever possible.</p>
                </div>
                <div class="card feature-card">
                    <span class="feature-card-icon" aria-hidden="true">CQC</span>
                    <h3>CQC regulated</h3>
                    <p>Rated Good by the Care Quality Commission. We're committed to safe, effective, and caring support.</p>
                </div>
                <div class="card feature-card">
                    <span class="feature-card-icon" aria-hidden="true">Kent</span>
                    <h3>Covering Kent</h3>
                    <p>From Maidstone to the coast. We serve communities across Kent and match you with local, experienced carers.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- The Difference We Bring (value cards) -->
    <section class="the-difference section" aria-labelledby="difference-heading">
        <div class="container">
            <span class="section-label">The difference we bring</span>
            <h2 id="difference-heading">Your well-being is <em>our priority</em></h2>
            <p class="section-lead">We don’t just provide care — we build relationships and continuity so you feel safe and supported.</p>
            <div class="value-cards">
                <div class="card value-card">
                    <h3>Compassion</h3>
                    <p>We listen, understand, and respond with kindness. Every client is treated as an individual.</p>
                </div>
                <div class="card value-card">
                    <h3>Care</h3>
                    <p>Skilled, consistent support that fits your life. Same carers so you don’t have to keep explaining.</p>
                </div>
                <div class="card value-card">
                    <h3>Integrity</h3>
                    <p>Honest pricing, clear communication, and no hidden fees. You’ll always know where you stand.</p>
                </div>
                <div class="card value-card">
                    <h3>Respect</h3>
                    <p>Your choices, your routine, your dignity. We’re here to enable your independence.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Services (two large blocks, Aims-style) -->
    <section class="our-services section" aria-labelledby="services-heading">
        <div class="container">
            <span class="section-label">Our services</span>
            <h2 id="services-heading">Care that fits <em>your life</em></h2>
            <p class="section-lead">From regular visits to complex and respite care, we tailor support to what you need.</p>
            <div class="service-blocks">
                <div class="service-block card">
                    <h3>Home care</h3>
                    <p>Visits at home for personal care, companionship, medication support, and daily living. Same team, your schedule.</p>
                    <ul class="service-block-links">
                        <li><a href="<?php ccs_service_link( 'domiciliary-care' ); ?>">Domiciliary care</a></li>
                        <li><a href="<?php ccs_service_link( 'complex-care' ); ?>">Complex care</a></li>
                        <li><a href="<?php ccs_service_link( 'respite-care' ); ?>">Respite care</a></li>
                    </ul>
                    <a href="<?php ccs_url( '/services/' ); ?>" class="btn btn-primary">View all services</a>
                </div>
                <div class="service-block card">
                    <h3>More support</h3>
                    <p>Higher-acuity and short-term care when you need it — PEG, ventilation, neurological conditions, or a break for family carers.</p>
                    <ul class="service-block-links">
                        <li><a href="<?php ccs_service_link( 'complex-care' ); ?>">Complex & nursing-led care</a></li>
                        <li><a href="<?php ccs_service_link( 'respite-care' ); ?>">Respite & short-term</a></li>
                    </ul>
                    <a href="<?php ccs_url( '/pricing/' ); ?>" class="btn btn-secondary">See pricing</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Your Care Journey (4 steps, Aims-style) -->
    <section class="care-journey section" aria-labelledby="journey-heading">
        <div class="container">
            <span class="section-label">Your care journey</span>
            <h2 id="journey-heading">From first call to ongoing care in <em>4 steps</em></h2>
            <ol class="care-journey-steps">
                <li class="care-step card">
                    <span class="care-step-num" aria-hidden="true">1</span>
                    <h3>Book a free assessment</h3>
                    <p>Call us or fill in the form. We’ll arrange a no-obligation visit to understand your needs and wishes.</p>
                </li>
                <li class="care-step card">
                    <span class="care-step-num" aria-hidden="true">2</span>
                    <h3>Your care plan</h3>
                    <p>We create a personalised plan that fits your routine, preferences, and any clinical requirements.</p>
                </li>
                <li class="care-step card">
                    <span class="care-step-num" aria-hidden="true">3</span>
                    <h3>Matched with your team</h3>
                    <p>We introduce you to your carers. Same faces, every time — so you can build trust and continuity.</p>
                </li>
                <li class="care-step card">
                    <span class="care-step-num" aria-hidden="true">4</span>
                    <h3>Ongoing support</h3>
                    <p>Care begins. We review with you regularly and adapt as your needs change.</p>
                </li>
            </ol>
            <a href="<?php ccs_url( '/how-it-works/' ); ?>" class="btn btn-tertiary">Find out more</a>
        </div>
    </section>

    <!-- Testimonials + stat strip -->
    <section class="testimonials section" aria-labelledby="testimonials-heading">
        <div class="container">
            <span class="section-label">Testimonial highlights</span>
            <h2 id="testimonials-heading">Trusted by <em>families</em> across Kent</h2>
            <div class="testimonial-stats">
                <div class="stat-card">
                    <span class="stat-number">500+</span>
                    <span class="stat-label">Families supported</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">Kent</span>
                    <span class="stat-label">Areas we serve</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">CQC Good</span>
                    <span class="stat-label">Rated</span>
                </div>
            </div>
            <div class="testimonial-grid">
                <blockquote class="testimonial">
                    <p>We couldn't ask for better care. The same team every time — they know Mum and she trusts them.</p>
                    <footer>— Family of a client in Maidstone</footer>
                </blockquote>
                <blockquote class="testimonial">
                    <p>Transparent pricing, no hidden fees. They explained everything at the start.</p>
                    <footer>— Son of a client</footer>
                </blockquote>
            </div>
        </div>
    </section>

    <!-- Areas we serve -->
    <section class="areas-serve section" aria-labelledby="areas-heading">
        <div class="container">
            <span class="section-label">Areas we serve</span>
            <h2 id="areas-heading">Caring for communities across <em>Kent</em></h2>
            <p class="section-lead">We provide home care across Kent, including Maidstone, Sittingbourne, Sheerness, Faversham, and surrounding areas.</p>
            <ul class="areas-towns">
                <li>Maidstone</li>
                <li>Sittingbourne</li>
                <li>Sheerness</li>
                <li>Faversham</li>
                <li>Gillingham</li>
                <li>Chatham</li>
                <li>Rochester</li>
                <li>Strood</li>
                <li>and surrounding areas</li>
            </ul>
            <a href="<?php ccs_url( '/locations/' ); ?>" class="btn btn-tertiary">Check our areas</a>
        </div>
    </section>

    <!-- Dual CTA (Need care / Looking for work) -->
    <section class="dual-cta section">
        <div class="container">
            <span class="section-label">Get started</span>
            <h2>Get <em>started</em></h2>
            <div class="dual-cta-grid">
                <div class="cta-block">
                    <h3>Need care?</h3>
                    <a href="<?php ccs_url( '/contact/' ); ?>" class="btn btn-primary">Book consultation</a>
                    <a href="<?php ccs_url( '/pricing/' ); ?>" class="btn btn-secondary">See pricing</a>
                </div>
                <div class="cta-block">
                    <h3>Looking for work?</h3>
                    <a href="<?php ccs_url( '/careers/jobs/' ); ?>" class="btn btn-primary">See jobs</a>
                    <a href="<?php ccs_url( '/careers/' ); ?>" class="btn btn-secondary">Why join us</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Get personalised home care today (form CTA) -->
    <section class="quick-contact section" aria-labelledby="contact-heading">
        <div class="container">
            <span class="section-label">Contact</span>
            <h2 id="contact-heading">Get personalised <em>home care</em> today</h2>
            <p class="quick-contact-lead">Begin your care journey with support tailored to your needs. We’ll create a personalised plan and match you with a trusted carer.</p>
            <p class="quick-contact-phone">Or call <a href="tel:01622809881">01622 809881</a>.</p>
            <form class="quick-contact-form" action="<?php ccs_url( '/contact/' ); ?>" method="get">
                <p>
                    <label for="quick-name">Name</label>
                    <input type="text" id="quick-name" name="name" required autocomplete="name">
                </p>
                <p>
                    <label for="quick-phone">Phone</label>
                    <input type="tel" id="quick-phone" name="phone" required autocomplete="tel">
                </p>
                <p>
                    <label for="quick-message">What are you looking for?</label>
                    <textarea id="quick-message" name="message" rows="3" placeholder="e.g. regular visits, respite, complex care"></textarea>
                </p>
                <p>
                    <button type="submit" class="btn btn-primary">Book a free consultation</button>
                </p>
            </form>
        </div>
    </section>

    <!-- FAQs (front-page accordion) -->
    <section class="front-page-faq section" aria-labelledby="faq-heading">
        <div class="container">
            <span class="section-label">FAQs</span>
            <h2 id="faq-heading">We're here to answer <em>your questions</em></h2>
            <div class="faq-accordion">
                <details class="faq-item">
                    <summary>How do I get started?</summary>
                    <div class="faq-answer">
                        <p>Call us on 01622 809881 or use the form above. We’ll arrange a free, no-obligation visit to discuss your needs and create a personalised care plan.</p>
                    </div>
                </details>
                <details class="faq-item">
                    <summary>Will I have the same carers?</summary>
                    <div class="faq-answer">
                        <p>Yes. We aim for continuity — the same small team so you don’t have to keep explaining. We’ll match you with carers who fit your routine and preferences.</p>
                    </div>
                </details>
                <details class="faq-item">
                    <summary>What areas do you cover?</summary>
                    <div class="faq-answer">
                        <p>We serve Kent, including Maidstone, Sittingbourne, Sheerness, Faversham, Gillingham, Chatham, Rochester, Strood, and surrounding areas. <a href="<?php ccs_url( '/locations/' ); ?>">See our locations</a>.</p>
                    </div>
                </details>
            </div>
            <a href="<?php ccs_url( '/faqs/' ); ?>" class="btn btn-tertiary">View all FAQs</a>
        </div>
    </section>

</div>

<?php get_footer(); ?>
