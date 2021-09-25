<?php

/**************************************/
/* Developed By : Priyankara Dilantha */
/* Contact Me 	: www.dilantha.org ****/
/**************************************/


//-------------------------------
// Page Language code

function bind_page_language_code($items) {

    if( isset($_COOKIE["am-lang"]) ){
        $str = $_COOKIE["am-lang"];
    }else{
        $str = "en";
    }
     
	return $items.$str;
}
add_filter('page_lang', 'bind_page_language_code');

function print_page_language_code() {

    echo get_filter('page_lang',"");

}
add_action('page_lang', 'print_page_language_code');




//-------------------------------
// Page text direction LTR/RTL

function bind_page_text_directionality($items) {

    if( isset($_COOKIE["am-lang"]) ){

        switch ($_COOKIE["am-lang"]) {
                
            case "ar": $str = "rtl"; break;
            case "dv": $str = "rtl"; break;
            case "fa": $str = "rtl"; break; 
            case "ha": $str = "rtl"; break;
            case "he": $str = "rtl"; break;
            case "ks": $str = "rtl"; break;    
            case "ps": $str = "rtl"; break;
            case "ur": $str = "rtl"; break;
            case "yi": $str = "rtl"; break;
                
            case "arc": $str = "rtl"; break;
            case "ckb": $str = "rtl"; break;
            case "khw": $str = "rtl"; break;
                
            default: $str = "ltr";
        }
        
    }else{
        $str = "ltr";
    }
     
	return $items.$str;
}
add_filter('page_rtl', 'bind_page_text_directionality');


function print_page_text_directionality() {

    echo get_filter('page_rtl',"");

}
add_action('page_lang', 'print_page_text_directionality');




//-------------------------------
// Page Main HTML Tag

function print_page_main_html_tag() {

    echo '<!DOCTYPE html>';
    echo '<html lang="' . get_filter('page_lang',"") . '" data-textdirection="' . get_filter('page_rtl',"") . '">';

}
add_action('rnd_html', 'print_page_main_html_tag');


function print_page_main_html_end_tag() {

    echo '</html>';

}
add_action('rnd__html', 'print_page_main_html_end_tag');




//-------------------------------
// Page Main BODY Tag

function print_page_main_body_tag() {
    echo '<body class="'.get_filter('body_class',"").'" '.get_filter('body_style',"").' '.get_filter('body_enqueue_data',"").'>';
}
add_action('rnd_body', 'print_page_main_body_tag');


function print_page_main_body_end_tag() {

    echo '</body>';

}
add_action('rnd__body', 'print_page_main_body_end_tag');

