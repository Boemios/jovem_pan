<?php

include('../db/database.php');
require_once('../db/conf.php');

$database = new Database(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, "jovempan");

function save($post, $database) {
  $database->stmt->prepare("INSERT INTO employees (name, position) VALUES (?, ?)");
  $database->stmt->bind_param('si', $database->connection->real_escape_string($post['name']),
    $post['position']);
  if($database->stmt->execute()) {
    // This is not nice, we shuld do it using http.
    header('Location: ../index.php');
  } else {
    printf("Ocorreu um erro na inclusão do registro.");
  }
}


if($_POST['action'] == 'create') {
  save($_POST, $database);
}
?>
