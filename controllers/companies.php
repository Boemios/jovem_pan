<?php
include('../db/database.php');
require_once('../db/conf.php');

function save($post) {
  global $database;

  $database->stmt->prepare("INSERT INTO companies (type, social_name, fantasy_name) VALUES (?, ?, ?)");
  $database->stmt->bind_param('iss', $post['type'],
    $database->connection->real_escape_string($post["social_name"]),
    $database->connection->real_escape_string($post["fantasy_name"]));

  if($database->stmt->execute()) {
    header('Location: ../layouts/companies.php');
  } else {
    printf("Ocorreu um erro na inclusão do registro.");
  }
}

function edit($post) {
  global $database;

  $database->stmt->prepare("UPDATE companies SET type=?, social_name=?, fantasy_name=? WHERE id=?");
  $database->stmt->bind_param('issi', $post['type'],
    $database->connection->real_escape_string($post["social_name"]),
    $database->connection->real_escape_string($post["fantasy_name"]), $post['id']);

  if($database->stmt->execute()) {
    // This is not nice, we shuld do it using http.
    header('Location: ../layouts/companies.php');
  } else {
    printf("Ocorreu um erro na edição do registro.");
  }
}

function remove($id) {
  global $database;

  $database->stmt->prepare("DELETE FROM companies WHERE id = ?");
  $database->stmt->bind_param('i', $id);

  if($database->stmt->execute()){
    header('Location: ../layouts/companies.php');
  }else{
    printf("Ocorreu um erro na exclusão do registro.");
  }
}

function search($argv = false) {
  global $database;

  $records = array();
  $query = sprintf("SELECT * FROM companies");

  if($argv) {
    $count = sizeof($argv);
    foreach($argv as $key => $value) {
      $query .= sprintf(" WHERE %s = %s", $key, $value);
      $count -= 1;
      if($count > 0)
        $query .= sprintf("AND ");
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
  if($method == NULL) {
    return(search($method));
  } else if($method['action'] == 'create') {
    save($method);
  } else if($method['action'] == 'edit') {
    edit($method);
  }
}

function encode($value_to_encode) {
  $str = $value_to_encode;
  return(base64_encode($str));
}

function decode($value_encoded) {
  $value_decoded = base64_decode($value_encoded);

  return $value_decoded;
}

function code_to_kind($code) {
  if($code == 0)
    return "Cliente";
  else if($code == 1)
    return "Agência";
  else
    return "Cliente e agência";
}

$database = new Database(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, "jovempan");

if(isset($_POST['action']))
  select_action($_POST);
else if(isset($_GET['delete']))
  remove(decode($_GET['delete']));

?>
