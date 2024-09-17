<?php

include 'conexao.php';

$error = false;

if(isset($_POST ["txt-usuario"]) != '') {
  $usuario = $_POST ["txt-usuario"];
  $senha = $_POST ["txt-senha"];

  $sql = mysql_query("SELECT * FROM tb_usuarios WHERE usuario = '$usuario' AND senha = '$senha'");

	if (mysql_num_rows($sql) > 0) {
    header("Location: alunos/aluno.html");
    exit();
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
      <input type="text" name="txt-usuario" value="" size="35" maxlength="30" required="yes">
  
      <label>Senha</label>
      <input type="password" name="txt-senha" value="" size="35" maxlength="30" required="yes">

      <div class="div-error">
        <?php 
          if($error == true) {
            echo "<p> Usuário Inválido </p>";
          }
        ?>
      </div>

      <div class="button">
        <input type="submit" value="Entrar" onclick="document.form1.action='conexao.php'">
      </div>
    </form>
    <center><a href="">Esqueçeu a senha?</a></center>
  </main>
</body>
</html>