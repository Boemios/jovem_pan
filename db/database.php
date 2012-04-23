<?php
/**********************************************************************************************
 * Class developed by Allam Marcos Campanini Matsubara, under MIT license, on March 29, 2012. *
 * Any doubt please send an email to allam.matsubara at gmail.com. This is a free software,   *
 * you can distribute, modify, sell or do whatever you want, but please, keep this header and *
 * the author name unchanged.                                                                 *
 **********************************************************************************************/
class Database {

  public  $connection;   // Variable that holds the connection with database, is a Mysqli object.
  public  $database;     // Database name
  public  $stmt;         // Mysqli Stmt instance, used to construct and execute queries.
  private $host;         // Host name (e.g. 'localhost', 'db.domain.example', ...).
  private $user;         // User name of database (e.g. 'root').
  private $password;     // Password of the user in the database.
  private $query;        // Query to be executed by database class
  
  /* Constructor for Database class. Set the variables class values and tries to start a      *
   * connection qith the database, based on the recently setted values. It receives as        *
   * parameters the host, user, password and database name to connect. Returns nothing.       */
  function __construct($host, $user, $password, $database) {
    $this->host     = $host;
    $this->user     = $user;
    $this->password = $password;
    $this->database = $database;

    if($this->check_database_existance()) {
      $this->connection = $this->connect();
    } else {
      die("It was not possible to connect to the database. Check log file to more information.");
    }
    $this->stmt = $this->connection->stmt_init();
  }

  /* Class destructor. Just close the database connection. it has no parameters and returns   *
   * nothing.                                                                                 */
  function __destruct(){
    $this->connection->close();
  }

  /* Function that realizes the databse connection, using the class variables setted on class *
   * construction. If any errors occur, ir display the message and return NULL value to the   *
   * connection, if the connection succed, it'll return the connection object. There are no   *
   * parameters for this function.                                                            */
  private function connect() {
    $connection = new mysqli($this->host, $this->user, $this->password, $this->database);
    return $connection;

    if($connection->connect_error){
      printf("Databse connection failed: %s\n", $connection->conect_error);
      return NULL;
    }
  }

  /* Method to check the database existance. It will run a mysql code to search in the schmas *
   * if the database name is there. It'll return true if database exists, false otherwise.    */
  private function check_database_existance() {
    $connect = mysql_connect($this->host, $this->user, $this->password);
    $query = sprintf("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME='%s';",
      $this->database);
    $result = mysql_query($query);

    if(mysql_affected_rows($connect)) {
      mysql_close($connect);
      return TRUE;
    } else{
      if($this->create_database($connect)){
        mysql_close($connect);
        return TRUE;
      }

      mysql_close($connect);
      return FALSE;
    }
  }

  /* Method that receives the connection created on check_database_existance, and, if         *
   * check_database_existance finds that $this->database does not exist yet, it'll call this. *
   * This method receives a connection as a parameter and returns true or false, depending on *
   * the query to database creation result.                                                   */
  private function create_database($connection) {
    $result = mysql_query("CREATE DATABASE " . $this->database . ";", $connection);

    return($result);
  }
  
  /* Method that create and execute queries by receiving a value mapping and the type of
   * requested query. Returns the result set of requested query */
  public function execute_query($type, $mapping){
    $query = prepare_query($type, $mapping);

  }

  private function create_query($type, $mapping, $pkfield){
    switch($type){
      case 'I':
        $sql = "INSERT INTO <table> VALUES <value>";
        break;
      case 'S':
        $sql = "SELECT <fields> FROM <table> <search>";
        break;
      case 'D':
        $sql = "DELETE FROM <table> WHERE <pkfield> = <value>";
        break;
      default:
        die("Query type not specified or a wrong value has been specified");
    }
    
    $sql = mapping_interpreter($mapping, $sql, $pkfield);
  
  }

  private function mapping_interpreter($mapping, $sql, $pkfield){
   $sql = str_replace("<pkfield>", $pkfield, $sql);
   foreach ($mapping as $key => $value){
    switch ($key){
      case 'TABLE':
        $sql = str_replace("<table>", $value, $sql);
        break;
      case 'FIELD':
        break;
      case 'PK':
        $sql = str_replace("<pkfield>", $value, $sql);
        break;
    }
   }
  }
}

?>
