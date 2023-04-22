<?php

/**
 * Theme Scripts
 */

 namespace App\Theme\Scripts;

 /**
  * Add hooks
  */
 function init() {
    add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\theme_assets' );
    add_filter( 'script_loader_tag',  __NAMESPACE__ . '\\make_script_module', 10, 3 );
 }

 /**
  * Load theme scripts
  */
 function theme_assets() {
    if ( wp_get_environment_type() == 'local' ) {
        wp_enqueue_script('vite-script', 'http://localhost:5173/@vite/client', [], null);
        wp_enqueue_script('vite-script2', 'http://localhost:5173/src/js/index.js', [], null);
    } else {
        wp_enqueue_script( 'vite-script', get_template_directory_uri() . '/src/js/main.js', [], '1.0.0', true );
    }
}

/**
 * Load scripts as module
 * 
 * @return string
 */
function make_script_module($tag, string $handle, string $src) {
    if (in_array($handle, ['vite-script', 'vite-script2'])) {
        return "<script type='module' src='" . esc_url($src) . "' defer></script>";
    }

    return $tag;
}

