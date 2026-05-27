<?php

session_start(); // Inicia a sessão do PHP para armazenar dados do usuário logado

include 'conecta.php'; // Inclui o arquivo responsável pela conexão com o banco de dados

// Verifica se o formulário foi enviado utilizando o método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recebe o valor digitado no campo login
    // O trim() remove espaços vazios no começo e no final
    // O ?? '' evita erro caso o campo não exista
    $login = trim(($_POST['login'] ?? ''));

    // Recebe o valor digitado no campo senha
    // Também remove espaços vazios extras
    $senha = trim(($_POST['senha'] ?? ''));

    // Verifica se algum campo ficou vazio
    if ($login === '' || $senha === '') {

        // Exibe alerta e retorna para index
        echo "<script>
        alert('Preencha todos os campos');
        window.location.href='index.php';
        </script>";

        // Interrompe completamente a execução do código
        exit;
    }

    try {

        // Prepara uma consulta SQL segura contra SQL Injection
        // Busca um usuário com o login informado
        // LIMIT 1 garante que apenas um usuário seja retornado
        $stmt = $pdo->prepare("SELECT * FROM operadores WHERE login = :login LIMIT 1");

        // Substitui o :login pelo valor digitado pelo usuário
        $stmt->bindValue(':login', $login);

        // Executa a consulta no banco de dados
        $stmt->execute();

        // Busca os dados retornados da consulta
        // PDO::FETCH_ASSOC transforma os dados em array associativo
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica:
        // 1 - Se o usuário existe
        // 2 - Se a senha digitada é igual à senha salva no banco
        if ($usuario && $senha == $usuario['senha'] && $login == $usuario['login']) {
            // Salva o nome do usuário na sessão
            $_SESSION['nome'] = $usuario['nome'];
            // Salva o tipo do usuário
            $_SESSION['funcao'] = $usuario['funcao'];
            
            $funcao = $usuario['funcao'];
            // Verifica se é administrador
            if ($funcao === "admin") {

                // Redireciona para página admin
                header('Location: home.php');

            } else {

                // Redireciona para página normal
                header('Location: home.php');
            }

            // Finaliza execução
            exit;

        } else {

            // Usuário ou senha inválidos
            echo "<script>
            alert('Usuário ou senha inválidos');
            window.location.href='index.php';
            </script>";

            // Finaliza execução
            exit;
        }

    } catch (PDOException $e) {

        // Caso aconteça erro no banco
        echo "<script>
        alert('Erro no sistema');
        window.location.href='index.php';
        </script>";

        // Finaliza execução
        exit;
    }
}

?>