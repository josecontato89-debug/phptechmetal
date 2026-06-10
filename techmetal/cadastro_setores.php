<?php
include 'conecta.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $setor = $_POST['setor'];
    $quant_funcionarios = $_POST['quant_funcionarios'];
    $funcao = $_POST['funcao'];
    
    
    try {
        $sqlCheck = "SELECT COUNT(*) FROM setores WHERE setor = :setor";
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->bindParam(':setor', $setor);
        $stmtCheck->execute();
        if ($stmtCheck->fetchColumn() > 0) {
            echo "<script>
                    alert('Setor já existe em nosso banco de dados!');
                    history.back();
                  </script>";
        }
        else {
            $sqlInsert = "INSERT INTO setores (setor, quant_funcionarios, funcao)
                          VALUES (:setor, :quant_funcionarios, :funcao)";
        
            $stmtInsert = $pdo->prepare($sqlInsert);
            $stmtInsert->bindParam(':setor', $setor);
            $stmtInsert->bindParam(':quant_funcionarios', $quant_funcionarios);
            $stmtInsert->bindParam(':funcao', $funcao);
            
            if ($stmtInsert->execute()) {
                echo "<script>
                        alert('Setor cadastrada com sucesso!');
                        window.location.href ='setores.php';
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