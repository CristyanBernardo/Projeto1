<!DOCTYPE html>
<html lang="pt-bt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CN Tech</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> 
    <link rel="stylesheet" href="../Assets/css/header.css">
    <script src="../Assets/js/header.js" defer></script>
</head>
<body>
    <?php
    // Incluindo o cabeçalho
    include '../includes/header.php'; // Caminho relativo para o header.php
    ?>
    <main>
        <form action="cadastro.php" method="post">

            <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" required>
            </div>

            <div class="form-group">
                <label for="sobrenome">Sobrenome</label>
                <input type="text" id="sobrenome" name="sobrenome" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required>
            </div>

            <div class="form-group">
                <label for="confirmar_senha">Confirmar Senha</label>
                <input type="password" id="confirma_senha" name="confirma_senha" required>
            </div>
        </form>
    </main>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirma_senha = $_POST['confirma_senha'];

    // Validação básica
    if ($senha !== $confirma_senha) {
        die("As senhas não coincidem.");
    }

    // Aqui você pode adicionar a lógica para armazenar os dados em um banco de dados
    // Exemplo: usando PDO para inserir no banco de dados

    // Conexão com o banco de dados (substitua pelos seus dados)
    $host = 'localhost';
    $db = 'seu_banco_de_dados';
    $user = 'seu_usuario';
    $pass = 'sua_senha';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Inserir dados no banco
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $email, password_hash($senha, PASSWORD_DEFAULT)]);

        echo "Cadastro realizado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
 
</body>
</html>