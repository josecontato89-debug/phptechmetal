<?php
include 'conecta.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $objetivo = $_POST['objetivo'];
    $quantidade = $_POST['quantidade'];
    
    try {
        $sqlCheck = "SELECT COUNT(*) FROM equipamentos WHERE nome=:nome AND tipo=:tipo AND objetivo=:objetivo AND quantidade=:quantidade";
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->bindParam(':nome', $nome);
        $stmtCheck->bindParam(':tipo', $tipo);
        $stmtCheck->bindParam(':objetivo', $objetivo);
        $stmtCheck->bindParam(':quantidade', $quantidade);
        
        $stmtCheck->execute();
        if ($stmtCheck->fetchColumn() > 0) {
            echo "<script>
                    alert('Equipamentos já existe em nosso banco de dados!');
                    history.back();
                  </script>";
        }
        else {
            $sqlInsert = "INSERT INTO equipamentos (nome, tipo, objetivo, quantidade)
                          VALUES (:nome, :tipo, :objetivo, :quantidade)";
        
            $stmtInsert = $pdo->prepare($sqlInsert);                      
            $stmtInsert->bindParam(':nome', $nome);
            $stmtInsert->bindParam(':tipo', $tipo);  
            $stmtInsert->bindParam(':objetivo', $objetivo); 
            $stmtInsert->bindParam(':quantidade', $quantidade);
            
            if ($stmtInsert->execute()) {
                echo "<script>
                        alert('Equipamentos cadastrada com sucesso!');
                        window.location.href ='equipamentos.php';
                      </script>";
                exit();
            } else {
                echo "<script>
                        alert('Erro ao cadastrar equipamentos!');
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