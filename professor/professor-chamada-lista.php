<?php
  include "../database.php";

  date_default_timezone_set("America/Sao_Paulo");

  $turma_chamada = $_GET["turma"];

  $sql = "SELECT * FROM tb_usuarios ORDER BY nome ASC";
  $result = mysqli_query($conn, $sql);

  /* echo "Today is " . date("Y/m/d") . "<br>"; */

  $data_atual = date("d/m/Y");

?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chamada Online</title>
  <link rel="stylesheet" href="styles/professor-chamada-lista.css">
</head>
<main>
  <div class="main-content">
    <div class="topside-div">
      <div class="topside-content">
        <div class="chamada-botao">
          <a href="professor.php?pagina=professor-chamada">
            <i class="fa-solid fa-arrow-left"></i>
          </a>
        </div>

        <div class="chamada-titulo">
          <p><?php echo "Chamada | Data: {$data_atual}"; ?></p>
        </div>
      </div>
    </div>

    <div class="bottomside-div">
      <div class="table-div">
        <table>
          <tr>
            <th>Nome</th>
            <th class="td-input">Presente</th>
          </tr>

          <?php

            if (mysqli_num_rows($result) > 0)
            {
              while ($row = mysqli_fetch_assoc($result))
              {
                if ($row["divisao"] == "aluno")
                {
                  $aluno_sql = "SELECT * FROM tb_aluno WHERE usuario = '{$row["usuario"]}' AND turma = '{$turma_chamada}' "; // Seleciona o usuario correto da tabela aluno
                  $aluno_result = mysqli_query($conn, $aluno_sql);
                  $aluno_row = mysqli_fetch_assoc($aluno_result);

                  if ($aluno_row["usuario"] == $row["usuario"])
                  {
                    echo 
                    "
                      <tr>
                        <td class='td-nome'>{$row["nome"]}</td>
                        <td class='td-input'><input type='checkbox'/></td>
                      </tr>
                    ";
                  }
                }
              }
            }

          ?>   
     
        </table>

        <div class="button-div">
          <a href="professor.php?pagina=professor-chamada">
            <button>
              Enviar
            </button>
          </a>
        </div>
      </div>
    </div>
  </div>
</main>