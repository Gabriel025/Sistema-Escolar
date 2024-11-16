<?php
  include "../database.php";

  // Iniciando uma sessão local para salvar dados temporariamente.
  session_start();

  // Atribuindo $usuario_logado o valor que foi inserido no login.
  $usuario_logado = $_SESSION['usuario-login'];

  // Se o usuário pressionar o botão de filtro
  if(isset($_POST['filter_button']) != '') 
  {
    // Caso o valor "filtro" que está salvo na sessão seja igual a "usuario"
    if ($_SESSION['filter'] == "usuario")
    {
      $_SESSION['filter'] = "nome";
      // Variável filtro para não ter que digitar um nome tão grande
      $filtro = $_SESSION['filter'];
    }
    else
    {
      $_SESSION['filter'] = "usuario";
      $filtro = $_SESSION['filter'];
    }  
  }
  // Caso o botão de filtro não for pressionado
  else {
    // Se o valor de filtro salvo na sessão não for nome. [Caso seja nome significa que o usuário já pressionou o botão de filtro antes]
    if ($_SESSION['filter'] != "nome")
    {
      // Esse if so acontece 1 vez, que é quando o usuário abre essa pagina pela primeira vez
      $_SESSION['filter'] = "usuario"; // Salva na sessão o filtro padrão "usuario"
    }
    $filtro = $_SESSION['filter'];
  }

  // Caso o usuário pressione o botão de pesquisar, e ele não esteja vazio
  if(isset($_POST['search-user']) != '') 
  {
    // Query sql para procrurar na tabela usuários, baseado no filtro selecionado
    $sql = "SELECT * FROM tb_usuarios WHERE $filtro LIKE '{$_POST['search-user']}%' ORDER BY $filtro ASC";
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
      $sql = "SELECT * FROM tb_usuarios ORDER BY $filtro ASC";
      $result = mysqli_query($conn, $sql);
    }
    // Caso a variável de sessão "search-query" não estiver vazia, isso significa que o filtro foi pressionado, porém ainda tem informação na barra de pesquisa.
    else
    {
      // Mostra todos os usuários/nomes que começam com o que foi digitado na barra de pesquisa
      $sql = "SELECT * FROM tb_usuarios WHERE $filtro LIKE '{$_SESSION['search-query']}%' ORDER BY $filtro ASC";
      $result = mysqli_query($conn, $sql);
    }
  }

  if (isset($_GET['painel'])) {
    $painel = $_GET['painel'];
  }
  else {
    $painel = $usuario_logado;
  }

  if (isset($_GET['delete'])) {

    $sql = "DELETE FROM tb_aluno WHERE usuario = '{$_GET['delete']}'";
    /* $sql = "SELECT * FROM tb_usuarios WHERE usuario = '{$_GET['delete']}'"; */
    mysqli_query($conn, $sql);

    $sql = "DELETE FROM tb_professor WHERE usuario = '{$_GET['delete']}'";
    mysqli_query($conn, $sql);

    $sql = "DELETE FROM tb_secretaria WHERE usuario = '{$_GET['delete']}'";
    mysqli_query($conn, $sql);
    
    $sql = "DELETE FROM tb_usuarios WHERE usuario = '{$_GET['delete']}'";
    mysqli_query($conn, $sql);

    if ($painel == $_GET['delete']) // Caso o usuário no painel for o mesmo que estamos excluíndo
    {
      header("Location: secretaria.php?pagina=secretaria-listagem"); // Volta o painel para o padrão (o usuário que está logado).
    }
    else
    {
      header("Location: secretaria.php?pagina=secretaria-listagem&painel={$painel}");
    }

  }


?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Administrar Usuários</title>

  <!-- Estilos -->
  <link rel="stylesheet" href="styles/listagem.css">
  <link rel="stylesheet" href="../styles/normalize.css">
