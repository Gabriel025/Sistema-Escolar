<?php 
  $db_server = "localhost";
  $db_user = "root";
  $db_pass = "usbw";
  $db_name = "db_sistema_academico";
  $conn = "";

  try {
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
  }
  catch(mysqli_sql_exception) {
    echo "Erro na Conexão <br>";
  }
?>