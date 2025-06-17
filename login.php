<?php
include('cabecalho.php');
// Exibe mensagem de erro caso ?error=1
$erro = isset($_GET['error']) && $_GET['error'] == 1;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

</head>
<body>

<div class="login-container">
    <form action="login_acao.php" method="post">
        <h2>Login</h2>

        <?php if ($erro): ?>
            <div class="error">Usuário ou senha inválidos</div>
        <?php endif; ?>

        <label for="email">Email:</label>
        <input type="text" name="email" id="email" placeholder="Digite seu email" required>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>

        <input type="hidden" name="acao" value="Login">
        <input type="submit" value="Entrar">
    </form>
</div>

</body>
</html>
