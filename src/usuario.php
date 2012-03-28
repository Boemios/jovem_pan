<?php
include_once 'classes/user.php';
require_once("phpgrid/conf.php");

$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST" ){
	$register = $user->register_user($_POST['name'], 1, $_POST['pass']);

	if ($register){
		echo 'Usuário criado com sucesso;';
	}else{
		echo 'ERRO!';
	}
}
?>

<form method="POST" action="usuario.php" name="reg">
	Usuário
	<input type="text" name="name" />
	Password
	<input type="password" name="pass" />
	<input type="submit" value="Salvar" />
</form>

<?php
	$dg = new C_DataGrid("SELECT * FROM USUARIOS", "cod", "USUARIOS");

	$dg->display();
?>
