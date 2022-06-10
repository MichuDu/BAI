<?php
$db = new mysqli('localhost', 'root',  '', 'todolist');

if ($db->connect_error) {
  die('Błąd połączenia:'. $db->connect_error);
}

$action = $_GET['action'];
$output = (object) array();

if ($action) {
  switch ($action) {
    case 'addTask':
      $name = $_POST['name'];
      $userId = $_POST['user_id'];
      $task = array();
      
      if ($name) {
        $sql = "INSERT INTO `tasks` (`id`, `user_id`, `name`, `status`) VALUES (NULL, '$userId', '$name', 0)";
        $db->query($sql);

        $id = $db->insert_id;
        $sqlSelect = "SELECT * FROM `tasks` WHERE (`id` = '$id')";
        $querySelect = $db->query($sqlSelect);

        while ($row = $querySelect->fetch_array(MYSQLI_ASSOC)) {
          array_push($task, $row);
        }

        $output->task = $task;
      }

      break;
    case 'getTasks':
      $userId = $_POST['user_id'];
      $tasks = array();
      
      $sql = "SELECT * FROM `tasks` WHERE (`user_id` = '$userId')";
      $query = $db->query($sql);

      while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
        array_push($tasks, $row);
      }

      $output->tasks = $tasks;
      break;
    case 'changeStatus':
      $id = $_POST['id'];

      $sql = "UPDATE `tasks` SET `status` = NOT `status` WHERE `id` = $id";
      $query = $db->query($sql);
      
      break;
    case 'deleteTask':
      $id = $_POST['id'];

      $sql = "DELETE FROM `tasks` WHERE `id` = $id";
      $query = $db->query($sql);

      break;
  }
}

header('Content-type: application/json');
echo json_encode($output);
die();

?>
