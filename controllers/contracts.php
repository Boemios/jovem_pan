<?php
include('../db/database.php');
require_once('../db/conf.php');

/* function save($post) {
  global $database;

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

function edit($post) {
  global $database;

  $database->stmt->prepare("UPDATE employees SET name=?, position=? WHERE id=?");
  $database->stmt->bind_param('sii', $database->connection->real_escape_string($post['name']),
    $post['position'], $post['id']);
  if($database->stmt->execute()) {
    // This is not nice, we shuld do it using http.
    header('Location: ../layouts/employees.php');
  } else {
    printf("Ocorreu um erro na edição do registro.");
  }

} */

function search($table, $argv = false) {
  global $database;
  $records = array();
  $query = sprintf("SELECT * FROM %s", $table);

  if($argv) {
    $count = sizeof($argv);
    foreach($argv as $key => $value) {
      $query .= sprintf(" WHERE %s = %s", $key, $value);
      $count -= 1;
      if($count > 0)
        $query .= sprintf(", ");
    }
  }

  if($result = $database->connection->query($query)) {
    while($row = $result->fetch_assoc()) {
      array_push($records, $row);
    }
  }

  return $records;
}

/* function remove($id) {
  global $database;

  $database->stmt->prepare("DELETE FROM employees WHERE id = ?");
  $database->stmt->bind_param('i', $id);

  if($database->stmt->execute()) {
    header('Location: ../layouts/employees.php');
  } else {
    printf("Ocorreu um erro na exclusão do registro.");
  }
} */

function select_action($method) {
  if($method == NULL) {
    return(search($method));
  } else if($method['action'] == 'create') {
    save($method);
  } else if($method['action'] == 'edit') {
    edit($method);
  }
}

/* function code_to_position($code) {
  if($code == 0)
    return "Gerente Corporativo";
  else if($code == 1)
    return "Gerente / supervisor comercial";
  else
    return "Executivo de vendas";
}

function encode($value_to_encode) {
  $str = $value_to_encode;
  return(base64_encode($str));
}

function decode($value_encoded) {
  $value_decoded = base64_decode($value_encoded);

  return $value_decoded;
} */

$database = new Database(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, "jovempan");

if(isset($_POST['action']))
  select_action($_POST);
else if(isset($_GET['delete']))
  remove(decode($_GET['delete']));

?>
