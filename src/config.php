<?php

/**************************************/
/* Developed By : Priyankara Dilantha */
/* Contact Me 	: www.dilantha.org ****/
/**************************************/

//--------------------------------------------------
// Configure Your Site Down Here
//--------------------------------------------------

// (01) Add "0", if your site is in production.

    define('SITE_TEST_MODE', 1 );



// (02) Host variables to identify this website.

    // This is your website address which is public to the world.
    // Please note: If you host sites contents in a sub folder,
    // You have to config "HOST_PATH" after this.
    define("HOST_URL", "http://localhost:8888" );

    // If you host the site in a subfolder, ex: "https://bu.lk/DIR", set "/DIR" down there.
    // "index.php", "config.php", ".htaccess" files must be there to avoid errors.
    // keep this empty ex: "", if you host the site in the root folder.
    // SPECIAL NOTE: 
    // If you host in a subfolder, while there is a ".htaccess" file in the root,
    // It can affect the site. We advise you to keep the site in the root always.
    define("HOST_PATH", "/MyWebsite" );

    // If you want to move "rnd-content" and "rnd-engine" folders to a sub-folder,
    // Add the folder name down here. This helps you to backup all data quickly.
    // Also this can improve your site's security.
    define("DATA_PATH", "" );




// (03) We configure API data here. Free version doesn't need this.
//      For special products, API access can be purchased from : https://www.rndvn.com/

    // The url where API will be linked with
    define("API_URL", '' );

    // API User ID (Use "0" for free usage). 
    define("API_USER", '0' ); 

    // API Login Key (Leave it empty for free usage).
    define("API_KEY", '' );

    // API Login Password (Leave it empty for free usage).
    define("API_PASS", '' );




//------------------------------------------
// Following values shouldn't be changed.

    // Public site
    define("APP_URL", HOST_URL .  HOST_PATH ); // Public address of website
    define("APP_TMPL_URL", APP_URL . DATA_PATH . '/rnd-content' ); // Public address of contents
    define("APP_ROOT_URL", APP_URL . DATA_PATH . '/rnd-engine' ); // Public address of root(ajax calls)
    define("APP_LOGIN_COOKIE", "am_access_token" ); // Cookie name for login token

    // Local site
    define("APP_REAL", __DIR__ );
    define("APP_TMPL", __DIR__ . DATA_PATH . '/rnd-content' ); // Where contents lives
    define("APP_ROOT", __DIR__ . DATA_PATH . '/rnd-engine' ); // Where root lives

