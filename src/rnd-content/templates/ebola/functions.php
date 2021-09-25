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

function bind_ebola_head($items) {

    $str = ''; 
    
    // Meta
    $str .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
    $str .= '<meta charset="utf-8">';
    $str .= '<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">';    
    
    // CSS
	$str .= '<link rel="stylesheet" href="'.RND_THEME_URL.'/css/main.min.css">';
    
    // Font awesome 5
    $str .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.1/css/all.min.css" integrity="sha512-ioRJH7yXnyX+7fXTQEKPULWkMn3CqMcapK0NNtCN8q//sW7ZeVFcbMJ9RvX99TwDg6P8rAH2IqUSt2TLab4Xmw==" crossorigin="anonymous" referrerpolicy="no-referrer" />';
	return $items.$str;
}
add_filter('page_head', 'bind_ebola_head');


function bind_ebola_main_js_files($items) {

    $str = ''; 
    
	$str .= '<script src="'.RND_THEME_URL.'/js/jquery.min.js"></script>';
	$str .= '<script src="'.RND_THEME_URL.'/js/jquery.dropotron.min.js"></script>';
	$str .= '<script src="'.RND_THEME_URL.'/js/jquery.scrollex.min.js"></script>';
	$str .= '<script src="'.RND_THEME_URL.'/js/jquery.scrolly.min.js""></script>';
	$str .= '<script src="'.RND_THEME_URL.'/js/browser.min.js"></script>';
	$str .= '<script src="'.RND_THEME_URL.'/js/breakpoints.min.js"></script>';
    $str .= '<script src="'.RND_THEME_URL.'/js/util.js"></script>';
    
	return $items.$str;
}
add_filter('page_footer', 'bind_ebola_main_js_files');


function bind_ebola_body_class($items) {

    $str = ''; 
    
	$str .= 'header-alt';
	$str .= ' ';
    
	return $items.$str;
}
add_filter('body_class', 'bind_ebola_body_class');




// Header
function bind_ebola_header($items) {
    
    $str = ''; 
    
    $str .= '<section id="header">';

	$str .= '<a href="'.APP_URL.'" class="logo">'.SITE_NAME.'</a>';
	$str .= '<nav id="nav">';
        $str .= '<ul>';
            $str .= get_filter('rnd_top_nav',"");
        $str .= '</ul>';
    $str .= '</nav>';
    $str .= '<a href="#navPanel" class="navPanelToggle">Menu</a>';
    $str .= '</section>';

	return $items.$str;
}
add_filter('ebola_header', 'bind_ebola_header');

// Content
function bind_ebola_body($items) {
    
    $str = ''; 
    
	$str .= '<div id="wrapper">';
    $str .= get_filter('ebola_header',"");
    $str .= '<section class="wrapper style1"><div class="inner">' . $items . '</div></section>';
    $str .= get_filter('ebola_footer',"");
    $str .= '</div>';

	return $str;
}
add_filter('page_content', 'bind_ebola_body');

// Footer
function bind_ebola_footer($items) {
    
    $str = ''; 
    
	$str .= '<section id="footer">';
        $str .= '<ul class="icons">';
            $str .= get_filter('rnd_footer_nav',"");
        $str .= '</ul>';
    $str .= '<p class="copyright"> © '.SITE_NAME.' '.date("Y").'.<br>Template Designer <a href="https://pixelarity.com/">Pixelarity</a> | Fonts Designer <a href="https://fontawesome.com/">FontAwesome</a></p>';
    $str .= '</section>';

	return $items.$str;
}
add_filter('ebola_footer', 'bind_ebola_footer');



function bind_ebola_top_nav_li_active($items) {
    
    $str = ''; 
    
	$str .= 'class="current"';

	return $str;
}
add_filter('top_nav_li_active', 'bind_ebola_top_nav_li_active');

function bind_ebola_top_nav_li_sub($items) {
    
    $str = ''; 
    
	$str .= 'class="opener"';

	return $str;
}
add_filter('top_nav_li_sub', 'bind_ebola_top_nav_li_sub');

function bind_ebola_top_nav_li_sub_ul($items) {
    
    $str = ''; 
    
	$str .= 'class="" style="user-select: none; display: none; position: absolute;"';

	return $str;
}
add_filter('top_nav_li_sub_ul', 'bind_ebola_top_nav_li_sub_ul');

function bind_ebola_top_nav_li_sub_a($items) {
    
    $str = ''; 
    
	$str .= 'class="icon solid fa-angle-down"';

	return $str;
}
add_filter('top_nav_li_sub_a', 'bind_ebola_top_nav_li_sub_a');


