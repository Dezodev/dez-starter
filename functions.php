<?php
/*
 *  Author: DezoDev | @dezodev
 *  URL: http://dezodev.tk/
 */

require_once('inc/bootstrap-walker-nav-menu.php');

/* Theme Support
**=====================================*/
if (!isset($content_width)) {
    $content_width = 900;
}

if (function_exists('add_theme_support')) {
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 750, 322, false); // Large Thumbnail
    add_image_size('medium', 250, 188, true); // Medium Thumbnail
    add_image_size('small', 150, 150, true); // Small Thumbnail

    add_theme_support('html5', ['comment-list']);

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/* Scripts & styles
**=====================================*/

function dez_custom_scripts() {
    wp_register_script('dez-jquery-script', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js', false, null, true);
    wp_enqueue_script('dez-jquery-script');

    wp_register_script('dez-popper-script', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', array('dez-jquery-script'), null, true);
    wp_enqueue_script('dez-popper-script');

    wp_register_script('dez-bootstrap4-script', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js', array('dez-jquery-script', 'dez-popper-script'), null, true);
    wp_enqueue_script('dez-bootstrap4-script');

    wp_register_script('dez-feather-icons', 'https://unpkg.com/feather-icons/dist/feather.min.js', false, null, true);
    wp_enqueue_script('dez-feather-icons');

    wp_register_script('dez-smooth-scroll-script', get_bloginfo('template_url') . '/node_modules/smooth-scroll/dist/js/smooth-scroll.min.js', false, null, true);
    wp_enqueue_script('dez-smooth-scroll-script');

    wp_register_script('dez-theme-script', get_bloginfo('template_url') . '/js/main.min.js', array('dez-jquery-script', 'dez-popper-script', 'dez-bootstrap4-script', 'dez-smooth-scroll-script'), '0.0.1', true);
    wp_enqueue_script('dez-theme-script');
}
add_action('wp_enqueue_scripts', 'dez_custom_scripts');

function dez_custom_styles() {
    wp_register_style('dez-bootstrap-style', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css', false, null, 'all');
    wp_enqueue_style('dez-bootstrap-style');

    wp_register_style('dez-fontawesome-style', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', false, null, 'all');
    wp_enqueue_style('dez-fontawesome-style');

    wp_register_style('dez-theme-style', get_bloginfo('template_url') . '/css/main.css', array('dez-bootstrap-style'), '0.0.1');
    wp_enqueue_style('dez-theme-style');
}
add_action('wp_enqueue_scripts', 'dez_custom_styles');

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
        'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
    ));
}
add_action('init', 'register_dezo_menu');

function display_post_meta_info($link_to_comment = false) {
?>
    <ul class="list-inline post-meta-infos text-center">
        <li class="list-inline-item post-date"><time datetime="<?php the_time('c'); ?>"><?php the_time(get_option('date_format').' '.get_option('time_format')); ?></time></li>
        <li class="list-inline-item post-author"><i data-feather="user"></i> <?php the_author_posts_link(); ?></li>

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
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="card card-mb %2$s"><div class="card-body">',
        'after_widget' => '</div></div>',
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
			'<div class="form-group row comment-form-author"><div class="col-sm-4"><label for="author">' . __( 'Name', 'html5blank' ) .
			( $req ? '<span class="required">*</span>' : '' ) . '</label></div>' .
			'<div class="col-sm-8"><input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
			'"' . $aria_req . ' /></div></div>',

		'email' =>
			'<div class="form-group row comment-form-email"><div class="col-sm-4"><label for="email">' . __( 'Email', 'html5blank' ) .
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
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $args['has_children'] ? 'parent row' : 'row' ); ?>>

        <?php if ( 0 != $args['avatar_size'] ): ?>
        <div class="comment-left col-auto mr-3 pr-0">
            <a href="<?php echo get_comment_author_url(); ?>" class="comment-avatar">
                <?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
            </a>
        </div>
        <?php endif; ?>

        <div class="comment-body col" id="div-comment-<?php comment_ID(); ?>">

            <?php printf( '<h4 class="comment-heading mt-0">%s</h4>', get_comment_author_link() ); ?>

            <div class="comment-metadata">
                <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>" class="smooth-scroll">
                    <time datetime="<?php comment_time( 'c' ); ?>"> <?php echo get_comment_date(). ' ' .get_comment_time(); ?> </time>
                </a>
            </div><!-- .comment-metadata -->

            <?php if ( '0' == $comment->comment_approved ) : ?>
            <p class="comment-awaiting-moderation label label-info"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
            <?php endif; ?>

            <div class="comment-content">
                <?php comment_text(); ?>
            </div><!-- .comment-content -->

            <ul class="list-inline text-right">
                <?php edit_comment_link( __( 'Edit' ), '<li class="list-inline-item edit-link">', '</li>' ); ?>

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
<?php
}

/* Optimizations
**=====================================*/

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist) {
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}
add_filter('the_category', 'remove_category_rel_from_category_list');

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
