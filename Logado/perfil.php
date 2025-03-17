<?php
require_once '../config/database.php'; // Inclui o arquivo de conexão

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario'];

$stmt = $mysqli->prepare("SELECT nome, email, data_nascimento, telefone,cpf FROM usuarios WHERE cod_usuarios = ? ");
$stmt->bind_param("i", $usuario_id); // "i" indica que $usuario_id é um inteiro
$stmt->execute();
$stmt->bind_result($nome, $email, $data_nascimento, $telefone, $cpf);
$stmt->fetch();
$stmt->close();

$modo_edicao = isset($_GET['editar']) && $_GET['editar'] == 'true';

?>

<!DOCTYPE html>
<html lang="pt-bt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CN Tech</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> 
    <link rel="stylesheet" href="../Assets/css/perfil.css">
</head>
<body>
    <!-- index.php -->
    <?php
include '../logado/header.php'; // Incluindo o cabeçalho
?>

<?php if (isset($nome)): ?>
        <?php if ($modo_edicao): ?>
            <div class="edit-perfil">
                <h2>Editar Perfil</h2>
            <form action="editar_perfil.php" method="post">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" value="<?php echo $nome; ?>"><br>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo $email; ?>"><br>

                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" name="data_nascimento" id="data_nascimento" value="<?php echo $data_nascimento; ?>"><br>

                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" id="telefone" value="<?php echo $telefone; ?>"><br>

                <input type="submit" value="Salvar Alterações">
                <a href="perfil.php">Cancelar</a>
            </form>
</div>
            
        <?php else: ?>
            <div class="info-perfil">
                <h2>Perfil do Usuário</h2>
            <p><strong>Nome:</strong> <?php echo $nome; ?></p>
            <p><strong>CPF:</strong> <?php echo $cpf; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Data de Nascimento:</strong> <?php echo $data_nascimento; ?></p>
            <p><strong>Telefone:</strong> <?php echo $telefone; ?></p>
        </div>
            

            <a href="perfil.php?editar=true">Editar Perfil</a>
        <?php endif; ?>
    <?php else: ?>
        <p>Usuário não encontrado.</p>
    <?php endif; ?>

    <?php    include '../Includes/footer.php'; ?>

</body>
</html>
