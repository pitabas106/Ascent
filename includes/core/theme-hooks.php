<?php
/**
 * Theme Hook Alliance hook stub list.
 *
 * @see  https://github.com/zamoose/themehookalliance
 *
 * @package     Ascent
 * @author      Ascent
 * @copyright   Copyright (c) 2019, Ascent
 * @link        https://ascenttheme.com/
 * @since       3.7.0
 *
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

/**
 * Define the version of THA support, in case that becomes useful down the road.
 */
define( 'ASCENT_HOOKS_VERSION', '1.0.0' );

/**
 * Themes and Plugins can check for ascent_hooks using current_theme_supports( 'ascent_hooks', $hook )
 * to determine whether a theme declares itself to support this specific hook type.
 *
 * Example:
 * <code>
 * 		// Declare support for all hook types
 * 		add_theme_support( 'ascent_hooks', array( 'all' ) );
 *
 * 		// Declare support for certain hook types only
 * 		add_theme_support( 'ascent_hooks', array( 'header', 'content', 'footer' ) );
 * </code>
 */
add_theme_support( 'ascent_hooks', array(

	/**
	 * As a Theme developer, use the 'all' parameter, to declare support for all
	 * hook types.
	 * Please make sure you then actually reference all the hooks in this file,
	 * Plugin developers depend on it!
	 */
	'all',

	/**
	 * Themes can also choose to only support certain hook types.
	 * Please make sure you then actually reference all the hooks in this type
	 * family.
	 *
	 * When the 'all' parameter was set, specific hook types do not need to be
	 * added explicitly.
	 */
	'html',
	'body',
	'head',
	'header',
	'content',
	'entry',
	'comments',
	'sidebars',
	'sidebar',
	'footer',

	/**
	 * If/when WordPress Core implements similar methodology, Themes and Plugins
	 * will be able to check whether the version of THA supplied by the theme
	 * supports Core hooks.
	 */
	//'core',
) );

/**
 * Determines, whether the specific hook type is actually supported.
 *
 * Plugin developers should always check for the support of a <strong>specific</strong>
 * hook type before hooking a callback function to a hook of this type.
 *
 * Example:
 * <code>
 * 		if ( current_theme_supports( 'ascent_hooks', 'header' ) )
 * 	  		add_action( 'ascent_head_top', 'prefix_header_top' );
 * </code>
 *
 * @param bool $bool true
 * @param array $args The hook type being checked
 * @param array $registered All registered hook types
 *
 * @return bool
 */
function ascent_current_theme_supports( $bool, $args, $registered ) {
	return in_array( $args[0], $registered[0] ) || in_array( 'all', $registered[0] );
}
add_filter( 'current_theme_supports-ascent_hooks', 'ascent_current_theme_supports', 10, 3 );

/**
 * HTML <html> hook
 * Special case, useful for <DOCTYPE>, etc.
 * $ascent_supports[] = 'html;
 */
function ascent_html_before() {
	do_action( 'ascent_html_before' );
}
/**
 * HTML <body> hooks
 * $ascent_supports[] = 'body';
 */
function ascent_body_top() {
	do_action( 'ascent_body_top' );
}

function ascent_body_bottom() {
	do_action( 'ascent_body_bottom' );
}

/**
 * HTML <head> hooks
 *
 * $ascent_supports[] = 'head';
 */
function ascent_head_top() {
	do_action( 'ascent_head_top' );
}

function ascent_head_bottom() {
	do_action( 'ascent_head_bottom' );
}

/**
 * Semantic <header> hooks
 *
 * $ascent_supports[] = 'header';
 */
function ascent_header_before() {
	do_action( 'ascent_header_before' );
}

function ascent_header_after() {
	do_action( 'ascent_header_after' );
}

function ascent_header_top() {
	do_action( 'ascent_header_top' );
}

function ascent_header_bottom() {
	do_action( 'ascent_header_bottom' );
}

/**
 * Semantic <content> hooks
 *
 * $ascent_supports[] = 'content';
 */
function ascent_content_before() {
	do_action( 'ascent_content_before' );
}

function ascent_content_after() {
	do_action( 'ascent_content_after' );
}

function ascent_content_top() {
	do_action( 'ascent_content_top' );
}

function ascent_content_bottom() {
	do_action( 'ascent_content_bottom' );
}

function ascent_content_while_before() {
	do_action( 'ascent_content_while_before' );
}

function ascent_content_while_after() {
	do_action( 'ascent_content_while_after' );
}

/**
 * Semantic <entry> hooks
 *
 * $ascent_supports[] = 'entry';
 */
function ascent_entry_before() {
	do_action( 'ascent_entry_before' );
}

function ascent_entry_after() {
	do_action( 'ascent_entry_after' );
}

function ascent_entry_content_before() {
	do_action( 'ascent_entry_content_before' );
}

function ascent_entry_content_after() {
	do_action( 'ascent_entry_content_after' );
}

function ascent_entry_top() {
	do_action( 'ascent_entry_top' );
}

function ascent_entry_bottom() {
	do_action( 'ascent_entry_bottom' );
}

/**
 * Comments block hooks
 *
 * $ascent_supports[] = 'comments';
 */
function ascent_comments_before() {
	do_action( 'ascent_comments_before' );
}

function ascent_comments_after() {
	do_action( 'ascent_comments_after' );
}

/**
 * Semantic <sidebar> hooks
 *
 * $ascent_supports[] = 'sidebar';
 */
function ascent_sidebars_before() {
	do_action( 'ascent_sidebars_before' );
}

function ascent_sidebars_after() {
	do_action( 'ascent_sidebars_after' );
}

function ascent_sidebar_top() {
	do_action( 'ascent_sidebar_top' );
}

function ascent_sidebar_bottom() {
	do_action( 'ascent_sidebar_bottom' );
}

/**
 * Semantic <footer> hooks
 *
 * $ascent_supports[] = 'footer';
 */
function ascent_footer_before() {
	do_action( 'ascent_footer_before' );
}

function ascent_footer_after() {
	do_action( 'ascent_footer_after' );
}

function ascent_footer_top() {
	do_action( 'ascent_footer_top' );
}

function ascent_footer_bottom() {
	do_action( 'ascent_footer_bottom' );
}


/* Ascent extra hooks */

function ascent_entry_meta_before() {
	do_action( 'ascent_entry_meta_before' );
}

function ascent_entry_meta_after() {
	do_action( 'ascent_entry_meta_after' );
}

function ascent_entry_header_before() {
	do_action( 'ascent_entry_header_before' );
}

function ascent_entry_header_after() {
	do_action( 'ascent_entry_header_after' );
}

function ascent_entry_footer_before() {
	do_action( 'ascent_entry_footer_before' );
}

function ascent_entry_footer_after() {
	do_action( 'ascent_entry_footer_after' );
}


