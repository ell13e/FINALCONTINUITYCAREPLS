<?php
/**
 * Template Name: Privacy Policy
 *
 * Legal page: Privacy Policy. UI mirrors CTA theme; content tailored for CCS (home care provider).
 *
 * @package CCS_Theme
 */

get_header();

$contact = ccs_get_contact_info();
$items   = array(
	array( 'label' => __( 'Home', 'ccs-wp-theme' ), 'url' => home_url( '/' ) ),
	array( 'label' => __( 'Privacy Policy', 'ccs-wp-theme' ), 'url' => false ),
);
?>
    <!-- page title -->
    <section class="page-title page-title-layout5 bg-overlay" aria-labelledby="privacy-heading">
      <div class="bg-img"><img src="<?php echo esc_url( ccs_asset( 'images/page-titles/4.jpg' ) ); ?>" alt="" loading="lazy"></div>
      <div class="container">
        <div class="row">
          <div class="col-12 d-flex justify-content-between flex-wrap align-items-center">
            <h1 id="privacy-heading" class="pagetitle__heading my-3"><?php esc_html_e( 'Privacy Policy', 'ccs-wp-theme' ); ?></h1>
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
                <h2><?php esc_html_e( '1. Data Controller', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'The Data Controller responsible for your personal information is:', 'ccs-wp-theme' ); ?></p>
                <p><strong><?php bloginfo( 'name' ); ?></strong><br>
                <?php if ( ! empty( $contact['email'] ) ) : ?>
                <?php esc_html_e( 'Email:', 'ccs-wp-theme' ); ?> <a href="mailto:<?php echo esc_attr( $contact['email'] ); ?>"><?php echo esc_html( $contact['email'] ); ?></a><br>
                <?php endif; ?>
                <?php esc_html_e( 'Phone:', 'ccs-wp-theme' ); ?> <?php echo esc_html( $contact['phone'] ); ?><br>
                <?php esc_html_e( 'Address:', 'ccs-wp-theme' ); ?> <?php echo esc_html( $contact['address'] ); ?></p>

                <h2><?php esc_html_e( '2. Information We Collect', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'We may collect and process the following personal information when you use our website or contact us:', 'ccs-wp-theme' ); ?></p>

                <h3><?php esc_html_e( 'Contact and enquiry forms', 'ccs-wp-theme' ); ?></h3>
                <ul>
                  <li><?php esc_html_e( 'Name', 'ccs-wp-theme' ); ?></li>
                  <li><?php esc_html_e( 'Email address', 'ccs-wp-theme' ); ?></li>
                  <li><?php esc_html_e( 'Phone number', 'ccs-wp-theme' ); ?></li>
                  <li><?php esc_html_e( 'Any message or enquiry details you provide', 'ccs-wp-theme' ); ?></li>
                </ul>

                <h3><?php esc_html_e( 'Arrange a visit / callback requests', 'ccs-wp-theme' ); ?></h3>
                <p><?php esc_html_e( 'When you request a visit or callback, we may collect name, phone number, and preferred time or message.', 'ccs-wp-theme' ); ?></p>

                <p><strong><?php esc_html_e( 'We do not collect payment details online.', 'ccs-wp-theme' ); ?></strong> <?php esc_html_e( 'Any payments or financial arrangements are made after you contact us.', 'ccs-wp-theme' ); ?></p>

                <h2><?php esc_html_e( '3. Legal Basis for Processing', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'We process personal data under UK GDPR:', 'ccs-wp-theme' ); ?></p>
                <ul>
                  <li><strong><?php esc_html_e( 'Legitimate interest (Article 6(1)(f))', 'ccs-wp-theme' ); ?></strong> — <?php esc_html_e( 'to respond to enquiries and provide information about our care services.', 'ccs-wp-theme' ); ?></li>
                  <li><strong><?php esc_html_e( 'Contract (Article 6(1)(b))', 'ccs-wp-theme' ); ?></strong> — <?php esc_html_e( 'when processing information necessary to provide care or related services you request.', 'ccs-wp-theme' ); ?></li>
                </ul>

                <h2><?php esc_html_e( '4. How We Use Your Information', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'We use personal information to:', 'ccs-wp-theme' ); ?></p>
                <ul>
                  <li><?php esc_html_e( 'Respond to contact and enquiry forms', 'ccs-wp-theme' ); ?></li>
                  <li><?php esc_html_e( 'Arrange visits or callbacks', 'ccs-wp-theme' ); ?></li>
                  <li><?php esc_html_e( 'Provide information about our home care services', 'ccs-wp-theme' ); ?></li>
                  <li><?php esc_html_e( 'Maintain records for business and care administration', 'ccs-wp-theme' ); ?></li>
                </ul>
                <p><?php esc_html_e( 'We do not sell or share your personal information with third parties for their own marketing.', 'ccs-wp-theme' ); ?></p>

                <h2><?php esc_html_e( '5. Sharing Your Information', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'We may share your information with trusted service providers who support our operations (e.g. hosting, security). They act as data processors and only process data according to our instructions. We may disclose personal data where required by law or regulatory authorities.', 'ccs-wp-theme' ); ?></p>

                <h2><?php esc_html_e( '6. Data Retention', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'We keep personal data only for as long as necessary to fulfil the purposes described in this policy or as required by law. You may request deletion of your personal data at any time.', 'ccs-wp-theme' ); ?></p>

                <h2><?php esc_html_e( '7. Your Rights Under UK GDPR', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'You have the right to access, rectification, erasure, restriction of processing, data portability, and to object. To exercise any of these rights, please contact us using the details below.', 'ccs-wp-theme' ); ?></p>

                <h2><?php esc_html_e( '8. Cookies', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'For details about cookies we use, please see our', 'ccs-wp-theme' ); ?> <a href="<?php echo esc_url( ccs_page_url( 'cookie-policy' ) ); ?>"><?php esc_html_e( 'Cookie Policy', 'ccs-wp-theme' ); ?></a>.</p>

                <h2><?php esc_html_e( '9. Contact Us', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'If you have any questions about this Privacy Policy or our data practices:', 'ccs-wp-theme' ); ?></p>
                <p>
                  <?php if ( ! empty( $contact['email'] ) ) : ?>
                  <strong><?php esc_html_e( 'Email:', 'ccs-wp-theme' ); ?></strong> <a href="mailto:<?php echo esc_attr( $contact['email'] ); ?>"><?php echo esc_html( $contact['email'] ); ?></a><br>
                  <?php endif; ?>
                  <strong><?php esc_html_e( 'Contact form:', 'ccs-wp-theme' ); ?></strong> <a href="<?php echo esc_url( $contact['contact_url'] ); ?>"><?php esc_html_e( 'Contact us', 'ccs-wp-theme' ); ?></a><br>
                  <strong><?php esc_html_e( 'Phone:', 'ccs-wp-theme' ); ?></strong> <?php echo esc_html( $contact['phone'] ); ?>
                </p>

                <h2><?php esc_html_e( '10. Changes to This Policy', 'ccs-wp-theme' ); ?></h2>
                <p><?php esc_html_e( 'We may update this Privacy Policy from time to time. The most recent version will be published on this page with the "Last updated" date at the top.', 'ccs-wp-theme' ); ?></p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="widget widget-help bg-overlay bg-overlay-secondary-gradient pb-70">
        <div class="bg-img"><img src="<?php echo esc_url( ccs_asset( 'images/banners/5.jpg' ) ); ?>" alt="" loading="lazy"></div>
        <div class="container">
          <div class="widget-content text-center py-50">
            <h2 class="widget__title mb-20"><?php esc_html_e( 'Questions about your data?', 'ccs-wp-theme' ); ?></h2>
            <p class="widget__desc mb-30"><?php esc_html_e( 'If you have any questions about how we handle your personal information, please get in touch.', 'ccs-wp-theme' ); ?></p>
            <div class="d-flex flex-wrap justify-content-center gap-2">
              <a href="<?php echo esc_url( $contact['contact_url'] ); ?>" class="btn btn__primary btn__rounded"><?php esc_html_e( 'Contact us', 'ccs-wp-theme' ); ?></a>
              <?php if ( ! empty( $contact['email'] ) ) : ?>
              <a href="mailto:<?php echo esc_attr( $contact['email'] ); ?>" class="btn btn__secondary btn__outlined btn__rounded"><?php esc_html_e( 'Email us', 'ccs-wp-theme' ); ?></a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php get_footer(); ?>
