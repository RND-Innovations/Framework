<?php

/**************************************/
/* Developed By : Priyankara Dilantha */
/* Contact Me 	: www.dilantha.org ****/
/**************************************/

class am_site{
    
    private $main_json  = null; 
    private $page       = null;    
    
    function __construct(){
        global $rnd_site_settings_json;
        
        // We use this main json to gather data.
        $this->main_json = $rnd_site_settings_json;
            
    }
    
    public function set_page($page_object){
        $this->page = $page_object;
    }
    
  
    public function get_page_content(){

        global $app;
        
        if(!defined('RND_PAGE_CONTENT_PATH')) {
            define("RND_PAGE_CONTENT_PATH", $app->get_path() );
        } 
        
        if(!defined('RND_PAGE_CONTENT_LAYOUT')) {
            define("RND_PAGE_CONTENT_LAYOUT", $app->page->layout );
        }
        
        if(!defined('RND_PAGE_LAYOUT_HTML_FILE')) {
            define("RND_PAGE_LAYOUT_HTML_FILE", APP_TMPL . '/layouts/' .  $app->page->layout . "/" . $app->page->layout . ".html" );
        }            

        if(!defined('RND_PAGE_LAYOUT_CSS_FILE')) {
            define("RND_PAGE_LAYOUT_CSS_FILE", APP_TMPL . '/layouts/' .  $app->page->layout . "/" . $app->page->layout . ".css" );
        }            

        if(!defined('RND_PAGE_LAYOUT_JS_FILE')) {
            define("RND_PAGE_LAYOUT_JS_FILE", APP_TMPL . '/layouts/' .  $app->page->layout . "/" . $app->page->layout . ".js" );
        } 
        
        // HTML
        function bind_page_main_content($items) {

            $str            = "";
            $lazy_page_1    = APP_TMPL . '/pages/' .  RND_PAGE_CONTENT_PATH . "/" . basename(RND_PAGE_CONTENT_PATH) . ".html" ;
            $lazy_page_2    = APP_TMPL . '/pages/' .  RND_PAGE_CONTENT_PATH . "/" . basename(RND_PAGE_CONTENT_PATH) . ".php" ;
 
            
            // Error must be loaded on contents
            if( RND_PAGE_CONTENT_LAYOUT == "page-error" ){
                global $page_data;
                $str .= '<div style="text-align:center;margin-top:10%;background:#fee">';
                $str .= '<h1 style="padding:10px;color:#d00;">' . $page_data["title"] . '</h1>';
                $str .= '<p style="padding:10px;color:#500;">' . $page_data["description"] . '</p>'; 
                $str .= '</div>';
            }
            
            
            if( file_exists($lazy_page_1) ){
                
                $str .= get_file_contents_from_a_file( $lazy_page_1 ); // Priority to HTML file
                
            }elseif( file_exists($lazy_page_2) ){
                
                $str .= get_file_contents_from_a_file( $lazy_page_2 ); // Secondly to PHP file
                
            }elseif( file_exists( RND_PAGE_LAYOUT_HTML_FILE ) ){
                
                global $app;
                
                $html   = get_file_contents_from_a_file( RND_PAGE_LAYOUT_HTML_FILE );
                $body   = $app->page->manipulate_content( $html , "body" );
                
                // Clean up unused complex content
                    $pattern = "/---(.*?)---/i";
                    if(preg_match_all($pattern, $body, $matches)) {
                        foreach($matches[1] as $tag){
                            $body = str_replace("---".$tag."---", "", $body);    
                        }
                    }                
                //------------------------------
                
                $str .= $body;
                
            }else{

                // Render a default message
                $str .= '<div style="text-align:center;margin-top:10%;background:#eee">';
                $str .= '<h1 style="padding:10px;color:#777;">Empty Page!</h1>';
                $str .= '<p style="padding:10px;color:#333;">We cannot find any content related to this page. Please contact us and share the URL you see this error.</p>'; 
                $str .= '</div>';
                
            }                
                

            return $str.$items;
        }
        add_filter('page_content', 'bind_page_main_content');
        
        
        // CSS
        if( file_exists( RND_PAGE_LAYOUT_CSS_FILE ) ){ 

            // Should add to main style
            function bind_layout_style_to_main_style($items) {
                global $app;
                $css = get_file_contents_from_a_file( RND_PAGE_LAYOUT_CSS_FILE );
                $css = $app->page->manipulate_content( $css , "style" );                    
                return $items.$css;
            }
            add_filter('page_style', 'bind_layout_style_to_main_style');                     

        }

        // JS
        if( file_exists( RND_PAGE_LAYOUT_JS_FILE ) ){

            // Should append to main script
            function bind_layout_script_to_main_script($items) {
                global $app;
                $js = get_file_contents_from_a_file( RND_PAGE_LAYOUT_JS_FILE );
                $js = $app->page->manipulate_content( $js , "script" );                        
                return $items.$js;
            }
            add_filter('page_script', 'bind_layout_script_to_main_script');                    
        }
              
        
    }
      
