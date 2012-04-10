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
    <input type="hidden" id="action" name="action" value="create" />
    <table>
      <tr>
        <td>
          <label for="name">Nome * :</label>
        </td>
        <td>
          <input type="text" id="name" name="name" size="50" />
        </td>
      </tr>
      <tr>
        <td>
          <label for="position">Cargo * :</label>
        </td>
        <td>
          <select id="position" name="position">
            <option value="">-- Selecione um cargo --</option>
            <option value="0">Gerente Corporativo</option>
            <option value="1">Gerente / Supervisor Comercial</option>
            <option value="2">Executivo de vendas</option>
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
