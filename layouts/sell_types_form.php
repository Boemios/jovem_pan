<?php
include("../controllers/sell_types.php");

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
  <title>Jovem Pan - Cadastro de tipos de venda</title>
  <meta charset="UTF-8" />
</head>

<body>
  <h3>Cadastro de tipos de venda</h3>
  <br />

  <form action="../controllers/sell_types.php" method="post">
    <?php
      if($edit) {
        echo("<input type='hidden' id='action' name='action' value='edit' />");
        echo("<input type='hidden' id='id' name='id' value='" . $records['id'] . "' />");
      } else {
        echo("<input type='hidden' id='action' name='action' value='create' />");
      }
    ?>
    <table>
       <tr>
        <td>
          <label for="type">Código * :</label>
        </td>
        <td>
          <?php
            if($edit)
              echo("<input type='text' id='code' name='code' size='50'
                value='" . $records['code'] . "' />");
            else
              echo('<input type="text" id="code" name="code" size="50" />');
          ?>
        </td>
      </tr>
      <tr>
        <td>
	  <label for="social_name">Descrição :</label>
        </td>
        <td>
          <?php
            if($edit) {
              echo("<textarea id='description' name='description' rows='5' cols='80'>");
              echo($records['description']);
	      echo("</textarea>");
            } else {
              echo("<textarea id='description' name='description' rows='5' cols='80'>");
	      echo("</textarea>");
            }
          ?>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <input type="submit" value="Salvar" />
        </td>
      </tr>
    </table>
  </form>

  <p><a href="sell_types.php">Voltar</a></p>
</body>

</html>
