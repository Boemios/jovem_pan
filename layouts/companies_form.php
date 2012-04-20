<?php
include("../controllers/companies.php");

if(array_key_exists('a', $_GET)) {
  $args = decode($_GET['a']);
  if($args[0] == 'edit') {
    $records = recover_to_edit($args[1]);
    $edit = 1;
  } else {
    $edit = 0;
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Jovem Pan - Cadastro de entidades</title>
  <meta charset="UTF-8" />
</head>

<body>
  <h3>Cadastro de entidades</h3>
  <br />

  <form action="../controllers/companies.php" method="post">
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
          <label for="type">Tipo * :</label>
        </td>
        <td>
          <select id="type" name="type">
            <option value="">-- Selecione um tipo --</option>
            <option value="0"<?= ($records['position'] == 0 ? ' selected': '')?>>
              Cliente
            </option>
            <option value="1"<?= ($records['position'] == 1 ? ' selected': '')?>>
              Agência
            </option>
            <option value="2"<?= ($records['position'] == 2 ? ' selected': '')?>>
              Ambos
            </option>
          </select>
        </td>
      </tr>
      <tr>
        <td>
	  <label for="social_name">Razão Social * :</label>
        </td>
        <td>
	  <input type="text" id="social_name" name="social_name" />
        </td>
      </tr>
     <tr>
        <td>
	  <label for="fantasy_name">Nome fantasia * :</label>
        </td>
        <td>
	  <input type="text" id="fantasy_name" name="fantasy_name" />
        </td>
      </tr>

      <tr>
        <td colspan="2">
          <input type="submit" value="Salvar" />
        </td>
      </tr>
    </table>
  </form>

  <p><a href="companies.php">Voltar</a></p>
</body>

</html>
