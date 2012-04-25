<?php
include("../controllers/goals.php");

if(isset($_GET['edit'])) {
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
  <title>Jovem Pan - Cadastro de metas</title>
  <meta charset="UTF-8" />
</head>

<body>
  <h3>Cadastro de metas</h3>
  <br />

  <form action="../controllers/goals.php" method="post">
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
          <label for="value">Valor * :</label>
        </td>
        <td>
          <?php
            if($edit)
              echo("<input type='text' id='value' name='value' size='50'
                value='" . str_replace(".", ",", $records[0]['value']) . "' />");
            else
              echo('<input type="text" id="value" name="value" size="50" />');
          ?>
        </td>
      </tr>
      <tr>
        <td>
          <label for="valid_date">Data de vigência * :</label>
        </td>
	<td>
          <?php
            if($edit)
              echo("<input type='text' id='valid_date' name='valid_date' size='50'
                value='" . format_date($records[0]['valid_date']) . "' />");
            else
              echo('<input type="text" id="valid_date" name="valid_date" size="50" />');
          ?>
      </tr>
      <tr>
        <td colspan="2">
          <input type="submit" value="Salvar" />
        </td>
      </tr>
    </table>
  </form>

  <p><a href="goals.php">Voltar</a></p>
</body>

</html>
