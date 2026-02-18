<?php
/**
 * Template Name: Our Team
 * Team listing (repurposed from doctors-grid). Lists child pages as team members.
 *
 * @package CCS_Theme
 */

get_header();

$contact = ccs_get_contact_info();
$items   = array(
	array( 'label' => __( 'Home', 'ccs-wp-theme' ), 'url' => home_url( '/' ) ),
	array( 'label' => get_the_title(), 'url' => false ),
);

$team_id = get_the_ID();
$members = get_posts( array(
	'post_type'      => 'page',
	'post_parent'    => $team_id,
	'post_status'    => 'publish',
	'orderby'        => 'menu_order title',
	'order'          => 'ASC',
	'posts_per_page' => -1,
	'nopaging'       => true,
) );
?>
	<!-- page title -->
	<section class="page-title page-title-layout1 bg-overlay">
		<div class="bg-img"><img src="<?php echo esc_url( ccs_asset( 'images/page-titles/7.jpg' ) ); ?>" alt="" loading="lazy"></div>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12 col-xl-5">
					<?php get_template_part( 'template-parts/breadcrumb', null, array( 'items' => $items ) ); ?>
					<h1 class="pagetitle__heading"><?php the_title(); ?></h1>
					<?php if ( has_excerpt() ) : ?>
						<p class="pagetitle__desc"><?php the_excerpt(); ?></p>
					<?php else : ?>
						<p class="pagetitle__desc"><?php esc_html_e( 'Meet the people who deliver your care. Our team is here to support you and your family.', 'ccs-wp-theme' ); ?></p>
					<?php endif; ?>
					<a href="<?php echo esc_url( $contact['contact_url'] ); ?>" class="btn btn__primary btn__rounded">
						<span><?php esc_html_e( 'Get in touch', 'ccs-wp-theme' ); ?></span>
						<i class="icon-arrow-right"></i>
					</a>
				</div>
			</div>
		</div>
	</section>

	<!-- Team layout 3 -->
	<section class="team-layout3 pb-40">
		<div class="container">
			<?php if ( ! empty( $members ) ) : ?>
				<div class="row">
					<?php foreach ( $members as $member ) : ?>
						<?php
						$thumb = get_the_post_thumbnail_url( $member->ID, 'medium_large' );
						$role  = get_post_meta( $member->ID, '_team_role', true );
						?>
						<div class="col-sm-6 col-md-4 col-lg-4">
							<div class="member">
								<div class="member__img">
									<?php if ( $thumb ) : ?>
										<img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( get_the_title( $member ) ); ?>" loading="lazy">
									<?php else : ?>
										<img src="<?php echo esc_url( ccs_asset( 'images/team/1.jpg' ) ); ?>" alt="<?php echo esc_attr( get_the_title( $member ) ); ?>" loading="lazy">
									<?php endif; ?>
								</div>
								<div class="member__info">
									<h5 class="member__name"><a href="<?php echo esc_url( get_permalink( $member ) ); ?>"><?php echo esc_html( get_the_title( $member ) ); ?></a></h5>
									<?php if ( $role ) : ?>
										<p class="member__job"><?php echo esc_html( $role ); ?></p>
									<?php endif; ?>
									<p class="member__desc"><?php echo esc_html( has_excerpt( $member ) ? get_the_excerpt( $member ) : wp_trim_words( $member->post_content, 20 ) ); ?></p>
									<div class="mt-20 d-flex flex-wrap justify-content-between align-items-center">
										<a href="<?php echo esc_url( get_permalink( $member ) ); ?>" class="btn btn__secondary btn__link btn__rounded">
											<span><?php esc_html_e( 'Read more', 'ccs-wp-theme' ); ?></span>
											<i class="icon-arrow-right"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php else : ?>
				<div class="row">
					<div class="col-12">
						<?php
						while ( have_posts() ) {
							the_post();
							the_content();
						}
						?>
						<p class="color-gray"><?php esc_html_e( 'Team member profiles will appear here when you add child pages under this page and assign them the "Team Member" template.', 'ccs-wp-theme' ); ?></p>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>
<?php
get_footer();
