<?php
include("../controllers/contracts.php");
$months = array('01' => 'Janeiro', '02' => 'Fevereiro', '03' => 'Março', '04' => 'Abril',
  '05' => 'Maio', '06' => 'Junho', '07' => 'Julho', '08' => 'Agosto', '09' => 'Setembro',
  '10' => 'Outubro', '11' => 'Novembro', '12' => 'Dezembro');

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
  <title>Jovem Pan - Cadastro de contratos</title>
  <meta charset="UTF-8" />
</head>

<body>
  <h3>Cadastro de contrato</h3>
  <br />

  <form action="../controllers/employees.php" method="post">
    <?php /*
      if($edit) {
        echo("<input type='hidden' id='action' name='action' value='edit' />");
        echo("<input type='hidden' id='id' name='id' value='" . $records[0]['id'] . "' />");
      } else {
        echo("<input type='hidden' id='action' name='action' value='create' />");
      }*/
    ?>
    <table>

      <tr>
        <td>
          <label for="company_id">Entidade * :</label>
        </td>
        <td>
          <select id="company_id" name="company_id">
            <option value="">-- Selecione uma entidade --</option>
            <?php
              foreach(search('companies') as $company) {
                echo("<option value=" . $company['id'] .
                  ($records[0]['company_id'] == $company['id']  ? ' selected': '') . ">");
                echo($company['fantasy_name']);
                echo("</option>");
              }
            ?>
          </select>
        </td>
      </tr>

      <tr>
        <td>
          <label for="date">Data de venda * :</label>
        </td>
        <td>
          <select id="month" name="month">
            <option value="">-- Selecione o mês --</option>
            <?php
              foreach($months as $month_num => $month) {
                if($records[0]['month'] == $month_num) {
                  $selected = 'selected';
                }
                printf("<option value = %s %s>%s</option>", $month_num, $selected, $month);
              }
              echo("</select>&nbsp;&nbsp;");
              echo("<select id=\"year\" name=\"year\">");
              echo("<option value=\"\">-- Selecione o ano --</option>");
              foreach(range(2007, 2017) as $year) {
                if($records[0]['year'] == $year) {
                  $selected = 'selected';
                }
                printf("<option value = %s %s>%s</option>", $year, $selected, $year);
              }
              echo("</select>&nbsp;&nbsp;");
            ?>
        </td>
      </tr>

      <tr>
        <td>
          <label for="sell_auth_code">Autorização de venda * :</label>
        </td>
        <td>
          <?= "<input type='text' id='sell_auth_code' name='sell_auth_code' size='50'
            value='$records[0]' />"; ?>
        </td>
      </tr>


      <tr>
        <td colspan="2">Responsáveis</td>
      </tr>
      <tr>
        <td>
          <label for="employee_manager">Gerente corporativo * :</label>
        </td>
        <td>
          <select id="employee_manager" name="employee_manager">
            <option value="">-- Selecione um gerente --</option>
            <?php
              foreach(search('employees', array("position" => 0)) as $manager) {
                if($records[0]['employee_manager'] == $manager['id']) {
                  $selected = 'selected';
                }
                printf("<option value = %s %s> %s </option>", $manager['id'], $selected,
                  $manager['name']);
              }
            ?>
          </select>
        </td>
      </tr>

      <tr>
        <td>
          <label for="employee_manager">Gerente / supervisor :</label>
        </td>
        <td>
          <select id="employee_supervisor" name="employee_supervisor">
            <option value="">-- Selecione um gerente / supervisor --</option>
            <?php
              foreach(search('employees', array("position" => 1)) as $supervisor) {
                if($records[0]['employee_supervisor'] == $supervisor['id']) {
                  $selected = 'selected';
                }
                printf("<option value = %s %s> %s </option>", $supervisor['id'], $selected,
                  $supervisor['name']);
              }
            ?>
          </select>
        </td>
      </tr>

      <tr>
        <td>
          <label for="employee_seller">Executivo de vendas :</label>
        </td>
        <td>
          <select id="employee_seller" name="employee_seller">
            <option value="">-- Selecione um executivo de vendas --</option>
            <?php
              foreach(search('employees', array("position" => 2)) as $seller) {
                if($records[0]['employee_supervisor'] == $seller['id']) {
                  $selected = 'selected';
                }
                printf("<option value = %s %s> %s </option>", $seller['id'], $selected,
                  $seller['name']);
              }
            ?>
          </select>
        </td>
      </tr>


      <tr>
        <td colspan="2">Venda</td>
      </tr>
      <tr>
        <td>
          <label for="sell_type">Tipo de venda :</label>
        </td>
        <td>
          <select id="sell_type" name="sell_type">
            <option value="">-- Selecione um tipo de venda --</option>
            <?php
              foreach(search('sell_types') as $sell_type) {
                if($records[0]['sell_type_code'] == $sell_type['id']) {
                  $selected = 'selected';
                }
                printf("<option value = %s %s> %s </option>", $sell_type['id'], $selected,
                  $sell_type['code']);
              }
            ?>
          </select>
        </td>
      </tr>

      <tr>
        <td>
          <label for="sell_total_value">Valor total da venda :</label>
        </td>
        <td>
          <?= "<input type='text' id='sell_total_value' name='sell_total_value' size='10'
            value='$records[0]' />"; ?>
        </td>
      </tr>

      <tr>
        <td>
          <label for="sell_discount_percentage">Percentual de desconto :</label>
        </td>
        <td>
          <?= "<input type='text' id='sell_discount_percentage' name='sell_discount_percentage'
            size='10' value='$records[0]' />"; ?>
        </td>
      </tr>

      <tr>
        <td>
          <label for="sell_liquid_value">Valor liquido:</label>
        </td>
        <td>
          <?= "<input type='text' id='sell_liquid_value' name='sell_liquid_value' size='10'
            value='$records[0]' />"; ?>
        </td>
      </tr>

      <tr>
        <td>
          <label for="sell_invoice_total">Valor total (parcelas) :</label>
        </td>
        <td>
          <?= "<input type='text' id='sell_invoice_total' name='sell_invoice_total' size='10'
            value='$records[0]' />"; ?>
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
