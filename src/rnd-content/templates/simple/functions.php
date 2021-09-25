<?php

/**************************************/
/* Developed By : Priyankara Dilantha */
/* Contact Me 	: www.dilantha.org ****/
/**************************************/

// When you add a custom, advanced theme,
// you should remove default areas

clean_header(); // Removing default header
//clean_content(); // No need default content
clean_footer(); // Removing default footer


// General 

function bind_simple_head($items) {

    $str = ''; 
    
    // Meta
    $str .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
    $str .= '<meta charset="utf-8">';
    $str .= '<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">';    
    
	return $items.$str;
}
add_filter('page_head', 'bind_simple_head');



function bind_simple_body_class($items) {

    $str = ''; 
    
	$str .= 'header-alt';
	$str .= ' ';
    
	return $items.$str;
}
add_filter('body_class', 'bind_simple_body_class');


function bind_simple_body($items) {
    
    $str = ''; 
    
	$str .= '<div id="wrapper">';
    $str .= get_filter('simple_header',"");
    $str .= '<section id="content">'.$items.'</section>';
    $str .= get_filter('simple_footer',"");
    $str .= '</div>';

	return $str;
}
add_filter('page_content', 'bind_simple_body');



// Header

function bind_simple_header($items) {
    
    $str = ''; 
    
    if(is_home()){
	   $str .= '<section id="header" class="home">';  
    }else{
	   $str .= '<section id="header">';   
    }

	$str .= '<a href="'.APP_URL.'" class="logo">' . SITE_NAME . '</a>';
	$str .= '<nav id="nav">';
        $str .= '<ul>';
            $str .= get_filter('rnd_top_nav',"");
        $str .= '</ul>';
    $str .= '</nav>';
    $str .= '</section>';

	return $items.$str;
}
add_filter('simple_header', 'bind_simple_header');


function bind_simple_top_nav_li_active($items) {
    
    $str = ''; 
    
	$str .= 'class="active"';

	return $str;
}
add_filter('top_nav_li_active', 'bind_simple_top_nav_li_active');


// Footer

function bind_simple_footer($items) {
    
    $str = ''; 
    
	$str .= '<section id="footer">';
        $str .= '<ul class="icons">';
            $str .= get_filter('rnd_footer_nav',"");
        $str .= '</ul>';
    $str .= '<p class="copyright"> © '.SITE_NAME.' '.date("Y").'.<br>'.SITE_TAG.'<br>Developed by <a href="https://www.dilantha.org/">Developer Dilantha</a> for <a href="https://www.rndvn.com">RND Innovations</a></p>';
    $str .= '</section>';

	return $items.$str;
}
add_filter('simple_footer', 'bind_simple_footer');
