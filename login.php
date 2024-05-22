<?php
session_start();
require_once 'db.php';

$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $pdo->prepare("SELECT * FROM Users WHERE email = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();
$user = $stmt->fetch();
// if ($user && password_verify($password, $user['password'])) {
if ($user) {
  $_SESSION['user_id'] = $user['id'];
  $_SESSION['name'] = $user['name'];
  header('Location: index.php');
} else {
  echo 'Invalid email or password';
}   