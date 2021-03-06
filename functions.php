<?php
/*
 *  Author: DezoDev | @dezodev
 *  URL: http://dezodev.tk/
 */

require_once('inc/bootstrap-walker-nav-menu.php');

include('inc/customizer.php');

/* Theme Support
**=====================================*/
if (!isset($content_width)) {
    $content_width = 900;
}


function dezo_setup() {
    if (function_exists('add_theme_support')) {
        // Add Menu Support
        add_theme_support('menus');

        // Add Thumbnail Theme Support
        add_theme_support('post-thumbnails');
        add_image_size('large', 750, 322, true); // Large Thumbnail
        add_image_size('medium', 250, 188, true); // Medium Thumbnail
        add_image_size('small', 150, 150, true); // Small Thumbnail

        // Site header image
        add_theme_support('custom-header', [
            'width'         => 2540,
            'height'        => 350,
            'default-image' => get_template_directory_uri() . '/images/header.jpg',
            'uploads'       => true,
        ]);

        // Comments
        add_theme_support('html5', ['comment-list']);

        // Custom logo
        add_theme_support('custom-logo', array(
            'height'      => 70,
            'width'       => 300,
            'flex-width' => true,
        ));

        // Localisation Support
        load_theme_textdomain('dez-starter', get_template_directory() . '/languages');
    }


}
add_action( 'after_setup_theme', 'dezo_setup' );

