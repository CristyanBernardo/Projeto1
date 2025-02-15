<?php
session_start();

require_once '../config/database.php'; // Arquivo de configuração do banco de dados
$conn = conectarAoBancoDeDados(); // Função para conectar ao banco de dados
if (!$conn) {
    die("Falha na conexão com o banco de dados.");
}

$erro = ""; // Variável para armazenar mensagens de erro

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']); // Remove espaços em branco extras
    $password = $_POST['password'];

    // Validação básica (você pode adicionar mais validações aqui)
    if (empty($username) || empty($password)) {
        $erro = "Nome de usuário/email e senha são obrigatórios.";
    } else {
        // Consulta ao banco de dados (usando prepared statements para segurança)
        $sql = "SELECT * FROM usuarios WHERE email = ? OR nome = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $username); // "ss" indica dois parâmetros string
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Verificação da senha (usando password_verify)
            if (password_verify($password, $row['senha'])) {
                // Login bem-sucedido: inicie a sessão e redirecione
                $_SESSION['id'] = $row['id'];
                $_SESSION['nome'] = $row['nome'];
                $_SESSION['email'] = $row['email']; // Adicione outras informações que você precisa
                header("Location: pagina_de_destino.php"); // Redirecione para a página desejada
                exit();
            } else {
                $erro = "Senha incorreta.";
            }
        } else {
            $erro = "Usuário não encontrado.";
        }

        $stmt->close(); // Fechar o statement
    }
    $conn->close(); // Fechar a conexão com o banco
}
?>