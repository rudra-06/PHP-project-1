<?php
session_start();
include 'connection.php';

$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = md5($_POST['password']);

$sql = "INSERT INTO employees(name, user_name, email, password) VALUES('$name', '$username', '$email', '$password')";
// echo "INSERT INTO employees(name, user_name, email, password) VALUES('$name', '$username', '$email', '$password')";
$result = mysqli_query($conn, $sql);

echo "<center><h1>SUCCESS</h1></center>"

?>