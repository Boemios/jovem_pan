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
          <label for="date">Data de vigência * :</label>
        </td>
	<td>
	  <input type="text" id="date" name="date" size="50" />
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
