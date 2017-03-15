<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Nu Themes
 */

get_header(); ?>

	<div class="row">
		<main id="content" class="col-md-8 col-lg-9 content-area" role="main">

			<section class="error-404 not-found box">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'nuthemes' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'nuthemes' ); ?></p>

		

					<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

				<!-- .page-content --></div>
			<!-- .error-404 --></section>

		<!-- #content --></main>

	
	<!-- .row --></div>

<?php get_footer(); ?>