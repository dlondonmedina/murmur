<?php
/**
* Class logs errors to file with timestamp
*/

class Error_Logger {
  protected static $file;
  private static $dir;
  protected static $last_entry;

  function __construct($file) {
    self::$file = $file; //error log filename
    self::$dir = BASE_PATH . 'log/';
  }

   function log_error($error_message) {
     $t = date("Y-m-d-h:m:s",time());
     $error_message = $t . " " . $error_message;
     self::$last_entry = $error_message;
     $dir = self::$dir;
     // if logdir doesn't exist
     if (!file_exists($dir)) {
       mkdir($dir, 0744);
     }

     $file = $dir. self::$file . '.log';
      if(!file_exists($file)) {
        touch($file);
        chmod($file, 0600);
      }


      if (!is_writable($file)) {
        echo "No Permissions";
      } else {
      file_put_contents($file, $error_message . "\n", FILE_APPEND);
      }
   }

   function get_last_error() {

     if (isset(self::$last_entry)) {

       echo self::$last_entry;

     } else {
       echo "No errors exist.";
     }
   }

}
