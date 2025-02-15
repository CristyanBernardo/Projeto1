<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=], initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../Assets/css/login.css"> <!-- Carregue primeiro o CSS do cabeçalho -->
    <script src="../Assets/js/login.js" defer></script>
    <link rel="stylesheet" href="../Assets/css/footer.css">
    <script src="../Assets/js/footer.js"></script>
</head>
<body>
     <?php
      include_once '../Includes/header.php';
     ?>

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
        
        <p>Ainda não tem uma conta? <a href="cadastro.php">Cadastre-se aqui</a></p> <!-- Link para cadastro -->
    </main>

    <?php include_once '../Includes/footer.php'?>

</body>
</html>