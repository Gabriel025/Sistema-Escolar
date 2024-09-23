<?php  
  // Conectando com o banco de dados.
  $mysqli = new mysqli("localhost","root","","sistema_academico");

  // Iniciando uma sessão, para salvar temporariamente o ultimo úsuario (aluno) criado, possibilitando editar a coluna turma dele..
  session_start();
  $usuario = $_SESSION['usuario-nome'];

  $usuario_editar = $_SESSION['usuario-editar'];

  $error = false;
  $usuario_error = false;

  if(isset($_POST ["txt-usuario"]) != '') {
    // Declarando Variáveis.
    $usuario = $_POST ["txt-usuario"];
    $senha = $_POST ["txt-senha"];
    $nome = $_POST ["txt-nome"];
    $divisao = $_POST ["txt-divisao"];
    
    $sql = $mysqli -> query("SELECT * FROM tb_usuarios WHERE usuario = '$usuario'");

    if ("$usuario" == "$senha") {
        $usuario_error = true;
    }

    if (mysqli_num_rows($sql) > 0) {  
        $error = true;
    }
    else {
      if ($divisao == "aluno" && $error == false && $usuario_error == false) {
        $_SESSION['usuario-valor'] = $usuario;
        $sql = $mysqli -> query("delete from tb_usuarios where usuario=". $_SESSION['usuario-editar']);
        $mysqli -> query ("INSERT INTO tb_usuarios VALUES ('$usuario','$senha','$divisao')");
        $mysqli -> query ("INSERT INTO tb_aluno VALUES ('$usuario','$nome','')");
        header("Location: cadastro-turma.php");
        exit();
      }
      else if($divisao == "professor" && $error == false && $usuario_error == false) {
        $sql = $mysqli -> query("delete from tb_usuarios where usuario=". $_SESSION['usuario-editar']);
        $mysqli -> query ("INSERT INTO tb_usuarios VALUES ('$usuario','$senha','$divisao')");
        $mysqli -> query ("INSERT INTO tb_professor VALUES ('$usuario','$nome','')");
      }
      else if($divisao == "secretaria" && $error == false && $usuario_error == false) {
        $sql = $mysqli -> query("delete from tb_usuarios where usuario=". $_SESSION['usuario-editar']);
        $mysqli -> query ("INSERT INTO tb_usuarios VALUES ('$usuario','$senha','$divisao')");
        $mysqli -> query ("INSERT INTO tb_secretaria VALUES ('$usuario','$nome','')");
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../estilos/style.css">
  <link rel="stylesheet" href="../estilos/cadastro.css">
  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
  <main>
    <div class="editar-content">
      <div class="div-logo">
        <img src="../imagens/logo.png" alt="Logo" class="logo">
      </div>
      <form name="form_cadastro" method="post">
        <label>Nome Completo</label>
        <input type="text" name="txt-nome" value="" size="35" maxlength="50" required="yes">

        <label>Usuário</label>
        <?php 
            if($error == false && $usuario_error == false) {
              echo '<input type="text" name="txt-usuario" value="" size="35" maxlength="30" required="yes">';
            }
            else {
              echo '<input type="text" name="txt-usuario" value="" size="35" maxlength="30" required="yes" class="input-erro">';
            }
        ?>
    
        <label>Senha</label>
        <?php 
            // Dependendo se houver um erro ou não, isso vai mudar a cor da borda do input.
            if($usuario_error == false) {
              echo '<input type="password" name="txt-senha" value="" size="35" maxlength="30" required="yes">';
            }
            else if($error == true) {
              echo '<input type="password" name="txt-senha" value="" size="35" maxlength="30" required="yes">';
            }
            else {
              echo '<input type="password" name="txt-senha" value="" size="35" maxlength="30" required="yes" class="input-erro">';
            }
        ?>

        <label>Função</label>
        <div class="div-select">
          <select name="txt-divisao">
            <option value="aluno">Aluno</option>
            <option value="professor">Professor</option>
            <option value="secretaria">Secretaria</option>
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

        <div class="button">
          <input type="submit" value="Editar">
        </div>
      </form>
      <center>
      <div class="button-cancelar">
        <a href="listagem.php"><button>Cancelar</button></a>
      </div>
      </center>
      
    </div>
  </main>
  <nav class="sidebar">
    <div class="sidebar-content">
      <div class="user">
        <img src="../imagens/perfil_vazio.png" class="user-avatar" alt="Avatar">
        
        <p class="user-infos">
          <span class="item-description">
            <?php
              echo "Usuário: {$usuario}";
            ?>
          </span>
        </p>
      </div>
  
      <ul class="side-items">
        <li class="side-item">
          <a href="secretaria-avisos.php" target="_parent">
            <i class="fa-solid fa-house"></i>
            <span class="item-description">
              Avisos
            </span>
          </a>
        </li>
  
        <li class="side-item">
          <a href="secretaria-periodo.php">
            <i class="fa-solid fa-calendar"></i>
            <span class="item-description">
              Período Letivo
            </span>
          </a>
        </li>
  
        <li class="side-item">
          <a href="secretaria-rematricula.php">
            <i class="fa-solid fa-school"></i>
            <span class="item-description">
              Rematrícula
            </span>
          </a>
        </li>
  
        <li class="side-item active">
          <a href="listagem.php">
            <i class="fa-solid fa-magnifying-glass"></i>
            <span class="item-description">
              Listagem Usuários
            </span>
          </a>
        </li>
  
        <li class="side-item">
          <a href="cadastro.php">
            <i class="fa-solid fa-user-plus"></i>
            <span class="item-description">
              Novo Usuário
            </span>
          </a>
        </li>
      </ul>
    </div>
    
    <div class="logout">
      <a href="../login.php" target="_parent">
      <button class="btn-logout">
        <i class="fa-solid fa-right-from-bracket"></i>
        Sair
      </button>
      </a>
    </div>
  </nav>
</body>
</html>