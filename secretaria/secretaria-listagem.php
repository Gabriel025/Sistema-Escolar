<?php
  include "../database.php";

  // Iniciando uma sessão local para salvar dados temporariamente.
  session_start();

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
        <div class="inputIcon-div">
          <p>
            <?php echo "{$filtro}"; ?>
          </p>
          <i class="fa-solid fa-filter"></i>
          <input type="submit" name="filter_button" value=".">  
        </div>
      </form>
    </div>
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