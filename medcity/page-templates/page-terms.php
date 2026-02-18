<?php
/**
 * Template Name: Terms of Use
 *
 * Legal page: Terms of Use. UI mirrors CTA theme; content tailored for CCS (home care provider).
 *
 * @package CCS_Theme
 */

get_header();

$contact = ccs_get_contact_info();
$items   = array(
	array( 'label' => __( 'Home', 'ccs-wp-theme' ), 'url' => home_url( '/' ) ),
	array( 'label' => __( 'Terms of Use', 'ccs-wp-theme' ), 'url' => false ),
);
?>
    <section class="page-title page-title-layout5 bg-overlay" aria-labelledby="terms-heading">
      <div class="bg-img"><img src="<?php echo esc_url( ccs_asset( 'images/page-titles/4.jpg' ) ); ?>" alt="" loading="lazy"></div>
      <div class="container">
        <div class="row">
          <div class="col-12 d-flex justify-content-between flex-wrap align-items-center">
            <h1 id="terms-heading" class="pagetitle__heading my-3"><?php esc_html_e( 'Terms of Use', 'ccs-wp-theme' ); ?></h1>
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
                <h2><?php esc_html_e( '1. About us', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'This website is operated by Continuity Care Services (CCS). We provide home care and support services. By using this website you agree to these terms.', 'ccs-wp-theme' ); ?></p>

                <h2><?php esc_html_e( '2. Eligibility', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'You must be at least 18 years old to use this website or to request information about our services on behalf of yourself or another person.', 'ccs-wp-theme' ); ?></p>

                <h2><?php esc_html_e( '3. Use of website', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'You agree to use this website only for lawful purposes. You must not use it to transmit harmful, offensive, or illegal content or to attempt to gain unauthorised access to our systems or data.', 'ccs-wp-theme' ); ?></p>

                <h2><?php esc_html_e( '4. No user accounts', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'We do not offer user accounts or login areas on this website. Enquiries and contact are made via forms and phone/email only.', 'ccs-wp-theme' ); ?></p>

                <h2><?php esc_html_e( '5. Enquiries and contact', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'Any enquiry or request for information, a visit, or a callback is subject to our availability and does not create a contract until we agree terms with you separately.', 'ccs-wp-theme' ); ?></p>

                <h2><?php esc_html_e( '6. No online purchase or payment', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'Care services are not purchased or paid for through this website. Arrangements and payments are made after you contact us and agree terms.', 'ccs-wp-theme' ); ?></p>

                <h2><?php esc_html_e( '7. Prices and information', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'Any prices or service information on the website are for guidance only and may change. We will confirm current terms when you contact us.', 'ccs-wp-theme' ); ?></p>

                <h2><?php esc_html_e( '8. Intellectual property', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'All content on this website (text, images, logos, design) is owned by us or our licensors. You may not copy, reproduce, or use it for commercial purposes without our written permission.', 'ccs-wp-theme' ); ?></p>

                <h2><?php esc_html_e( '9. Liability', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'We do not exclude or limit our liability for death or personal injury caused by negligence, fraud, or anything else that cannot be excluded by law. Otherwise, we are not liable for any indirect or consequential loss arising from your use of this website.', 'ccs-wp-theme' ); ?></p>

                <h2><?php esc_html_e( '10. Data protection', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'Your use of this website and any information you provide is also governed by our', 'ccs-wp-theme' ); ?> <a href="<?php echo esc_url( ccs_page_url( 'privacy-policy' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'ccs-wp-theme' ); ?></a>.</p>

                <h2><?php esc_html_e( '11. Cookies', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'Information about cookies is set out in our', 'ccs-wp-theme' ); ?> <a href="<?php echo esc_url( ccs_page_url( 'cookie-policy' ) ); ?>"><?php esc_html_e( 'Cookie Policy', 'ccs-wp-theme' ); ?></a>.</p>

                <h2><?php esc_html_e( '12. Governing law', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'These terms are governed by the laws of England and Wales. Any dispute is subject to the exclusive jurisdiction of the courts of England and Wales.', 'ccs-wp-theme' ); ?></p>

                <h2><?php esc_html_e( '13. Contact', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'If you have any questions about these terms, please', 'ccs-wp-theme' ); ?> <a href="<?php echo esc_url( $contact['contact_url'] ); ?>"><?php esc_html_e( 'contact us', 'ccs-wp-theme' ); ?></a> <?php esc_html_e( 'or call', 'ccs-wp-theme' ); ?> <?php echo esc_html( $contact['phone'] ); ?>.</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="widget widget-help bg-overlay bg-overlay-secondary-gradient pb-70">
        <div class="bg-img"><img src="<?php echo esc_url( ccs_asset( 'images/banners/5.jpg' ) ); ?>" alt="" loading="lazy"></div>
        <div class="container">
          <div class="widget-content text-center py-50">
            <h2 class="widget__title mb-20"><?php esc_html_e( 'Questions about these terms?', 'ccs-wp-theme' ); ?></h2>
            <p class="widget__desc mb-30"><?php esc_html_e( 'Get in touch and we’ll be happy to help.', 'ccs-wp-theme' ); ?></p>
            <a href="<?php echo esc_url( $contact['contact_url'] ); ?>" class="btn btn__primary btn__rounded"><?php esc_html_e( 'Contact us', 'ccs-wp-theme' ); ?></a>
          </div>
        </div>
      </section>
    </main>

<?php get_footer(); ?>