</head>
<main>

  <div class="search-div">
    <div class="search-bar">
      <form name="search-form" method="POST">
        <div class="search-icon">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="submit" value="">
        </div>

        <div class="search-input">
          <input type="text" name="search-user" placeholder="Pesquisar" value="<?php echo $_SESSION['search-query'] // Serve para não apagar o que o usuário digita ?>">
        </div>
      </form>
    </div>

    <div class="search-buttons">
      <form class="filter-form" method="POST">
        <div class="input-icon-div">
          <p>
            <?php echo "{$filtro}"; ?>
          </p>
          <i class="fa-solid fa-filter"></i>
          <input type="submit" name="filter_button" value=".">  
        </div>
      </form>
    </div>
  </div>

  <div class="main-div">
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
                <a href='secretaria.php?pagina=secretaria-listagem&painel={$row["usuario"]}'>
                <div class='left-part'>
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
                </a>

                <div class='right-part'>
                  <i class='fa-solid fa-pen-to-square'></i>
                  <a href='secretaria.php?pagina=secretaria-listagem&painel={$painel}&delete={$row["usuario"]}'>
                    <i class='fa-solid fa-trash'></i>
                  </a>
                </div>
              </div>
             
            ";
          }
        }
      ?>
    </div>

    <div class="card-desc-div">
      <div class="card-panel-div">

        <div class="desc-avatar">
          <img src='../imagens/perfil_vazio.png' alt='Foto de Perfil'>
        </div>

        <div class="desc-text">
          <div>
            <?php
              $usuario = $painel;

              $painel_sql = "SELECT * FROM tb_usuarios WHERE usuario LIKE '{$usuario}'";
              $painel_result = mysqli_query($conn, $painel_sql);

              if(mysqli_num_rows($painel_result) > 0)
              {
                while($painel_row = mysqli_fetch_assoc($painel_result))
                {
                  $nome = $painel_row["nome"];
                  $divisao = $painel_row["divisao"];
                  $senha = $painel_row["senha"];

                  if ($painel_row["divisao"] == "aluno")
                  {
                    $painel_funcao_sql = "SELECT * FROM tb_aluno WHERE usuario = '{$usuario}'"; // Seleciona o usuario correto da tabela aluno
                    $painel_funcao_result = mysqli_query($conn, $painel_funcao_sql);
                    $painel_funcao_row = mysqli_fetch_assoc($painel_funcao_result);
                    $painel_string = "Turma: {$painel_funcao_row["turma"]}";
                  }
                  else if ($painel_row["divisao"] == "professor")
                  {
                    $painel_funcao_sql = "SELECT * FROM tb_professor WHERE usuario = '{$usuario}'"; // Seleciona o usuario correto da tabela aluno
                    $painel_funcao_result = mysqli_query($conn, $painel_funcao_sql);
                    $painel_funcao_row = mysqli_fetch_assoc($painel_funcao_result);
                    $painel_string = "Especialização: {$painel_funcao_row["especializacao"]}";
                  }
                  else 
                  {
                    $painel_funcao_sql = "SELECT * FROM tb_secretaria WHERE usuario = '{$usuario}'"; // Seleciona o usuario correto da tabela aluno
                    $painel_funcao_result = mysqli_query($conn, $painel_funcao_sql);
                    $painel_funcao_row = mysqli_fetch_assoc($painel_funcao_result);
                    $painel_string = "Cargo: {$painel_funcao_row["cargo"]}";
                  }
                }
              }

            ?>
            <p>
              <?php echo "{$nome}" ?>
            </p>
            <p>
              <span>@<?php echo "$usuario"?></span>
            </p>
          </div>
          
          <div>
            <p>
              <?php echo "$divisao"?>
            </p>
            <p>
              <span><?php echo "$painel_string"?></span>
            </p>
          </div>

          <div>
            <p>
              Senha
            </p>

            <p>
              <span><?php echo "$senha"?></span>
            </p>
          </div>
        </div>

        <div class="panel-icons">
          <i class="fa-solid fa-pen-to-square"></i>
          <a href="secretaria.php?pagina=secretaria-listagem&painel=<?php echo "{$painel}";?>&delete=<?php echo "{$painel}";?>">
            <i class="fa-solid fa-trash"></i>
          </a>
        </div>

      </div>
    </div>
  </div>
</main>