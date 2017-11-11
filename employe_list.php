<html lang="pt-br">
<head>
  <link rel="stylesheet" href="css/style.css">
  <title>Funcionários</title>
  <meta charset="UTF-8">
</head>
<body>
  <?php require 'header.php' ?>
  <div id="content">
      <div class="employe-table">
        <table>
          <thead>
            <td>Nome</td>
            <td>Sexo</td>
            <td>Cargo</td>
            <td>RG</td>
            <td>Logradouro</td>
            <td>Cidade</td>
            <td colspan="2">Ações</td>
          </thead>
          <tr>
            <td>Mateus Ferreira</td>
            <td>Masculino</td>
            <td>Clínico Geral</td>
            <td>12.345.678</td>
            <td>Av. Getúlio Vargas, 1023</td>
            <td>Uberlândia</td>
            <td><a href="employe_visualization.php?id=1">Editar</a></td>
            <td><a href="employe_delete.php?id=1">Excluir</a></td>
          </tr>
        </table>
      </div>
  </div>
</body>
</html>