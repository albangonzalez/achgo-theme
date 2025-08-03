<?php
/**
 * ACHGO theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage achgo
 * @since ACHGO 1.0
 */

function  achgo_enqueue_styles() {
	wp_enqueue_style(
		'achgo-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}

function achgo_add_editor_styles() {
	add_editor_style( get_stylesheet_uri() );
}

/**
 * Registers the block using a `blocks-manifest.php` file, which improves the performance of block type registration.
 * Behind the scenes, it also registers all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://make.wordpress.org/core/2025/03/13/more-efficient-block-type-registration-in-6-8/
 * @see https://make.wordpress.org/core/2024/10/17/new-block-type-registration-apis-to-improve-performance-in-wordpress-6-7/
 */
function achgo_post_header_block_init() {
    /**
     * Registers the block(s) metadata from the `blocks-manifest.php` and registers the block type(s)
     * based on the registered block metadata.
     * Added in WordPress 6.8 to simplify the block metadata registration process added in WordPress 6.7.
     *
     * @see https://make.wordpress.org/core/2025/03/13/more-efficient-block-type-registration-in-6-8/
     */
    if ( function_exists( 'wp_register_block_types_from_metadata_collection' ) ) {
        wp_register_block_types_from_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
        return;
    }

    /**
     * Registers the block(s) metadata from the `blocks-manifest.php` file.
     * Added to WordPress 6.7 to improve the performance of block type registration.
     *
     * @see https://make.wordpress.org/core/2024/10/17/new-block-type-registration-apis-to-improve-performance-in-wordpress-6-7/
     */
    if ( function_exists( 'wp_register_block_metadata_collection' ) ) {
        wp_register_block_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
    }
    /**
     * Registers the block type(s) in the `blocks-manifest.php` file.
     *
     * @see https://developer.wordpress.org/reference/functions/register_block_type/
     */
    $manifest_data = require __DIR__ . '/build/blocks-manifest.php';
    foreach ( array_keys( $manifest_data ) as $block_type ) {
        register_block_type( __DIR__ . "/build/{$block_type}" );
    }
}

add_action( 'wp_enqueue_scripts', 'achgo_enqueue_styles' );
add_action( 'after_setup_theme', 'achgo_add_editor_styles' );
add_action( 'init', 'achgo_post_header_block_init' );
