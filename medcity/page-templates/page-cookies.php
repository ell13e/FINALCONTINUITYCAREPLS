<?php
/**
 * Template Name: Cookie Policy
 *
 * Legal page: Cookie Policy. UI mirrors CTA theme; content tailored for CCS.
 *
 * @package CCS_Theme
 */

get_header();

$contact = ccs_get_contact_info();
$items   = array(
	array( 'label' => __( 'Home', 'ccs-wp-theme' ), 'url' => home_url( '/' ) ),
	array( 'label' => __( 'Cookie Policy', 'ccs-wp-theme' ), 'url' => false ),
);
?>
    <section class="page-title page-title-layout5 bg-overlay" aria-labelledby="cookies-heading">
      <div class="bg-img"><img src="<?php echo esc_url( ccs_asset( 'images/page-titles/4.jpg' ) ); ?>" alt="" loading="lazy"></div>
      <div class="container">
        <div class="row">
          <div class="col-12 d-flex justify-content-between flex-wrap align-items-center">
            <h1 id="cookies-heading" class="pagetitle__heading my-3"><?php esc_html_e( 'Cookie Policy', 'ccs-wp-theme' ); ?></h1>
            <nav aria-label="<?php esc_attr_e( 'Breadcrumb', 'ccs-wp-theme' ); ?>">
              <?php get_template_part( 'template-parts/breadcrumb', null, array( 'items' => $items ) ); ?>
            </nav>
          </div>
        </div>
        <p class="pagetitle__desc mb-0"><?php echo esc_html( sprintf( __( 'Last updated: %s', 'ccs-wp-theme' ), get_the_modified_date( 'F j, Y' ) ) ); ?></p>
      </div>
    </section>

    <main id="main-content">
      <section class="pt-120 pb-70">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="legal-content">
                <h2><?php esc_html_e( '1. What are cookies?', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'Cookies are small text files stored on your device when you visit a website. They help the site work properly and can remember your preferences or record how you use the site.', 'ccs-wp-theme' ); ?></p>

                <h2><?php esc_html_e( '2. How we use cookies', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'We use cookies only where necessary to make this website function and to improve your experience. We do not use cookies for advertising or to track you across other websites.', 'ccs-wp-theme' ); ?></p>

                <h2><?php esc_html_e( '3. Types of cookies we may use', 'ccs-wp-theme' ); ?></h2>

                <h3><?php esc_html_e( 'Strictly necessary', 'ccs-wp-theme' ); ?></h3>
                <p><?php esc_html_e( 'These are required for the website to work (e.g. security, load balancing, remembering your choices in a session). You cannot turn these off.', 'ccs-wp-theme' ); ?></p>

                <h3><?php esc_html_e( 'Functional', 'ccs-wp-theme' ); ?></h3>
                <p><?php esc_html_e( 'These remember settings or choices (e.g. accessibility preferences) so we can provide a better experience.', 'ccs-wp-theme' ); ?></p>

                <h3><?php esc_html_e( 'Analytics (if used)', 'ccs-wp-theme' ); ?></h3>
                <p><?php esc_html_e( 'If we use analytics cookies, they help us understand how visitors use the site (e.g. which pages are viewed). We would only use them in a way that respects your privacy.', 'ccs-wp-theme' ); ?></p>

                <h2><?php esc_html_e( '4. Managing cookies', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'You can control or delete cookies via your browser settings. Blocking all cookies may affect how the website works.', 'ccs-wp-theme' ); ?></p>

                <h2><?php esc_html_e( '5. More information', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'For how we handle your personal data, see our', 'ccs-wp-theme' ); ?> <a href="<?php echo esc_url( ccs_page_url( 'privacy-policy' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'ccs-wp-theme' ); ?></a>. <?php esc_html_e( 'If you have questions about cookies, please', 'ccs-wp-theme' ); ?> <a href="<?php echo esc_url( $contact['contact_url'] ); ?>"><?php esc_html_e( 'contact us', 'ccs-wp-theme' ); ?></a>.</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="widget widget-help bg-overlay bg-overlay-secondary-gradient pb-70">
        <div class="bg-img"><img src="<?php echo esc_url( ccs_asset( 'images/banners/5.jpg' ) ); ?>" alt="" loading="lazy"></div>
        <div class="container">
          <div class="widget-content text-center py-50">
            <h2 class="widget__title mb-20"><?php esc_html_e( 'Questions about cookies?', 'ccs-wp-theme' ); ?></h2>
            <p class="widget__desc mb-30"><?php esc_html_e( 'We’re happy to answer any questions.', 'ccs-wp-theme' ); ?></p>
            <a href="<?php echo esc_url( $contact['contact_url'] ); ?>" class="btn btn__primary btn__rounded"><?php esc_html_e( 'Contact us', 'ccs-wp-theme' ); ?></a>
          </div>
        </div>
      </section>
    </main>

<?php get_footer(); ?>
