<?php
include('../db/database.php');
require_once('../db/conf.php');

function save($post, $database) {
  $database->stmt->prepare("INSERT INTO employees (name, position) VALUES (?, ?)");
  $database->stmt->bind_param('si', $database->connection->real_escape_string($post['name']),
    $post['position']);
  if($database->stmt->execute()) {
    // This is not nice, we shuld do it using http.
    header('Location: ../layouts/employees.php');
  } else {
    printf("Ocorreu um erro na inclusão do registro.");
  }
}

function search($post, $database) {
  $records = array();
  $query = sprintf("SELECT * FROM employees");

  if($result = $database->connection->query($query)) {
    while($row = $result->fetch_assoc()) {
      array_push($records, $row);
    }
  }

  return $records;
}

function select_action() {
  $database = new Database(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, "jovempan");

  if(!array_key_exists('action', $_POST)) {
    return(search($_POST, $database));
  } else {
    if($_POST['action'] == 'create') {
      save($_POST, $database);
    }
  }
}

function code_to_position($code) {
  if($code == 0)
    return "Gerente Corporativo";
  else if($code == 1)
    return "Gerente / supervisor comercial";
  else
    return "Executivo de vendas";
}

select_action();
?>
