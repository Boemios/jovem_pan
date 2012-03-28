<?php
include_once 'database.php';

class Employee{
	var $cod;
	var $name;
	var $funct;
	#Codigo da praca
	var $praca_cod;
	#codigo do mercado
	var $market_cod;

	public function __construct(){
		$db = new Database();	
	}

	public function insert(){
		$sql = 'INSERT INTO cad_col (col_nom, col_car, col_praca, col_mercado) VALUES ('$name','$funct','$praca_cod','$market_cod')';

		$result = mysql_query($sql) or die ("Erro ao inserir colaborador: " . mysql_error());

		return $result;
	}

	public static function select_all(){
		$sql = 'SELECT * FROM cad_col';

		$result = mysql_query($sql);

		if (!$result){
			return die("Error ao consultar base: " . mysql_error());
		}

		while ($row = mysql_fetch_array($result)){
			
		}
	}
}

?>
