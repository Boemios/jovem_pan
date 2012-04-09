<?php
/*********************************************************************************************
 * This file is a PHP script, don't try to run it on the browser, I really don't know what   *
 * can happen, i didn't test it on these situations. This should be runned on command-line   *
 * using php-cli which you can find on http://www.php-cli.com/. It works on Linux and others *
 * OS. Please, remember to modify the attributes to match your database confirguration.      *
 * Currently this script only works with mysql, ans probably it'll never support others.     *
 *********************************************************************************************/

include("database.php");
require_once("conf.php");

class CreateTables {
  public  $db;          // Database instance.
  public  $conn;        // Connection to the database, catch from db instance.
  private $tables;      // Array that will hold all tables names.

  /* Class contructor, ir just instantiate database class and defines an STDIN if it is not   *
   * alerady defined. It does not receive any parameter, and returns nothing. The method is   *
   * used to trigger other methods that will help user to manage database creations and       *
   * deletions.                                                                               */
  function __construct() {
    $this->db     = new Database(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, "jovempan");
    $this->conn   = $this->db->connection;
    $this->tables = array('employees', 'companies', 'sell_types', 'selles', 'contracts',
                          'contracts_employees');

    if(!defined("STDIN")) {
      define("STDIN", fopen('php://stdin', 'r'));
    }

    if($_SERVER["argc"] == 3) {

      if($_SERVER["argv"][1] == "create") {
        if($_SERVER["argv"][2] == 'all') {
          foreach($this->tables as $t) {
            $this->create($t);
          }
        } else {
          $this->create($_SERVER["argv"][2]);
        }
      } else if($_SERVER["argv"][1] == "remove") {
        if($_SERVER["argv"][2] == 'all') {
          foreach($this->tables as $t) {
            $this->drop($t);
          }
        } else {
          $this->drop($_SERVER["argv"][2]);
        }
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
    if($this->conn->query($query) === TRUE) {
      printf("Tabela %s removida com sucesso!\n", $table);
      return 1;
    } else {
      die("Erro na exclusão da tabela " . $table . ".\n" . $this->conn->error . "\n");
    }
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

  private function query_for_employees() {
    $query = "CREATE TABLE employees (id INT NOT NULL AUTO_INCREMENT,";
    $query .= " name VARCHAR(128) NOT NULL, position INT NOT NULL,";
    $query .= " PRIMARY KEY(id));";

    return $query;
  }

  private function query_for_companies() {
    $query = "CREATE TABLE companies (id INT NOT NULL AUTO_INCREMENT,";
    $query .= "type INT NOT NULL, social_name VARCHAR(128) NOT NULL,";
    $query .= "fantasy_name VARCHAR(128) NOT NULL, PRIMARY KEY(id))";

    return $query;
  }

  private function query_for_sell_types() {
    $query = "CREATE TABLE sell_types (id INT NOT NULL AUTO_INCREMENT,";
    $query .= "code VARCHAR(32) NOT NULL, description TINYTEXT NULL, PRIMARY KEY(id))";

    return $query;
  }

  private function query_for_selles() {
    $query = "create table selles (id INT NOT NULL AUTO_INCREMENT,";
    $query .= " sell_type_id INT NOT NULL, discount_percentage DECIMAL(10, 4) NULL,";
    $query .= " liquid_value DECIMAL(10, 4) NULL, invoice_total DECIMAL(10, 4) NULL,";
    $query .= " PRIMARY KEY(id), FOREIGN KEY(sell_type_id) REFERENCES sell_types(id) ON";
    $query .= " UPDATE CASCADE ON DELETE SET NULL);";

    return $query;
  }

  private function query_for_contracts() {
    $query = "create table contracts (id INT NOT NULL AUTO_INCREMENT,";
    $query .= " company_id INT NOT NULL, date DATE NOT NULL,";
    $query .= " contract_code VARCHAR(32) NOT NULL, sell_auth_code VARCHAR(32) NOT NULL,";
    $query .= " PRIMARY KEY(id), FOREIGN KEY(company_id) REFERENCES companies(id) ON";
    $query .= " UPDATE CASCADE ON DELETE RESTRICT);";

    return $query;
  }

  private function query_for_contracts_employees() {
    $query = "create table contracts_employees (id INT NOT NULL AUTO_INCREMENT,";
    $query .= " contract_id INT NOT NULL, employee_id INT NOT NULL,";
    $query .= " PRIMARY KEY(id), FOREIGN KEY(contract_id) REFERENCES contracts(id) ON";
    $query .= " UPDATE CASCADE ON DELETE RESTRICT, FOREIGN KEY(employee_id) REFERENCES";
    $query .= " employees(id) ON UPDATE CASCADE ON DELETE RESTRICT);";

    return $query;
  }
}

$create_tables = new CreateTables();

?>
