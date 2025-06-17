<?php
session_start();

$acao = $_POST['acao'] ?? "";

if ($acao === "Login") {
    login();
} elseif ($acao === "Logout") {
    logout();
}

function login() {
    $usuarioForm = [
        'email' => $_POST['email'] ?? "",
        'senha' => $_POST['senha'] ?? ""
    ];

    $usuarios = [];

    if (file_exists("pessoa.json")) {
        $json = file_get_contents("pessoa.json");
        $usuarios = json_decode($json);
    }

    $logado = false;

    foreach ($usuarios as $user) {
        // Verifica se o email e a senha batem
        if ($user->email === $usuarioForm['email'] && $user->senha === $usuarioForm['senha']) {
            $logado = true;

            // Salva dados importantes na sessão (você pode salvar outros se quiser)
            $_SESSION['usuario'] = $user->nome;
            $_SESSION['email'] = $user->email;
            $_SESSION['perfil'] = $user->perfil;
            break;
        }
    }

    if ($logado) {
        header("Location: pessoa_list.php");
    } else {
        header("Location: login.php?error=1");
    }
    exit;
}

function logout() {
    session_start();
    session_destroy();
    header("Location: login.php");
    exit;
}
