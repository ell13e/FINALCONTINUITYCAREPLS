<?php
/**
 * Template Name: Accessibility Statement
 *
 * Legal page: Accessibility. UI mirrors CTA theme; content tailored for CCS.
 *
 * @package CCS_Theme
 */

get_header();

$contact = ccs_get_contact_info();
$items   = array(
	array( 'label' => __( 'Home', 'ccs-wp-theme' ), 'url' => home_url( '/' ) ),
	array( 'label' => __( 'Accessibility Statement', 'ccs-wp-theme' ), 'url' => false ),
);
?>
    <section class="page-title page-title-layout5 bg-overlay" aria-labelledby="accessibility-heading">
      <div class="bg-img"><img src="<?php echo esc_url( ccs_asset( 'images/page-titles/4.jpg' ) ); ?>" alt="" loading="lazy"></div>
      <div class="container">
        <div class="row">
          <div class="col-12 d-flex justify-content-between flex-wrap align-items-center">
            <h1 id="accessibility-heading" class="pagetitle__heading my-3"><?php esc_html_e( 'Accessibility Statement', 'ccs-wp-theme' ); ?></h1>
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
                <h2><?php esc_html_e( 'Our commitment', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'Continuity Care Services (CCS) is committed to making this website accessible to as many people as possible. We aim to meet the requirements of the Equality Act 2010 and to follow the Web Content Accessibility Guidelines (WCAG) 2.1 where practicable.', 'ccs-wp-theme' ); ?></p>

                <h2><?php esc_html_e( 'Measures we take', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'We design and maintain the site with accessibility in mind: clear structure, readable text, sufficient contrast, and keyboard navigation. We test with screen readers and adjust where we find issues.', 'ccs-wp-theme' ); ?></p>

                <h2><?php esc_html_e( 'Conformance', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'We aim for WCAG 2.1 Level AA where possible. Some older content or third-party elements may not yet meet this standard; we are working to improve them.', 'ccs-wp-theme' ); ?></p>

                <h2><?php esc_html_e( 'Known issues', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'If we are aware of specific accessibility problems (e.g. on a particular page or with a form), we will note them here and aim to fix them in a timely way.', 'ccs-wp-theme' ); ?></p>

                <h2><?php esc_html_e( 'Feedback', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'If you have difficulty using any part of this website or have suggestions for improvement, we want to hear from you. Please contact us:', 'ccs-wp-theme' ); ?></p>
                <p>
                  <a href="<?php echo esc_url( $contact['contact_url'] ); ?>"><?php esc_html_e( 'Contact form', 'ccs-wp-theme' ); ?></a><br>
                  <?php esc_html_e( 'Phone:', 'ccs-wp-theme' ); ?> <?php echo esc_html( $contact['phone'] ); ?>
                  <?php if ( ! empty( $contact['email'] ) ) : ?><br>
                  <?php esc_html_e( 'Email:', 'ccs-wp-theme' ); ?> <a href="mailto:<?php echo esc_attr( $contact['email'] ); ?>"><?php echo esc_html( $contact['email'] ); ?></a>
                  <?php endif; ?>
                </p>

                <h2><?php esc_html_e( 'Enforcement', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'If you are not happy with our response, you can contact the Equality Advisory and Support Service (EASS):', 'ccs-wp-theme' ); ?> <a href="https://www.equalityadvisoryservice.com/" target="_blank" rel="noopener noreferrer">www.equalityadvisoryservice.com</a>.</p>

                <h2><?php esc_html_e( 'Updates', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'We review this statement periodically and when we make significant changes to the site. The "Last updated" date at the top of this page shows when the statement was last revised.', 'ccs-wp-theme' ); ?></p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="widget widget-help bg-overlay bg-overlay-secondary-gradient pb-70">
        <div class="bg-img"><img src="<?php echo esc_url( ccs_asset( 'images/banners/5.jpg' ) ); ?>" alt="" loading="lazy"></div>
        <div class="container">
          <div class="widget-content text-center py-50">
            <h2 class="widget__title mb-20"><?php esc_html_e( 'Having trouble using this site?', 'ccs-wp-theme' ); ?></h2>
            <p class="widget__desc mb-30"><?php esc_html_e( 'Tell us what we can do better and we’ll do our best to help.', 'ccs-wp-theme' ); ?></p>
            <a href="<?php echo esc_url( $contact['contact_url'] ); ?>" class="btn btn__primary btn__rounded"><?php esc_html_e( 'Contact us', 'ccs-wp-theme' ); ?></a>
          </div>
        </div>
      </section>
    </main>

<?php get_footer(); ?>
