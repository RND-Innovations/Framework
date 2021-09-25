<?php

/**************************************/
/* Developed By : Priyankara Dilantha */
/* Contact Me 	: www.dilantha.org ****/
/**************************************/

class am_app{
    
    private $core       = null;
    private $path       = "";
    
    public $pages_dir   = "pages";
    public $page        = null;
    public $reply_arr   = array();    
    public $host_msg   = array();
    
    function __construct($core) {
        $this->core  = $core;
        $this->path  = $this->set_path();
    }
    
    
    // Get Values
    function get_path() {
        return $this->path;
    }
    
    function get_parent(){
        $parts  = explode("/", $this->path );
        $last   = array_pop($parts);
        return implode( "/" , $parts );    
    }
    
    function get_dirs() {
         // Array of request path order.
        return explode( "/", $this->path );
    }
    
    function get_target_dir(){

        // Fire this to get target directory from path request,
        // Ex: "home/login/error" ---- will return --- "error"
        $dirs = $this->get_dirs(); 
        return end($dirs);
    }    
    
    function get_depth() {
        
        $depth  = "";
        
        foreach($this->get_dirs() as $k){
             // Get the depth
            $depth .= "../";
        }
        
        return $depth;
    }  
    
    function include_all() {
        
        $dir_parent = "";

        foreach( $this->get_dirs() as $dir_name){

            if( strlen($dir_name)>0 ){            
                $fn = APP_TMPL . "/" . $this->pages_dir . "/" . $dir_parent . $dir_name . "/" . $dir_name . ".json";

                if(!file_exists($fn)){
                    // We need all Json files in the path
                    // If missing, show 404 error
                    header("HTTP/1.0 404 Not Found");
                    $this->page->load_json( APP_TMPL . "/" . $this->pages_dir . "/404/404.json" );
                }else{
                    $this->page->load_json( $fn );
                }
                $dir_parent .= $dir_name . "/";
            }
        } 
    } 
    
    function init() {
               
        // Create Page Class
        $this->page = new am_page($this->core, $this);
        
        // {{{{{{{{{{{{{{{{{{{{{{{}}}}}}}}}}}}}}}}}}}}}}}
        // There 4 Init Methods 
        // 01 - full: A full load of a page from the target directory.
        // 02 - update: Frequently send a data array (for counters) to the front-end. 
        // 03 - post: Submitting form data to the main core.        
        // 04 - embed: Embed a page area without loading it
        // {{{{{{{{{{{{{{{{{{{{{{{}}}}}}}}}}}}}}}}}}}}}}}
        
        // Get directory to load 
        $dir    = $this->get_target_dir(); 
        

            // Handle the request
            if( $dir == "update"){

                // (01) Update elemants on front-end
                $this->handle_update();
                
            }elseif($dir == "post"){ 

                // (02) Post data to the core from front-end
                $this->handle_post();
                

            }elseif($dir == "embed"){

                // (03) Send small elements to the front-end to embed
                $this->handle_embed();
                
            }else{
                
                // (04) Send full page load                 
                $this->handle_page();

                
            }
        
        
    }    
    
    function render() {
        // Return App All Elemants 
        return $this->reply_arr;
    }    
  
    
    private function set_path() {


        //----------------------
        // (00) Home dir should be root
        
            if( substr($_SERVER['REQUEST_URI'], -4)=="home" || substr($_SERVER['REQUEST_URI'], -5)=="home/" ){
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . HOST_URL . HOST_PATH  );
                exit();               
            }
        
        
        //----------------------
        // (01) Get Path from request
        if( HOST_PATH == "" ){
            
            // (ROOT)
            // Here comes when you host in main root.
            // Home will be ($_SERVER['REQUEST_URI']="/")
            // So we specially call home folder in this case
            // Others get as a path
            
            $path = ( strlen($_SERVER['REQUEST_URI'])<2 ? "home" : $_SERVER['REQUEST_URI'] ); //echo $path; exit;
            
            if(substr($path, 0, 1)=="/"){
                $path = substr(trim($path), 1);
            } 
            
        }else{
            
            // (SUB-FOLDER)
            // Here comes when you host in a subfodler
            //.htaccess will be hosted inside sub-folder
            // 
            
            $gets = explode( HOST_PATH, $_SERVER['REQUEST_URI']);
            $path = substr($gets[1], 1);         
        }
        //----------------------
        
        
        
