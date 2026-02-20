<?php
/**
 * Template Name: About Page
 * How We Started, What We Do Differently, Our Numbers, CQC, Who Runs It, Our Values.
 * Phone: 01622 809881 (tel:01622809881) in CTAs.
 */
get_header();
?>

<div class="page-about">
    <div class="container">
        <?php ccs_breadcrumbs(); ?>

        <header class="page-header">
            <h1>Who We Are</h1>
        </header>

        <section class="about-section section">
            <h2>How We Started</h2>
            <p>Continuity Care Services was set up to give people in Kent real choice and consistency in their care. We saw too many families struggling with agencies that sent different carers every week, didn’t pay travel time, or pushed 15-minute visits. We built something different: same carers, proper visit lengths, and clear pricing.</p>
        </section>

        <section class="about-section section">
            <h2>What We Do Differently</h2>
            <ul>
                <li><strong>No 15-minute visits</strong> — We don’t offer rushed slots; minimum visits are 30 minutes or 1 hour so we can do the job properly.</li>
                <li><strong>Same carers</strong> — You get a small, consistent team so you’re not meeting a new face every week.</li>
                <li><strong>We pay travel time</strong> — Carers are paid for getting to you, so your visit isn’t cut short by travel.</li>
                <li><strong>No jargon</strong> — We explain things in plain English and keep your care plan easy to understand.</li>
            </ul>
        </section>

        <section class="about-numbers section">
            <h2>Our Numbers</h2>
            <ul class="numbers-grid">
                <li><span class="number">80+</span> <span class="label">clients</span></li>
                <li><span class="number">45</span> <span class="label">carers</span></li>
                <li><span class="number">3.5</span> <span class="label">years average carer tenure</span></li>
                <li><span class="number">CQC Good</span> <span class="label">rating</span></li>
            </ul>
            <p><a href="https://www.cqc.org.uk/location/1-2624556588" target="_blank" rel="noopener noreferrer">View our CQC report</a> (Rated: Good).</p>
        </section>

        <section class="about-leadership section">
            <h2>Who Runs It</h2>
            <p>Rachel Thompson and James Patel lead the team. Between them they bring years of experience in care and operations, and they’re involved in recruitment, training, and making sure every client gets a consistent, reliable service.</p>
        </section>

        <section class="about-values section">
            <h2>Our Values</h2>
            <ul>
                <li><strong>Continuity</strong> — Same carers, same standards, so you know what to expect.</li>
                <li><strong>Honesty</strong> — Clear rates, no hidden fees, straight talk about what we can and can’t do.</li>
                <li><strong>Respect</strong> — For you, your family, and our carers; we treat everyone with dignity.</li>
            </ul>
        </section>

        <div class="page-cta">
            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary">Book Consultation</a>
            <a href="<?php echo esc_url(home_url('/careers')); ?>" class="btn btn-secondary">See Careers</a>
            <a href="tel:01622809881" class="btn btn-secondary">Call 01622 809881</a>
        </div>
    </div>
</div>

<?php get_footer(); ?>
