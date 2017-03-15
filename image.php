<?php
/**
 * The template for displaying image attachments.
 *
 * @package Nu Themes
 */

get_header(); ?>

	<div class="row">
		<main id="content" class="col-md-8 col-lg-7 col-md-offset-0 col-lg-offset-1 content-area image-attachment" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'box' ); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

					<div class="entry-meta">
						<?php
							$metadata = wp_get_attachment_metadata();
							printf( __( '<time class="image-date" datetime="%1$s">%2$s</time> <a class="image-size" href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> <a class="image-entry" href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a>', 'nuthemes' ),
								esc_attr( get_the_date( 'c' ) ),
								esc_html( get_the_date() ),
								esc_url( wp_get_attachment_url() ),
								$metadata['width'],
								$metadata['height'],
								esc_url( get_permalink( $post->post_parent ) ),
								esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
								get_the_title( $post->post_parent )
							);

							edit_post_link( __( 'Edit', 'nuthemes' ), '<span class="edit-link">', '</span>' );
						?>
					<!-- .entry-meta --></div>
				<!-- .entry-header --></header>

				<div class="entry-content">
					<div class="entry-attachment">
						<div class="attachment">
							<?php nuthemes_the_attached_image(); ?>
						<!-- .attachment --></div>

						<?php if ( has_excerpt() ) : ?>
						<div class="entry-caption">
							<?php the_excerpt(); ?>
						<!-- .entry-caption --></div>
						<?php endif; ?>
					<!-- .entry-attachment --></div>

					<?php
						the_content();
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'nuthemes' ),
							'after'  => '</div>',
						) );
					?>
				<!-- .entry-content --></div>

				<?php edit_post_link( __( 'Edit', 'nuthemes' ), '<footer class="entry-footer entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
			<!-- #post-<?php the_ID(); ?> --></article>

			<nav role="navigation" id="image-navigation" class="image-navigation">
				<div class="nav-previous"><?php previous_image_link( false, __( '<span class="meta-nav">&larr;</span>', 'nuthemes' ) ); ?></div>
				<div class="nav-next"><?php next_image_link( false, __( '<span class="meta-nav">&rarr;</span>', 'nuthemes' ) ); ?></div>
			<!-- #image-navigation --></nav>

			<?php
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>

		<?php endwhile; ?>

		<!-- #content --></main>

		<?php get_sidebar(); ?>
	<!-- .row --></div>

<?php get_footer(); ?>
