<?php
/**
 * Template Name: Pricing Page
 * What It Costs: hourly rates, where money goes, how to pay, what's not included, common questions.
 * Phone: 01622 809881 (tel:01622809881).
 */
get_header();
?>

<div class="page-pricing">
    <div class="container">
        <?php ccs_breadcrumbs(); ?>

        <header class="page-header">
            <h1>What It Costs</h1>
            <p class="lead">No hidden fees. You see the rates up front and we’ll confirm everything in your care plan before anything starts.</p>
        </header>

        <section class="pricing-rates section">
            <h2>Hourly rates</h2>
            <div class="pricing-cards">
                <div class="pricing-card card">
                    <h3>Domiciliary care</h3>
                    <p class="rate">£28–32/hr</p>
                    <ul>
                        <li>Personal care, companionship, medication support</li>
                        <li>Minimum visit 30 minutes or 1 hour (depending on need)</li>
                    </ul>
                </div>
                <div class="pricing-card card">
                    <h3>Complex care</h3>
                    <p class="rate">£32–38/hr</p>
                    <ul>
                        <li>PEG, ventilation, neurological conditions, nursing-led support</li>
                        <li>Minimum visit 1 hour</li>
                    </ul>
                </div>
                <div class="pricing-card card">
                    <h3>Respite care</h3>
                    <p class="rate">From £28/hr</p>
                    <ul>
                        <li>Short-term cover so family carers can take a break</li>
                        <li>Overnight (10pm–8am): £120 flat rate</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="where-money-goes section">
            <h2>Where your money goes</h2>
            <p>We’re transparent about how your fee is used:</p>
            <ul>
                <li><span>Carer wages</span><span>72%</span></li>
                <li><span>Insurance</span><span>12%</span></li>
                <li><span>Travel</span><span>8%</span></li>
                <li><span>Admin &amp; coordination</span><span>8%</span></li>
            </ul>
        </section>

        <section class="how-to-pay section">
            <h2>How to pay</h2>
            <ul>
                <li><strong>Self-funding</strong> — You pay us directly; we’ll agree the rate and schedule in your care plan.</li>
                <li><strong>Local Authority (KCC)</strong> — If Kent County Council contributes, you may have a top-up of around £2–5/hr depending on your assessment.</li>
                <li><strong>NHS CHC</strong> — Fully funded continuing healthcare; we work with the NHS team to arrange care.</li>
                <li><strong>Attendance Allowance</strong> — You can use this toward your care costs; we can point you to guidance if needed.</li>
            </ul>
        </section>

        <section class="not-included section">
            <h2>What’s not included (so you know)</h2>
            <ul>
                <li>Assessments and care plan — <strong>free</strong></li>
                <li>Reviews — <strong>free</strong></li>
                <li>Cancellation with 24 hours’ notice — <strong>no charge</strong></li>
                <li>Bank holidays — <strong>no surcharge</strong></li>
                <li>Medications — you buy these; we support with administration</li>
            </ul>
        </section>

        <section class="pricing-faq section">
            <h2>Common questions</h2>
            <details>
                <summary>Why do rates vary?</summary>
                <div class="faq-answer">Rates depend on the type of care (domiciliary vs complex), visit length, and time of day. We’ll give you a clear quote after your free consultation.</div>
            </details>
            <details>
                <summary>Can I reduce hours later?</summary>
                <div class="faq-answer">Yes. We’ll review with you and adjust the plan; we don’t lock you into a minimum term.</div>
            </details>
            <details>
                <summary>Do you do payment plans?</summary>
                <div class="faq-answer">We invoice regularly (e.g. weekly or fortnightly). If you need a different pattern, we can discuss it.</div>
            </details>
            <details>
                <summary>What if I need to cancel a visit?</summary>
                <div class="faq-answer">Give us 24 hours’ notice and there’s no charge. Less than 24 hours’ notice is charged at half the visit fee.</div>
            </details>
        </section>

        <div class="page-cta">
            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary">Book Free Consultation</a>
            <a href="tel:01622809881" class="btn btn-secondary">Call 01622 809881</a>
        </div>
    </div>
</div>

<?php get_footer(); ?>
