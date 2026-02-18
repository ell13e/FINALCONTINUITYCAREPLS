<?php
/**
 * Template Name: Areas We Cover
 * Listing of areas/locations we serve (repurposed from departments.html).
 * Lists child pages as areas; optionally use "Area (single)" template for each.
 *
 * @package CCS_Theme
 */

get_header();

$contact  = ccs_get_contact_info();
$items    = array(
	array( 'label' => __( 'Home', 'ccs-wp-theme' ), 'url' => home_url( '/' ) ),
	array( 'label' => get_the_title(), 'url' => false ),
);
$areas_id = get_the_ID();
$areas    = get_posts( array(
	'post_type'      => 'page',
	'post_parent'    => $areas_id,
	'post_status'    => 'publish',
	'orderby'        => 'menu_order title',
	'order'          => 'ASC',
	'posts_per_page' => -1,
	'nopaging'       => true,
) );
?>
	<!-- page title -->
	<section class="page-title page-title-layout1 bg-overlay">
		<div class="bg-img"><img src="<?php echo esc_url( ccs_asset( 'images/page-titles/4.jpg' ) ); ?>" alt="" loading="lazy"></div>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12 col-xl-5">
					<?php get_template_part( 'template-parts/breadcrumb', null, array( 'items' => $items ) ); ?>
					<h1 class="pagetitle__heading"><?php the_title(); ?></h1>
					<?php if ( has_excerpt() ) : ?>
						<p class="pagetitle__desc"><?php the_excerpt(); ?></p>
					<?php else : ?>
						<p class="pagetitle__desc"><?php esc_html_e( 'We provide care and support across the following areas. Get in touch to discuss your location.', 'ccs-wp-theme' ); ?></p>
					<?php endif; ?>
					<a href="<?php echo esc_url( $contact['contact_url'] ); ?>" class="btn btn__primary btn__rounded">
						<span><?php esc_html_e( 'Get in touch', 'ccs-wp-theme' ); ?></span>
						<i class="icon-arrow-right"></i>
					</a>
				</div>
			</div>
		</div>
	</section>

	<!-- Services Layout 2 (area cards) -->
	<section class="services-layout2 pt-130">
		<div class="container">
			<?php if ( ! empty( $areas ) ) : ?>
				<div class="row">
					<?php
					$images = array( '1', '2', '3', '4', '5', '6' );
					$i      = 0;
					foreach ( $areas as $area ) :
						$thumb = get_the_post_thumbnail_url( $area->ID, 'medium_large' );
						$img   = $thumb ? $thumb : ccs_asset( 'images/services/' . $images[ $i % 6 ] . '.jpg' );
						$i++;
						?>
						<div class="col-sm-12 col-md-6 col-lg-4">
							<div class="service-item">
								<div class="service__img">
									<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( get_the_title( $area ) ); ?>" loading="lazy">
								</div>
								<div class="service__content">
									<h4 class="service__title"><?php echo esc_html( get_the_title( $area ) ); ?></h4>
									<p class="service__desc"><?php echo esc_html( has_excerpt( $area ) ? get_the_excerpt( $area ) : wp_trim_words( $area->post_content, 18 ) ); ?></p>
									<a href="<?php echo esc_url( get_permalink( $area ) ); ?>" class="btn btn__secondary btn__outlined btn__rounded">
										<span><?php esc_html_e( 'Read more', 'ccs-wp-theme' ); ?></span>
										<i class="icon-arrow-right"></i>
									</a>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php else : ?>
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-8 offset-lg-2">
						<?php
						while ( have_posts() ) {
							the_post();
							the_content();
						}
						?>
						<p class="color-gray"><?php esc_html_e( 'Add child pages under this page to list areas you cover. You can assign each the "Area (single)" template for a dedicated area page.', 'ccs-wp-theme' ); ?></p>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>
<?php
get_footer();
