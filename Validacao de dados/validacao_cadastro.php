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

    $senha_hash = password_hash($dados['senha'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (nome, data_nascimento, email, senha, telefone) VALUES (?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("sssss", $dados['nome'], $dados['data_nascimento'], $dados['email'], $senha_hash, $dados['telefone']);

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