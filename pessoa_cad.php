<?php
include "pessoa_acao.php";
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$dados = array();
if ($id != 0)
    $dados = carregar($id);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<?php include 'cabecalho.php'; ?>

<body>
    <header class="container">
        <?php include 'menu.php'; ?>
    </header>
    <main class="container">
        <form action="pessoa_acao.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Cadastro de Pessoas</legend>

                <label for="id">Id</label>
                <input type="text" name="id" id="id" value="<?= $id ?>" readonly><br>

                <label for="nome">Nome</label>
                <input type="text" size="40" name="nome" id="nome" value="<?php if ($id != 0) echo $dados['nome']; ?>" required><br>

                <label for="email">email</label>
                <input type="email" name="email" id="email" value="<?php if ($id != 0) echo $dados['email']; ?>"><br>

                <label for="senha">senha</label>
                <input type="text" name="senha" id="senha" value="<?php if ($id != 0) echo $dados['senha']; ?>"><br>

                <label for="foto">foto</label>
                <input type="file" name="foto" id="foto"><br>

                <label for="perfil">Perfil</label>
                <select name="perfil" id="perfil">
                    <option value="usuario" <?php if ($id != 0 && $dados['perfil'] == 'usuario') echo 'selected'; ?>>Usuário</option>
                    <option value="admin" <?php if ($id != 0 && $dados['perfil'] == 'admin') echo 'selected'; ?>>Admin</option>
                </select><br>

                <input class="primary" type="submit" name="acao" id="acao" value="<?= $id == 0 ? "Salvar" : "Alterar" ?>">
                <input type="reset" value="Cancelar" />
            </fieldset>
        </form>
    </main>
    <footer class="container"></footer>
</body>
</html>
