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
        Data de referência
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
	  printf("%1\$.2f", $register['value']);
	?>
      </td>
      <td>
        <?php
          echo(date_format(date_create_from_format('Y-m-d', $register['valid_date']), 'd/m/Y'));
        ?>
      </td>
      <td>
        <?php
          $encoded = encode($register['id']);
          echo("<a href=goals_form.php?edit=$encoded>Editar</a>");
        ?>
      </td>
      <td>
	<?php
	  $encoded = encode($register['id']);
          echo("<a href=../controllers/goals.php?delete=$encoded>Excluir</a>");
        ?>
      </td>
    </tr>
    <?php } } ?>
  </table>

  <p><a href="../index.php">Voltar</a></p>
  <p><a href="goals_form.php">Incluir novo</a></p>
</body>

</html>
