<?php
include 'conecta.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $problema = $_POST['problema'];
    $prioridade = $_POST['prioridade'];
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];
    
    try {
        $sqlCheck = "SELECT COUNT(*) FROM manutencoes WHERE problema=:problema AND prioridade=:prioridade AND data_inicio=:data_inicio AND data_fim=:data_fim";
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->bindParam(':prioridade', $prioridade);
        $stmtCheck->bindParam(':problema', $problema);
        $stmtCheck->bindParam(':data_inicio', $data_inicio);
        $stmtCheck->bindParam(':data_fim', $data_fim);
        
        $stmtCheck->execute();
        if ($stmtCheck->fetchColumn() > 0) {
            echo "<script>
                    alert('Manutenção já existe em nosso banco de dados!');
                    history.back();
                  </script>";
        }
        else {
            $sqlInsert = "INSERT INTO manutencoes (problema, prioridade, data_inicio, data_fim)
                          VALUES (:problema, :prioridade, :data_inicio, :data_fim)";
        
            $stmtInsert = $pdo->prepare($sqlInsert);                      
            $stmtInsert->bindParam(':problema', $problema);
            $stmtInsert->bindParam(':prioridade', $prioridade);  
            $stmtInsert->bindParam(':data_inicio', $data_inicio); 
            $stmtInsert->bindParam(':data_fim', $data_fim);
            
            if ($stmtInsert->execute()) {
                echo "<script>
                        alert('Manutenções cadastrada com sucesso!');
                        window.location.href ='manutencoes.php';
                      </script>";
                exit();
            } else {
                echo "<script>
                        alert('Erro ao cadastrar manutenções!');
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