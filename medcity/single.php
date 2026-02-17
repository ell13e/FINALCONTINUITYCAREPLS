<?php
/**
 * Single post template — Medcity UI.
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
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header mb-40">
					<div class="post__meta d-flex mb-20">
						<span class="post__meta-date"><?php echo get_the_date(); ?></span>
						<?php if ( get_the_author() ) : ?>
							<span class="post__meta-author ml-20"><?php the_author(); ?></span>
						<?php endif; ?>
					</div>
					<h1 class="heading__title"><?php the_title(); ?></h1>
				</header>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="post__img mb-40"><?php the_post_thumbnail( 'large', array( 'loading' => 'lazy' ) ); ?></div>
				<?php endif; ?>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</article>
			<?php
		endwhile;
		?>
	</div>
</main>
<?php
get_footer();
