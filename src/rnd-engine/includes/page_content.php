<?php

/**************************************/
/* Developed By : Priyankara Dilantha */
/* Contact Me 	: www.dilantha.org ****/
/**************************************/

// Define Uploaded/Images directory
if(!defined('MEDIA_URL')) {
    define("MEDIA_URL", APP_TMPL_URL . '/uploads' );
}


function bind_page_default_content($items) {

    $str = ''; 
    
    $str .= '<div>';
        //$str .= get_filter('rnd_top_nav',"");
    $str .= '</div>';   


	return $items.$str;
}
add_filter('page_content', 'bind_page_default_content');


function clean_content(){
    function remove_page_default_content($items) {

        $str = ''; 
        return $str;
    }
    add_filter('page_content', 'remove_page_default_content');  
}


function print_page_content_items() {
    echo get_filter('page_content',"");
}
add_action('rnd_content', 'print_page_content_items');