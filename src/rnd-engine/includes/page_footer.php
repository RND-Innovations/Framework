<?php

/**************************************/
/* Developed By : Priyankara Dilantha */
/* Contact Me 	: www.dilantha.org ****/
/**************************************/

function bind_page_default_footer($items) {

    global $page_data;
    
    $str = ''; 
    
	$str .= '<section class="'.get_filter('footer_nav_section_class',"").'">';
	$str .= '<nav class="'.get_filter('footer_nav_nav_class',"").'">';
        $str .= '<ul class="'.get_filter('footer_nav_ul_class',"").'">';
            $str .= get_filter('rnd_footer_nav',"");
        $str .= '</ul>';
    $str .= '</nav>';
    $str .= '<p class="copyright"> © '.get_filter('page_footer_copyright',"").'</p>';
    $str .= '</section>';
    
	return $items.$str;
}
add_filter('page_footer', 'bind_page_default_footer');

function clean_footer(){
    function remove_page_default_footer($items) {

        $str = ''; 
        return $str;
    }
    add_filter('page_footer', 'remove_page_default_footer');    
}

function print_page_footer_items() {
    echo get_filter('page_footer',"");
    
    echo '<script>';
        echo get_filter('page_script',"");
    echo '</script>';    
}
add_action('rnd_footer', 'print_page_footer_items');

