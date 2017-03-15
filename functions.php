<?php
/**
 * Nu Themes functions and definitions
 *
 * @package Nu Themes
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since nuThemes 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 500; /* pixels */

if ( ! function_exists( 'nuthemes_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since nuThemes 1.0
 */
function nuthemes_setup() {

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'thumb-small', 350, 9999 );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'nuthemes' ),
	) );

}
endif;
add_action( 'after_setup_theme', 'nuthemes_setup' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since nuThemes 1.0
 */
function nuthemes_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}









add_filter( 'body_class', 'nuthemes_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since nuThemes 1.0
 */
function nuthemes_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'nuthemes_enhanced_image_navigation', 10, 2 );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @since nuThemes 1.0
 */
function nuthemes_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'nuthemes' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'nuthemes_wp_title', 10, 2 );

/**
 * Returns a "Continue Reading" link for  excerpts
 */
function nuthemes_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '" class="more-link">' . __( 'more <span class="meta-nav">&rarr;</span>', 'nuthemes' ) . '</a>';
}

/**
 * Adds a pretty "Continue Reading" link to defined excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function nuthemes_custom_excerpt( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= '&hellip; ' . nuthemes_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'nuthemes_custom_excerpt' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and athemes_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function nuthemes_auto_excerpt_more( $output ) {
	$output = '';
	$output .= '&hellip; ' . nuthemes_continue_reading_link();
	return $output;
}
add_filter( 'excerpt_more', 'nuthemes_auto_excerpt_more' );

/**
 * Sets the post excerpt length to maximum 20 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function nuthemes_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'nuthemes_excerpt_length' );


/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since nuThemes 1.0
 */
function nuthemes_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'nuthemes' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget box %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'nuthemes_widgets_init' );

/**
 * Returns the Google font stylesheet URL, if available.
 *
 * @since nuThemes 1.0
 */
function nuthemes_fonts_url() {
	$fonts_url = '';

	// Ubuntu
	$ubuntu = _x( 'on', 'Ubuntu font: on or off', 'nuthemes' );

	// Source Sans Pro
	$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'nuthemes' );

	if ( 'off' !== $ubuntu || 'off' !== $source_sans_pro ) {
		$font_families = array();

		if ( 'off' !== $ubuntu )
			$font_families[] = 'Ubuntu:400,500,400italic,500italic';

		if ( 'off' !== $source_sans_pro )
			$font_families[] = 'Source Sans Pro:300,400,700,300italic,400italic,700italic';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}

/**
 * Enqueues scripts and styles for front end.
 *
 * @since nuThemes 1.0
 */
function nuthemes_scripts() {
	// Load Bootstrap stylesheet.
	wp_enqueue_style( 'nu-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array() );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'nu-genericons', get_template_directory_uri() . '/css/genericons.css', array() );

	// Add Open Sans and Bitter fonts, used in the main stylesheet.
	wp_enqueue_style( 'nu-fonts', nuthemes_fonts_url(), array() );

	// Loads our main stylesheet.
	wp_enqueue_style( 'nu-style', get_stylesheet_uri(), array() );

	// Load Bootstrap JavaScript.
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), null, true );

	if ( ! is_admin() ) :
	    // Deregister built in masonry since it is old version 3.
	    wp_deregister_script( 'jquery-masonry' );

		// Load imagesLoaded plugin.
	    wp_enqueue_script( 'imagesLoaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', false, null, true );

		// Load newer masonry.
	    wp_enqueue_script( 'masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array( 'imagesLoaded'), null, true );

	endif;

	// Adds JavaScript to support threaded comments.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Load JavaScript settings.
	wp_enqueue_script( 'nu-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'nuthemes_scripts' );



define('NUTHEMES_PATH', get_template_directory() );

/**
 * Customizer additions.
 *
 * @since nuThemes 1.0
 */
require NUTHEMES_PATH . '/inc/customizer.php';

/**
 * Custom template tags for this theme.
 *
 * @since nuThemes 1.0
 */
require NUTHEMES_PATH . '/inc/template-tags.php';

/**
 * Custom nav walker to match Bootstrap structure.
 *
 * @since nuThemes 1.0
 */
require NUTHEMES_PATH . '/inc/wp-bootstrap-navwalker.php';

/**
 * Custom gallery using Bootstrap layout.
 *
 * @since nuThemes 1.0
 */
require NUTHEMES_PATH . '/inc/wp-bootstrap-gallery.php';

add_filter('widget_text', 'do_shortcode');

function CreateHackadelicDiscreetTextWidget() {
class HackadelicDiscreetTextWidget extends WP_Widget_Text
{
	function HackadelicDiscreetTextWidget() {
		$widget_ops = array('classname' => 'discreet_text_widget', 'description' => __('Arbitrary text or HTML, only shown if not empty'));
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('discrete_text', __('Discreet Text'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args, EXTR_SKIP);
		$text = apply_filters( 'widget_text', $instance['text'] );
		if (empty($text)) return;
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
			<div class="textwidget"><?php echo $instance['filter'] ? wpautop($text) : $text; ?></div>
		<?php
		echo $after_widget;
	}
}
return register_widget("HackadelicDiscreetTextWidget");
}

add_action('widgets_init', 'CreateHackadelicDiscreetTextWidget');

/**
* Remove the text – ‘You may use these <abbr title=”HyperText Markup
* Language”>HTML</abbr> tags …’
* from below the comment entry box.
*/

add_filter(‘comment_form_defaults’, ‘remove_comment_styling_prompt’);

function remove_comment_styling_prompt($defaults) {
$defaults

[‘comment_notes_after’] = ”;
return $defaults;
}
