<?php
class TextEntry {
  protected static $user;
  protected $conn;

  public function __construct($user){
    self::$user = $user->get_properties();
    $db = new Db_Connect();
    $this->conn = $db->connect();
  }

}
