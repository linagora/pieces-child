<?php
/**
 * The template for displaying archive pages.
 *
 * @package Nu Themes
 */

get_header(); ?>

	<div class="row">
		<main id="content" class="col-md-12 col-lg-12 content-area" role="main">

		<?php if ( have_posts() ) : ?>

				<header class="box archive-header">
					<h1 class="archive-title">
						<?php
							if ( is_category() ) :
								single_cat_title();

							elseif ( is_tag() ) :
								single_tag_title();

							elseif ( is_author() ) :
								the_post();
								printf( __( 'Author: %s', 'nuthemes' ), '<span class="vcard">' . get_the_author() . '</span>' );
								rewind_posts();

							elseif ( is_day() ) :
								printf( __( 'Day: %s', 'nuthemes' ), '<span>' . get_the_date() . '</span>' );

							elseif ( is_month() ) :
								printf( __( 'Month: %s', 'nuthemes' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

							elseif ( is_year() ) :
								printf( __( 'Year: %s', 'nuthemes' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

							else :
								_e( 'Archives', 'nuthemes' );

							endif;
						?>
					</h1>
					<?php
						$term_description = term_description();
						if ( ! empty( $term_description ) ) :
							printf( '<div class="taxonomy-description">%s</div>', $term_description );
						endif;
					?>
				<!-- .archive-header --></header>

				<div id="masonry" class="row">
				<?php while ( have_posts() ) : the_post(); ?>

					<div id="archive-masonry" class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-sm-offset-0 col-md-offset-0 col-lg-offset-0 masonry-item masonry-item">
						<?php get_template_part( 'content', get_post_format() ); ?>
					</div>

				<?php endwhile; ?>
			<!-- #masonry --></div>

			<?php nuthemes_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>

		<!-- #content --></main>
	<!-- .row --></div>

<?php get_footer(); ?>
