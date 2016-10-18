<?php
class SharedDoc extends TextEntry {

  public function save_doc($title, $text, $course) {
    $stmt = parent::$conn->prepare("INSERT INTO SharedDocs (netid, title, doc, course) values (?,?,?,?);");
    $stmt->bindParam('sss', parent::$netid, $title, $text, $course);
    $stmt->execute();
  }

  public function get_doc($title) {
    $stmt = parent::$conn->prepare("SELECT * from SharedDocs WHERE title=" . $title . ");");
    $result = $stmt->execute();

  }
}
