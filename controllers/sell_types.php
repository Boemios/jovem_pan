<?php
include('../db/database.php');
require_once('../db/conf.php');

function save($post) {
  global $database;

  $database->stmt->prepare("INSERT INTO sell_types (code, description) VALUES (?, ?)");
  $database->stmt->bind_param('ss', $database->connection->real_escape_string($post['code']),
    $database->connection->real_escape_string($post['description']));
  if($database->stmt->execute()) {
    // This is not nice, we shuld do it using http.
    header('Location: ../layouts/sell_types.php');
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

  $database->stmt->prepare("UPDATE sell_types SET code=?, description=? WHERE id=?");
  $database->stmt->bind_param('ssi', $database->connection->real_escape_string($post['code']),
    $database->connection->real_escape_string($post['description']), $post['id']);
  if($database->stmt->execute()) {
    // This is not nice, we shuld do it using http.
    header('Location: ../layouts/sell_types.php');
  } else {
    printf("Ocorreu um erro na edição do registro.");
  }

}

function search($argv = false) {
  global $database;
  $records = array();
  $query = sprintf("SELECT * FROM sell_types");

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

function remove($id){
  global $database;

  $database->stmt->prepare("DELETE FROM sell_types WHERE id = ?");
  $database->stmt->bind_param('i', $id);

  if($database->stmt->execute()){
    header("Location: ../layouts/sell_types.php");
  }else{
    printf("Ocorreu um erro na exclusão do registro");
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