        //----------------------
        // (02) Avoid trailing "/"
        if(substr($path, -1)=="/"){
            $path = substr(trim($path), 0, -1);
            
            // Permanent 301 redirection if invalid data call
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . HOST_URL . HOST_PATH . "/" . $path );
            exit();            
        }
        //----------------------
        
        
        //----------------------
        // (03) Avoid requests to folders
        if (strpos($path, '/?') !== false) {

            // Gets values
            $gets = explode("?", $path);  
            
            if(count($gets)>1){
                $append = "/home?".$gets[1];
            }else{
                $append = "";
            }
            
            // Permanent 301 redirection if invalid data call
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . HOST_URL . HOST_PATH . $append );
            exit();
        }
        //----------------------
        

        
        //----------------------
        // (04) If get request has no page, send to home        
        if(substr($path, 0, 1)=="?"){
            // Permanent 301 redirection if invalid data call
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . HOST_URL . HOST_PATH . "/home" . $path );
            exit();
        } 
        //----------------------
        
        
        //----------------------
        // (05) Filter out get data
        if(strlen($path)>0){
            
            // Avoid get data and return the clean path
            $gets = explode("?", $path);

            return $gets[0];//substr($gets[0], 1);
        }else{
            // If no-path called
            return ( isset( $_COOKIE[APP_LOGIN_COOKIE] ) ? "dashboard" : "home" ); 
        }
        //----------------------  

    }
    
    /*
        Old Version By Matt
    private function set_path() {

        
        //----------------------
        // (00) Home dir should be root
        
            if( substr($_SERVER['REQUEST_URI'], -4)=="home" || substr($_SERVER['REQUEST_URI'], -5)=="home/" ){
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . HOST_URL . HOST_PATH  );
                exit();               
            }
        
        
        //----------------------
        // (01) Get Path from request
        if( HOST_PATH == "" ){
            
            // (ROOT)
            // Here comes when you host in main root.
            // Home will be ($_SERVER['REQUEST_URI']="/")
            // So we specially call home folder in this case
            // Others get as a path
            
            $path = ( strlen($_SERVER['REQUEST_URI'])<2 ? "home" : $_SERVER['REQUEST_URI'] ); //echo $path; exit;
            
            if(substr($path, 0, 1)=="/"){
                $path = substr(trim($path), 1);
            } 
            
        }else{
            
            // (SUB-FOLDER)
            // Here comes when you host in a subfodler
            //.htaccess will be hosted inside sub-folder
            // 
            $gets = explode( HOST_PATH, $_SERVER['REQUEST_URI']);
            $path = substr($gets[1], 1);         
        }
        //----------------------
        
        
        
        //----------------------
        // (02) Avoid trailing "/"
        if(substr($path, -1)=="/"){
            $path = substr(trim($path), 0, -1);
            
            // Permanent 301 redirection if invalid data call
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . HOST_URL . HOST_PATH . "/" . $path );
            exit();            
        }
        //----------------------
        
        
        //----------------------
        // (03) Avoid requests to folders
        if (strpos($path, '/?') !== false) {

            // Gets values
            $gets = explode("?", $path);  
            
            if(count($gets)>1){
                $append = "/home?".$gets[1];
            }else{
                $append = "";
            }
            
            // Permanent 301 redirection if invalid data call
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . HOST_URL . $append );
            exit();
        }
        //----------------------
        
        
        
        //----------------------
        // (04) Filter out get data
        if(strlen($path)>0){
            
            // Avoid get data and return the clean path
            $gets = explode("?", $path);

            return $gets[0];//substr($gets[0], 1);
        }else{
            // If no-path called
            return ( isset( $_COOKIE[APP_LOGIN_COOKIE] ) ? "dashboard" : "home" ); 
        }
        //----------------------  

    }
    */
    
    private function handle_update(){
        
        // Get submitted data on the form
        $buffer = array();
        

        // Post object to communicate with server
        $connector = new am_connector( $this->core, $this, $buffer, "update" );
        
        
        // Send data
        $connector->request(); 
        
    }    

    private function handle_post(){
        
        // Load Json
        $this->page->load_json( APP_TMPL . "/" . $this->pages_dir . "/" . $this->get_parent() . "/" . basename($this->path) . ".json" ); 

        
        // We need form object
        $form = new am_form($this->page, $this->page->form);
        

        // Get submitted data on the form
        $buffer = $form->get_data_submitted();
        
        
        // Post object to communicate with server
        $connector = new am_connector( $this->core, $this, $buffer, "post" );
        
        
        // Send data
        $connector->request(); 
        
    }
   
    private function handle_embed(){
        
        // Load Json
        $this->page->load_json( APP_TMPL . "/" . $this->pages_dir . "/" . $this->get_parent() . "/" . basename($this->path) . ".json" ); 

        
        // We need form object
        $form = new am_form($this->page, $this->page->form);
        

        // Get submitted data on the form
        $buffer = $form->get_data_submitted();
        
        
        // Post object to communicate with server
        $connector = new am_connector( $this->core, $this, $buffer, "embed" );
        
        
        // Send data
        $connector->request();   
    }
     
    private function handle_page(){
        
        // Embed contents from indexes (can manipulate page)
        // This call all index.php on the path. (ex: user/login/confirm --- 3 index.php)
        $this->include_all();
        

        // Post object to communicate with server
        $connector = new am_connector( $this->core, $this, array(), "load" );


        // Send data
        $connector->request();

        
        // Load Page Elemants
        $this->reply_arr += $this->page->render_page();   
    }
          
      
}



