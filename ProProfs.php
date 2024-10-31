<?php
/* 
Plugin Name: ProProfs Embed
Plugin URI: https://www.proprofs.com
Description: Embed quizzes, courses and surveys on your WordPress site with this easy to use embed plugin. Here is the shortcode [ProProfs src="https://proprofs.com" width="100%" height="500"]
Version: 1.0.0
Author: ProProfs
License: GPLv3   
*/

define('PROPROFS_PLUGIN_VERSION', '1.0.0');

add_filter( 'plugin_row_meta', 'pp_plugin_row_meta', 10, 2 );

function pp_frame( $attrib ) {    											// Setting default attributes for iframes                            
	$defaultparam = array(
		'src' => 'https://proprofs.com',
		'width' => '100%',
		'height' => '500',
		'scrolling' => 'yes',
		'class' => 'class-pp',
		'frameborder' => '1' );

	$attrib = shortcode_atts( $defaultparam, $attrib );       				// Merging the arguments with default parameter

	$condition = $attrib['src'];

				if(strpos($condition, "proprofs.com") !== false){

					$output = "\n".'<!-- ProProfs plugin v.'.PROPROFS_PLUGIN_VERSION.' -->'."\n";

					if( strpos($attrib['width'], '%') !== false )
						$output .= "<style> iframe.class-pp{width:".$attrib['width']."} </style>";
					else 
						$output .= "<style> iframe.class-pp{width:".$attrib['width']."px} </style>";

					$output .= '<iframe';

					foreach( $attrib as $key => $value ) {

						if ( $value != '' ) {  				            					// Adding all attributes
								$output .= ' ' . esc_attr( $key ) . '="' . esc_attr( $value ) . '"';
							} else {  														// Adding empty attributes
								$output .= ' ' . esc_attr( $key );
							}
						}

					$output .= '></iframe>'."\n";

					return $output;
					}
					
					else
					{
						echo "";
					}

  				 }

				function pp_plugin_row_meta( $urls, $file ) {       					  // Adding meta data(information) regarding plugin
					if ( $file == plugin_basename( __FILE__ ) ) {
						$plugin_row_meta = array('support' => '<a href="https://quiz.proprofs.com/submit-a-ticket" target="_blank"><span></span> ' . __( 'ProProfs Support', 'iframe' ) . '</a>' );
						$urls = array_merge( $urls, $plugin_row_meta );
					}
					return  $urls;
				}

				add_shortcode( 'ProProfs', 'pp_frame' );   	 							 // Adding shortcode for end users