<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lançar Atividades</title>

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

        <div class="clip-area-div">
          <div class="clip-div">
            <i class="fa-solid fa-paperclip"></i>
          </div>

          <div class="turma-select-div">
            <p>
              Turma
            </p>

            <select name="txt-turma">
              <option value="A1">A1</option>
              <option value="B2">B2</option>
              <option value="C3">C3</option>
              <option value="D4">D4</option>
            </select>
          </div>
          
        </div>
        
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
          <input type="submit" value="Enviar">
        </div>
      </form>
    </div>
  </main>
</html>