<?php
include_once 'database.php';

class User{
	public function __construct(){
		$db = new Database();
	}

	public function register_user($username, $colcod, $pass){
		$pass = md5($pass);

		$result = mysql_query("INSERT INTO USUARIOS(cod_col, pass, nome) VALUES ('$colcod','$pass','$username')") or die(mysql_error());

		return $result;
	}
}
