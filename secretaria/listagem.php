<?php
// Conectando ao banco de dados
$mysqli = new mysqli("localhost","root","","sistema_academico");
session_start(); // Para salvar o nome do úsuario que está logando

$usuario = $_SESSION['usuario-nome'];

if(isset($_POST['busca_usuario']) != '') {
	$sql = $mysqli -> query("select * from tb_usuarios where usuario like  '{$_POST['busca_usuario']}%' order by usuario asc");
} else {
	$sql = $mysqli -> query("select * from tb_usuarios order by usuario asc");
}

if(isset($_GET['apagar'])){
	$sql = $mysqli -> query("delete from tb_usuarios where usuario=". $_GET['apagar']);
  header("Location: listagem.php");
  exit();
}

if(isset($_GET['editar'])){
  $_SESSION['usuario-editar'] = $_GET['editar']; 
  header("Location: editar-conta.php");
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
  <link rel="stylesheet" href="../estilos/listagem.css">
  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
  <main>
    <div class="content">
    <form method="post">
      <p class="p-class">
        Digite um usuário:
      </p>
      <input type="text" name="busca_usuario">
      <input type="submit" value="FILTRAR" class="input-button">
    </form>

    <div class="div-logo">
        <img src="../imagens/logo.png" alt="Logo" class="logo">
      </div>

    <table border="1">
    <tr>
				<th colspan="10e" class="titulo">Tabela de Usuários</th>
				</tr>
				<tr class="cor">
				<th class="coluna">Usuário</th>
				<th class="coluna">Senha</th>
				<th class="coluna">Divisão</th>
				<th class="coluna">Apagar</th>
				<th class="coluna">Editar</th>
				</tr>
				<tr class="cor">
          
        <?php
					while($linha = mysqli_fetch_assoc($sql)) {
				?>
				<td align="center"><?php echo $linha['usuario']; ?></td>
				<td align="center"><?php echo $linha['senha']; ?></td>
				<td align="center"><?php echo $linha['divisao']; ?></td>
        <th><a href="listagem.php?apagar='<?php echo $linha['usuario']; ?>'"><i class="fa-solid fa-trash"></i></a></th>
        <th><a href="listagem.php?editar='<?php echo $linha['usuario']; ?>'"><i class="fa-solid fa-pencil"></i></a></th>
        <tr class="cor">
							
				<?php  } 
				?>
	  </table>
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
          <a href="#">
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