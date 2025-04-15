<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica se já está logado, caso contrário, exibe o formulário de login
if (isset($_SESSION['username'])) {
    header("Location: home.php");  // Redireciona se já estiver logado
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('conexao.php');  // Inclua a conexão com o banco de dados

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $senha = $_POST['senha'];

    // Verifica o banco de dados para encontrar o usuário
    $query = "SELECT * FROM usuarios WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verifica se a senha está correta
        if (password_verify($senha, $user['senha'])) {
            $_SESSION['username'] = $username;  // Cria a sessão para o usuário
            header("Location: home.php");  // Redireciona para a página inicial
            exit();
        } else {
            echo "<script>alert('Senha incorreta!'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado!'); window.location.href='index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <canvas id="particleCanvas"></canvas>

    <div class="container">
        <div class="login-form">
            <h1>Bem-vindo de volta!</h1>
            <p>Entre na sua conta</p>
            <form action="index.php" method="POST" id="loginForm">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" id="username" placeholder="Usuário" required>
                    <span id="usernameError" class="error-message"></span>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="senha" id="senha" placeholder="Senha" required>
                    <span id="senhaError" class="error-message"></span>
                </div>

                <button type="submit" >Entrar</button>
            </form>
            <p class="forgot-password"><a href="#">Esqueceu sua senha?</a></p>
            <div class="social-media">
                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-google"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
            </div>
            <p class="switch-form">Não tem uma conta? <a href="register.php" class="register-link">Crie uma agora!</a></p>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
