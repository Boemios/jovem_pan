<?php
include_once 'classes/user.php';
require_once("phpgrid/conf.php");
	
	$dg = new C_DataGrid("SELECT * FROM USUARIOS", "cod", "USUARIOS");

	$dg->set_col_hidden("pass");
	$dg->set_col_hidden("col_cod");
	$dg->set_col_hidden("cod_col");
	$dg->set_col_hidden("cod");

	$dg->set_col_title("Usuário", "nome");

	$dg->set_caption("Usuários do sistema");

	$sdg = new C_DataGrid("SELECT col_nom, col_car FROM cad_col", "col_cad", "cad_col");

	$dg->set_subgrid($sdg, "cod_col");			

	$dg->display();
?>
