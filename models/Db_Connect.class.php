<?php
class Db_Connect {
  // The database connection
  protected static $connection;


  /**
  * Connect to the database
  *
  * @return bool false on failure / PDO object instance on success
  */
  public function connect() {
    // Try and connect to the database.
    if(!isset(self::$connection)) {
      try {
         // Establish connection
         self::$connection = new PDO('mysql:host='. MYSQL_HOST.';dbname='. MYSQL_DATABASE.';charset=utf8mb4',
          MYSQL_USERNAME, MYSQL_PASSWORD, array(
            PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      } catch (PDOException $ex) {
         echo "Connection failed!";
         $log = new Error_Logger('database');
         $log->log_error($ex->getMessage());
         die();
      }
    }
    return self::$connection;
  }

  /**
  * Fetch the last error from database
  *
  * @return string Database error Message
  */
  public function error() {
    $connection = $this -> connect();
    return $connection -> error;
  }

  /**
  * Quote and escape value for use in a database query
  *
  * @param string $value The value to be quoted and escaped
  * @return string The quoted and escaped string
  */
  public function quote($value) {
      $connection = $this -> connect();
      return "'" . $connection -> real_escape_string($value) . "'";
  }

}
