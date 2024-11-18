<?php
  // Conectando ao banco de dados
  include "database.php"; 

  // Uma vaŕiavel que vai se tornar true, caso o usuário tente inserir informações inválidas
  $erro = false;

  // Caso o campo que contenha a informação "txt-usuario" não estiver vazio (ou seja: o usuário pressionou o botão logar).
  if(isset($_POST ["txt-usuario"]) != '') {

    // Declarando varíaveis e atribuindo o valor do que o usuário digitou no form.
    $usuario = $_POST ["txt-usuario"];
    $senha = $_POST ["txt-senha"];

    /* Essa variável agora tem o valor de uma query no mysql.
    Especificamente ela traz linhas onde o usuario e a senha são iguais aos digitados pelo usuário */
    $sql = "SELECT * FROM tb_usuarios WHERE usuario = '$usuario' AND senha = '$senha'";

    // $result está fazendo uma query no mysql, valor1 = banco de dados; valor2 = a query em si.
    $result = mysqli_query($conn, $sql);

    // Se tiver um usuário e senha compativeis com o que foi digitado.
    if(mysqli_num_rows($result) > 0) {
      // $row pega as colunas associadas com o que foi ganho em $result.
      $row = mysqli_fetch_assoc($result);

      // Iniciando uma sessão local para salvar dados temporariamente.
      session_start();

      // Marcando temporariamente o nome do usuário que está logando.
      $_SESSION['usuario-login'] = $usuario;

      // salvando a divisão(cargo) do usuário que está logando
      $divisao = $row["divisao"];
      
      // myqsli_close == fecha a conexão com o banco de dados.
      // header Location == Vai pra essa outra página.
      
      mysqli_close($conn);
      header("Location: {$divisao}/{$divisao}.php");
    }

    // Caso contrário significa que o usuário/senha estavam errados.
    else {
      $erro = true;
    }
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <!-- Estilos -->
  <link rel="stylesheet" href="styles/normalize.css">
  <link rel="stylesheet" href="styles/login.css">

  <!-- Fontes -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

</head>
<body class="body-login">
  <main class="main-login">
    <div class="div-logo">
      <img src="imagens/logo-alt.png" alt="Logo">
    </div>
    <form name="form-login" method ="post" class="form-login">
      <label>Usuário</label>
      <?php
          /* Caso falso, a borda do input vai ter a cor padrão */
          if($erro == false) {
            echo '<input type="text" name="txt-usuario" value="" size="35" maxlength="30" required="yes">';
          }
          /* Caso verdadeiro, o input ganhará uma classe, que faz sua borda ficar vermelha */
          else {
            echo '<input type="text" name="txt-usuario" value="" size="35" maxlength="30" required="yes" class="input-erro">';
          }
      ?>
  
      <label>Senha</label>
      <?php 
          if($erro == false) {
            echo '<input type="password" name="txt-senha" value="" maxlength="30" required="yes">';
          }
          else {
            echo '<input type="password" name="txt-senha" value="" maxlength="30" required="yes" class="input-erro">';
          }
      ?>

      <!-- Aqui é necessário criar uma div para definir um espaço pro texto
      Sem essa div, o texto iria apareçer e mudar a posição do botão.
      Basicamente ela significa: "Ei, está vazio no momento, mas esse espaço está reservado." -->
      <div class="div-erro">
        <?php 
          if($erro == true) {
            echo "<p> Informações Inválidas </p>";
          }
        ?>
      </div>

      <div class="button-login">
        <input type="submit" value="Entrar">
      </div>
    </form>
  </main>
</body>
</html>