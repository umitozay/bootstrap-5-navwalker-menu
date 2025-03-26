<?php
/**
 * WP_Bootstrap_Navwalker – Bootstrap 5 uyumlu özel Walker sınıfı
 *
 * Bu sınıf, verilen HTML5 yapısına birebir uyan menü çıktısı üretir.
 */
class WP_Bootstrap_Navwalker extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        if ($depth == 0) {
            $output .= "\n$indent<ul class=\"dropdown-menu fade-down\">\n";
        } else {
            $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
        }
    }

    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    public function start_el(  &$output, $item, $depth = 0, $args = array(), $id = 0  ) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes);

        if ($depth === 0) {
            $li_classes = array('nav-item');
            if ($has_children) {
                $li_classes[] = 'dropdown';
            }
            $output .= $indent . '<li class="' . esc_attr(implode(' ', $li_classes)) . '">';

            $a_classes = array('nav-link');
            if ($has_children) {
                $a_classes[] = 'dropdown-toggle';
            }
            $href = ($has_children) ? '#' : esc_url($item->url);
            $attributes  = ' class="' . esc_attr(implode(' ', $a_classes)) . '"';
            $attributes .= ' href="' . $href . '"';
            if ($has_children) {
                $attributes .= ' data-bs-toggle="dropdown"';
            }

            $output .= '<a' . $attributes . '>';
            $output .= apply_filters('the_title', $item->title, $item->ID);
            $output .= '</a>';

        } elseif ($depth === 1) {
            if ($has_children) {
                $output .= $indent . '<li class="dropdown-submenu">';
                $a_classes = array('dropdown-item', 'dropdown-toggle');
                $href = '#';
            } else {
                $output .= $indent . '<li>';
                $a_classes = array('dropdown-item');
                $href = esc_url($item->url);
            }
            $attributes  = ' class="' . esc_attr(implode(' ', $a_classes)) . '"';
            $attributes .= ' href="' . $href . '"';

            $output .= '<a' . $attributes . '>';
            $output .= apply_filters('the_title', $item->title, $item->ID);
            $output .= '</a>';

        } else {
            $output .= $indent . '<li>';
            $a_classes = array('dropdown-item');
            $href = esc_url($item->url);
            $attributes  = ' class="' . esc_attr(implode(' ', $a_classes)) . '"';
            $attributes .= ' href="' . $href . '"';
            $output .= '<a' . $attributes . '>';
            $output .= apply_filters('the_title', $item->title, $item->ID);
            $output .= '</a>';
        }
    }

    public function end_el(  &$output, $item, $depth = 0, $args = array()  ) {
        $output .= "</li>\n";
    }
}
