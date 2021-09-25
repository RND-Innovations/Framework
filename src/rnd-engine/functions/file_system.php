<?php

/**************************************/
/* Developed By : Priyankara Dilantha */
/* Contact Me 	: www.dilantha.org ****/
/**************************************/

function get_file_contents_from_a_file($file){

    if( file_exists($file) ){
        ob_start("sanitize_output");
        include $file;
        return ob_get_clean();
    }

} 

function get_json_data($path){
    
    if (filter_var($path, FILTER_VALIDATE_URL)) { 
        $string = curl_file_get_contents($path);
    }else{
        $string = file_get_contents($path);      
    }
    

    if($string===false){echo "Cannot get file contents";}
    $json_a = json_decode($string, true);
    if($json_a===null){echo "Empty Json-A !!!";}
    return $json_a;
}

function json_output($reply) {
    // Return a Json Array
    header('Content-Type: application/json');
    echo json_encode($reply); 
    exit;
} 

function target_dir(){
    global $app;
    
    // Fire this to get target directory from path request,
    // Ex: "home/login/error" ---- will return --- "error"
    $dirs = $app->get_dirs(); 
    return end($dirs);
}

function embed_local_page($local_dir, $page_name="page"){
    global $app, $page;
    
    // Fire this function to embed local json.
    // Put it on local index.php
    $dirs = $app->get_dirs(); 
    if( basename($local_dir) == target_dir() ){
        $app->page->load_json( $local_dir . "/" . basename($local_dir) . ".json" );
    }
}


function curl_file_get_contents($url) {
   $c = curl_init();
   curl_setopt($c, CURLOPT_URL, $url);
   curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
   $data = curl_exec($c);
   curl_close($c);
   return $data;
}