    public function connect_template(){
        

        
        if(file_exists( RND_THEME_PATH . '/style.css')){


            // Load theme functions from functions.php
            // This file can hook extra to the template
            // For example, link extra stylesheets, javascripts

            $fn = RND_THEME_PATH . '/functions.php' ;

            if (file_exists($fn)){
                include_once($fn); // register template functions (hooks)
            }       


            // Get and put main CSS style from style.css
            // style.css is the core of a template.
            function bind_page_main_styles($items) {
                $str = get_file_contents_from_a_file( RND_THEME_PATH . '/style.css' );
                return $str.$items;
            }
            add_filter('page_style', 'bind_page_main_styles');


            // Load main scripts from script.js. 
            // Put all of your common scripts here.
            if (file_exists( RND_THEME_PATH . '/script.js' )){
                function bind_page_main_scripts($items) {
                    $str = get_file_contents_from_a_file( RND_THEME_PATH . '/script.js' );
                    return $str.$items;
                }
                add_filter('page_script', 'bind_page_main_scripts');   
            }     
        }

    }    
    
    public function connect_plugins(){
        
        foreach( glob( APP_TMPL . "/plugins/*", GLOB_ONLYDIR ) as $dir ){

            $fn = $dir . "/" . basename($dir) . ".php" ;

            if (file_exists($fn)){
                include_once($fn); // register plugin
            }
        }

    }    
     
    public function connect_menus(){
        
    //-----------------------------------
    // Top Navigation Actions/Filters
    //-----------------------------------

        
        function rnd_menu_top_nav_list($items) {
            
            //global $app; 
            $nst = new am_site();
            $mnu = $nst->get_settings_json();
            $str = $nst->render_primary_menu($mnu["site_menu"]["_top"], "top_nav");
            return $items.$str;

        }
        add_filter('rnd_top_nav', 'rnd_menu_top_nav_list');

        function rnd_print_top_nav_list() {
            echo get_filter('rnd_top_nav',"");
        }
        add_action('rnd_top_nav', 'rnd_print_top_nav_list');  
        
        
    //-----------------------------------
    // Side Navigation
    //-----------------------------------
        
        function rnd_menu_side_nav_list($items) {
            
            //global $app; 
            $nst = new am_site();
            $mnu = $nst->get_settings_json();
            $str = $nst->render_primary_menu($mnu["site_menu"]["_side"], "side_nav");
            return $items.$str;

        }
        add_filter('rnd_side_nav', 'rnd_menu_side_nav_list');

        function rnd_print_side_nav_list() {
            echo get_filter('rnd_side_nav',"");
        }
        add_action('rnd_side_nav', 'rnd_print_side_nav_list');  
                
        
    //-----------------------------------
    // Footer Navigation
    //-----------------------------------

        function rnd_menu_footer_nav_list($items) {
            
            //global $app; 
            $nst = new am_site();
            $mnu = $nst->get_settings_json();
            $str = $nst->render_primary_menu($mnu["site_menu"]["_footer"], "footer_nav");
            return $items.$str;

        }
        add_filter('rnd_footer_nav', 'rnd_menu_footer_nav_list');

        function rnd_print_footer_nav_list() {
            echo get_filter('rnd_footer_nav',"");
        }
        add_action('rnd_footer_nav', 'rnd_print_footer_nav_list');         
        
    }    
     
