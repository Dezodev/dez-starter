<?php
/**
* Class Name: Bootstrap_Walker_Nav_Menu
* Version: 1.0.0
* Description: A Bootstrap 4 Navbar for WordPress
* GitHub URI: https://github.com/juavenel/Bootstrap_Walker_Nav_Menu/
* Author: juavenel
* License: MIT
*/
class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {
    private $current_item;

    /**
    * Starts the list before the elements are added.
    *
    * @since 3.0.0
    *
    * @see Walker::start_lvl()
    *
    * @param string $output Passed by reference. Used to append additional content.
    * @param int    $depth  Depth of menu item. Used for padding.
    * @param array  $args   An array of wp_nav_menu() arguments.
    */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat( "\t", $depth );
        $output .= "\n$indent<div class=\"dropdown-menu\" aria-labelledby=\"dropdown-menu-item-" . $this->current_item->title . "\">\n";
    }

    /**
    * Ends the list of after the elements are added.
    *
    * @since 3.0.0
    *
    * @see Walker::end_lvl()
    *
    * @param string $output Passed by reference. Used to append additional content.
    * @param int    $depth  Depth of menu item. Used for padding.
    * @param array  $args   An array of wp_nav_menu() arguments.
    */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat( "\t", $depth );
        $output .= "$indent</div>\n";
    }

    /**
    * Starts the element output.
    *
    * @since 3.0.0
    * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
    *
    * @see Walker::start_el()
    *
    * @param string $output Passed by reference. Used to append additional content.
    * @param object $item   Menu item data object.
    * @param int    $depth  Depth of menu item. Used for padding.
    * @param array  $args   An array of wp_nav_menu() arguments.
    * @param int    $id     Current item ID.
    */
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $this->current_item = $item;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        // For when no menu has associated for this theme_location
        if (empty($item->menu_order)) return;

        if ( strcasecmp( $item->attr_title, 'dropdown-divider' ) == 0 && $depth === 1 ) {
            $output .= $indent . '<div class="dropdown-divider"></div>';
            return;
        }

        if ( strcasecmp( $item->attr_title, 'dropdown-header' ) == 0 && $depth === 1 ) {
            $output .= $indent . '<h6 class="dropdown-header">' . esc_attr( $item->title ) . '</h6>';;
            return;
        }

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        //Filters the arguments for a single nav menu item.
        $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

        // Filters the CSS class(es) applied to a menu item's list item element.
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names .= ' nav-item';

        if ( in_array( 'menu-item-has-children', $classes ) ) $class_names .= ' dropdown';
        if ( in_array( 'current-menu-item', $classes ) || in_array( 'current-menu-parent', $classes ) ) $class_names .= ' active';

        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        // Filters the ID applied to a menu item's list item element.
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        if ( $depth === 0 ) $output .= $indent . '<li' . $id . $class_names .'>';

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

        if ( $depth === 0 ) $atts['class'] = 'nav-link';

        if ( $depth === 0 && in_array( 'menu-item-has-children', $classes ) ) {
            $atts['class']       .= ' dropdown-toggle';
            $atts['data-toggle']  = 'dropdown';
            $atts['id']           = 'dropdown-menu-item-' . $this->current_item->title;
        }

        if ( $depth > 0 ) $atts['class'] = 'dropdown-item';
        if ( in_array('current-menu-item', $item->classes) ) $atts['class'] .= ' active';

        // Filters the HTML attributes applied to a menu item's anchor element.
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';

        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                if ($attr === 'title') $value = $item->title;
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        // This filter is documented in wp-includes/post-template.php
        $title = apply_filters( 'the_title', $item->title, $item->ID );

        // Filters a menu item's title.
        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
        $item_output = $args->before;

        $item_output .= '<a'. $attributes .'>';

        if (!empty($item->attr_title)) $item_output .= '<span class="' . esc_attr( $item->attr_title ) . '"></span>';

        else $item_output .= $args->link_before . $title . $args->link_after;

        $item_output .= '</a>';
        $item_output .= $args->after;

        // Filters a menu item's starting output.
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

    }

    /**
    * Ends the element output, if needed.
    *
    * @since 3.0.0
    *
    * @see Walker::end_el()
    *
    * @param string $output Passed by reference. Used to append additional content.
    * @param object $item   Page data object. Not used.
    * @param int    $depth  Depth of page. Not Used.
    * @param array  $args   An array of wp_nav_menu() arguments.
    */
    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        if ( in_array( 'menu-item-has-children', $item->classes ) && $depth === 0 ) $output .= "</li>\n";
    }
}
