<?php
function trimInput($input) {
  $input = trim($input);
  $input = stripslashes($input);
  $input = htmlspecialchars($input);
  return $input;
}

function isNameValidate ($name, $output) {
  if ($name == '') {
    $output->error['name'] = true;
    $output->message['name'] = 'Imię jest wymagane.';
    return false;
  }

  return true;
}

function isLastnameValidate ($lastname, $output) {
  if ($lastname == '') {
    $output->error['lastname'] = true;
    $output->message['lastname'] = 'Nazwisko jest wymagane.';
    return false;
  }

  return true;
}

function isLoginValidate ($login, $output) {
  if ($login == '') {
    $output->error['login'] = true;
    $output->message['login'] = 'Login jest wymagany.';
    return false;
  }

  return true;
}

function isEmailValidate ($email, $output) {
  if ($email == '') {
    $output->error['email'] = true;
    $output->message['email'] = 'Email jest wymagany.';
    return false;
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $output->error['email'] = true;
    $output->message['email'] = 'Niepoprawny format emaila.';
    return false;
  };

  return true;
}

function isPasswordValidate ($password, $output) {
  if ($password == '') {
    $output->error['password'] = true;
    $output->message['password'] = 'Hasło jest wymagane.';
    return false;
  }

  return true;
}

function isPasswordConfirmValidate ($password, $passwordConfirm, $output) {
  if ($passwordConfirm == '') {
    $output->error['password_confirm'] = true;
    $output->message['password_confirm'] = 'Potwierdzenie hasła jest wymagane.';
    return false;
  }

  if ($password != $passwordConfirm) {
    $output->error['password_confirm'] = true;
    $output->message['password_confirm'] = 'Hasła nie są takie same.';
    return false;
  }

  return true;
}

function isLoginExist ($login, $output, $db) {
  $sql = "SELECT * FROM users WHERE `login` = '$login'";
  $query = $db->query($sql);

  if ($query->num_rows > 0) {
    $output->error['login'] = true;
    $output->message['login'] = 'Ten login jest już w użyciu.';
    return true;
  }

  return false;
}

function isEmailExist ($email, $output, $db) {
  $sql = "SELECT * FROM users WHERE `email` = '$email'";
  $query = $db->query($sql);

  if ($query->num_rows > 0) {
    $output->error['email'] = true;
    $output->message['email'] = 'Ten email jest już powiązany z jakimś kontem.';
    return true;
  }

  return false;
}

?>
