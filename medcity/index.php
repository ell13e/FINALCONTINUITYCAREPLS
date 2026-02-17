<?php
/**
 * Blog / main loop — Medcity UI.
 *
 * @package CCS_Theme
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>
<main class="main-content pt-130 pb-80">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="row">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<div class="col-sm-12 col-md-6 col-lg-4 mb-40">
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-item' ); ?>>
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="post__img">
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy' ) ); ?></a>
								</div>
							<?php endif; ?>
							<div class="post__body">
								<div class="post__meta d-flex">
									<span class="post__meta-date"><?php echo get_the_date(); ?></span>
								</div>
								<h4 class="post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								<p class="post__desc"><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
								<a href="<?php the_permalink(); ?>" class="btn btn__secondary btn__link btn__rounded"><span>Read More</span> <i class="icon-arrow-right"></i></a>
							</div>
						</article>
					</div>
				<?php endwhile; ?>
			</div>
			<?php
			the_posts_pagination();
		else :
			?>
			<p class="mb-0">No posts found.</p>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
