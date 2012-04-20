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
      <td width="300px">
        Tipo
      </td>
      <td width="300px">
        Razão social
      </td>
      <td width="300px">
	Nome fantasia
      </td>
    </tr>
    <?php
      foreach(select_action(NULL) as $register) {
    ?>
    <tr>
      <td>
	<?php
	  echo($register['type']);
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
          $encoded = encode('edit', $register['id']);
          echo("<a href=../controllers/companies.php?a=$encoded>Editar</a>");
        ?>
      </td>
      <td>
	<?php
	  $encoded = encode('delete', $register['id']);
          echo("<a href=../controllers/companies.php?a=$encoded>Excluir</a>");
        ?>
      </td>
    </tr>
    <?php } ?>
  </table>

  <p><a href="../index.php">Voltar</a></p>
  <p><a href="companies_form.php">Incluir novo</a></p>
</body>

</html>
