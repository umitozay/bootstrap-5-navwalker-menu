<?php

require_once get_theme_file_path() . '/wp-bootstrap-navwalker.php';

function register_my_menus() {
    register_nav_menus(
        array(
            'primary' => __( 'Ust Menu', 'umitweb' ),
        )
    );
}
add_action( 'init', 'register_my_menus' );

