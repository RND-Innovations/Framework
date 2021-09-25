<?php

/**************************************/
/* Developed By : Priyankara Dilantha */
/* Contact Me 	: www.dilantha.org ****/
/**************************************/

class am_core{
    
    private function ip(){
        
        // Return client IP address
        $ipaddress = '';

        if(isset($_SERVER['HTTP_CLIENT_IP'])){
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }elseif(isset($_SERVER['HTTP_X_FORWARDED'])){
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        }elseif(isset($_SERVER['HTTP_FORWARDED_FOR'])){
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        }elseif(isset($_SERVER['HTTP_FORWARDED'])){
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        }elseif($_SERVER['REMOTE_ADDR']){
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        }else{
            $ipaddress = '0.0.0.0'; 
        }

        $list = explode(",", $ipaddress); // If comma separated IPs, get first IP
        return $list[0];
    }

    private function user_agent(){
        // Return client user agent
        return ( isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "" );
    }    
    
    private function referrer(){
        // Return client referrer
        return ( isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "");
    }

    public function connect($path="", $data=array()){ 
        $get_array  = array();
        //$gets       = explode("?", $_GET["data"]); echo $_GET["data"];
        parse_str($_SERVER['QUERY_STRING'], $get_array);
        
        $params = array(
            'user' => urlencode( API_USER ),
            'key' => urlencode( API_KEY ),
            'pass' => urlencode( API_PASS ),
            'ip' => urlencode( $this->ip() ),
            'cookies' => json_encode( utf8ize($_COOKIE) ),
            'session' => json_encode( $_SESSION ),
            'get' => json_encode( $get_array ),
            'ua' => urlencode( $this->user_agent() ),
            'ref' => urlencode( $this->referrer() )
        );

        /*'images' => array(
                 urlencode(base64_encode('image1')),
                 urlencode(base64_encode('image2'))
                 ) */
                     
        $data = http_build_query( $params + $data );
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, API_URL . "/" .$path );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);  // Should be greater than "CURLOPT_CONNECTTIMEOUT" (includes connectiontimeout)     

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }        
        curl_close($ch);
        
        if (isset($error_msg)) {
            return "";
        }else{
            //echo $result;exit;
            return json_decode($result, true);    
        }
    } 
    
}
