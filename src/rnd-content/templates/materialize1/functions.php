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


define("MAT1_THEME_COLOR","bg-rnd");

// General 
function bind_materialize1_head($items) {

    $str = ''; 
    
    // Meta
    $str .= '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';    
    
    // CSS
    $str .= '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">';
	$str .= '<link rel="stylesheet" href="'.RND_THEME_URL.'/css/materialize.min.css">';
    
	return $items.$str;
}
add_filter('page_head', 'bind_materialize1_head');


function bind_materialize1_main_js_files($items) {

    $str = ''; 
    
	$str .= '<script src="'.RND_THEME_URL.'/js/materialize.min.js"></script>';
    
	return $items.$str;
}
add_filter('page_footer', 'bind_materialize1_main_js_files');


function bind_materialize1_body_class($items) {

    $str = ''; 
    
	$str .= 'header-alt';
	$str .= ' ';
    
	return $items.$str;
}
add_filter('body_class', 'bind_materialize1_body_class');




// Header
function bind_materialize1_header($items) {
    
    $str = ''; 

    $str .= '<header>';
    $str .= '<div class="navbar-fixed">';
    
    $str .= '<nav class="'.MAT1_THEME_COLOR.'">';
    $str .= '<div class="nav-wrapper container">';
    $str .= '<a href="'.APP_URL.'" class="brand-logo">'.SITE_NAME.'</a>';
        $str .= '<ul class="right hide-on-med-and-down">';
            $str .= get_filter('rnd_top_nav',"");
        $str .= '</ul>';
    $str .= '</div>';
    $str .= '</nav>';

    $str .= '</div>';
    $str .= '</header>';    
    
	return $items.$str;
}
add_filter('materialize1_header', 'bind_materialize1_header');

// Content
function bind_materialize1_body($items) {
    
    $str = ''; 
    
    $str .= get_filter('materialize1_header',"");
    $str .= '<main class="container">' . $items . '</main>';
    $str .= get_filter('materialize1_footer',"");


	return $str;
}
add_filter('page_content', 'bind_materialize1_body');

// Footer
function bind_materialize1_footer($items) {
    
    $str = ''; 
   
    
	$str .= '<footer class="page-footer '.MAT1_THEME_COLOR.'">';
    
        $str .= '<div class="container">';
        $str .= '<div class="row">';
    
            $str .= '<div class="col l6 s12">';   
            $str .= '<h5 class="white-text">'.SEO_TITLE.'</h5>';
            $str .= '<p class="grey-text text-lighten-4">'.SEO_DESCRIPTION.'</p>';    
            $str .= '</div>';    
    
            $str .= '<div class="col l4 offset-l2 s12">';   
            $str .= '<h5 class="white-text">Explore More</h5>';
            $str .= '<ul>' . get_filter('rnd_footer_nav',"") . '</ul>';    
            $str .= '</div>'; 
    
        $str .= '</div>';
        $str .= '</div>';    
    
        $str .= '<div class="footer-copyright">';
        $str .= '<div class="container">';
        $str .= '© '.date("Y").' '.SITE_NAME.'';
        $str .= '<a class="grey-text text-lighten-4 right" href="https://materializecss.com">Based on MaterilizeCss</a>';
        $str .= '</div>';
        $str .= '</div>';
	$str .= '</footer>';
    
    
            
    /*
	$str .= '<section id="footer">';
        $str .= '<ul class="icons">';
            $str .= get_filter('rnd_footer_nav',"");
        $str .= '</ul>';
    $str .= '<p class="copyright"> © '.SITE_NAME.' '.date("Y").'.<br>Template Designer <a href="https://pixelarity.com/">Pixelarity</a> | Fonts Designer <a href="https://fontawesome.com/">FontAwesome</a></p>';
    $str .= '</section>';
    */
    
    
	return $items.$str;
}
add_filter('materialize1_footer', 'bind_materialize1_footer');



// Menu
function bind_materialize1_top_nav_li_active($items) {
    
    $str = ''; 
    
	$str .= 'class="active"';

	return $str;
}
add_filter('top_nav_li_active', 'bind_materialize1_top_nav_li_active');

function bind_materialize1_top_nav_li_sub_ico($items) {
    
    $str = ''; 
    
	$str .= '<i class="material-icons right">arrow_drop_down</i>';

	return $str;
}
add_filter('top_nav_li_sub_ico', 'bind_materialize1_top_nav_li_sub_ico');

function bind_materialize1_top_nav_li_sub_ul($items) {
    
    $str = ''; 
    
	$str .= 'class="dropdown-content"';

	return $str;
}
add_filter('top_nav_li_sub_ul', 'bind_materialize1_top_nav_li_sub_ul');

function bind_materialize1_top_nav_li_sub_a($items) {
    
    $str = ''; 
    
	$str .= 'class="dropdown-trigger"';

	return $str;
}
add_filter('top_nav_li_sub_a', 'bind_materialize1_top_nav_li_sub_a');


