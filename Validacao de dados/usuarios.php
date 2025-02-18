<?php
require_once '../config/database.php';

function validarUsuario($dados, $tipo = 'cadastro') {
    $erros = [];

    if (empty($dados['email'])) {
        $erros['email'] = "O email é obrigatório.";
    } elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
        $erros['email'] = "Email inválido.";
    }

    if ($tipo == 'cadastro') { // Validações específicas para cadastro
        if (empty($dados['nome'])) {
            $erros['nome'] = "O nome é obrigatório.";
        }

        if (empty($dados['data_nascimento'])) {
            $erros['data_nascimento'] = "A data de nascimento é obrigatória.";
        }

        if (empty($dados['senha'])) {
            $erros['senha'] = "A senha é obrigatória.";
        } elseif ($dados['senha'] !== $dados['confirmar_senha']) {
            $erros['senha'] = "As senhas não coincidem.";
        }

        if (empty($dados['telefone'])) {
            $erros['telefone'] = "O telefone é obrigatório.";
        }
    } else { // Validações específicas para login
        if (empty($dados['senha'])) {
            $erros['senha'] = "A senha é obrigatória.";
        }
    }

    return $erros;
}


function validarLogin($dados) {
    global $mysqli;

    $erros = validarUsuario($dados, 'login');

    if (empty($erros)) {
        $email = $mysqli->real_escape_string($dados['email']);
        $password = $dados['senha'];

        $sql_code = "SELECT senha, cod_usuarios, nome FROM usuarios WHERE email = '$email'"; // Corrigido o nome da coluna
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $dado = $sql_query->fetch_assoc();
        $total = $sql_query->num_rows;

        if ($total == 0) {
            $erros[] = "Usuário não encontrado.";
        } else {
            if (password_verify($password, $dado['senha'])) {
                session_start();
                $_SESSION['usuario'] = $dado['cod_usuarios']; // Corrigido o nome da coluna
                $_SESSION['nome'] = $dado['nome'];
                return true;
            } else {
                $erros[] = "Senha incorreta.";
            }
        }
    }

    return $erros;
}
?>