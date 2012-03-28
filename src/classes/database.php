<?php

define('DB_DATABASE', 'JovemPan');
define('DB_USER', 'root');
define('DB_PASS', 'mab01@061089');
define('DB_SERVER', 'localhost');

class Database{
	public function __construct(){
		$connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die('Oops connection error ->' .
					    mysql_error());
		mysql_select_db(DB_DATABASE, $connection)
		or die('Database error ->' . mysql_error());
	}
}
