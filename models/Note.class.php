<?php

class Note extends TextEntry {

  /**
  * Saves note to database
  *
  * @param text Note text from form
  * @param int 0 or 1 Anonymous from form
  */
  public function save_note($text, $course, $anon) {
    $user = self::$user;
    $stmt = self::$conn->prepare("INSERT INTO Notes (netid, note, course, anonymous) values (:netid, :newtext, :course, :anon);");
    $stmt->bindParam(':netid', $user['netid'], PDO::PARAM_STR);
    $stmt->bindParam(':newtext', $text, PDO::PARAM_STR);
    $stmt->bindParam(':course', $user['course'], PDO::PARAM_STR);
    $stmt->bindParam(':anon', $anon, PDO::PARAM_INT);
    $stmt->execute();
  }

/**
* Gets notes from database
*
* @param index_by array Where conditions for sql statement
* @return result Result of db query
*/
  public function get_note($id, $course) {
    if(isset($id) && isset($course)) {
      $stmt = self::$conn->prepare("SELECT note, entered, netid, anonymous FROM Notes WHERE netid = :id AND course = :course);");
      $stmt->bindParam(':id', $id, PDO::PARAM_STR);
      $stmt->bindParam(':course', $course, PDO::PARAM_STR);
    } elseif (isset($id) && !isset($course)) {
      $stmt = self::$conn->prepare("SELECT note, entered, netid, anonymous FROM Notes WHERE netid = :id);");
      $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    } elseif (!isset($id) && isset($course)) {
      $stmt = self::$conn->prepare("SELECT note, entered, netid, anonymous FROM Notes WHERE course = :course);");
      $stmt->bindParam(':course', $course, PDO::PARAM_STR);
    } else {
      $stmt = self::$conn->prepare("SELECT note, entered, netid, anonymous FROM Notes);");
    }
    $result = $stmt->execute();
    return $result;

  }

}
