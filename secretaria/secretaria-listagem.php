<?php
  include "../database.php";

  // Iniciando uma sessão local para salvar dados temporariamente.
  session_start();

  $sql = "SELECT * FROM tb_usuarios ORDER BY usuario ASC";
  $result = mysqli_query($conn, $sql);

  if(isset($_GET['filter']) != '') 
  {
    // Caso o valor "filtro" que está salvo na sessão seja igual a "usuario"
    if ($_SESSION['filter'] == "usuario")
    {
      $_SESSION['filter'] = "nome";
      // Variável filtro para não ter que digitar um nome tão grande
      $filter = $_SESSION['filter'];
      header("Location: secretaria.php?pagina=secretaria-listagem");
    }
    else
    {
      $_SESSION['filter'] = "usuario";
      $filter = $_SESSION['filter'];
      header("Location: secretaria.php?pagina=secretaria-listagem");
    }  
  }
  else 
  {
    // Se o valor de filtro salvo na sessão não for nome. [Caso seja nome significa que o usuário já pressionou o botão de filtro antes]
    if ($_SESSION['filter'] != "nome")
    {
      // Esse if so acontece 1 vez, que é quando o usuário abre essa pagina pela primeira vez
      $_SESSION['filter'] = "usuario"; // Salva na sessão o filtro padrão "usuario"
    }
    $filter = $_SESSION['filter'];
  }

  if(isset($_POST['search-user']) != '') 
  {
    // Query sql para procrurar na tabela usuários, baseado no filtro selecionado
    $sql = "SELECT * FROM tb_usuarios WHERE $filter LIKE '{$_POST['search-user']}%' ORDER BY $filter ASC";
    $result = mysqli_query($conn, $sql);

    // Salvando numa sessão local o que o usuário pesquisou.
    $_SESSION['search-query'] = $_POST['search-user'];
  }
  // Caso o botão de pesquisa não tiver sido pressionado (Isso pode acontecer de 2 formas: 1°: quando o usuário entra nessa página, 2°: quando ele pressione o filtro).
  else 
  {
    // Se a variável de sessão que salva o que o usuário pesquisa estiver vazia.
    if ($_SESSION['search-query'] == '')
    {
      // Por padrão mostra todos os usuários em ordem alfabética do filtro.
      $sql = "SELECT * FROM tb_usuarios ORDER BY $filter ASC";
      $result = mysqli_query($conn, $sql);
    }
    // Caso a variável de sessão "search-query" não estiver vazia, isso significa que o filtro foi pressionado, porém ainda tem informação na barra de pesquisa.
    else
    {
      // Mostra todos os usuários/nomes que começam com o que foi digitado na barra de pesquisa
      $sql = "SELECT * FROM tb_usuarios WHERE $filter LIKE '{$_SESSION['search-query']}%' ORDER BY $filter ASC";
      $result = mysqli_query($conn, $sql);
    }
  }

  if (isset($_GET['delete'])) 
  {
    $delete_shard = $_GET['delete'];
  }

  if (isset($_GET['delete_shard'])) 
  {
    $sql = "DELETE FROM tb_aluno WHERE usuario = '{$_GET['delete_shard']}'";
    /* $sql = "SELECT * FROM tb_usuarios WHERE usuario = '{$_GET['delete']}'"; */
    mysqli_query($conn, $sql);

    $sql = "DELETE FROM tb_professor WHERE usuario = '{$_GET['delete_shard']}'";
    mysqli_query($conn, $sql);

    $sql = "DELETE FROM tb_secretaria WHERE usuario = '{$_GET['delete_shard']}'";
    mysqli_query($conn, $sql);
    
    $sql = "DELETE FROM tb_usuarios WHERE usuario = '{$_GET['delete_shard']}'";
    mysqli_query($conn, $sql);

    $deleted_user = $_SESSION['card_usuario'];

    if ($deleted_user == $_GET['delete_shard']) // Caso o usuário no card for o mesmo que estamos excluíndo
    {
      header("Location: secretaria.php?pagina=secretaria-listagem"); // Volta o card para o padrão (O primeiro na lista).
    }
    else
    {
      header("Location: secretaria.php?pagina=secretaria-listagem&shard_card={$deleted_user}");
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrar Usuários</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="styles/listagem.css">

  <script>
        $(document).ready(function() {
            <?php if ($delete_shard): ?>
                $('#deleteModal').modal('show');
            <?php endif; ?>
        });
  </script>

</head>
<main>
  <div class="main-div">
    <div class="topside-div">
      <div class="search-div">
        <form method="POST">
          <div class="search-icon-div">
            <input type="submit" value="">
            <i class="fa-solid fa-magnifying-glass"></i>
          </div>

          <div class="search-input-div">
            <input type="text" name="search-user" placeholder="Pesquisar" value="<?php echo $_SESSION['search-query'] // Serve para não apagar o que o usuário digita ?>">
          </div>
        </form>
      </div>

      <div class="buttons-div">
        <div class="button-filter-div">
          <p><?php echo "{$filter}"?></p>
          <a href="secretaria.php?pagina=secretaria-listagem&filter=change">
            <i class="fa-solid fa-filter"></i>
          </a>
        </div>

        <div class="button-create-div">
          <p>Criar Usuário</p>
          <i class="fa-solid fa-user-plus"></i>
        </div>
      </div>
    </div>

    <div class="bottomside-div">
      <div class="shard-div">
        <?php
          if (mysqli_num_rows($result) > 0)
          {
            while ($row = mysqli_fetch_assoc($result))
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

              if (isset($_GET['shard_card'])) {
                $shard_card = $_GET['shard_card'];
                $_SESSION['shard-card'] = $shard_card;
              }
              else {
                if (!$shard_card)
                {
                  if ($_SESSION['shard-card'])
                  {
                    $shard_card = $_SESSION['shard-card'];
                  }
                  else
                  {
                    $shard_card = "{$row["usuario"]}";
                    $_SESSION['shard-card'] = $shard_card;
                  }
                }
              }
            
              echo "
                <div class='shard'>
                  <a href='secretaria.php?pagina=secretaria-listagem&shard_card={$row["usuario"]}'>
                    <div class='shard-link'>
                      <div class='shard-avatar'>
                        <img src='../imagens/perfil_vazio.png' alt='Avatar'>
                      </div>

                      <div class='shard-info'>
                        <div>
                          <p>{$row["nome"]}</p>
                          <p><span>@{$row["usuario"]}</span></p>
                        </div>
                          <p>{$string}</p>
                      </div>
                    </div>
                  </a>

                  <div class='shard-buttons'>
                    <a>
                      <i class='fa-solid fa-pen-to-square'></i>
                    </a>

                    <a href='secretaria.php?pagina=secretaria-listagem&shard_card={$shard_card}&delete={$row["usuario"]}'>
                      <i class='fa-solid fa-trash'></i>
                    </a>
                  </div>
                </div>
              ";
            }
          }
        ?>

      </div>

      <div class="shard-card-div">
        <div class="shard-card">
          <div class="shard-card-avatar">
            <img src='../imagens/perfil_vazio.png' alt='Avatar'>
          </div>

          <div class="shard-card-info">
            <?php
              $card_usuario = $shard_card;

              $_SESSION['card_usuario'] = $card_usuario;

              $sql = "SELECT * FROM tb_usuarios WHERE usuario LIKE '{$card_usuario}'";
              $result = mysqli_query($conn, $sql);

              if (mysqli_num_rows($result) > 0)
              {
                while($row = mysqli_fetch_assoc($result))
                {
                  $card_nome = $row["nome"];
                  $card_divisao = $row["divisao"];
                  $card_senha = $row["senha"];

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
                }
              }
            
            ?>
            <div>
              <p>
              <?php echo "{$card_nome}"; ?>
              </p>
              <p>
                <span>@<?php echo "{$card_usuario}"; ?></span>
              </p>
            </div>

            <div>
              <p>
              <?php echo "{$card_divisao}"; ?>
              </p>
              <p>
                <span><?php echo "{$string}"; ?></span>
              </p>
            </div>

            <div>
              <p>
                Senha
              </p>
              <p>
                <span><?php echo "{$card_senha}"; ?></span>
              </p>
            </div>
          </div>

          <div class="shard-card-buttons">
            <i class='fa-solid fa-pen-to-square'></i>
            <a href='secretaria.php?pagina=secretaria-listagem&shard_card=<?php echo "$card_usuario"; ?>&delete=<?php echo "{$card_usuario}"; ?>'>
              <i class='fa-solid fa-trash'></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- POP UPS DA PAGINA -->

    <!-- Pop Up Deletar -->
  <div class="modal" id="deleteModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Deletar <?php echo "{$delete_shard}"?>?</h4>
          <a href="secretaria.php?pagina=secretaria-listagem&shard_card=<?php echo "{$card_usuario}"; ?>" class="btn-close" ></a>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <p>
            Tem certeza que deseja deletar esse usuário?
          </p>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <a href="secretaria.php?pagina=secretaria-listagem&delete_shard=<?php echo "{$delete_shard}"; ?>" type="button" class="btn btn-success"> Confirmar</a>
          <a href="secretaria.php?pagina=secretaria-listagem&shard_card=<?php echo "{$card_usuario}"; ?>" class="btn btn-danger">Sair</a>
        </div>

      </div>
    </div>
  </div>
</main>
</html>