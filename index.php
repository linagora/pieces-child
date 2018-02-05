<?php
/**
 * The main template file.
 *
 * @package Nu Themes
 */
get_header(); ?>
	<div class="row">
		<main id="content" class="col-md-12 col-lg-12 content-area" role="main">
		<?php if ( have_posts() ) : ?>
			<div id="masonry" class="row row-centered">
			<?php while ( have_posts() ) : the_post(); ?>
				<div id="archive-masonry" class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-sm-offset-0 col-md-offset-0 col-lg-offset-0 col-centered masonry-item">
					<?php get_template_part( 'content', get_post_format() ); ?>
				</div>
			<?php endwhile; ?>
			<!-- #masonry --></div>
			<?php nuthemes_content_nav( 'nav-below' ); ?>
		<?php else : ?>
			<?php get_template_part( 'no-results', 'index' ); ?>
		<?php endif; ?>
		<!-- #content --></main>
	<!-- .row --></div>
<?php get_footer(); ?>
