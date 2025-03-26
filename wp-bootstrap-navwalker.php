<?php
/**
 * WP_Bootstrap_Navwalker – Bootstrap 5 uyumlu özel Walker sınıfı
 *
 * Bu sınıf, verilen HTML5 yapısına birebir uyan menü çıktısı üretir.
 */
class WP_Bootstrap_Navwalker extends Walker_Nav_Menu {

    // Alt seviye (submenu) başlangıcı
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        if ($depth == 0) {
            // Üst seviye dropdown için
            $output .= "\n$indent<ul class=\"dropdown-menu fade-down\">\n";
        } else {
            // Daha derin alt menüler için
            $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
        }
    }

    // Alt seviye bitişi
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    // Menü öğesi başlangıcı
    public function start_el(  &$output, $item, $depth = 0, $args = array(), $id = 0  ) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        // Varsayılan sınıflar; WordPress'in "menu-item-has-children" sınıfını kontrol ediyoruz.
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes);

        if ($depth === 0) {
            // Üst seviye öğeler
            $li_classes = array('nav-item');
            if ($has_children) {
                $li_classes[] = 'dropdown';
            }
            $output .= $indent . '<li class="' . esc_attr(implode(' ', $li_classes)) . '">';

            // Üst seviye bağlantı ayarları
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
            // 1. seviye alt menü öğeleri
            if ($has_children) {
                // Alt menüde de dropdown varsa: dropdown-submenu
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
            // Derin seviye (depth>=2) öğeler; burada da benzer şekilde "dropdown-item" kullanıyoruz.
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

    // Menü öğesi bitişi
    public function end_el(  &$output, $item, $depth = 0, $args = array()  ) {
        $output .= "</li>\n";
    }
}
