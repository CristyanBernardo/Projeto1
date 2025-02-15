<?php
require_once '../Validacao de dados/validacao_cadastro.php';

// Inicializa o array $erros *ANTES* de qualquer outra coisa
$erros = [
    'nome' => '',
    'data_nascimento' => '',
    'email' => '',
    'senha' => '',
    'confirmar_senha' => '',
    'telefone' => ''
];

// Mensagens de feedback
$success_msg = "";
$error_msg = "";
$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dados = [
        'nome' => isset($_POST['nome']) ? trim($_POST['nome']) : '',
        'data_nascimento' => isset($_POST['data_nascimento']) ? trim($_POST['data_nascimento']) : '',
        'email' => isset($_POST['email']) ? trim($_POST['email']) : '',
        'senha' => isset($_POST['senha']) ? $_POST['senha'] : '',
        'confirmar_senha' => isset($_POST['confirmar_senha']) ? $_POST['confirmar_senha'] : '',
        'telefone' => isset($_POST['telefone']) ? trim($_POST['telefone']) : ''
    ];

    $erros = validarCadastro($dados);

    if (empty($erros)) {
        $resultado_cadastro = cadastrarUsuario($dados);

        if ($resultado_cadastro === true) {
            $success_msg = "Cadastro realizado com sucesso!";
            $_POST = array();
        } else {
            $error_msg = $resultado_cadastro; // Mensagem de erro do cadastro
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../Assets/css/header.css">
    <link rel="stylesheet" href="../Assets/css/cadastro.css">
    <script src="../Assets/js/cadastro.js" defer></script> <!-- Incluindo JavaScript -->
    <link rel="stylesheet" href="../Assets/css/footer.css">
    <script src="../Assets/js/footer.js"></script>
</head>
<body>

    <?php include_once '../Includes/header.php'?> <!-- Incluindo cabeçalho -->
  

    <!-- Formulário HTML -->
    <main class="cadastro-main">
        <form action="cadastro.php" method="post">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo" required>
                <?php if (isset($erros['nome']) && !empty($erros['nome'])) { echo "<span class='error'>".$erros['nome']."</span>"; } ?>
            </div>

            <div class="form-group">
                <label for="nome">Data de nascimento</label>
                <input type="date" id="data_nascimento" name="data_nascimento" required>
                <?php if (isset($erros['data_nascimento']) && !empty($erros['data_nascimento'])) { echo "<span class='error'>".$erros['data_nascimento']."</span>"; } ?>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Digite seu Email" required>
                <?php if (isset($erros['email']) && !empty($erros['email'])) { echo "<span class='error'>".$erros['email']."</span>"; } ?>
            </div>

            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                <?php if (isset($erros['senha']) && !empty($erros['senha'])) { echo "<span class='error'>".$erros['senha']."</span>"; } ?>
            </div>

            <div class="form-group">
                <label for="confirmar_senha">Confirmar Senha</label>
                <input type="password" id="confirmar_senha" name="confirmar_senha" placeholder="Confirme sua senha" required>
                <?php if (isset($erros['confirmar_senha']) && !empty($erros['confirmar_senaha'])) { echo "<span class='error'>".$erros['confirmar_senha']."</span>"; } ?>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="tel" id="telefone" name="telefone" placeholder="(xx) xxxxx-xxxx" required>
                <?php if (isset($erros['telefone']) && !empty($erros['telefone'])) { echo "<span class='error'>".$erros['telefone']."</span>"; } ?>
            </div>

            <button type="submit">Cadastrar</button> <!-- Botão de envio -->
        </form>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <?php include_once '../Includes/footer.php'?> <!-- Incluindo rodapé -->
</body>
</html>
