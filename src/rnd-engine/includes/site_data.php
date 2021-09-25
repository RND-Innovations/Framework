<?php

/**************************************/
/* Developed By : Priyankara Dilantha */
/* Contact Me 	: www.dilantha.org ****/
/**************************************/


// This variable will be used to store site settings in json file
$rnd_site_settings_json = get_json_data( APP_TMPL_URL . '/settings.json' );


    // Need this contastant to access theme via "https://.." link
    if(!defined('RND_THEME_URL')) {
        define("RND_THEME_URL", APP_TMPL_URL . '/templates/' . $rnd_site_settings_json["site_template_name"] );
    }


    // Need this contastant to access via internal php path
    if(!defined('RND_THEME_PATH')) {
        define("RND_THEME_PATH", APP_TMPL . '/templates/' . $rnd_site_settings_json["site_template_name"] );
    } 


// Site Name
/*function register_rnd_site_name($items) {
    global $rnd_site_settings_json;
    return $rnd_site_settings_json["site_name"];
}
add_filter('site_name', 'register_rnd_site_name');*/

foreach($rnd_site_settings_json as $name=>$value){
    if(!is_array($value)){
        
        $define   = strtoupper($name);
        
        if(!defined($define)) {
            define($define, $value );
        } 
        
    }
}