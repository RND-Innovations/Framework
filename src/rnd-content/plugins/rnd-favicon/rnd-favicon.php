<?php

/**
 * RND Favicon
 *
 * @package           RNDCorePlugins
 * @author            Developer Dilantha
 * @copyright         2021 RND Innovations
 * @license           GPL-2.0-or-later
 *
 * @rnd-plugin
 * Plugin Name:       RND Favicon
 * Plugin URI:        https://rnd.rodee.ca/core-plugins
 * Description:       This plugin will add a favicon and other important visual icons to the head.
 * Version:           1.0.1
 * Requires at least: 1.0.0
 * Requires PHP:      5.2
 * Author:            Dilantha
 * Author URI:        https://www.dilantha.org
 * Text Domain:       dilantha
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Generate Favicon from : https://www.favicon-generator.org/
// Learn More: https://evilmartians.com/chronicles/how-to-favicon-in-2021-six-files-that-fit-most-needs
// Learn More: https://sympli.io/blog/heres-everything-you-need-to-know-about-favicons-in-2020/

function rnd_favicon_add_image($items) {

    $path   = APP_TMPL_URL . '/plugins/' . basename( dirname( __FILE__ ) ) . '/logos';
    
    $str = '<link rel="icon" type="image/png" href="'.$path.'/favicon.ico" sizes="16x16">'; 
    
    $str .= '<link rel="icon" type="image/png" href="'.$path.'/favicon-16x16.png" sizes="16x16">';    
    $str .= '<link rel="icon" type="image/png" href="'.$path.'/favicon-32x32.png" sizes="32x32">'; 
    $str .= '<link rel="icon" type="image/png" href="'.$path.'/favicon-96x96.png" sizes="96x96">';
    
    $str .= '<link rel="apple-touch-icon" href="'.$path.'/apple-icon-57x57.png" sizes="57x57" >';
    $str .= '<link rel="apple-touch-icon" href="'.$path.'/apple-icon-60x60.png" sizes="60x60" >';
    $str .= '<link rel="apple-touch-icon" href="'.$path.'/apple-icon-72x72.png" sizes="72x72" >';
    $str .= '<link rel="apple-touch-icon" href="'.$path.'/apple-icon-76x76.png" sizes="76x76" >';
    $str .= '<link rel="apple-touch-icon" href="'.$path.'/apple-icon-114x114.png" sizes="114x114" >';
    $str .= '<link rel="apple-touch-icon" href="'.$path.'/apple-icon-120x120.png" sizes="120x120" >';    
    $str .= '<link rel="apple-touch-icon" href="'.$path.'/apple-icon-144x144.png" sizes="144x144" >';
    $str .= '<link rel="apple-touch-icon" href="'.$path.'/apple-icon-152x152.png" sizes="152x152" >';
    $str .= '<link rel="apple-touch-icon" href="'.$path.'/apple-icon-180x180.png" sizes="180x180" >';
    
    //$str = '<link rel="manifest" href="'.$path.'/manifest.json" type="image/png" >';
    
    
	return $items.$str;
}
add_filter('page_head', 'rnd_favicon_add_image');
