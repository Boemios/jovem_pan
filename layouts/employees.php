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
      <td width="400px">
        Nome
      </td>
      <td width="400px">
        Cargo
      </td>
    </tr>
    <?php
      foreach(select_action() as $register) {
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
    </tr>
    <?php } ?>
  </table>

  <p><a href="../index.php">Voltar</a></p>
  <p><a href="employees_form.php">Incluir novo</a></p>
</body>

</html>
