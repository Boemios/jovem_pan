<?php
include('../db/database.php');
require_once('../db/conf.php');

function save($post, $database) {
  $database->stmt->prepare("INSERT INTO companies (type, social_name, fantasy_name) VALUES (?, ?, ?)");

  $database->stmt->bind_param('iss', $database->connection->real_escape_string($post['type']),
				     $database->connection->real_escape_string($post["social_name"]),
				     $database->connection->real_escape_string($post["fantasy_name"]));
  
  if($database->stmt->execute()) {
    // This is not nice, we shuld do it using http.
    header('Location: ../layouts/companies.php');
  } else {
    printf("Ocorreu um erro na inclusão do registro.");
  }
}

function edit($id, $database) {
  echo("Oi $id");

}

function remove($id, $database){
 $database->stmt->prepare("DELETE FROM companies WHERE id = ?");
 $database->stmt->bind_param('i', $id);

 if($database->stmt->execute()){
   header('Location: ../layouts/goals.php');
 }else{
   printf("Ocorreu um erro na exclusão do registro.");
 }
}

function search($post, $database, $argv = false) {
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
  }else if($opt[0] == 'remove'){
    remove($opt[1], $database);
  }
}

if(array_key_exists('a', $_GET)) {
  select_action($_GET);
} else {
  select_action($_POST);
}
?>
