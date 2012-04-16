<?php
  include('../controllers/goals.php');
?>
<!DOCTYPE html>
<html>

<head>
  <title>Jovem Pan - Cadastro de metas</title>
  <meta charset="UTF-8" />
</head>

<body>
  <h3>Cadastro de metas</h3>
  <table>
    <tr>
      <td width="300px">
        Valor(R$)
      </td>
      <td width="300px">
        Mês de referência
      </td>
      <td width="300px">
      </td>
      <td width="300px">
      </td>
    </tr>
    <?php
      foreach(select_action(NULL) as $register) {
    ?>
    <tr>
      <td>
	<?php
	  /*echo($register['goal_value']);*/
	  printf("%1\$.2f", $register['goal_value']);
	?>
      <td>
      <td>
        <?php
          echo($register['goal_maturity_date']);
        ?>
      </td>
      <td>
        <?php
          $encoded = encode('edit', $register['id']);
          echo("<a href=../controllers/goals.php?a=$encoded>Editar</a>");
        ?>
      </td>
      <td>
        <a href="../controllers.php">Excluir</a>
      </td>
    </tr>
    <?php } ?>
  </table>

  <p><a href="../index.php">Voltar</a></p>
  <p><a href="goals_form.php">Incluir novo</a></p>
</body>

</html>
