<?php
/**
 * 404 — Page Not Found. Card grid: Need Care?, Looking for Work?, Have a Question? + phone.
 */
get_header();
?>

<div class="container page-404">

    <article class="error-404">
        <header class="page-header">
            <h1>404</h1>
            <p class="lead">Page Not Found</p>
            <p>We couldn't find the page you're looking for. Use the links below or give us a call.</p>
        </header>

        <div class="404-cards">
            <div class="card">
                <h2>Need Care?</h2>
                <p>Find out about our care services and how we can help.</p>
                <a href="<?php echo esc_url(home_url('/services/')); ?>" class="btn btn-primary">View Services</a>
            </div>
            <div class="card">
                <h2>Looking for Work?</h2>
                <p>Join our team of carers. See current jobs and why to join us.</p>
                <a href="<?php echo esc_url(home_url('/careers/')); ?>" class="btn btn-primary">Careers</a>
            </div>
            <div class="card">
                <h2>Have a Question?</h2>
                <p>Get in touch and we'll get back to you.</p>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Contact Us</a>
            </div>
        </div>

        <p class="404-phone">Or call <a href="tel:01622809881">01622 809881</a></p>
    </article>

</div>

<?php get_footer(); ?>
