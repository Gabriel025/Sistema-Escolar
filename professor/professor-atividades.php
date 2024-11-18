<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <!-- Estilos -->
  <link rel="stylesheet" href="styles/professor-atividades.css">

</head>
  <main class="body-login">
    <div class="main-login">
    <div class="div-logo">
      <img src="../imagens/logo-alt.png" alt="Logo">
    </div>
      <form  class="form-login">
        <label>Título</label>
        <input type="text"  value="" size="35" maxlength="30" required="yes">
            
    
        <label>Descrição</label>
        <input type="password"  value="" maxlength="30" required="yes">

        <!-- FAZER O SELECT DA TURMA Q A ATIVIDADE VAI SER ENVIADA -->

        <i class="fa-solid fa-paperclip"></i>

        <div class="data-div">
          <div>
            <p>Data de Abertura</p>
            <input type="date">
          </div>
          <div>
            <p>Data de Fechamento</p>
            <input type="date">
          </div>
        </div>

        <div class="button-login">
          <input type="submit" value="Entrar">
        </div>
      </form>
    </div>
  </main>
</html>