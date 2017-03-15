<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Nu Themes
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'box' ); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	<!-- .entry-header --></header>

	<div class="clearfix entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'nuthemes' ),
				'after'  => '</div>',
			) );
		?>
	<!-- .entry-content --></div>

	<?php edit_post_link( __( 'Edit', 'nuthemes' ), '<footer class="entry-footer entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
<!-- #post-<?php the_ID(); ?> --></article>