<?php
  include('../controllers/sell_types.php');
?>
<!DOCTYPE html>
<html>

<head>
  <title>Jovem Pan - Cadastro de tipos de vendas</title>
  <meta charset="UTF-8" />
</head>

<body>
  <h3>Tipos de venda</h3>
  <table>
    <tr>
      <td width="300px">
        Código
      </td>
      <td width="300px">
        Descrição
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
          echo($register['code']);
        ?>
      </td>
      <td>
        <?php
          echo($register['description']);
        ?>
      </td>
      <td>
        <?php
          $encoded = encode('edit', $register['id']);
          echo("<a href=sell_types_form.php?a=$encoded>Editar</a>");
        ?>
      </td>
      <td>
        <?php
          $encoded = encode('delete', $register['id']);
          echo("<a href=../controllers/sell_types.php?delete=$encoded>Excluir</a>");
        ?>
      </td>
    </tr>
    <?php } } ?>
  </table>

  <p><a href="../index.php">Voltar</a></p>
  <p><a href="sell_types_form.php">Incluir novo</a></p>
</body>

</html>
