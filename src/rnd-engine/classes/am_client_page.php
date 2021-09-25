<?php

/**************************************/
/* Developed By : Priyankara Dilantha */
/* Contact Me 	: www.dilantha.org ****/
/**************************************/

class am_page{
    
    public $core    = null;
    public $app     = null;
    
    // Properties
    public $json_page = ""; // Json data from page.json
    
    public $title = "Page Error";
    public $mtext = "Cannot render this page";
    public $mkeys = "";    
    public $layout = "default";
    
    public $head    = array();
    public $body    = array();  
    public $style   = array();
    public $script  = array(); 
   
    public $lists = array(); // Store lists as an array (Ex: countryList, browserList, etc)
    public $js_lists = array(); // Store lists for js client (public)
    

    
    function __construct($core, $app){
        $this->core = $core;
        $this->app  = $app;
    }    
    
    
    // Load Page data to memory from the page's Json file.
    public function load_json($json_path) {
        
        // Here we read and load json file
        if( file_exists($json_path) ){
                                 
            $json = get_json_data($json_path);
            $this->json_page = $json;
                                 
            if(array_key_exists("head", $json)){ 
                $this->head = $json["head"];
                if(array_key_exists("title", $json["head"])){ 
                    $this->title = $json["head"]["title"]; 
                }     
                if(array_key_exists("text", $json["head"])){ 
                    $this->mtext = $json["head"]["text"]; 
                }
                if(array_key_exists("keys", $json["head"])){ 
                    $this->mkeys = $json["head"]["keys"]; 
                }                
                if(array_key_exists("layout", $json["head"])){ 
                    $this->layout = $json["head"]["layout"]; 
                }     
            }
            if(array_key_exists("body", $json)){ $this->body = $json["body"]; } 
            if(array_key_exists("style", $json)){ $this->style = $json["style"]; }
            if(array_key_exists("script", $json)){ $this->script = $json["script"]; }
            
        }else{
            $this->title    = "Page Missing Contents!";
            $this->mtext    = "This page is created without content. Please inform developer to write contents.";
            $this->mkeys    = "missing contents";
            $this->layout   = "default";
        }
    }
    
    // Returns json page data
    public function return_json() {
        return $this->json_page;
    }   
    
    // Find and replace page layouts in content body
    public function manipulate_content($content, $type="body") {

        // Read Page Body Data
        $json_data = $this->$type; 
        foreach($json_data as $area_code=>$area_data){
            
            if(is_array($area_data)){
                
                // Here we found a complex elemant
                $sub_con = $this->manipulate_children($area_data, $this->head["layout"] );
                $content = str_replace("---".$area_code."---", $sub_con, $content);
                
            }else{
                
                // Other elemants will be replaced with value
                $content = str_replace("{{".$area_code."}}", $area_data, $content);
            }

        }
        
        $content = str_replace("[[MEDIA_URL]]", MEDIA_URL, $content);
        $content = str_replace("[[THEME_URL]]", RND_THEME_URL, $content);
        $content = str_replace("[[SITE_URL]]", APP_URL, $content);
        return $content;
    }   
    
    // Find and replace children in content body layouts
    public function manipulate_children( $json_data, $parent="" ) {
        
        $path       = APP_TMPL . '/layouts/' .  $parent . "/children/" . $json_data["layout"] . ".html";
        $content    = get_file_contents_from_a_file( $path );        
        $sub_con    = "";
        
        $appends    = array();
        
        foreach($json_data as $area_code=>$area_data){
            
            if(is_array($area_data)){
                
                
                if(array_key_exists($area_data["layout"], $appends)){
                    $appends[$area_data["layout"]] .= $this->manipulate_children($area_data, $parent );
                }else{
                    $appends[$area_data["layout"]] = $this->manipulate_children($area_data, $parent );
                }
                
            }else{
                
                // Other elemants will be replaced with value
                $content = str_replace("{{".$area_code."}}", $area_data, $content);
            }

        }
        
        foreach($appends as $k=>$v){
            $content = str_replace("---".$k."---", $v, $content);
        }
        
        $content = str_replace("[[MEDIA_URL]]", MEDIA_URL, $content);
        $content = str_replace("[[THEME_URL]]", RND_THEME_URL, $content);
        $content = str_replace("[[SITE_URL]]", APP_URL, $content);
        return $content;        
        
    }
        
    // Replace page variables
    public function append_page($data) {
        
        // All elemants in an array;
        if(is_array($data)){
            
            foreach($data as $elemant=>$its_data){
                
                $ele    = $this->$elemant;  
                
                foreach($its_data as $k=>$v){
                      
                    $params = array($k, $v); 
                    
                    if(is_array($ele)){
                        array_walk_recursive( $ele, array($this, 'array_replace_string'), $params );
                    }else{
                        $ele = str_replace("[[".$k."]]", $v, $ele);
                    }

                }

                $this->$elemant = $ele;
            }
            
        }
    }
        
    // Rendering page elemants into an array
    public function render_page() {
        
        // If connected with a remote host, we need to check connection status.
        // Here we work on that logic.
        
        if(API_USER>0) {
            
            $reply  = $this->app->host_msg;

            // Recieved an empty reply from the API
            if(!isset($reply) || $reply==null || empty($reply)){

                // 101 Error
                $this->title    = "Service Offline!";
                $this->mtext    = "You are still able to surf our website during this time, though it is recommended to avoid making any action on the site.<br>We apologize for the inconvenience!";
                $this->mkeys    = "404/101 error";
                $this->layout   = "page-error";            

            // Handling correct reply format  
            }elseif( array_key_exists("status", $reply) ){

                // Error reply
                if( $reply["status"]=="error" ){
                    $this->title    = "System Error: " . $reply["errCode"];
                    $this->mtext    = "Error: ".$reply["msg"]."<brr>Code : ".$reply["errCode"];
                    $this->mkeys    = "404/101 error";
                    $this->layout   = "page-error";   
                }


            // Recieved a wrong reply format        
            }else{

                // 102 Error
                $this->title    = "Service Under Construction!";
                $this->mtext    = "Our technical team might be working on this page due to a service interruption.<br>Please contact us with the page address to help you in this case.<br>We apologize for the inconvenience!";
                $this->mkeys    = "404/102 error";
                $this->layout   = "page-error";  
            }    
        }
        

        
        $elems  = array();
        
        $elems  += array( "url" => $this->get_url() );
        $elems  += array( "title" => $this->title );
        $elems  += array( "description" => $this->mtext );
        $elems  += array( "keywords" => $this->mkeys );
        $elems  += array( "content" => $this->body );
        $elems  += array( "js_lists" => $this->js_lists );
        
        return $elems;
    }
    


    // From here you can set page props
    public function set_title($title) {
        // Title is a plain text only
        $this->title = $title;
    }    
    public function set_body($body) {
        // body must be a valid json
        $this->body = $body;
    }
    public function set_lists($data) {
        
        // All elemants in an array;
        if(is_array($data)){
            
            $this->lists += $data;
            
        }
    }
    public function set_js_lists($data) {
        
        // All elemants in an array;
        if(is_array($data)){
            
            $this->js_lists += $data;
            
        }
    }
 
    
    // Generate URL of relevant path
    public function get_url() {
        return APP_URL . "/" . ( $this->app->get_path()!="home" ? $this->app->get_path() : "" );
    }
   


    // Private functions goes below
    private function array_replace_string(&$value, $key, $params) {
        if(!is_array($params[1])){
            $value = str_replace("[[".$params[0]."]]", $params[1], $value);
        }
    }    
    
    
}
