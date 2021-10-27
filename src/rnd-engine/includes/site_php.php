<?php

/**************************************/
/* Developed By : Priyankara Dilantha */
/* Contact Me 	: www.dilantha.org ****/
/**************************************/


// In case a project needs custom functions/variables (PRIVATE),
// You can store them in "rnd-content" folder by creating a new folder,
// named "runtime" which keeps *.php files that includes functions/vars/constants


if(file_exists(APP_TMPL . "/runtime")){
    foreach( glob( APP_TMPL . "/runtime/*.php" ) as $file ){
        include_once($file);
    }   
}