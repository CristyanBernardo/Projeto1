<?php
require_once '../config/database.php';

function validarCadastro($dados) {
    $erros = [];

    if (empty($dados['nome'])) {
        $erros['nome'] = "O nome é obrigatório.";
    }

    if (empty($dados['data_nascimento'])) {
        $erros['data_nascimento'] = "A data de nascimento é obrigatória.";
    }

    if (empty($dados['email'])) {
        $erros['email'] = "O email é obrigatório.";
    } elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
        $erros['email'] = "Email inválido.";
    }

    if (empty($dados['senha'])) {
        $erros['senha'] = "A senha é obrigatória.";
    } elseif ($dados['senha'] !== $dados['confirmar_senha']) {
        $erros['senha'] = "As senhas não coincidem.";
    }

    if (empty($dados['telefone'])) {
        $erros['telefone'] = "O telefone é obrigatório.";
    }
    if (empty($dados['cpf'])) {
        $erros['cpf'] = "O CPF é obrigatório.";
    }

    return $erros;
}

function cadastrarUsuario($dados) {
    $conn = conectarAoBancoDeDados();

    if ($conn === null) {
        return "Erro ao conectar ao banco de dados.";
    }
    
    $stmt_check = $conn->prepare("SELECT email, cpf FROM usuarios WHERE email = ? OR cpf = ?");
    if ($stmt_check) {
        $stmt_check->bind_param("ss", $dados['email'], $dados['cpf']);
        $stmt_check->execute();
        $stmt_check->store_result();
        var_dump($stmt_check->error); // Verifique erros na consulta preparada

        if ($stmt_check->num_rows > 0 && $stmt_check) { // Verificação crucial aqui
            $result = $stmt_check->get_result();
            if ($result) { // Verifique se get_result() foi bem-sucedido
                $dado = $result->fetch_assoc();
                if ($dado['email'] == $dados['email']) {
                    return "Já existe um usuário com este email.";
                } else {
                    return "Já existe um usuário com este CPF.";
                }
            } else {
                error_log("Erro ao obter resultado da consulta: " . $stmt_check->error);
                return "Erro na verificação de usuário.";
            }
        }
        $stmt_check->close();
    } else {
        return "Erro na preparação da consulta de verificação: " . $conn->error;
    }
  
    $senha_hash = password_hash($dados['senha'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (nome, data_nascimento, email, senha, telefone, cpf) VALUES (?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("ssssss", $dados['nome'], $dados['data_nascimento'], $dados['email'], $senha_hash, $dados['telefone'], $dados['cpf']);

        if ($stmt->execute()) {
            return true; // Cadastro realizado com sucesso
        } else {
            if ($stmt->errno == 1062) {
                return "Email já cadastrado. Por favor, utilize outro email.";
            } else {
                return "Erro ao cadastrar: " . $stmt->error;
            }
        }
        $stmt->close();
    } else {
        return "Erro na preparação da consulta: " . $conn->error;
    }
    $conn->close();
}

?>