<?php
/**
 * Template Name: Team Member
 * Single team member profile (repurposed from doctors-single). Use for child pages of Our Team.
 *
 * @package CCS_Theme
 */

get_header();

$contact = ccs_get_contact_info();
$parent  = get_post_parent();
$items   = array(
	array( 'label' => __( 'Home', 'ccs-wp-theme' ), 'url' => home_url( '/' ) ),
	array( 'label' => $parent ? get_the_title( $parent ) : __( 'Our Team', 'ccs-wp-theme' ), 'url' => $parent ? get_permalink( $parent ) : ccs_page_url( 'our-team' ) ),
	array( 'label' => get_the_title(), 'url' => false ),
);
$role = get_post_meta( get_the_ID(), '_team_role', true );
?>
	<!-- page title -->
	<section class="page-title page-title-layout2 bg-overlay text-center pb-0">
		<div class="bg-img"><img src="<?php echo esc_url( ccs_asset( 'images/page-titles/3.jpg' ) ); ?>" alt="" loading="lazy"></div>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 offset-xl-2">
					<?php get_template_part( 'template-parts/breadcrumb', null, array( 'items' => $items ) ); ?>
					<div class="pagetitle__icon"><i class="icon-heart"></i></div>
					<h1 class="pagetitle__heading"><?php the_title(); ?></h1>
					<?php if ( $role ) : ?>
						<p class="pagetitle__desc mb-30"><?php echo esc_html( $role ); ?></p>
					<?php elseif ( has_excerpt() ) : ?>
						<p class="pagetitle__desc mb-30"><?php the_excerpt(); ?></p>
					<?php endif; ?>
					<a href="<?php echo esc_url( $contact['contact_url'] ); ?>" class="btn btn__white btn__rounded"><?php esc_html_e( 'Get in touch', 'ccs-wp-theme' ); ?></a>
				</div>
			</div>
		</div>
	</section>

	<section class="pt-120 pb-80">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-4">
					<aside class="sidebar has-marign-right">
						<div class="widget widget-member shifted-top">
							<div class="member mb-0">
								<div class="member__img">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'medium_large', array( 'alt' => get_the_title() ) ); ?>
									<?php else : ?>
										<img src="<?php echo esc_url( ccs_asset( 'images/team/1.jpg' ) ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
									<?php endif; ?>
								</div>
								<div class="member__info">
									<h5 class="member__name"><?php the_title(); ?></h5>
									<?php if ( $role ) : ?>
										<p class="member__job"><?php echo esc_html( $role ); ?></p>
									<?php endif; ?>
									<?php if ( has_excerpt() ) : ?>
										<p class="member__desc"><?php the_excerpt(); ?></p>
									<?php endif; ?>
									<div class="mt-20 d-flex flex-wrap justify-content-between align-items-center">
										<ul class="social-icons list-unstyled mb-0">
											<li><a href="<?php echo esc_url( $contact['social']['facebook'] ); ?>" class="facebook" aria-label="<?php esc_attr_e( 'Facebook', 'ccs-wp-theme' ); ?>"><i class="fab fa-facebook-f"></i></a></li>
											<li><a href="<?php echo esc_url( $contact['social']['linkedin'] ); ?>" class="linkedin" aria-label="<?php esc_attr_e( 'LinkedIn', 'ccs-wp-theme' ); ?>"><i class="fab fa-linkedin-in"></i></a></li>
											<li><a href="<?php echo esc_url( $contact['phone_link'] ); ?>" class="phone" aria-label="<?php esc_attr_e( 'Call', 'ccs-wp-theme' ); ?>"><i class="fas fa-phone-alt"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="widget widget-help bg-overlay bg-overlay-primary-gradient">
							<div class="bg-img"><img src="<?php echo esc_url( ccs_asset( 'images/banners/5.jpg' ) ); ?>" alt="" loading="lazy"></div>
							<div class="widget-content">
								<div class="widget__icon"><i class="icon-call3"></i></div>
								<h4 class="widget__title"><?php esc_html_e( 'Get in touch', 'ccs-wp-theme' ); ?></h4>
								<p class="widget__desc"><?php esc_html_e( 'Contact our friendly staff with any enquiry.', 'ccs-wp-theme' ); ?></p>
								<a href="<?php echo esc_url( $contact['phone_link'] ); ?>" class="phone__number">
									<i class="icon-phone"></i> <span><?php echo esc_html( $contact['phone'] ); ?></span>
								</a>
							</div>
						</div>
						<a href="<?php echo esc_url( $parent ? get_permalink( $parent ) : ccs_page_url( 'our-team' ) ); ?>" class="btn btn__secondary btn__block">
							<span><?php esc_html_e( 'All team', 'ccs-wp-theme' ); ?></span> <i class="icon-arrow-right"></i>
						</a>
					</aside>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-8">
					<div class="text-block mb-50">
						<?php
						while ( have_posts() ) {
							the_post();
							the_content();
						}
						?>
					</div>
					<div class="widget-plan mb-0">
						<div class="widget__footer d-flex flex-wrap justify-content-between align-items-center">
							<a href="<?php echo esc_url( $contact['contact_url'] ); ?>" class="btn btn__primary btn__rounded">
								<span><?php esc_html_e( 'Get in touch', 'ccs-wp-theme' ); ?></span> <i class="icon-arrow-right"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php
get_footer();
