<?php

/**************************************/
/* Developed By : Priyankara Dilantha */
/* Contact Me 	: www.dilantha.org ****/
/**************************************/

// (#) Error handling for the test mode.
if(SITE_TEST_MODE){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);  
}


    // (#) Require All Core functions to be loaded.
    // Classes, Includes will depend on these functions.
    // Only Core developers can add new functions here.
    foreach( glob( __DIR__ . "/functions/*.php" ) as $file ){
        require_once($file);
    }

        // (#) Require All Classes (autoload all)
        // Classes are OOP objects from the developing team.
        // Do not mess with them, check the engine version.
        foreach( glob( __DIR__ . "/classes/*.php" ) as $file ){
            require_once($file);
        }


        $core = new am_core(); // Core Object
        $app = new am_app($core); // App Object
                
            $app->init(); // Initilaize

            $page_data = $app->render(); // get output data array


                    // (#) Include all hooks files to rending engine.
                    // These functions can register actions, filters.
                    // Have ability to render html5+css3 default layer.
                    foreach( glob( __DIR__ . "/includes/*.php" ) as $file ){
                        include_once($file);
                    }

                        $site = new am_site(); // Site renderer comes here. (Do not change order below)
                            $site->get_page_content(); // Load page contents/layouts
                            $site->connect_template(); // Load template.
                            $site->connect_plugins(); // Load plugins.
                            $site->connect_menus(); 
                            $site->render(); // Print output 