<?php
$host = 'localhost';  // Alterar para o host do seu banco
$user = 'root';       // Alterar para o usuário do seu banco
$pass = '';           // Alterar para a senha do seu banco
$dbname = 'sistema_login';  // Alterar para o nome do seu banco de dados


$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}
?>