    public function render(){
        
        if(defined('RND_HTTP_HEADER')) {
            header(RND_HTTP_HEADER); // Let third parties manupulate http header can manipulate
        }else{
            header('Content-Type: text/html; charset=utf-8');
        }     
        
        get_action('menu_renderer');
        
            get_action('rnd_html');
            get_action('rnd_head');
            get_action('rnd_body');

                get_action('rnd_header');
                get_action('rnd_left_side');
                get_action('rnd_content');
                get_action('rnd_right_side');
                get_action('rnd_footer');

            get_action('rnd__body');
            get_action('rnd__html');
            exit;
    }

    
    

        
    public function render_primary_menu($menu_array, $menu_prefix){

        global $app;

        $str = ""; 
        $ind = 1;

        foreach($menu_array as $k=>$v){

            if(strlen($k)<4){

                // Treat as a menu seperator
                $str    .= '<li '.get_filter( $menu_prefix . '_li_sep' , "").'></li>';
            }else{


                //----------------------------
                // Create the opening href
                    $lnkSub = $this->get_menu_open_href_link($v["href"]);
                //----------------------------

                //----------------------------
                // Link open behavior
                    $lnkPop = $this->get_menu_open_behaviour($v["new"]);
                //----------------------------

                // Check for sub menus
                if(count($v["items"])>0){

                    // Found a sub menu
                    $str    .= '<li '.get_filter($menu_prefix . '_li_sub' , "").'>';
                    $str    .= '<a href="#" '.get_filter($menu_prefix . '_li_sub_a' , "").'  data-target="'.$menu_prefix.'_sub_'.$ind.'">'.$k.' '.get_filter($menu_prefix . '_li_sub_ico' , "").'</a>';
                    $str    .= '<ul id="'.$menu_prefix.'_sub_'.$ind.'" '.get_filter($menu_prefix . '_li_sub_ul' , "").'>';
                    $str    .= $this->render_secondary_menu( $v["items"], $menu_prefix . '_li_sub_ul', 1 );
                    $str    .= '</ul>';
                    $str    .= '</li>';

                    $ind++;
                }else{

                    // Single item
                    if($v["href"]==$app->get_path()){
                        // active item
                        $lnk    = '<a href="'.$lnkSub.'" target="'.$lnkPop.'" '.get_filter($menu_prefix . '_a_active' , "").'>'.$k.'</a>';
                        $str    .= '<li '.get_filter($menu_prefix . '_li_active' , "").'>'.$lnk.'</li>';                    
                    }else{
                        // inactive item
                        $lnk    = '<a href="'.$lnkSub.'" target="'.$lnkPop.'" '.get_filter($menu_prefix . '_a' , "").'>'.$k.'</a>';
                        $str    .= '<li '.get_filter($menu_prefix . '_li' , "").'>'.$lnk.'</li>';
                    }
                }

            }
        }

        return $str;
    }
    
    public function render_secondary_menu($menu_array, $menu_prefix, $menu_level){
        global $app;
        
        $str = "";
        
        
        foreach($menu_array as $k=>$v){

            if(strlen($k)<4){

                // Treat as a menu seperator
                $str    .= '<li '.get_filter( $menu_prefix . '_li_sep' , "").'></li>';
            }else{


                //----------------------------
                // Create the opening href
                    $lnkSub = $this->get_menu_open_href_link($v["href"]);
                //----------------------------

                //----------------------------
                // Link open behavior
                    $lnkPop = $this->get_menu_open_behaviour($v["new"]);
                //----------------------------

                // Check for sub menus
                if(count($v["items"])>0){

                    // Found a sub menu
                    $str    .= '<li '.get_filter($menu_prefix . '_li_sub' , "").'>';
                    $str    .= '<a href="#" '.get_filter($menu_prefix . '_li_sub_a' , "").'>'.$k.'</a>';
                    $str    .= '<ul '.get_filter($menu_prefix . '_li_sub_ul' , "").'>';
                    $str    .= $this->render_secondary_menu( $v["items"], $menu_prefix, $menu_level+1 );
                    $str    .= '</ul>';
                    $str    .= '</li>';

                }else{

                    // Single item
                    if($v["href"]==$app->get_path()){
                        // active item
                        $lnk    = '<a href="'.$lnkSub.'" target="'.$lnkPop.'" '.get_filter($menu_prefix . '_a_active' , "").'>'.$k.'</a>';
                        $str    .= '<li '.get_filter($menu_prefix . '_li_active' , "").'>'.$lnk.'</li>';                    
                    }else{
                        // inactive item
                        $lnk    = '<a href="'.$lnkSub.'" target="'.$lnkPop.'" '.get_filter($menu_prefix . '_a' , "").'>'.$k.'</a>';
                        $str    .= '<li '.get_filter($menu_prefix . '_li' , "").'>'.$lnk.'</li>';
                    }
                }

            }
        }
        
        
        return $str;                 
    }

    public function get_menu_open_behaviour($new_true){
        if( $new_true>0 ){
            return '_blank';
        }else{
            return '_self';
        }   
    }

    public function get_menu_open_href_link($href_link){
        $lnkSub = substr($href_link,0,6);

        if( $lnkSub=="http:/" || $lnkSub=="https:" ){
            return $href_link;
        }else{
            return APP_URL . "/" . $href_link;
        } 
    }

    public function get_settings_json(){
        return $this->main_json; 
    }
    
     
    
}
