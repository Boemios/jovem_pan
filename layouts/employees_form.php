<?php
include("../controllers/employees.php");

if($_GET['edit']) {
  $params['id'] = decode($_GET['edit']);
  $records = search($params);
  $edit = 1;
} else {
  $edit = 0;
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Jovem Pan - Cadastro de colaborador</title>
  <meta charset="UTF-8" />
</head>

<body>
  <h3>Cadastro de colaborador</h3>
  <br />

  <form action="../controllers/employees.php" method="post">
    <?php
      if($edit) {
        echo("<input type='hidden' id='action' name='action' value='edit' />");
        echo("<input type='hidden' id='id' name='id' value='" . $records[0]['id'] . "' />");
      } else {
        echo("<input type='hidden' id='action' name='action' value='create' />");
      }
    ?>
    <table>
      <tr>
        <td>
          <label for="name">Nome * :</label>
        </td>
        <td>
          <?php
            if($edit)
              echo("<input type='text' id='name' name='name' size='50'
                value='" . $records[0]['name'] . "' />");
            else
              echo('<input type="text" id="name" name="name" size="50" />');
          ?>
        </td>
      </tr>
      <tr>
        <td>
          <label for="position">Cargo * :</label>
        </td>
        <td>
          <select id="position" name="position">
            <option value="">-- Selecione um cargo --</option>
            <option value="0"<?= ($records[0]['position'] == 0 ? ' selected': '')?>>
              Gerente Corporativo
            </option>
            <option value="1"<?= ($records[0]['position'] == 1 ? ' selected': '')?>>
              Gerente / Supervisor Comercial
            </option>
            <option value="2"<?= ($records[0]['position'] == 2 ? ' selected': '')?>>
              Executivo de vendas
            </option>
          </select>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <input type="submit" value="Salvar" />
        </td>
      </tr>
    </table>
  </form>

  <p><a href="employees.php">Voltar</a></p>
</body>

</html>
