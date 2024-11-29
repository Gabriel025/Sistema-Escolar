<?php

	include "../database.php";

	date_default_timezone_set("America/Sao_Paulo");

	if (isset($_POST["txt-abertura"])) {
		$abertura_str = $_POST["txt-abertura"];
		$fechamento_str = $_POST["txt-fechamento"];
		$data_atual_str = date("Y-m-d");

		// Cria objetos DateTime a partir das strings de data
		$abertura = DateTime::createFromFormat('Y-m-d', $abertura_str);
		$fechamento = DateTime::createFromFormat('Y-m-d', $fechamento_str);
		$data_atual = DateTime::createFromFormat('Y-m-d', $data_atual_str);

		$data_erro = false;

		// Verifica se a data de abertura é menor que a data atual
		if ($abertura < $data_atual) {
			$data_erro = true;
		} 
		// Verifica se a data de fechamento é menor que a data atual
		else if ($fechamento < $data_atual) {
			$data_erro = true;
		} 
		// Verifica se a data de abertura é maior que a data de fechamento
		else if ($abertura > $fechamento) {
			$data_erro = true;
		}

		// Se não houver erro, atualiza os dados no banco de dados
		if (!$data_erro) {
			$sql = ("UPDATE tb_rematricula SET data_abertura = '$abertura_str', data_fechamento = '$fechamento_str'");
      		mysqli_query($conn, $sql);
		}
	}
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rematrícula</title>
  <link rel="stylesheet" href="styles/secretaria-rematricula.css">
</head>
<main>

	<div class="rematricula-div">
		<form method="POST">
			<div class="form-content">
				<div class="form-dates">
					<label>
						Data de início
					</label>
					<input type="date" name="txt-abertura" required="yes">

					<label>
						Data de fechamento da rematrícula
					</label>
					<input type="date" name="txt-fechamento" required="yes">
				</div>
				
				<div class="rematricula-button-div">
					<button type="submit">
						Enviar
					</button>
					<p>
						<?php
							if ($data_erro) {
								if ($abertura < $data_atual) {
									echo "Escolha uma data de abertura válida.";
								} else if ($fechamento < $abertura) {
									echo "Escolha uma data de fechamento válida.";
								}
							}
						?>
					</p>
				</div>
			</div>
		</form>
	</div>
</main>
