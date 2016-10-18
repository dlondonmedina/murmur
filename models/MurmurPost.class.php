<?php

class MurmurPost extends TextEntry {


  public function save_murmur($text, $hashtags, $anon) {
    $stmt = parent::$conn->prepare("INSERT INTO Mur (netid, mur, hashtags, anonymous) values (:netid, :mur, :hashtags, :anon);");
    $stmt->bindParam(':netid', parent::$netid, PDO::PARAM_STR);
    $stmt->bindParam(':mur', $text, PDO::PARAM_STR);
    $stmt->bindParam(':hashtags', $hashtags, PDO::PARAM_STR);
    $stmt->bindParam(':anon', $anon, PDO::PARAM_INT);
    $stmt->execute();
  }

/**
* Gets murmurs from database
*
* @param id of user we want
* @return result Result of db query Make sure to join with usernames if not anonymous
*/
  public function get_murmur($id) {
    if(isset(parent::$netid)) {
      $stmt = parent::$conn->prepare("SELECT note, entered, netid, anonymous FROM Mur WHERE netid = :id);");
      $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    } else {
      $stmt = parent::$conn->prepare("SELECT note, entered, netid, anonymous FROM Mur);");
    }
    $result = $stmt->execute();
    return $result;

  }
}
