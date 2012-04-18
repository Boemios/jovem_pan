<!DOCTYPE html>
<html>

<head>
  <title>Jovem Pan - Cadastro de metas</title>
  <meta charset="UTF-8" />

<script type="text/javascript">
    function clear(id) {
      document.getElementById(id).value="";
    }
  </script>

</head>

<body>
  <h3>Cadastro de metas</h3>
  <br />

  <form action="../controllers/goals.php" method="post">
    <input type="hidden" id="action" name="action" value="create" />
    <table>
      <tr>
        <td>
          <label for="value">Valor * :</label>
        </td>
        <td>
          <input type="text" id="value" name="value" size="50" />
        </td>
      </tr>
      <tr>
        <td>
          <label for="valid_date">Data de vigência * :</label>
        </td>
	<td>
          <input type="text" name="valid_date" size="50" />
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
