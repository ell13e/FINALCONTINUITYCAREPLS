<?php
/**
 * Default page template — Medcity UI.
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
					<h1 class="heading__title"><?php the_title(); ?></h1>
				</header>
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
