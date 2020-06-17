<?php
/**
 * Gutenberg Preset Colors
 *
 * Specify custom color swatches.
 *
 * After adding here, make sure your CSS for frontend and backend matches the rules that are generated.
 *
 * @package WordPress
 * @subpackage lf-theme
 * @since 1.0.0
 */

add_theme_support(
	'editor-color-palette',
	array(
		array(
			'name'  => __( 'White' ),
			'slug'  => 'white',
			'color' => '#FFFFFF',
		),
		array(
			'name'  => __( 'Black' ),
			'slug'  => 'black',
			'color' => '#202020',
		),
		array(
			'name'  => __( 'Primary' ),
			'slug'  => 'primary',
			'color' => '#0078f7',
		),
		array(
			'name'  => __( 'Secondary' ),
			'slug'  => 'secondary',
			'color' => '#97a8bb',
		),
		array(
			'name'  => __( 'Tertiary' ),
			'slug'  => 'tertiary',
			'color' => '#e4edf6',
		),
	)
);
