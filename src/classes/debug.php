<?php
/* REQUIRES PHP 7.x AT LEAST */

class aeSecureDebug
{
    
    protected static $instance = null;
   
    private static $_enable=false;
   
    function __construct()
    {

        self::$_enable=false;
        return true;
    } // function __construct()
    
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new aeSecureDebug();
        }
        return self::$instance;
    } // function getInstance()
   
    public function enable()
    {
      
        self::$_enable=true;
   
        ini_set("display_errors", "1");
        ini_set("display_startup_errors", "1");
        ini_set("html_errors", "1");
        ini_set("docref_root", "http://www.php.net/");
        ini_set("error_prepend_string", "<div style='color:black;font-family:verdana;border:1px solid red; padding:5px;'>");
        ini_set("error_append_string", "</div>");
        error_reporting(E_ALL);
            
        return true;
    } // function enable()
   
   /**
    * Return the current URL
    *
    * @param type $use_forwarded_host
    * @param type $bNoScriptName          If FALSE, only return the URL and folders name but no script name (f.i. remove index.php and parameters if any)
    * @return type string
    */
    public static function log(string $line, bool $return = false) : string
    {
      
        $line.=' <em class="text-info">('.debug_backtrace()[1]['class'].'::'.debug_backtrace()[1]['function'].', line '.debug_backtrace()[0]['line'].')</em><br/>';
      
        if ($return==true) {
            return $line;
        } else {
            if (self::$_enable) {
                echo $line;
            }
            return '';
        }
    } // function log()
} // class aeSecureDebug