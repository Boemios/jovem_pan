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
  <h3>Cadastor de metas</h3>
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
