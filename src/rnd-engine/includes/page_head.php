<?php

/**************************************/
/* Developed By : Priyankara Dilantha */
/* Contact Me 	: www.dilantha.org ****/
/**************************************/


function bind_page_default_head($items) {

    global $page_data;
    
    $str = ''; 
    
	$str .= '<title>' . get_arr_value( "title", $page_data, "Lowrance give some dollar site amen" ) . '</title>';
	$str .= '<meta name="description" content="' . get_arr_value( "description", $page_data, "Lowrance give some dollar site amen. Florance meets some collar bite amen." ) . '" />';
	$str .= '<meta name="keywords" content="' . get_arr_value( "keywords", $page_data, "lowrance give some" ) . '" />';
	$str .= '<link rel="canonical" href="' . get_arr_value( "url", $page_data, APP_URL) . '"/>';

	return $items.$str;
}
add_filter('page_head', 'bind_page_default_head');


function print_page_head_items() {
    echo '<head>';
    echo get_filter('page_head',"");
    
        echo '<style>';
            echo get_filter('page_style',"");
        echo '</style>';
    
    echo '</head>';
}
add_action('rnd_head', 'print_page_head_items');