<?php

// Conectando ao banco de dados
$mysqli = new mysqli("localhost","root","","sistema_academico");
$error = false;

session_start(); // Para salvar o nome do úsuario que está logando

if(isset($_POST ["txt-usuario"]) != '') {
  $usuario = $_POST ["txt-usuario"];
  $senha = $_POST ["txt-senha"];

  $sql = $mysqli -> query("SELECT * FROM tb_usuarios WHERE usuario = '$usuario' AND senha = '$senha'");

  // Caso exista um úsuario e senha compatíveis com o que foi digitado no banco.
	if (mysqli_num_rows($sql) > 0) {
    // Caso exista um úsuario com uma divisão específica no banco.
    $aluno = $mysqli -> query("SELECT * FROM tb_usuarios WHERE usuario = '$usuario' AND divisao = 'aluno'");
    $professor = $mysqli -> query("SELECT * FROM tb_usuarios WHERE usuario = '$usuario' AND divisao = 'professor'");

    if(mysqli_num_rows($aluno) > 0) {
      $_SESSION['usuario-nome'] = $usuario; // Lembrando qual o úsuario que está logando, para mostrar seu nome mais a frente.
      header("Location: alunos/aluno-sidebar.html");
      exit();
    }
    else if(mysqli_num_rows($professor) > 0) {
      $_SESSION['usuario-nome'] = $usuario;
      header("Location: professores/professor-sidebar.html");
      exit();
    }
    else {
      $_SESSION['usuario-nome'] = $usuario;
      header("Location: secretaria/secretaria-sidebar.html");
      exit();
    }
  }

  else {
    $error = true;
  }
} 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="estilos/login.css">
</head>
<body>
  <main>
    <div class="div-logo">
      <img src="imagens/logo.png" alt="Logo" class="logo">
    </div>
    <form name="form-login" method ="post">
      <label>Usuário</label>
      <?php 
          if($error == false) {
            echo '<input type="text" name="txt-usuario" value="" size="35" maxlength="30" required="yes">';
          }
          else {
            echo '<input type="text" name="txt-usuario" value="" size="35" maxlength="30" required="yes" class="input-erro">';
          }
      ?>
  
      <label>Senha</label>
      <?php 
          if($error == false) {
            echo '<input type="password" name="txt-senha" value="" size="35" maxlength="30" required="yes">';
          }
          else {
            echo '<input type="password" name="txt-senha" value="" size="35" maxlength="30" required="yes" class="input-erro">';
          }
      ?>

      <div class="div-error">
        <?php 
          if($error == true) {
            echo "<p> Informações Inválidas </p>";
          }
        ?>
      </div>

      <div class="button">
        <input type="submit" value="Entrar">
      </div>
    </form>
    <center><a href="">Esqueçeu a senha?</a></center>
  </main>
</body>
</html>