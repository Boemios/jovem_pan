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

function edit($id) {
  echo("Oi $id");

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

function select_action($method) {
  $database = new Database(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, "jovempan");

  if($method == NULL) {
    return(search($method, $database));
  } else if(array_key_exists('a', $method)) {
    decode($method['a']);
  } else {
    if($method['action'] == 'create') {
      save($method, $database);
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

function encode($arg_action, $id) {
  $str = $arg_action . " " . $id;
  return(base64_encode($str));
}

function decode($action) {
  $str = base64_decode($action);
  $opt = explode(" ", $str);

  if($opt[0] == 'edit') {
    edit($opt[1]);
  }
}

if(array_key_exists('a', $_GET)) {
  select_action($_GET);
} else {
  select_action($_POST);
}
?>
