<?php
include 'conecta.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $setor = $_POST['setor'];
    $quant_funcionarios = $_POST['quant_funcionarios'];
    $funcao = $_POST['funcao'];
    
    
    try {
        $sqlCheck = "SELECT COUNT(*) FROM setores WHERE cpf = :cpf";
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->bindParam(':cpf', $cpf);
        $stmtCheck->execute();
        if ($stmtCheck->fetchColumn() > 0) {
            echo "<script>
                    alert('Operador já existe em nosso banco de dados!');
                    history.back();
                  </script>";
        }
        else {
            $sqlInsert = "INSERT INTO operadores (nome, cpf, funcao, genero, login, senha)
                          VALUES (:nome, :cpf, :funcao, :genero, :login, :senha)";
        
            $stmtInsert = $pdo->prepare($sqlInsert);
            $stmtInsert->bindParam(':nome', $nome);
            $stmtInsert->bindParam(':cpf', $cpf);
            $stmtInsert->bindParam(':funcao', $funcao);
            $stmtInsert->bindParam(':genero', $genero);
            $stmtInsert->bindParam(':login', $login);
            $stmtInsert->bindParam(':senha', $senha);
            if ($stmtInsert->execute()) {
                echo "<script>
                        alert('Operador cadastrada com sucesso!');
                        window.location.href ='operadores.php';
                      </script>";
                exit();
            } else {
                echo "<script>
                        alert('Erro ao cadastrar usuario!');
                        history.back();
                      </script>";
            }
            exit();
        }
    } catch (PDOException $e) {
       echo "Erro:".$e->getMessage();
    }
}
?>