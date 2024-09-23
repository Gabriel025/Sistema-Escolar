<?php  
  // Conectando com o banco de dados.
  $mysqli = new mysqli("localhost","root","","sistema_academico");

  // Iniciando uma sessão para pegar o valor do úsuario que está sendo afetado.
  session_start();
  $usuario = $_SESSION['usuario-nome'];

  $usuario = $_SESSION['usuario-valor'];

  if(isset($_POST ["txt-turma"]) != '') {
    $turma = $_POST ["txt-turma"];
    $mysqli -> query("UPDATE tb_aluno SET turma = '$turma' WHERE usuario = '$usuario';");
    header("Location: cadastro.php");
    exit();
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
    <div class="content">
      <div class="div-logo">
        <img src="../imagens/logo.png" alt="Logo" class="logo">
      </div>
      <p class="turma-titulo">
        Escolha a turma desse aluno:
      </p>
      <form name="form_turma" method="post">
        <div class="grid">
          <button name="txt-turma" type="submit" value="a1" class="button-a1">A1</button>
          <button name="txt-turma" type="submit" value="b2" class="button-b2">B2</button>
        
          <button name="txt-turma" type="submit" value="c3" class="button-c3">C3</button>
          <button name="txt-turma" type="submit" value="d4" class="button-d4">D4</button>
        </div>
      </form>
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
  
        <li class="side-item">
          <a href="listagem.php">
            <i class="fa-solid fa-magnifying-glass"></i>
            <span class="item-description">
              Listagem Usuários
            </span>
          </a>
        </li>
  
        <li class="side-item active">
          <a href="#">
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