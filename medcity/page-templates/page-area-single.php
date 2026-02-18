<?php
/**
 * Template Name: Area (single)
 * Single area/location page (repurposed from departments-single). Use for child pages of Areas We Cover.
 *
 * @package CCS_Theme
 */

get_header();

$contact = ccs_get_contact_info();
$parent  = get_post_parent();
$items   = array(
	array( 'label' => __( 'Home', 'ccs-wp-theme' ), 'url' => home_url( '/' ) ),
	array( 'label' => $parent ? get_the_title( $parent ) : __( 'Areas we cover', 'ccs-wp-theme' ), 'url' => $parent ? get_permalink( $parent ) : ccs_page_url( 'areas-we-cover' ) ),
	array( 'label' => get_the_title(), 'url' => false ),
);
?>
	<!-- page title -->
	<section class="page-title page-title-layout2 bg-overlay text-center pb-0">
		<div class="bg-img"><img src="<?php echo esc_url( ccs_asset( 'images/page-titles/4.jpg' ) ); ?>" alt="" loading="lazy"></div>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 offset-xl-2">
					<?php get_template_part( 'template-parts/breadcrumb', null, array( 'items' => $items ) ); ?>
					<div class="pagetitle__icon"><i class="icon-location"></i></div>
					<h1 class="pagetitle__heading"><?php the_title(); ?></h1>
					<?php if ( has_excerpt() ) : ?>
						<p class="pagetitle__desc mb-30"><?php the_excerpt(); ?></p>
					<?php endif; ?>
					<a href="<?php echo esc_url( $contact['contact_url'] ); ?>" class="btn btn__primary btn__rounded">
						<span><?php esc_html_e( 'Enquire about care here', 'ccs-wp-theme' ); ?></span> <i class="icon-arrow-right"></i>
					</a>
				</div>
			</div>
		</div>
	</section>

	<section class="pt-120 pb-80">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-8">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="mb-40">
							<?php the_post_thumbnail( 'large', array( 'class' => 'rounded' ) ); ?>
						</div>
					<?php endif; ?>
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
				<div class="col-sm-12 col-md-12 col-lg-4">
					<aside class="sidebar">
						<div class="widget widget-help bg-overlay bg-overlay-secondary-gradient">
							<div class="bg-img"><img src="<?php echo esc_url( ccs_asset( 'images/banners/5.jpg' ) ); ?>" alt="" loading="lazy"></div>
							<div class="widget-content">
								<div class="widget__icon"><i class="icon-call3"></i></div>
								<h4 class="widget__title"><?php esc_html_e( 'Get in touch', 'ccs-wp-theme' ); ?></h4>
								<p class="widget__desc"><?php esc_html_e( 'Contact us to discuss care in this area.', 'ccs-wp-theme' ); ?></p>
								<a href="<?php echo esc_url( $contact['phone_link'] ); ?>" class="phone__number">
									<i class="icon-phone"></i> <span><?php echo esc_html( $contact['phone'] ); ?></span>
								</a>
							</div>
						</div>
						<a href="<?php echo esc_url( $parent ? get_permalink( $parent ) : ccs_page_url( 'areas-we-cover' ) ); ?>" class="btn btn__secondary btn__block">
							<span><?php esc_html_e( 'All areas', 'ccs-wp-theme' ); ?></span> <i class="icon-arrow-right"></i>
						</a>
					</aside>
				</div>
			</div>
		</div>
	</section>
<?php
get_footer();
