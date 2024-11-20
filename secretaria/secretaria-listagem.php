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
    $search = "SELECT * FROM tb_usuarios WHERE $filter LIKE '{$_POST['search-user']}%' ORDER BY $filter ASC";
    $search_result = mysqli_query($conn, $search);

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
      $search = "SELECT * FROM tb_usuarios ORDER BY $filter ASC";
      $search_result = mysqli_query($conn, $search);
    }
    // Caso a variável de sessão "search-query" não estiver vazia, isso significa que o filtro foi pressionado, porém ainda tem informação na barra de pesquisa.
    else
    {
      // Mostra todos os usuários/nomes que começam com o que foi digitado na barra de pesquisa
      $search = "SELECT * FROM tb_usuarios WHERE $filter LIKE '{$_SESSION['search-query']}%' ORDER BY $filter ASC";
      $search_result = mysqli_query($conn, $search);
    }
  }

  if (isset($_GET['create']) == "new_user")
  {
    $create_shard = $_GET['create'];
  }
  else if (isset($_GET['create_turma']) == "turma")
  {
    $create_turma = $_GET['create_turma'];
  }

  if(isset($_POST ["txt-usuario"]) != '') 
  {
    // Declarando Variáveis.
    $usuario = $_POST ["txt-usuario"];
    $senha = $_POST ["txt-senha"];
    $nome = $_POST ["txt-nome"];
    $divisao = $_POST ["txt-divisao"];
    
    $sql = "SELECT * FROM tb_usuarios WHERE usuario = '$usuario'";
    $result = mysqli_query($conn, $sql);

    if ("$usuario" == "$senha")
    {
        $usuario_error = true;
    }

    if (mysqli_num_rows($result) > 0) 
    {  
        $error = true;
    }
    else 
    {
        if ($divisao == "aluno" && $error == false && $usuario_error == false) {

          $_SESSION['usuario-valor'] = $usuario;
          $_SESSION['senha-valor'] = $senha;
          $_SESSION['divisao-valor'] = $divisao;
          $_SESSION['nome-valor'] = $nome;

          header("Location: secretaria.php?pagina=secretaria-listagem&create_turma=turma");
        }
        else if($divisao == "professor" && $error == false && $usuario_error == false) {
          $sql = ("INSERT INTO tb_usuarios VALUES ('$usuario','$senha','$divisao', '$nome')");
          mysqli_query($conn, $sql);

          $sql = ("INSERT INTO tb_professor VALUES ('$usuario', NULL)");
          mysqli_query($conn, $sql);

          header("Location: secretaria.php?pagina=secretaria-listagem");
        }
        else if($divisao == "secretaria" && $error == false && $usuario_error == false) {
          $sql = ("INSERT INTO tb_usuarios VALUES ('$usuario','$senha','$divisao', '$nome')");
          mysqli_query($conn, $sql);

          $sql = ("INSERT INTO tb_secretaria VALUES ('$usuario', NULL)");
          mysqli_query($conn, $sql);

          header("Location: secretaria.php?pagina=secretaria-listagem");
        }
    }
  }

  if (isset($_POST['txt-turma'])) 
  {
    $usuario_antigo = $_SESSION['usuario_antigo'];

    $usuario = $_SESSION['usuario-valor'];
    $senha = $_SESSION['senha-valor'];
    $divisao = $_SESSION['divisao-valor'];
    $nome = $_SESSION['nome-valor'];

    $turma = $_POST['txt-turma'];

    if ($_SESSION['editar-valor'] == $usuario_antigo && $_SESSION['usuario_antigo'] != '') // Editando Usuário Já existente
    {

      if ($_SESSION['divisao_antigo'] == "secretaria")
      {
        $sql = ("DELETE FROM tb_secretaria WHERE usuario = '$usuario_antigo'");
        mysqli_query($conn, $sql);
      }
      else if ($_SESSION['divisao_antigo'] == "professor")
      {
        $sql = ("DELETE FROM tb_professor WHERE usuario = '$usuario_antigo'");
        mysqli_query($conn, $sql);
      }
      else
      {
        $sql = ("DELETE FROM tb_aluno WHERE usuario = '$usuario_antigo'");
        mysqli_query($conn, $sql);
      }

      $sql = ("UPDATE tb_usuarios SET usuario = '$usuario', senha = '$senha', divisao = '$divisao', nome = '$nome' WHERE usuario = '$usuario_antigo'");
      mysqli_query($conn, $sql);

      $sql = ("INSERT INTO tb_aluno VALUES ('$usuario', '$turma')");
      mysqli_query($conn, $sql);
    }
    else
    {
      $sql = ("INSERT INTO tb_usuarios VALUES ('$usuario','$senha','$divisao', '$nome')"); // Criando novo Aluno
      mysqli_query($conn, $sql);

      $sql = ("INSERT INTO tb_aluno VALUES ('$usuario','$turma')");
      mysqli_query($conn, $sql);
    }

    if($_SESSION['shard-card'] == $usuario_antigo)
    {
      $_SESSION['shard-card'] = $usuario;
    }

        

    $_SESSION['usuario_antigo'] = '';

    header("Location: secretaria.php?pagina=secretaria-listagem&shard_card={$_SESSION['shard-card']}");
  }

  if (isset($_GET['edit']))
  {
    $edit_shard = $_GET['edit'];
  }

  if(isset($_POST ["new-usuario"]) != '') 
  {
    $usuario_antigo = $_SESSION['usuario_antigo'];

    $divisao_antigo = $_SESSION['divisao_antigo'];

    // Declarando Variáveis.
    $usuario = $_POST ["new-usuario"];
    $senha = $_POST ["new-senha"];
    $nome = $_POST ["new-nome"];
    $divisao = $_POST ["new-divisao"];
    
    $sql = "SELECT * FROM tb_usuarios WHERE usuario = '$usuario'";
    $result = mysqli_query($conn, $sql);

    if ("$usuario" == "$senha") 
    {
        $usuario_error = true;
    }

    if (mysqli_num_rows($result) > 0) 
    {
      while ($row = mysqli_fetch_assoc($result))
      {
        $check = $row["usuario"];
      }
      if ($usuario_antigo != $check)
      {
        $error = true;
      }
    }

      if ($divisao == "aluno" && $error == false && $usuario_error == false) 
      {
        $_SESSION['usuario-valor'] = $usuario;
        $_SESSION['senha-valor'] = $senha;
        $_SESSION['divisao-valor'] = $divisao;
        $_SESSION['nome-valor'] = $nome;

        $_SESSION['editar-valor'] = $usuario_antigo;

        header("Location: secretaria.php?pagina=secretaria-listagem&create_turma=turma");
      }
      else if ($divisao == "professor" && $error == false && $usuario_error == false) 
      {

        if ($_SESSION['divisao_antigo'] == "secretaria")
        {
          $sql = ("DELETE FROM tb_secretaria WHERE usuario = '$usuario_antigo'");
          mysqli_query($conn, $sql);
        }
        else if ($_SESSION['divisao_antigo'] == "professor")
        {
          $sql = ("DELETE FROM tb_professor WHERE usuario = '$usuario_antigo'");
          mysqli_query($conn, $sql);
        }
        else
        {
          $sql = ("DELETE FROM tb_aluno WHERE usuario = '$usuario_antigo'");
          mysqli_query($conn, $sql);
        }


        $sql = ("UPDATE tb_usuarios SET usuario = '$usuario', senha = '$senha', divisao = '$divisao', nome = '$nome' WHERE usuario = '$usuario_antigo'");
        mysqli_query($conn, $sql);

        $sql = ("INSERT INTO tb_professor VALUES ('$usuario', NULL)");
        mysqli_query($conn, $sql);

        if($_SESSION['shard-card'] == $usuario_antigo)
        {
          $_SESSION['shard-card'] = $usuario;
        }

        header("Location: secretaria.php?pagina=secretaria-listagem&shard_card={$_SESSION['shard-card']}");
      }
      else if ($divisao == "secretaria" && $error == false && $usuario_error == false)
      {
        if ($_SESSION['divisao_antigo'] == "secretaria")
        {
          $sql = ("DELETE FROM tb_secretaria WHERE usuario = '$usuario_antigo'");
          mysqli_query($conn, $sql);
        }
        else if ($_SESSION['divisao_antigo'] == "professor")
        {
          $sql = ("DELETE FROM tb_professor WHERE usuario = '$usuario_antigo'");
          mysqli_query($conn, $sql);
        }
        else
        {
          $sql = ("DELETE FROM tb_aluno WHERE usuario = '$usuario_antigo'");
          mysqli_query($conn, $sql);
        }

        $sql = ("UPDATE tb_usuarios SET usuario = '$usuario', senha = '$senha', divisao = '$divisao', nome = '$nome' WHERE usuario = '$usuario_antigo'");
        mysqli_query($conn, $sql);

        $sql = ("INSERT INTO tb_secretaria VALUES ('$usuario', NULL)");
        mysqli_query($conn, $sql);
        

        if($_SESSION['shard-card'] == $usuario_antigo)
        {
          $_SESSION['shard-card'] = $usuario;
        }

        header("Location: secretaria.php?pagina=secretaria-listagem&shard_card={$_SESSION['shard-card']}");
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

    if ($_SESSION['shard-card'] == $_GET['delete_shard']) // Caso o usuário no card for o mesmo que estamos excluíndo
    {
      $_SESSION['shard-card'] = '';
      header("Location: secretaria.php?pagina=secretaria-listagem"); // Volta o card para o padrão (O primeiro na lista).
    }
    else
    {
      header("Location: secretaria.php?pagina=secretaria-listagem&shard_card={$_SESSION['shard-card']}");
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
            <?php if ($create_shard): ?>
                $('#createModal').modal('show');
            <?php endif; ?>
        });

        $(document).ready(function() {
            <?php if ($create_turma): ?>
                $('#turmaModal').modal('show');
            <?php endif; ?>
        });

        $(document).ready(function() {
            <?php if ($edit_shard): ?>
                $('#editModal').modal('show');
            <?php endif; ?>
        });

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
          <a href='secretaria.php?pagina=secretaria-listagem&create=new_user'>
            <i class="fa-solid fa-user-plus"></i>
          </a>
        </div>
      </div>
    </div>

    <div class="bottomside-div">
      <div class="shard-div">
        <?php
          if (mysqli_num_rows($search_result) > 0)
          {
            while ($row = mysqli_fetch_assoc($search_result))
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

              if (isset($_GET['shard_card']) != '') {
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
                    <a href='secretaria.php?pagina=secretaria-listagem&shard_card={$shard_card}&edit={$row["usuario"]}'>
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
            <a href='secretaria.php?pagina=secretaria-listagem&shard_card=<?php echo "$card_usuario"; ?>&edit=<?php echo "{$card_usuario}"; ?>'>
              <i class='fa-solid fa-pen-to-square'></i>
            </a>
            <a href='secretaria.php?pagina=secretaria-listagem&shard_card=<?php echo "$card_usuario"; ?>&delete=<?php echo "{$card_usuario}"; ?>'>
              <i class='fa-solid fa-trash'></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- POP UPS DA PAGINA -->

  <!-- Pop Up Criar Usuário -->
  <div class="modal" id="createModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Novo Usuário</h4>
          <a href="secretaria.php?pagina=secretaria-listagem&shard_card=<?php echo "{$card_usuario}"; ?>" class="btn-close" ></a>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="logo-div">
              <img src="../imagens/logo-alt.png" alt="Logo">
            </div>
          <form method="POST">
            <div class="flex-div">
              <label> Nome Completo </label>
              <input type="text" name="txt-nome"  value="<?php echo "{$nome}"; ?>" maxlength="60" required="yes">
            </div>

            <div class="flex-div">
              <label> Usuário </label>
              <input type="text" name="txt-usuario"   value="<?php echo "{$usuario}"; ?>" maxlength="30" required="yes">
            </div>

            <div class="flex-div">
              <label> Senha </label>
              <input type="password" name="txt-senha"   value="<?php echo "{$senha}"; ?>" maxlength="30" required="yes">
            </div>

            <div class="flex-div">
              <label> Divisão </label>
              <select name="txt-divisao"  value="<?php echo "{$divisao}"; ?>">
                <option value="aluno">aluno</option>
                <option value="professor">professor</option>
                <option value="secretaria">secretaria</option>
              </select>
            </div>

            <div class="div-error">
              <?php 
                if($error == true) {
                  echo "<p> Esse usuário já existe </p>";
                }
                else if($usuario_error == true) {
                  echo "<p> O usuário e a senha não podem ser iguais </p>";
                }
              ?>
            </div>

            <input type="submit" value="Confirmar" class="btn btn-success">
          </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <a href="secretaria.php?pagina=secretaria-listagem&shard_card=<?php echo "{$card_usuario}"; ?>" class="btn btn-danger">Sair</a>
        </div>

      </div>
    </div>
  </div>

  <!-- Pop Up Escolha de Turma -->
  <div class="modal" id="turmaModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Selecione Uma Turma <?php echo "{$usuario}"; ?></h4>
          <a href="secretaria.php?pagina=secretaria-listagem&shard_card=<?php echo "{$card_usuario}"; ?>" class="btn-close" ></a>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="logo-div">
              <img src="../imagens/logo-alt.png" alt="Logo">
            </div>
          <form method="POST" name="form_turma" class="form-turma">
            <div class="turma-grid">
              <input type="submit" name="txt-turma" value="A1">
              <input type="submit" name="txt-turma" value="B2">
              <input type="submit" name="txt-turma" value="C3">
              <input type="submit" name="txt-turma" value="D4">
            </div>
          </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <a href="secretaria.php?pagina=secretaria-listagem&shard_card=<?php echo "{$card_usuario}"; ?>" class="btn btn-danger">Sair</a>
        </div>

      </div>
    </div>
  </div>

  <!-- Pop Up Editar Usuário -->
  <div class="modal" id="editModal">
    <div class="modal-dialog">
      <div class="modal-content">

      <?php
        $sql = "SELECT * FROM tb_usuarios WHERE usuario = '{$_GET["edit"]}'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0)
          {
            while ($row = mysqli_fetch_assoc($result))
            {
              $usuario = $row["usuario"];
              $senha = $row["senha"];
              $divisao = $row["divisao"];
              $nome = $row["nome"];
            }

            $_SESSION['usuario_antigo'] = $usuario;
            $_SESSION['divisao_antigo'] = $divisao;
          }
           
      ?>

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Editar Usuário</h4>
          
          <a href="secretaria.php?pagina=secretaria-listagem&shard_card=<?php echo "{$card_usuario}"; ?>" class="btn-close" ></a>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="logo-div">
              <img src="../imagens/logo-alt.png" alt="Logo">
            </div>
          <form method="POST">
            <div class="flex-div">
              <label> Nome Completo </label>
              <input type="text" name="new-nome"  value="<?php echo "{$nome}"; ?>" maxlength="60" required="yes">
            </div>

            <div class="flex-div">
              <label> Usuário </label>
              <input type="text" name="new-usuario"   value="<?php echo "{$usuario}"; ?>" maxlength="30" required="yes">
            </div>

            <div class="flex-div">
              <label> Senha </label>
              <input type="password" name="new-senha" value="<?php echo "{$senha}"; ?>" maxlength="30" required="yes">
            </div>

            <div class="flex-div">
              <label> Divisão </label>
              <select name="new-divisao">
                <?php
                  if ($divisao == "aluno")
                  {
                    echo 
                    "
                      <option value='aluno'>Aluno</option>
                      <option value='professor'>Professor</option>
                      <option value='secretaria'>secretaria</option>
                    ";
                  }
                  else if ($divisao == "professor")
                  {
                    echo 
                    "
                      <option value='professor'>Professor</option>
                      <option value='aluno'>Aluno</option>
                      <option value='secretaria'>Secretaria</option>
                    ";
                  }
                  else
                  {
                    echo 
                    "
                      <option value='secretaria'>Secretaria</option>
                      <option value='professor'>Professor</option>
                      <option value='aluno'>Aluno</option>
                    ";
                  }            
                
                ?>
                
              </select>
            </div>

            <div class="div-error">
              <?php 
                if($error == true) {
                  echo "<p> Esse usuário já existe </p>";
                }
                else if($usuario_error == true) {
                  echo "<p> O usuário e a senha não podem ser iguais </p>";
                }
              ?>
            </div>

            <input type="submit" value="Confirmar" class="btn btn-success">
          </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <a href="secretaria.php?pagina=secretaria-listagem&shard_card=<?php echo "{$card_usuario}"; ?>" class="btn btn-danger">Sair</a>
        </div>

      </div>
    </div>
  </div>

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