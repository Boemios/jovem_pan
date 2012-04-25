<?php
  include('../controllers/companies.php');
?>
<!DOCTYPE html>
<html>

<head>
  <title>Jovem Pan - Cadastro de entidades</title>
  <meta charset="UTF-8" />
</head>

<body>
  <h3>Cadastro de entidades</h3>
  <table>
    <tr>
      <td width="200px">
        Tipo
      </td>
      <td width="200px">
        Razão social
      </td>
      <td width="200px">
	Nome fantasia
      </td>

      <td width="200px">
      </td>
      <td width="200px">
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
	  echo(code_to_kind($register['type']));
	?>
      </td>
      <td>
        <?php
          echo($register['social_name']);
        ?>
      </td>
      <td>
        <?php
          echo($register['fantasy_name']);
        ?>
      </td>
      <td>
        <?php
          $encoded = encode($register['id']);
          echo("<a href=companies_form.php?edit=$encoded>Editar</a>");
        ?>
      </td>
      <td>
	<?php
	  $encoded = encode($register['id']);
          echo("<a href=../controllers/companies.php?delete=$encoded>Excluir</a>");
        ?>
      </td>
    </tr>
    <?php } } ?>
  </table>

  <p><a href="../index.php">Voltar</a></p>
  <p><a href="companies_form.php">Incluir novo</a></p>
</body>

</html>
