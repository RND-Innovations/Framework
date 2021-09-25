<?php

/**************************************/
/* Developed By : Priyankara Dilantha */
/* Contact Me 	: www.dilantha.org ****/
/**************************************/


// *************************
// Hook functions
// *************************

//Arrays to store user-registered actions and filters.
$action_events = array();
$filter_events = array();


//---------------------------------------//
// ACTIONS: Execute all functions at hook
//---------------------------------------//

    // Functions for Action Hooks
    function get_action($event){
        global $action_events;

        if(isset($action_events[$event])){
            foreach($action_events[$event] as $func){
                if(!function_exists($func)) {
                    die('Unknown function: '.$func);
                }
                call_user_func($func);//, $args);
            }
        }
    }

    // Register action
    function add_action($event, $func){
        global $action_events;
        $action_events[$event][] = $func;
    }


//---------------------------------------//
// FILTERS: return all contents to hook
//---------------------------------------//

    // Functions for Filter Hooks
    function get_filter($event, $content) {

        global $filter_events;

        // If event is set in $filter_events[] array
        if(isset($filter_events[$event])){
            foreach($filter_events[$event] as $func) {
                // If function not exist it is an error
                if(!function_exists($func)) {
                    die('Unknown function: '.$func);
                }
                // append data together and return
                $content = call_user_func($func,$content);
            }
        }
        return $content;
    }

    // Register filter
    function add_filter($event, $func){
        global $filter_events;
        $filter_events[$event][] = $func; // Get functions to array from index.php of plugin
    }
