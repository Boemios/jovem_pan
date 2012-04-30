<?php
include('../db/database.php');
require_once('../db/conf.php');

function save($post) {
  global $database;

  $database->stmt->prepare("INSERT INTO shares (value, due_date, sell_id) VALUES (?, ?, ?)");
  /*TODO: Needs to change bind_param parameters to fit form nomination*/
  $database->stmt->bind_param('fds', $database->connection->real_escape_string($post['name']),
    $post['position']);
  if($database->stmt->execute()) {
    // This is not nice, we shuld do it using http.
    header('Location: ../layouts/sells.php');
  } else {
    printf("Ocorreu um erro na inclusão do registro.");
  }
}

function edit($post) {
  global $database;

  $database->stmt->prepare("UPDATE shares SET value=?, due_date=?, sell_id=?  WHERE id=?");
  /*TODO: Needs to change bind_param parameters to fit form nomination*/
  $database->stmt->bind_param('dsii', $database->connection->real_escape_string($post['name']),
    $post['position'], $post['id']);
  if($database->stmt->execute()) {
    // This is not nice, we shuld do it using http.
    header('Location: ../layouts/sells.php');
  } else {
    printf("Ocorreu um erro na edição do registro.");
  }

}

function search($argv = false) {
  global $database;
  $records = array();
  $query = sprintf("SELECT * FROM shares");

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

function remove($id) {
  global $database;

  $database->stmt->prepare("DELETE FROM shares WHERE id = ?");
  $database->stmt->bind_param('i', $id);

  if($database->stmt->execute()) {
    header('Location: ../layouts/sells.php');
  } else {
    printf("Ocorreu um erro na exclusão do registro.");
  }
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

$database = new Database(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, "jovempan");

if(isset($_POST['action']))
  select_action($_POST);
else if(isset($_GET['delete']))
  remove(decode($_GET['delete']));

?>
