<?php

/**************************************/
/* Developed By : Priyankara Dilantha */
/* Contact Me 	: www.dilantha.org ****/
/**************************************/


// *************************
// Smart Functions
// *************************

function _p($what){
    print $what;
}

function _e($what){
    echo $what;
}

function _d($format){
    return date($format);
}

function is_home(){
    global $app;
    if($app->get_path()=="home"){return true;}
    return false;
}

// *************************
// Important Functions
// *************************

function sanitize_output($buffer) {

    $search = array(
        '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
        '/[^\S ]+\</s',     // strip whitespaces before tags, except space
        '/(\s)+/s',         // shorten multiple whitespace sequences
        '/<!--(.|\s)*?-->/' // Remove HTML comments
    );

    $replace = array(
        '>',
        '<',
        '\\1',
        ''
    ); 

    $buffer = preg_replace($search, $replace, $buffer);

    return $buffer;
}

function cleanInputData($str){
    $str = strip_tags($str);
    return $str;
}

function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}

function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function get_arr_value($value, $data_array, $default){
    if(array_key_exists($value, $data_array)){
        return $data_array[$value];
    }
    return $default;
}
