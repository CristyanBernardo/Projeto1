<?php
require_once '../Validacao de dados/usuarios.php'; // Inclui o arquivo com a validação unificada

$erro = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dados = [
        'email' => $_POST['username'], // Usar 'username' para email
        'senha' => $_POST['password']
    ];

    $erro = validarLogin($dados); // Chama a função de validação

    if ($erro === true) {
        header("Location: index.php");
        exit();
    }else {
        var_dump($erro); // Exibe os erros para debugging
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../Assets/css/login.css">
    <script src="../Assets/js/login.js" defer></script>
    <link rel="stylesheet" href="../Assets/css/footer.css">
    <script src="../Assets/js/footer.js"></script>
</head>

<body>

    <?php include_once '../Includes/header.php'; ?>

    <main class="login">
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="username">Nome de Usuário ou E-mail</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button class="login-button" type="submit">Entrar</button>
        </form>

        <?php
        if (!empty($erro)) { // Exibe os erros, se houver
            foreach ($erro as $mensagem) {
                echo "<p class='erro'>$mensagem</p>"; // Estilize a mensagem de erro com CSS
            }
        }
        ?>

        <p>Ainda não tem uma conta? <a href="cadastro.php">Cadastre-se aqui</a></p>
    </main>

    <?php include_once '../Includes/footer.php'; ?>

</body>

</html>