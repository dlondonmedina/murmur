<?php
class User {
   // Data about person
   public $fname;
   public $lname;
   public $course;
   private static $id;
   protected static $email;
   protected static $roll;

   function __construct($person_name, $person_id, $person_course, $person_email, $person_roll) {
     $names = explode(" ", $person_name);
     if(count($names) > 1) {
       $sliced = array_slice($names, 0, -1);
       $this->fname = implode(" ", $sliced);
       $this->lname = end($names);
     } else {
       $this->fname = current($names);
       $this->lname = "";
     }
     $this->course = $person_course;
     self::$id = $person_id;
     self::$email = $person_email;
     self::$roll = $person_roll;
   }

   /**
   * Get user
   *
   * @param string user id
   * @return result User info from db
   */
   public function get_user() {
     $db = new Db();
     $conn = $db->connect();
     $stmt = $conn->prepare('SELECT * from Users WHERE netid = :netid);');
     $stmt->bindParam(':netid', self::$id);
     $stmt->execute();
     $result = $stmt->fetchAll();

     if(empty($result)) {
       echo "<script type='text/javascript'>alert('User " . $this->fname . " " . $this->lname . " does not exist. Creating user.')</script>";
       $result = null;
     }

     return $result;


   }
   /**
   * Register new user if they don't exists in db
   *
   * @return string message Error message
   */
   public function register_user() {
     // Check if user exists in db
     $result = $this->get_user(self::$id);

      // Establish Db connection
      $db = new Db();
      $conn = $db->connect();

      //$result = $stmt->fetchAll();
      if (!isset($result)) {
        try {
          $stmt = $conn->prepare("INSERT INTO Users (netid, fname, lname, course, email, roll) values (:netid, :fname, :lname, :course, :email, :roll);");
          // $stmt->bindParam("sssssi", self::$id, $this->fname, $this->lname, $this->course, self::$email, self::$roll);
          $stmt->bindParam(':netid', self::$id, PDO::PARAM_STR);
          $stmt->bindParam(':fname', $this->fname, PDO::PARAM_STR);
          $stmt->bindParam(':lname', $this->lname, PDO::PARAM_STR);
          $stmt->bindParam(':course', $this->course, PDO::PARAM_STR);
          $stmt->bindParam(':email', self::$email, PDO::PARAM_STR);
          $stmt->bindParam(':roll', self::$roll, PDO::PARAM_INT);
          $stmt->execute();
          $message = "Registration successful!";

        } catch(PDOException $ex) {
          $message = "There was an error in registration! Try again!";
          $log = new Error_Logger('user');
          $log->log_error($ex->getMessage());
        }
      } else {
        $message = "User:". $this->fname . " " . $this->lname . " exists!";
      }

      return $message;
   }
//NEW ADDED 923
   public function get_properties() {
      $properties = array(
        'fname' => $this->fname,
        'lname' => $this->lname,
        'netid' => self::$id,
        'email' => self::$email,
        'course' => $this->course
      );
      return $properties;
   }


}
