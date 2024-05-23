<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// open the $_SESSION
session_start();

$user = false;

// Check $_POST is not empty
if(!empty($_POST)) {
  // 1. Check all the inputs exist
  // 2. We check also if the $_POST are not empty because we load the page, the form is empty
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
include "includes/header.view.php";

?>

    <h1>User Login</h1>

    <form method="post" action="">
        <?php if(isset($_POST["login"]) && !$user) {
            echo "<p>User or Password not valid</p>";
        } ?>
        <div>
            <label for="login">Login :</label>
            <input type="text" name="login">
        </div>
        <div>
            <label for="pass">Password</label>
            <input type="text" name="pass">
        </div>
        <button type="submit">Login</button>
    </form>



<?php
include "includes/footer.view.php";
?>