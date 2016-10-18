<?php
class Murmur_Form {

  public function __construct() {

  }
  public function output_field($results) {
    while($row = $results->fetch(PDO::FETCH_ASSOC)) {
      foreach($row as $k=>$v) {
        echo '<div class="">
        ' . $k['mur'];
        if ($k['annonymous'] == '0') {
          echo '<br />' . $k['fname'];
        }
        echo '<br /></div>';
      }
    }

  }
  public function input_field() {
    $html = '<form class="" action="?murmur" method="post">
    <h2>Say something:</h2>
    <textarea name="murmur_post" rows="4" cols="80"></textarea>
    <br />
    <input type="submit" name="submit" value="Post" />
    </form>';

    return $html;
  }

}
