<?php

	include "../database.php";

	date_default_timezone_set("America/Sao_Paulo");

	if (isset($_POST["txt-abertura"]))
	{
		$abertura_str = $_POST["txt-abertura"];

		$fechamento_str = $_POST["txt-fechamento"];

		$time = strtotime($abertura_str);
		$abertura = date('d/m/Y',$time);

		$time = strtotime($fechamento_str);
		$fechamento = date('d/m/Y',$time);

		

		$data_atual = date("d/m/Y");

		/* $data_atual = date("Y/m/d"); */

		if ($abertura < $data_atual)
		{
			$data_erro = true;
		}
		else if($fechamento < $data_atual)
		{
			$data_erro = true;
		}

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
						Data de fechamento da rematricula
					</label>

					<input type="date" name="txt-fechamento" required="yes">
				</div>
				
				<div class="rematricula-button-div">
					<button type="submit">
						Enviar
					</button>
					<p>
						<?php
						
							if($abertura < $data_atual) 
							{
								echo "Escolha uma data de abertura válida";
							}
							else if($fechamento < $data_atual)
							{
								echo "Escolha uma data de fechamento válida";
							}
					
						?>
					</p>
				</div>
			</div>
		</form>
	</div>
</main>