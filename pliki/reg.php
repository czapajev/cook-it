<?php
session_start();
require_once('mysql_connect.php');

$login = $_POST['login'];
$haslo = $_POST['haslo'];
$email = $_POST['email'];

$query = "INSERT INTO users (username, email, haslo, data_rejestracji) VALUES ('$login', '$email', '$haslo', NOW())";
$result = mysql_query($query);

echo mysql_insert_id();






?>