<?php
/*********************************************************************************************
 * This file is a PHP script, don't try to run it on the browser, I really don't know what   *
 * can happen, i didn't test it on these situations. This should be runned on command-line   *
 * using php-cli which you can find on http://www.php-cli.com/. It works on Linux and others *
 * OS. Please, remember to modify the attributes to match your database confirguration.      *
 * Currently this script only works with mysql, ans probably it'll never support others.     *
 *********************************************************************************************/

include("database.php");

class CreateTables {

  public $db;          // Database instance.
  public $conn;        // Connection to the database, catch from db instance.
  public $stmt;        // Query API to use in complex queries over the database.

  /* Class contructor, ir just instantiate database class and defines an STDIN if it is not   *
   * alerady defined. It does not receive any parameter, and returns nothing. The method is   *
   * used to trigger other methods that will help user to manage database creations and       *
   * deletions.                                                                               */
  function __construct() {
    $this->db   = new Database("localhost", "root", "", "jovempan");
    $this->conn = $this->db->connection;
    $this->stmt = $this->conn->stmt_init();

    if(!defined("STDIN")) {
      define("STDIN", fopen('php://stdin', 'r'));
    }

    if($_SERVER["argc"] == 3) {
      if($_SERVER["argv"][1] == "create") {
        $this->create($_SERVER["argv"][2]);
      }
    }
  }

  /* This method is responsable for creation and reacreation of all tables. It recieves a     *
   * table name as a parameter and it first: verify if the table already through              *
   * verify_table_existance method, which whom returns a true to create if it's ok to create  *
   * the table if it already exists, or not ok and then, nothing happens.(Explanation about   *
   * the logic involved in verify_table_existance, see comentary on it.) Create has no        *
   * return, intead generates comprehensive information about the procces of creating tables. */
  private function create($table) {
    if($this->verify_table_existance($table)) {
      $method = sprintf("query_for_%s", $table);
      $query = $this->$method();

      if($this->conn->query($query) === TRUE)
        printf("Tabela %s (re)criada com sucesso!\n", $table);
      else
        die("Erro na criação da tabela " . $table . ".\n" . $this->conn->error . "\n");

    } else {
      printf("Table %s não foi modificada.\n", $table);
    }
  }

  /* This method is responsible for drop tables. It recieves a table name as a parameter and  *
   * try to drop it. If the task was successfully, it returns true, if it wasn't, it kill the *
   * script and generate comprehensive information about what was wrong.                      */
  private function drop($table) {
    $query = sprintf("DROP TABLE %s;", $table);
    if($this->conn->query($query) === TRUE)
      return 1;
    else
      die("Erro na exclusão da tabela " . $table . ".\n" . $this->conn->error . "\n");
  }

  /* This method verifies if a table exists or no. It seraches for a table name like the      *
   * parameter passed to it on SHOW TABLE sql command, and, if the serach returns 1, which    *
   * means that the table exists, it will prompt the user about overwrite the existent table  *
   * or not. After the user choose the option, verify_table_existance will drop the table and *
   * return true or just return false. Otherwise, if the serach for the table return 0, the   *
   * method will return true, so crete will be able to... create (Oh really?).                */
  private function verify_table_existance($t_name){
    $query = sprintf("SHOW TABLES FROM %s LIKE '%s';", $this->db->database, $t_name);
    $result = $this->conn->query($query);

    if($result->num_rows == 0) {
      return 1;
    } else {
      printf("A tabela %s já existe, deseja sobrescreve-la? (s para sim /n para não): ", $t_name);
      $overwrite = fread(STDIN, 1);

      if($overwrite == 's' && $this->drop($t_name)) {
        return 1;
      } else {
        return 0;
      }
    }
  }

  /* All the methods bellow has only one function, create a SQL string to be processed by     *
   * create, so here you will find all the sql structures of the tables. All teh methods have *
   * the table name that it describes as a suffix, preceded by "query_for_". It all does not  *
   * have any parameter, and all returns a string as query to bem processed.                  */

  private function query_for_employee() {
    $query = "CREATE TABLE employee (id INT NOT NULL AUTO_INCREMENT,";
    $query .= " name VARCHAR(128) NOT NULL, position VARCHAR(128) NOT NULL,";
    $query .= " PRIMARY KEY(id));";

    return $query;
  }

}

$create_tables = new CreateTables();

?>
