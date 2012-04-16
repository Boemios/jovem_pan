<?php
include('../db/database.php');
require_once('../db/conf.php');

function save($post, $database) {
  $database->stmt->prepare("INSERT INTO goals (goal_value, goal_maturity_date) VALUES (?, ?)");

  $date = new DateTime(date('Y-m-d', $post['date']));


  $database->stmt->bind_param('si', $database->connection->real_escape_string($post['value']), $date);
  
  if($database->stmt->execute()) {
    // This is not nice, we shuld do it using http.
    header('Location: ../layouts/goals.php');
  } else {
    printf("Ocorreu um erro na inclusão do registro.");
  }
}

function edit($id, $database) {
  echo("Oi $id");

}

function remove($id, $database){
 $database->stmt->prepare("DELETE FROM goals WHERE id = ?");
 $database->stmt->bind_param('i', $id);

 if($database->stmt->execute()){
   header('Location: ../layouts/goals.php');
 }else{
   printf("Ocorreu um erro na exclusão do registro.");
 }
}

function search($post, $database) {
  $records = array();
  $query = sprintf("SELECT * FROM goals");

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
    decode($method['a'], $database);
  } else if(array_key_exists('delete', $method)){
    decode($method['delete'], $database);
  } else {
    if($method['action'] == 'create') {
      save($method, $database);
    }
  }
}

function encode($arg_action, $id) {
  $str = $arg_action . " " . $id;
  return(base64_encode($str));
}

function decode($action, $database) {
  $str = base64_decode($action);
  $opt = explode(" ", $str);

  if($opt[0] == 'edit') {
    edit($opt[1], $database);
  }else if($opt[0]){
    remove($opt[1], $database);
  }
}

if(array_key_exists('a', $_GET)) {
  select_action($_GET);
} else {
  select_action($_POST);
}
?>
