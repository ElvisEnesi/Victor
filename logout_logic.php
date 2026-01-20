<?php
  include 'partials/database.php';
  // clear caches
  // $_SESSION = array(); // clear all sessions
  // if (ini_get("session.use_cookies")) {
  //   $params = session_get_cookie_params();
  //   setcookie(session_name(), '', time() - 42000, 
  //   $params["path"], $params["domain"], $params["secure"], 
  //   $params["httponly"]);
  // }
  session_destroy();
  // redirect back to home page
  header("location: index.php");
  die();
?>
