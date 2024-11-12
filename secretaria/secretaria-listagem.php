<?php
  include "../database.php";

  if(isset($_POST['search-user']) != '') 
  {
    $sql = "SELECT * FROM tb_usuarios WHERE usuario LIKE '{$_POST['search-user']}%' ORDER BY usuario ASC";
    $result = mysqli_query($conn, $sql);
  } 
  else 
  {
    $sql = "SELECT * FROM tb_usuarios ORDER BY nome ASC";
    $result = mysqli_query($conn, $sql);
  }



?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Administrar Usuários</title>

  <!-- Estilos -->
  <link rel="stylesheet" href="styles/listagem.css">
</head>
<main>
  <div class="search-div">
    <form name="search-form" method="POST">
      <input type="text" name="search-user" placeholder="Pesquisar" value="<?php echo $_POST['search-user'] ?>">
      <input type="submit" value="" class="search-button">
    </form>
    <i class="fa-solid fa-magnifying-glass"></i>
  </div>

  <div class="card-div">
    <?php
      if(mysqli_num_rows($result) > 0)
      {
        while($row = mysqli_fetch_assoc($result))
        {
          if ($row["divisao"] == "aluno")
          {
            $funcao_sql = "SELECT * FROM tb_aluno WHERE usuario = '{$row["usuario"]}'"; // Seleciona o usuario correto da tabela aluno
            $funcao_result = mysqli_query($conn, $funcao_sql);
            $funcao_row = mysqli_fetch_assoc($funcao_result);
            $string = "Turma: {$funcao_row["turma"]}";
          }
          else if ($row["divisao"] == "professor")
          {
            $funcao_sql = "SELECT * FROM tb_professor WHERE usuario = '{$row["usuario"]}'"; // Seleciona o usuario correto da tabela aluno
            $funcao_result = mysqli_query($conn, $funcao_sql);
            $funcao_row = mysqli_fetch_assoc($funcao_result);
            $string = "Especialização: {$funcao_row["especializacao"]}";
          }
          else 
          {
            $funcao_sql = "SELECT * FROM tb_secretaria WHERE usuario = '{$row["usuario"]}'"; // Seleciona o usuario correto da tabela aluno
            $funcao_result = mysqli_query($conn, $funcao_sql);
            $funcao_row = mysqli_fetch_assoc($funcao_result);
            $string = "Cargo: {$funcao_row["cargo"]}";
          }
          echo "
            <div class='user-card'>
              <div class='card-avatar'>
                <img src='../imagens/perfil_vazio.png' alt='Foto de Perfil'>
              </div>

              <div class='card-info'>
                <p class='card-name'>
                  {$row["nome"]}
                </p>

                <p class='card-name'>
                  @{$row["usuario"]}
                </p>

                <p>
                  {$string}
                </p>
              </div>
            </div>
          ";
        }
      }
    ?>

  </div>
</main>