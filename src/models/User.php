<?php

namespace Models;

use Exception;
use Models\Database;

class User extends Database
{
  public function addUser($login, $email, $pass)
  {

    if(isset($login, $email, $pass) &&
        !empty($login) && !empty($email) && !empty($pass)
    ) {

        // strip_tags for the login
        $loginPost = strip_tags($login);

        // check valid email
        $emailPost = filter_var($email, FILTER_VALIDATE_EMAIL);

        // hash the password
        $passPost = password_hash($pass, PASSWORD_BCRYPT);

        //SQL part
        $q = $this->query(
            "INSERT INTO users(login, email, password) 
                    VALUES (:login, :email, :password)",
            [":login" => $loginPost,
              ":email" => $emailPost,
              ":password" => $passPost]);

        if (!$q) {
            die("form not sent to the db");
        }

        // retreive the last ID
        $id = $this->lastInsertId();

        // store data of user in $_SESSION
        $_SESSION["user"] = [
          "id" => $id,
          "login" => $loginPost,
          "email" => $emailPost
        ];

    } else {
      throw new Exception("form incomplete");
    }
  }


  public function loginUser()
  {
      if (isset($_POST["login"], $_POST["pass"]) && !empty($_POST['login']) && !empty($_POST['pass'])) {


      //SQL part
      require_once "Database.php";

      $login = strip_tags($_POST["login"]);

      $q = $db->prepare("SELECT * FROM users WHERE login = :login");

      // bindParam() accepte uniquement une variable qui est interprétée au moment de l'execute()
      $q->bindParam(":login", $login, PDO::PARAM_STR);

      // execute return a boolean
      if(!$q->execute()) {
          die("User or Password not valid");
      }

      $user = $q->fetch(PDO::FETCH_ASSOC);

      // check the password input with the password in db
      if($user && !password_verify($_POST["pass"], $user['password'])) {
          die("User or Password not valid");
      };

      // store data of user in $_SESSION
      $_SESSION['user'] = [
       $user['id'],
       $user['login'],
       $user['email']
      ];


      header("Location: index.view.php");
    }
  }

}