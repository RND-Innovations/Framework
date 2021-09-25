<?php

/**************************************/
/* Developed By : Priyankara Dilantha */
/* Contact Me 	: www.dilantha.org ****/
/**************************************/

function bind_page_default_header($items) {

    $str = ''; 
    

    $str .= '<section class="'.get_filter('top_nav_section_class',"").'">';
    $str .= get_filter('page_logo',"");
    $str .= '<nav class="'.get_filter('top_nav_nav_class',"").'">';
        $str .= '<ul class="'.get_filter('top_nav_ul_class',"").'">';
            $str .= get_filter('rnd_top_nav',"");
        $str .= '</ul>';
    $str .= '</nav>';
    $str .= get_filter('page_menu_handle',"");
    $str .= '</section>';    


	return $items.$str;
}
add_filter('page_header', 'bind_page_default_header');

function clean_header(){
    function remove_page_default_header($items) {

        $str = ''; 
        return $str;
    }
    add_filter('page_header', 'remove_page_default_header');  
}



function print_page_header_items() {
    echo get_filter('page_header',"");
}
add_action('rnd_header', 'print_page_header_items');

