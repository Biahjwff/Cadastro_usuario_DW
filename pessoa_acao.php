<?php
define("DESTINO", "pessoa_list.php");
define("ARQUIVO_JSON", "pessoa.json");
define("LOGIN", "login.php");

$acao = "";
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $acao = $_GET['acao'] ?? "";
        break;
    case 'POST':
        $acao = $_POST['acao'] ?? "";
        break;
}

switch ($acao) {
    case 'Salvar':
        salvar();
        break;
    case 'Alterar':
        alterar();
        break;
    case 'excluir':
        excluir();
        break;
}

function salvarFoto() {
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $diretorio = 'fotos/';
        $nome_foto = $diretorio . time() . '_' . basename($_FILES['foto']['name']);
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $nome_foto)) {
            return $nome_foto;
        }
    }
    return "";
}

function tela2array() {
    return array(
        'id' => $_POST['id'] != "0" ? $_POST['id'] : date("YmdHis"),
        'nome' => $_POST['nome'] ?? "",
        'email' => $_POST['email'] ?? "",
        'senha' => $_POST['senha'] ?? "",
        'foto' => salvarFoto(),
        'perfil' => $_POST['perfil'] ?? ""
    );
}

function array2json($array_dados, &$json_dados) {
    $json_dados->id = $array_dados['id'];
    $json_dados->nome = $array_dados['nome'];
    $json_dados->email = $array_dados['email'];
    $json_dados->senha = $array_dados['senha'];
    $json_dados->foto = $array_dados['foto'];
    $json_dados->perfil = $array_dados['perfil'];
    return $json_dados;
}

function salvar_json($dados, $arquivo) {
    file_put_contents($arquivo, $dados);
}

function ler_json($arquivo) {
    if (!file_exists($arquivo)) return [];
    $conteudo = file_get_contents($arquivo);
    return json_decode($conteudo);
}

function carregar($id) {
    $json = ler_json(ARQUIVO_JSON);
    foreach ($json as $key) {
        if ($key->id == $id)
            return (array) $key;
    }
}

function alterar() {
    $novo = tela2array();
    $json = ler_json(ARQUIVO_JSON);
    foreach ($json as &$item) {
        if ($item->id == $novo['id']) {
            array2json($novo, $item);
        }
    }
    salvar_json(json_encode($json), ARQUIVO_JSON);
    header("Location: " . DESTINO);
}

function excluir() {
    $id = $_GET['id'] ?? "";
    $json = ler_json(ARQUIVO_JSON);
    $novo = array_filter($json, fn($item) => $item->id != $id);
    salvar_json(json_encode(array_values($novo)), ARQUIVO_JSON);
    header("Location: " . DESTINO);
}

function salvar() {
    $pessoa = tela2array();
    $json = ler_json(ARQUIVO_JSON);
    $json[] = $pessoa;
    salvar_json(json_encode($json), ARQUIVO_JSON);
    header("Location: " . LOGIN);
}
?>