/* Scripts & styles
**=====================================*/
function theme_scripts() {

	$templ_dir = get_bloginfo('template_url');
	$templ_ver = '0.0.1';


	/* -- CSS -- */
	$css_includes = [
		[
			'name'          => 'dez-bootstrap-style',
			'url'           => $templ_dir. '/node_modules/bootstrap/dist/css/bootstrap.min.css',
			'dependencies'  => false,
			'version'       => '4.1.1',
			'media'         => 'all'
		],
		[
			'name'          => 'dez-fontawesome-style',
			'url'           => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
			'dependencies'  => false,
			'version'       => '4.7.0',
			'media'         => 'all'
		],
		[
			'name'          => 'dez-theme-style',
			'url'           => $templ_dir. '/assets/css/main.css',
			'dependencies'  => false,
			'version'       => time(),
			'media'         => 'all'
		],
	];

	foreach ($css_includes as $css_include) {
		wp_register_style( $css_include['name'], $css_include['url'], $css_include['dependencies'], $css_include['version'], $css_include['media'] );
		wp_enqueue_style( $css_include['name'] );
	}

	/* -- JS -- */
	$js_includes = [
		[
			'name'          => 'dez-jquery-script',
			'url'           => $templ_dir.'/node_modules/jquery/dist/jquery.min.js',
			'dependencies'  => false,
			'version'       => '3.3.1',
			'inFooter'      => true
		],
		[
			'name'          => 'dez-popper-script',
			'url'           => $templ_dir.'/node_modules/popper.js/dist/umd/popper.min.js',
			'dependencies'  => array('jquery'),
			'version'       => '1.14.3',
			'inFooter'      => true
		],
		[
			'name'          => 'dez-bootstrap-script',
			'url'           => $templ_dir.'/node_modules/bootstrap/dist/js/bootstrap.min.js',
			'dependencies'  => array('jquery', 'dez-popper-script'),
			'version'       => '4.1.1',
			'inFooter'      => true
		],
		[
			'name'          => 'dez-feather-icons',
			'url'           => $templ_dir.'/node_modules/feather-icons/dist/feather.min.js',
			'dependencies'  => false,
			'version'       => '4.7.3',
			'inFooter'      => true
		],
		[
			'name'          => 'dez-smooth-scroll-script',
			'url'           => $templ_dir.'/node_modules/smooth-scroll/dist/smooth-scroll.min.js',
			'dependencies'  => false,
			'version'       => '14.2.0',
			'inFooter'      => true
		],
		[
			'name'          => 'dez-theme-script',
			'url'           => $templ_dir.'/assets/js/main.min.js',
			'dependencies'  => array('jquery', 'dez-popper-script', 'dez-bootstrap-script', 'dez-smooth-scroll-script'),
			'version'       => time(),
			'inFooter'      => true
		],
	];

	foreach ($js_includes as $js_include) {
		wp_register_script( $js_include['name'], $js_include['url'], $js_include['dependencies'], $js_include['version'], $js_include['inFooter'] );
		wp_enqueue_script( $js_include['name'] );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );

/* Functions
**=====================================*/

// Navigation
function dezo_nav() {
    wp_nav_menu([
        'theme_location'  => 'header-menu',
        'menu'            => '',
        'container'       => 'div',
        'container_id'    => 'navbar-content',
        'container_class' => 'collapse navbar-collapse',
        'menu_id'         => false,
        'menu_class'      => 'navbar-nav',
        'echo'            => true,
        'depth'           => 2,
        'walker'          => new Bootstrap_Walker_Nav_Menu()
    ]);
}

function register_dezo_menu() {
    register_nav_menus(array(
        'header-menu' => __('Header Menu', 'dez-starter'), // Main Navigation
    ));
}
add_action('init', 'register_dezo_menu');

function display_post_meta_info($link_to_comment = false) {
?>
    <ul class="list-inline post-meta-infos text-center">
        <li class="list-inline-item post-date"><time datetime="<?php the_time('c'); ?>"><?php the_time(get_option('date_format').' '.get_option('time_format')); ?></time></li>

        <?php if(get_theme_mod('dezo_post_meta_authors_display', 'show') == 'show') : ?>
            <li class="list-inline-item post-author"><i data-feather="user"></i> <?php the_author_posts_link(); ?></li>
        <?php endif ?>

        <?php if (comments_open(get_the_ID())): ?>
            <li class="list-inline-item post-comments"><i data-feather="message-square"></i>
                <?php if($link_to_comment) echo '<a href="#comments-section" class="smooth-scroll">' ?>
                <?php echo get_comments_number() ?>
                <?php if($link_to_comment) echo '</a>' ?>
            </li>
        <?php endif; ?>
    </ul>
<?php
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes) {
    global $post;

    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    if (is_archive()) {
        $classes[] = 'outside-title-page';
    }

    return $classes;
}
add_filter('body_class', 'add_slug_to_body_class');

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar')) {
    // Define Sidebar Widget
    register_sidebar(array(
        'name' => __('Sidebar', 'dez-starter'),
        'description' => __('Widget area for Sidebar', 'dez-starter'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="widget-card card card-mb %2$s"><div class="card-body">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Footer Widget
    register_sidebar(array(
        'name' => __('Footer', 'dez-starter'),
        'description' => __('Widget area for footer', 'dez-starter'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="col-12 col-md widget-footer %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}
add_action('widgets_init', 'my_remove_recent_comments_style');

function dezo_pagination($echo) {
    global $wp_query;

    $big = 999999999; // need an unlikely integer

    $pages = paginate_links(array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'type'  => 'array',
        'prev_next'   => true,
    ));

    if(is_array($pages)) {
        $paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');

        $html = '<ul class="pagination">';

        foreach ( $pages as $page ) {
            $suppClass = (strpos($page, 'current') !== false)? ' active' : '';

            $page = str_replace('page-numbers', 'page-numbers page-link', $page);
            $html .= "<li class=\"page-item$suppClass\">$page</li>";
        }

        $html .= '</ul>';

        if ( $echo ) {
            echo $html;
        } else {
            return $html;
        }
    }
}
add_action('init', 'dezo_pagination');

 // Enable Threaded Comments
function enable_threaded_comments() {
    if (!is_admin()) {
        if (is_singular() and comments_open() and (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}
add_action('get_header', 'enable_threaded_comments');

/* Comments
**=====================================*/
    // Move comment field to bottom
function dezo_move_comment_field_to_bottom($fields) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;

    return $fields;
}
add_filter( 'comment_form_fields', 'dezo_move_comment_field_to_bottom' );

    // Define default fields with html
function dezo_comment_default_fields($arg) {
    return [
		'author' =>
			'<div class="form-group row comment-form-author"><div class="col-sm-4"><label for="author">' . __( 'Name', 'dez-starter' ) .
			( $req ? '<span class="required">*</span>' : '' ) . '</label></div>' .
			'<div class="col-sm-8"><input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
			'"' . $aria_req . ' /></div></div>',

		'email' =>
			'<div class="form-group row comment-form-email"><div class="col-sm-4"><label for="email">' . __( 'Email', 'dez-starter' ) .
			( $req ? '<span class="required">*</span>' : '' ) . '</label></div>' .
			'<div class="col-sm-8"><input id="email" class="form-control" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			'"' . $aria_req . ' /></div></div>',
    ];
}
add_filter('comment_form_default_fields', 'dezo_comment_default_fields');

    // Custom Comments Callback
function dezo_comments( $comment, $args, $depth ) {
    $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $args['has_children'] ? 'parent' : '' ); ?>>
        <article class="comment-body d-flex" id="div-comment-<?php comment_ID(); ?>">
            <?php if ( 0 != $args['avatar_size'] ): ?>
                <div class="comment-left col-auto">
                    <a href="<?php echo get_comment_author_url(); ?>" class="comment-avatar">
                        <?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
                    </a>
                </div>
            <?php endif; ?>

            <div class="comment-text col">

                <?php printf( '<h4 class="comment-heading mt-0">%s</h4>', get_comment_author_link() ); ?>

                <div class="comment-metadata">
                    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>" class="smooth-scroll">
                        <time datetime="<?php comment_time( 'c' ); ?>"> <?php echo get_comment_date(). ' ' .get_comment_time(); ?> </time>
                    </a>
                </div><!-- .comment-metadata -->

                <?php if ( '0' == $comment->comment_approved ) : ?>
                    <p class="comment-awaiting-moderation label label-info"><?php _e('Your comment is awaiting moderation.', 'dez-starter'); ?></p>
                <?php endif; ?>

                <div class="comment-content">
                    <?php comment_text(); ?>
                </div><!-- .comment-content -->

                <ul class="list-inline text-right">
                    <?php edit_comment_link( __('Edit', 'dez-starter'), '<li class="list-inline-item edit-link">', '</li>' ); ?>

                    <?php
                    comment_reply_link( array_merge( $args, array(
                        'add_below' => 'div-comment',
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth'],
                        'before'    => '<li class="list-inline-item reply-link">',
                        'after'     => '</li>'
                    ) ) );
                    ?>

                </ul>

            </div>

        </article>
<?php
}

/* Optimizations
**=====================================*/

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist) {
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}
add_filter('the_category', 'remove_category_rel_from_category_list');

// Remove hard coded thumbnails dimensions
function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);


/* Disable the emoji's
**=====================================*/

function disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
}
add_action('init', 'disable_emojis');

/**
* Filter function used to remove the tinymce emoji plugin.
*
* @param array $plugins
* @return array Difference betwen the two arrays
*/
function disable_emojis_tinymce($plugins) {
    if (is_array($plugins)) {
        return array_diff($plugins, array( 'wpemoji' ));
    } else {
        return array();
    }
}
