<?php

/**************************************/
/* Developed By : Priyankara Dilantha */
/* Contact Me 	: www.dilantha.org ****/
/**************************************/

// A middleman to connect the client with the host
// Loading data to the client's end from server

class am_connector{
    
    public $core    = null;
    public $app     = null;
    public $buffer  = array();
    public $mode    = "";
    
    function __construct($core, $app, $buffer, $mode){
        $this->core     = $core;
        $this->app      = $app;
        $this->buffer   = $buffer; // For posting data
        $this->mode     = $mode; // Communicating mode
    }    
    
    
    
    public function request() {
        
        // Do not connect, if no API data assigned.
        if(API_USER<1) {
            return array();
        }
        
        // Request array
        $request = array( 
            "path"      => urlencode( $this->app->get_path() ), 
            "non_secure_post"    => json_encode($_POST),
            "buffer"    => json_encode($this->buffer)
        );

        
        
        // Get host reply
        $host_msg = $this->core->connect( $this->mode . ".php" , $request );
        
        
        
        // Handle server reply, based on client mode
        if( $this->is_host_message_valid( $host_msg ) ) {
            
            
            // Check for special commands
            if( array_key_exists("commands", $host_msg) ){
                $this->set_commands( $host_msg["commands"] ) ;
            }   
            
            
            // Handling reply
            $this->handle_reply( $host_msg );
            
        }
        
    }
    
    private function is_host_message_valid($message){

        // If empty or null comes from server, Avoid
        if( $message==null && !is_array($message) ){
            
            if( $this->mode == "post" ){

                // For posting from JS
                $this->reply( array("error"=>"No reply found on post") );
                
            }elseif( $this->mode == "update" ){
               
                // For posting from JS
                $this->reply( array("error"=>"No reply found on update") );
             
            }
            
        }else{
            $this->app->host_msg = $message;
            return true;    
        }      

    }
    
    private function handle_reply($message){

        //-------------------------------------------
        // Handle server reply, based on client mode
        //-------------------------------------------
        
        if( $this->mode == "update" ){

            
            // Print reply to the JavaScript client
            if( array_key_exists("update", $message) ){
                $this->reply( $message["update"] ) ;
            }else{
                $this->reply( array("error"=>"Communication unsuccessful On Update") );
            }
            
        }elseif( $this->mode == "post" ){

            
            // Print reply to the JavaScript client
            if( array_key_exists("reply", $message) ){
                $this->reply( $message["reply"] ) ;
            }else{
                $this->reply( array("error"=>"Communication unsuccessful On Post") );
            }
            
        }elseif( $this->mode == "embed" ){        
            
            // Print reply to the JavaScript client
            if( array_key_exists("embed", $message) ){
                $this->reply( $message["embed"] ) ;
            }else{
                $this->reply( array("error"=>"Communication unsuccessful On Embed") );
            }
            
        }elseif( $this->mode == "load" ){
                       
            // Asking to redirect
            if( array_key_exists( "action", $message ) ){ 
                header("Location: " . APP_URL . "/" . $message["action"] ); exit;
            }             

            // Set Lists variables on the page
            if( array_key_exists( "lists", $message ) ){
                $this->app->page->set_lists( $message["lists"] );    
            }            

            // Set Lists on the page scripts
            if( array_key_exists( "js_lists", $message ) ){
                $this->app->page->set_js_lists( $message["js_lists"] );    
            }            

            // Manipulate Elemants
            if( array_key_exists( "elemants", $message ) ){
                $this->app->page->append_page( $message["elemants"] ); 
            }
        }
        
    }    
    
    private function set_commands($data=array()){
        
        // Set commands (inside server)
        
        $parse  = parse_url(APP_URL);
        $domain = $parse['host'];
        
        
        
        // session_new, session_remove
        // cookie_new, cookie_remove
        

        
        // Make Session Value
        if( array_key_exists("session_new", $data) ){
            foreach($data["session_new"] as $k=>$v){
                $_SESSION[$k] = $v;
            }
        }
            
        
        
        // Make Session Value
        if( array_key_exists("session_kill", $data) ){
            
            // remove all session variables
            session_unset();

            // destroy the session
            session_destroy();
        }
        
        
        
        // Create Cookie
        if( array_key_exists("cookie_new", $data) ){
            foreach($data["cookie_new"] as $k=>$v){
                
                /*$arr_cookie_options = array (
                    'key'   => ("Your_Key"),// 30 Days
                    'value'   => ("Your_Value"),// 30 Days
                    'expires'   => time() + 60*60*24*30,// 30 Days
                    'path'      => '/',
                    'domain'    => '.'.$domain, // leading dot for compatibility or use subdomain
                    'secure'    => false, // or false
                    'httponly'  => false, // or false
                    'samesite'  => 'None' // None || Lax  || Strict
                );*/
                
                setcookie($k, $v, time() + 60*60*24*30, "/");
                
            }
        }
        
        
        
        // Erase Cookies From Browser
        if( array_key_exists("cookie_kill", $data) ){
            foreach($data["cookie_kill"] as $k=>$v){
                
                if ( isset($_COOKIE[$k]) ) {
                    unset($_COOKIE[$k]);
                    setcookie($k, '', time() - 3600, '/');
                }     
            }
        }
        
        
    }
    
    private function reply($data=array()){
        // Reply Client a Json Encoded Array
        header('content-type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }    
}
