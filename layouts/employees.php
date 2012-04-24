<?php
include('../controllers/employees.php');
?>
<!DOCTYPE html>
<html>

<head>
  <title>Jovem Pan - Cadastro de colaborador</title>
  <meta charset="UTF-8" />
</head>

<body>
  <h3>Colaborador</h3>
  <table>
    <tr>
      <td width="300px">
        Nome
      </td>
      <td width="300px">
        Cargo
      </td>
      <td width="300px">
      </td>
      <td width="300px">
      </td>
    </tr>
    <?php
      if(sizeof(select_action(NULL)) == 0) {
        echo("<tr><td colspan=4>Nenhum registro encontrado.</td></tr>");
      } else {
        foreach(select_action(NULL) as $register) {
    ?>
    <tr>
      <td>
        <?php
          echo($register['name']);
        ?>
      </td>
      <td>
        <?php
          echo(code_to_position($register['position']));
        ?>
      </td>
      <td>
        <?php
          $encoded = encode($register['id']);
          echo("<a href=employees_form.php?edit=$encoded>Editar</a>");
        ?>
      </td>
      <td>
	<?php
	  $encoded = encode($register['id']);
          echo("<a href=../controllers/employees.php?delete=$encoded>Excluir</a>");
        ?>
      </td>
    </tr>
    <?php } } ?>
  </table>

  <p><a href="../index.php">Voltar</a></p>
  <p><a href="employees_form.php">Incluir novo</a></p>
</body>

</html>
