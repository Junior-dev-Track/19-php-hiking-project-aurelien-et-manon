<?php
session_start();

// delete session variable
unset($_SESSION['user']);

header('Location: index.view.php');