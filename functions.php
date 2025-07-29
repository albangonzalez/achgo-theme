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

add_action( 'wp_enqueue_scripts', 'achgo_enqueue_styles' );
