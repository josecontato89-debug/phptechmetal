<?php
include 'conecta.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $maquina = $_POST['maquina'];
    $data_movimento = $_POST['data_movimento'];
    $setor_atual = $_POST['setor_atual'];
    $setor_anterior = $_POST['setor_anterior'];
    $responsavel = $_POST['responsavel'];
    
    try {
        $sqlCheck = "SELECT COUNT(*) FROM alocacoes WHERE maquina=:maquina AND data_movimento=:data_movimento AND setor_atual=:setor_atual AND setor_anterior=:setor_anterior AND responsavel=:responsavel";
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->bindParam(':maquina', $maquina);
        $stmtCheck->bindParam(':data_movimento', $data_movimento);
        $stmtCheck->bindParam(':setor_atual', $setor_atual);
        $stmtCheck->bindParam(':setor_anterior', $setor_anterior);
        $stmtCheck->bindParam(':responsavel', $responsavel);
        
        $stmtCheck->execute();
        if ($stmtCheck->fetchColumn() > 0) {
            echo "<script>
                    alert('Alocação ja fou informada em nosso banco de dados!');
                    history.back();
                  </script>";
        }
        else {
            $sqlInsert = "INSERT INTO alocacoes (maquina, data_movimento, setor_atual, setor_anterior, responsavel)
                          VALUES (:maquina, :data_movimento, :setor_atual, :setor_anterior, :responsavel)";
        
            $stmtInsert = $pdo->prepare($sqlInsert);                      
            $stmtInsert->bindParam(':maquina', $maquina);
            $stmtInsert->bindParam(':data_movimento', $data_movimento);  
            $stmtInsert->bindParam(':setor_atual', $setor_atual); 
            $stmtInsert->bindParam(':setor_anterior', $setor_anterior);
            $stmtInsert->bindParam(':responsavel', $responsavel);
            
            if ($stmtInsert->execute()) {
                echo "<script>
                        alert('Relocação informada com sucesso!');
                        window.location.href ='alocacoes.php';
                      </script>";
                exit();
            } else {
                echo "<script>
                        alert('Erro ao informar realocação!');
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