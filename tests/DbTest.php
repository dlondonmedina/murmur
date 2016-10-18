<?php
use PHPUnit\Framework\TestCase;

class DbTest extends TestCase {

  public function dbCanConnect() {
    $db = new Db();
     $this->assertNotNull($db, "Db Connection Failed");
  }
}
