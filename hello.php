<?php
/**
 * Plugin Name: Hello Dolly
 *
 * @package Hello Dolly
 *
 * Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, Dolly. When activated you will randomly see a lyric from <cite>Hello, Dolly</cite> in the upper right of your admin screen on every page.
 * Plugin URI: https://github.com/mt8/hello-dolly
 * Author: mt8
 * Version: 1.7.2
 * Author URI: https://mt8.biz/
 * Tested up to: 6.6
 * Requires at least: 4.6
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Original Plugin URI: http://wordpress.org/plugins/hello-dolly/
 * Original Author: Matt Mullenweg
 * Original Version: 1.7.2
 * Original Author URI: http://ma.tt/
 */

/**
 *  Get a lyric from Hello Dolly.
 *
 * @since 1.7.0
 * @return string
 */
function hello_dolly_get_lyric() {
	/** These are the lyrics to Hello Dolly */
	$lyrics = "Hello, Dolly
Well, hello, Dolly
It's so nice to have you back where you belong
You're lookin' swell, Dolly
I can tell, Dolly
You're still glowin', you're still crowin'
You're still goin' strong
I feel the room swayin'
While the band's playin'
One of our old favorite songs from way back when
So, take her wrap, fellas
Dolly, never go away again
Hello, Dolly
Well, hello, Dolly
It's so nice to have you back where you belong
You're lookin' swell, Dolly
I can tell, Dolly
You're still glowin', you're still crowin'
You're still goin' strong
I feel the room swayin'
While the band's playin'
One of our old favorite songs from way back when
So, golly, gee, fellas
Have a little faith in me, fellas
Dolly, never go away
Promise, you'll never go away
Dolly'll never go away again";

	// Here we split it into lines.
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line.
	return wptexturize( $lyrics[ wp_rand( 0, count( $lyrics ) - 1 ) ] );
}

/**
 * This just echoes the chosen line, we'll position it later.
 *
 * @since 1.7.0
 * @return void
 */
function hello_dolly() {
	$chosen = hello_dolly_get_lyric();
	$lang   = '';
	if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
		$lang = ' lang="en"';
	}

	printf(
		'<p id="dolly"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
		esc_html( __( 'Quote from Hello Dolly song, by Jerry Herman:', 'hello-dolly' ) ),
		esc_html( $lang ),
		esc_html( $chosen )
	);
}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'hello_dolly' );

/**
 * Enqueue the styles for the Hello Dolly.
 *
 * @since 1.7.0
 * @return void
 */
function dolly_css() {
	echo "
	<style type='text/css'>
	#dolly {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #dolly {
		float: left;
	}
	.block-editor-page #dolly {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#dolly,
		.rtl #dolly {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action( 'admin_head', 'dolly_css' );
