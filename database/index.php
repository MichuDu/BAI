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
  'login' => false,
);
$output = (object) $outputArray;

switch ($action) {
  case 'read':
    $sql = "SELECT * FROM users";
    $query = $db->query($sql);
    $users = array();

    while ($row = $query->fetch_array()) {
      array_push($users, $row);
    }

    $output->users = $users;

    break;
  case 'login':
    $login = $_POST['login'];
    $password = $_POST['password'];

    $valid = true;

    if (!isLoginValidate ($login, $output)) {
      $valid = false;
    }

    if (!isPasswordValidate ($password, $output)) {
      $valid = false;
    }

    if ($valid) {
      $sql = "SELECT * FROM users WHERE (`login` = '$login' OR `email`='$login')";
      $query = $db->query($sql);
      $row = $query->fetch_array(MYSQLI_ASSOC);

      if (password_verify($password, $row['password']) && $query->num_rows > 0) {
        $user = array();
        $output->login = true;
        $output->user = $row;
      } else {
        $output->login = false;
        $output->message['error'] = "Niepoprawny login lub hasło.";
      }
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
