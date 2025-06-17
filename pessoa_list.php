<!DOCTYPE html>
<html lang="pt-BR" data-theme="light">
<?php include 'cabecalho.php'; ?>

<body>
    <main class="container">
        <?php include 'menu.php'; ?>
        <table role="grid">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>email</th>
                <th>senha</th>
                <th>foto</th>
                <th>perfil</th>
                <th>Alterar</th>
                <th>Excluir</th>
            </tr>
            <?php
            $dados = json_decode(file_get_contents('pessoa.json'), true);
            if ($dados == NULL || count($dados) == 0) {
                echo "<h1>sem dados a serem exibidos</h1>";
            }
            foreach ($dados as $key) {
                echo "<tr>
                    <td>{$key['id']}</td>
                    <td>{$key['nome']}</td>
                    <td>{$key['email']}</td>
                    <td>{$key['senha']}</td>
                    <td>"; 
                if (!empty($key['foto'])) {
                echo '<img src="' . $key['foto'] . '" alt="Foto" width="50%" height="50%" style="object-fit: cover; border-radius: 5%;">';
                } else {echo 'Sem foto';
                }echo "</td>
                    <td>{$key['perfil']}</td>
                    <td align='center'><a role='button' href='pessoa_cad.php?id={$key['id']}'>A</a></td>
                    <td align='center'><a role='button' href=javascript:excluirRegistro('pessoa_acao.php?acao=excluir&id={$key['id']}');>E</a></td>
                </tr>";
            }
            ?>
        </table>
    </main>
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar Exclusão?"))
                location.href = url;
        }
    </script>
</body>
</html>
