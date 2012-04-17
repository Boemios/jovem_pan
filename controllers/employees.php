<?php
include('../db/database.php');
require_once('../db/conf.php');

function save($post) {
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

function recover_to_edit($id) {
  global $database;
  $argv['id'] = $id;
  $records = search($argv);

  if(sizeof($records == 1)) {
    return $records[0];
  } else {
    die("A consulta deveria retornar um único resutado mas retornou mais ou menos do que isso.");
  }
}

function update($post) {
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

}

function search($argv = false) {
  global $database;
  $records = array();
  $query = sprintf("SELECT * FROM employees");

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

function select_action($method) {
  global $database;

  if($method == NULL) {
    return(search());
  } elseif($method['action'] == 'create') {
    save($method);
  } elseif($method['action'] == 'edit') {
    update($method);
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

function encode($arg_action, $id) {
  $str = $arg_action . " " . $id;
  return(base64_encode($str));
}

function decode($action) {
  $str = base64_decode($action);
  $opt = explode(" ", $str);

  return $opt;
}

$database = new Database(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, "jovempan");

if(array_key_exists('a', $_GET)) {
  select_action($_GET);
} else {
  select_action($_POST);
}
?>
