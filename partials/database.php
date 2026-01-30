<?php 
  // starting session
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  // declare DB variables
  $server = 'localhost';
  $username = 'root';
  $dbpass = '';
  $dbname = 'victor';
  // make connetion
  $connection = new mysqli($server, $username, $dbpass, $dbname);
  // checking for successful connection
  if ($connection->connect_error) {
    die("Connection failed: " .$connection->connect_error);
  }












?>

