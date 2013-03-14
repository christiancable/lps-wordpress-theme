<?php


// load header font from google webfonts

function load_fonts() {
            wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Lobster');
            wp_enqueue_style( 'googleFonts');
}
 
add_action('wp_print_styles', 'load_fonts');

?>