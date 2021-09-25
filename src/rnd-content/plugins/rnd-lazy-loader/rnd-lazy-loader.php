<?php

/**
 * RND Lazy Loader
 *
 * @package           RNDCorePlugins
 * @author            Developer Dilantha
 * @copyright         2021 RND Innovations
 * @license           GPL-2.0-or-later
 *
 * @rnd-plugin
 * Plugin Name:       RND Lazy Loader
 * Plugin URI:        https://www.rndvn.com/framework/plugins/lazy-loader
 * Description:       This plugin will speedup image loading process of the page and save bandwidth.
 * Version:           1.0.0
 * Requires at least: 1.0.0
 * Requires PHP:      5.2
 * Author:            Dilantha
 * Author URI:        https://www.dilantha.org
 * Text Domain:       dilantha
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */


// To develop this plugin, the following links will be useful:
// https://www.programmersought.com/article/58362981209/
// https://css-tricks.com/the-complete-guide-to-lazy-loading-images/
// https://imagekit.io/blog/lazy-loading-images-complete-guide/

function rnd_lazy_loader_manipulate_content($items) {

    
    $pattern    = "/<img.*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/";
    $loader     = APP_TMPL_URL . '/plugins/' . basename( dirname( __FILE__ ) ) . '/images/loader2.png';
    
    return preg_replace_callback( $pattern, function($m) use($loader){

        $img    = $m[0];
        $img    = str_replace('src=', 'data-src=', $img);
        $img    = str_replace('<img', '<img src="' . $loader . '"', $img);
        
        if( strpos($img,'class="') ){
           $img = preg_replace('#class="#is', 'class="lazy ', $img);
        }else{
           $img = str_replace('<img', '<img class="lazy"', $img);
        }
        
        return $img;
        
    }, $items);
    

}
add_filter('page_content', 'rnd_lazy_loader_manipulate_content');

function rnd_lazy_loader_put_scripts($items) {

    $js_path = APP_TMPL . '/plugins/' . basename( dirname( __FILE__ ) ) . '/script.js';
    
    $scripts = get_file_contents_from_a_file( $js_path );
    //$js = $app->page->manipulate_content( $js , "script" );                        
    return $items.$scripts;
}
add_filter('page_script', 'rnd_lazy_loader_put_scripts'); 