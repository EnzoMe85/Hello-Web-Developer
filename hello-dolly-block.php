<?php
/**
 * Plugin Name:       Hello Web Developer
 * Description:       Based on Matt Mullenweg's popular "Hello Dolly" plug-in, the "Hello, Web Developer" block is a block for random quotes on the web. You can use it in your pages developed with block editors. This fantastic WordPress Block is dedicated to the many Web Developers who are approaching the wonderful world of WordPress ❤️
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Enzo Mele
 * Author URI:		  Enzomele.it
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       hello-Web-Developer
 *
 * @package           create-block
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_hello_dolly_block_block_init() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'create_block_hello_dolly_block_block_init' );

function hello_dolly_get_lyric() {
	/** These are the lyrics to Hello Dolly */
	$lyrics = " “It’s not a bug. It’s an undocumented feature!”
	“A website without visitors is like a ship lost in the horizon.”
	“If you think math is hard, try web design.”
	“We don’t just build websites, we build websites that SELLS.”
	“A website without SEO is like a car with no gas.”
	“Websites promote you 24/7: No employee will do that.”
	“Digital design is like painting, except the paint never dries.”
	“Things aren’t always #000000 and #FFFFFF.”
	“I will never stop learning.”";

	// Here we split it into lines.
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line.
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later.
function hello_dolly_render_liryc() {
	$chosen = hello_dolly_get_lyric();
	$lang   = '';
	if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
		$lang = ' lang="en"';
	}

	return sprintf(
		'<span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span>',
		__( 'Quote from Hello Dolly song, by Jerry Herman:' ),
		$lang,
		$chosen
	);
}
