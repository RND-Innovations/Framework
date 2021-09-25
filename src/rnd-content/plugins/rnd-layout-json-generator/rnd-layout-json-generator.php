<?php

/**
 * RND Layout Json Generator
 *
 * @package           RNDExtraPlugins
 * @author            Developer Dilantha
 * @copyright         2021 RND Innovations
 * @license           GPL-2.0-or-later
 *
 * @rnd-plugin
 * Plugin Name:       RND Layout Json Generator
 * Plugin URI:        https://rnd.rodee.ca/core-plugins
 * Description:       This will generate page.json file for all layouts that we can find in the theme folder.
 * Version:           1.1.0
 * Requires at least: 1.0.0
 * Requires PHP:      5.2
 * Author:            Dilantha
 * Author URI:        https://www.dilantha.org
 * Text Domain:       dilantha
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

if(SITE_TEST_MODE>0){
    rnd_layout_json_generator_generate();
}


function rnd_layout_json_generator_generate(){
    foreach( glob( APP_TMPL . "/layouts/*", GLOB_ONLYDIR ) as $dir ){

        $name   = basename($dir);
        $page   = rnd_layout_json_generator_default_head( $name );
        
        // HTML: Load contents data from HTML file
        $fn = $dir . "/" . $name . ".html" ;
        if (file_exists($fn)){
            
            $str = get_file_contents_from_a_file( $fn );
            
            $subs = array();
            
            // Complex elemant types
            $pattern = "/---(.*?)---/i";
            if(preg_match_all($pattern, $str, $matches)) {
                $subs = rnd_layout_json_generator_complex_content($matches[1], $name);
            } 
            
            
            // Single elemant types
            $pattern = "/{{(.*?)}}/i";
            if(preg_match_all($pattern, $str, $matches)) {
                //$page += rnd_layout_json_generator_default_content($matches[1], "body", $subs);
                $page += array( 
                    "body" => rnd_layout_json_generator_default_content($matches[1], $subs) 
                );
            }else{
                $page += array( 
                    "body" => $subs 
                );
            }
            
           
        }
        
        // Style: Load contents data from CSS file
        $fn = $dir . "/" . $name . ".css" ;
        if (file_exists($fn)){
            $str = get_file_contents_from_a_file( $fn );
            $pattern = "/{{(.*?)}}/i";
            if(preg_match_all($pattern, $str, $matches)) {
                //$page += rnd_layout_json_generator_default_content($matches[1], "style");
                $page += array( 
                    "style" => rnd_layout_json_generator_default_content($matches[1]) 
                );                
            }
        }        

        // Script: Load contents data from JS file
        $fn = $dir . "/" . $name . ".js" ;
        if (file_exists($fn)){
            $str = get_file_contents_from_a_file( $fn );
            $pattern = "/{{(.*?)}}/i";
            if(preg_match_all($pattern, $str, $matches)) {
                //$page += rnd_layout_json_generator_default_content($matches[1], "script");
                $page += array( 
                    "script" => rnd_layout_json_generator_default_content($matches[1]) 
                );                
            }
        } 
        
        $jfile  = APP_TMPL . '/layouts/' . $name . ".json" ; 
        
        $fp = fopen($jfile, 'w');
        fwrite($fp, json_encode($page, JSON_PRETTY_PRINT));
        fclose($fp);
        
    }
}

function rnd_layout_json_generator_default_head($layout_name){
    
    return array( "head" => array(
        "title"     => "[[TITLE]]",
        "text"      => "[[TEXT]]",
        "keys"      => "[[KEYWORDS]]",
        "short"     => "[[SHORT]]",
        "layout"    => $layout_name,
    ));
    
}

function rnd_layout_json_generator_default_content($tags_array, $append = array()){
    $contents = array();
    foreach($tags_array as $k=>$v){
        $contents += array( $v => "[[".strtoupper($v)."]]") ;
    }
    
    $contents += $append;
    
    return $contents;//array( $type => $contents );
}

function rnd_layout_json_generator_complex_content($tags_array, $parent){
    
    $return = array();
    
    foreach($tags_array as $tag){
        

        
        $fn = APP_TMPL . "/layouts/" . $parent . "/children/" . $tag . ".html";
        if (file_exists($fn)){
            
            $str = get_file_contents_from_a_file( $fn );
            
            $subs = array("layout"=>$tag);
            
            
            // Complex elemant types
            $pattern = "/---(.*?)---/i";
            if(preg_match_all($pattern, $str, $matches)) {
                $subs += rnd_layout_json_generator_complex_content($matches[1], $parent );
                $complex_found  = 1;
            } 
            
            
            // Single elemant types
            $pattern = "/{{(.*?)}}/i";
            if(preg_match_all($pattern, $str, $matches)) {
                if(isset($complex_found)){
                    $subs = rnd_layout_json_generator_default_content($matches[1], $subs);   
                }else{
                    $subs = $subs + rnd_layout_json_generator_default_content($matches[1]);
                }

            }
                      
        } 
        $return += array($tag=>$subs);
    }
    
    return $return;
}