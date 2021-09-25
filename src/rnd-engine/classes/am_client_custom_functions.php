<?php

/**************************************/
/* Developed By : Priyankara Dilantha */
/* Contact Me 	: www.dilantha.org ****/
/**************************************/

class am_custom_functions{

    private static $store = [];
    private static $maker = "";
    private static $declaration = '
        function %s() {
            return call_user_func_array(
                %s::get(__FUNCTION__),
                func_get_args()
            );
        }
    ';

    private static function safeName($name) {
        // extra safety against bad function names
        $name = preg_replace('/[^a-zA-Z0-9_]/',"",$name);
        $name = substr($name,0,64);
        return $name;
    }

    public static function add($name,$func) {
        // prepares a new function for make()
        $name = self::safeName($name);
        self::$store[$name] = $func;
        self::$maker.=sprintf(self::$declaration,$name,__CLASS__);
    }

    public static function get($name) {  
        // returns a stored callable
        return self::$store[$name];
    }

    public static function make() {  
        // returns a string with all declarations
        return self::$maker;
    }

}