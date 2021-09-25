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


// Add CSS and Set <head> area 
function bind_bootstrap5_head($items) {

    $str = ''; 
    
    // Meta
    $str .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
    $str .= '<meta charset="utf-8">';
    $str .= '<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">';    
    
    // CSS
	$str .= '<link rel="stylesheet" href="'.RND_THEME_URL.'/css/bootstrap.min.css">';
    $str .= '<link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">';

	return $items.$str;
}
add_filter('page_head', 'bind_bootstrap5_head');

// Add *.js files to the footer
function bind_bootstrap5_main_js_files($items) {

    $str = ''; 
    
	$str .= '<script src="'.RND_THEME_URL.'/js/bootstrap.min.js"></script>';
	return $items.$str;
}
add_filter('page_footer', 'bind_bootstrap5_main_js_files');




// Common Header
function bind_bootstrap5_header($items) {
    
    $str = ''; 
     
	$str .= '<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-rnd ">';
	$str .= '<div class="container-fluid">';
    
        $str .= '<a href="'.APP_URL.'" class="navbar-brand">'.SITE_NAME.'</a>';
        $str .= '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>';
    
    
        $str .= '<div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">';
        $str .= '<ul class="navbar-nav">';
        $str .= get_filter('rnd_top_nav',"");
        $str .= '</ul>';
        $str .= '</div>';
    
	$str .= '</div>';
	$str .= '</nav>';    
      
	return $items.$str;
}
add_filter('bootstrap5_header', 'bind_bootstrap5_header');


// Common Footer
function bind_bootstrap5_footer($items) {
    
    $str = ''; 
    
    //-------------------------------------------------------------------
    // We can manipulate default footer menu with Bootstrap design here
    $default_footer_menu    = get_filter('rnd_footer_nav',"");
    $default_footer_menu    = str_replace('<li>', '<li class="nav-item">', $default_footer_menu);
    $default_footer_menu    = str_replace('<a ', '<a class="nav-link" ', $default_footer_menu);
    //-------------------------------------------------------------------
    
	$str .= '<footer class="blog-footer">';
        $str .= '<ul class="nav justify-content-center">';
            $str .= $default_footer_menu;
        $str .= '</ul>';
    $str .= '<p class="copyright"> © '.SITE_NAME.' '.date("Y").'.<br>Built With <a href="https://getbootstrap.com/">Bootstrap</a> | Built By <a href="https://www.dilantha.org">Dilantha</a></p>';
    $str .= '</footer>';

	return $items.$str;
}
add_filter('bootstrap5_footer', 'bind_bootstrap5_footer');


// Content body
function bind_bootstrap5_body($items) {
    
    $str = ''; 
    
    $str .= get_filter('bootstrap5_header',"");
    
    $str .= '<main class="container">' . $items . '</main>';
    
    $str .= get_filter('bootstrap5_footer',"");
    

	return $str;
}
add_filter('page_content', 'bind_bootstrap5_body');




// Menu Related
function bind_bootstrap5_top_nav_li_active($items) {
    
    $str = ''; 
    
	$str .= '';

	return $str;
}
add_filter('top_nav_li_active', 'bind_bootstrap5_top_nav_li_active');

function bind_bootstrap5_top_nav_a_active($items) {
    
    $str = ''; 
    
	$str .= 'class="nav-link active" aria-current="page"';

	return $str;
}
add_filter('top_nav_a_active', 'bind_bootstrap5_top_nav_a_active');

function bind_bootstrap5_top_nav_li($items) {
    
    $str = ''; 
    
	$str .= 'class="nav-item"';

	return $str;
}
add_filter('top_nav_li', 'bind_bootstrap5_top_nav_li');

function bind_bootstrap5_top_nav_a($items) {
    
    $str = ''; 
    
	$str .= 'class="nav-link"';

	return $str;
}
add_filter('top_nav_a', 'bind_bootstrap5_top_nav_a');

function bind_bootstrap5_top_nav_li_sub($items) {
    
    $str = ''; 
    
	$str .= 'class="nav-item dropdown"';

	return $str;
}
add_filter('top_nav_li_sub', 'bind_bootstrap5_top_nav_li_sub');

function bind_bootstrap5_top_nav_li_sub_a($items) {
    
    $str = ''; 
    
	$str .= 'class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"';

	return $str;
}
add_filter('top_nav_li_sub_a', 'bind_bootstrap5_top_nav_li_sub_a');

function bind_bootstrap5_top_nav_li_sub_ul($items) {
    
    $str = ''; 
    
	$str .= 'class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"';

	return $str;
}
add_filter('top_nav_li_sub_ul', 'bind_bootstrap5_top_nav_li_sub_ul');

function bind_bootstrap5_top_nav_li_sub_ul_a($items) {
    
    $str = ''; 
    
	$str .= 'class="dropdown-item"';

	return $str;
}
add_filter('top_nav_li_sub_ul_a', 'bind_bootstrap5_top_nav_li_sub_ul_a');

function bind_bootstrap5_top_nav_li_sub_ul_a_active($items) {
    
    $str = ''; 
    
	$str .= 'class="dropdown-item active" aria-current="true"';

	return $str;
}
add_filter('top_nav_li_sub_ul_a_active', 'bind_bootstrap5_top_nav_li_sub_ul_a_active');