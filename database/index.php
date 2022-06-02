<?php
require 'validation.php';

$db = new mysqli('localhost', 'root',  '', 'todolist');

if ($db->connect_error) {
  die('Błąd połączenia:'. $db->connect_error);
}

$action = $_GET['action'];

$outputArray = array(
  'error' => array(),
  'message' => array(),
);
$output = (object) $outputArray;

switch ($action) {
  case 'login':
    $login = $_POST['login'];
    $password = $_POST['password'];

    if (!isLoginValidate ($login, $output)) {
      return;
    }

    if (!isPasswordValidate ($password, $output)) {
      return;
    }

    $sql = "SELECT * FROM users WHERE (`login` = '$login' OR `email`='$login')";
    $query = $db->query($sql);
    $result = mysqli_fetch_assoc($query);

    if (password_verify($password, $result['password'])) {
      $userOutput = $result;
      return;
    }

    break;

    case 'register':
      $name = trimInput($_POST['name']);
      $lastname = trimInput($_POST['lastname']);
      $login = trimInput($_POST['login']);
      $email = trimInput($_POST['email']);
      $password = trimInput($_POST['password']);
      $passwordConfirm = trimInput($_POST['password_confirm']);

      $valid = true;

      if (!isNameValidate ($name, $output)) {
        $valid = false;
      }

      if (!isLastnameValidate ($lastname, $output)) {
        $valid = false;
      }

      if (!isLoginValidate ($login, $output)) {
        $valid = false;
      }

      if (!isEmailValidate ($email, $output)) {
        $valid = false;
      }

      if (!isPasswordValidate ($password, $output)) {
        $valid = false;
      }

      if (!isPasswordConfirmValidate($password, $passwordConfirm, $output)) {
        $valid = false;
      }

      if (isLoginExist ($login, $output, $db)) {
        $valid = false;
      }

      if (isEmailExist ($email, $output, $db)) {
        $valid = false;
      }

      if ($valid) {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `login`, `password`) VALUES (NULL, '$name', '$lastname', '$email', '$login', '$passwordHash')";
        $query = $db->query($sql);
      }

      break;
}

header('Content-type: application/json');
echo json_encode($output);
die();

?>
