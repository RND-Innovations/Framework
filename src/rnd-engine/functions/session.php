<?php

/**************************************/
/* Developed By : Priyankara Dilantha */
/* Contact Me 	: www.dilantha.org ****/
/**************************************/


    // **PREVENTING SESSION HIJACKING**
    // Refuses access to the session cookie from JavaScript. 
    // This setting prevents cookies snatched by a JavaScript injection.
    ini_set('session.cookie_httponly', 1);
    
    // **PREVENTING SESSION FIXATION**
    // session.use_only_cookies specifies whether the module will only use cookies to store the session id on the client side. 
    // Enabling this setting prevents attacks involved passing session ids in URLs.
    ini_set('session.use_only_cookies', 1);


    // Avoid Non-SSL Access
    if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
        
        // Only if the site is SSL
        if(strpos(HOST_URL, 'http://') === false){
            
            // Redirect to SSL Mode
            $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: ' . $location);
            exit;    
        }
        
        ini_set('session.cookie_secure', 0);
  
    }else{
        // Uses a secure connection (HTTPS) if possible
        // Allow access to the session ID cookie only when the protocol is HTTPS. 
        // If a website is only accessible via HTTPS, it should enable this setting.
        ini_set('session.cookie_secure', 1);  
        
        
        // HSTS implementation to avoid middleman attack using NonSSL
        header("strict-transport-security: max-age=31536000; includeSubDomains; preload");
    }


    // Start the session
    session_start();

