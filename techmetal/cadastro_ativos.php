<?php
include 'conecta.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $maquina = $_POST['maquina'];
    $modelo = $_POST['modelo'];
    $funcionalidade = $_POST['funcionalidade'];
    $n_patrimonio = $_POST['n_patrimonio'];
    $setor = $_POST['setor'];
    
    try {
        $sqlCheck = "SELECT COUNT(*) FROM ativos WHERE maquina=:maquina AND modelo=:modelo AND funcionalidade=:funcionalidade AND n_patrimonio=:n_patrimonio AND setor=:setor";
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->bindParam(':maquina', $maquina);
        $stmtCheck->bindParam(':modelo', $modelo);
        $stmtCheck->bindParam(':funcionalidade', $funcionalidade);
        $stmtCheck->bindParam(':n_patrimonio', $n_patrimonio);
        $stmtCheck->bindParam(':setor', $setor);
        
        $stmtCheck->execute();
        if ($stmtCheck->fetchColumn() > 0) {
            echo "<script>
                    alert('Ativos já existe em nosso banco de dados!');
                    history.back();
                  </script>";
        }
        else {
            $sqlInsert = "INSERT INTO ativos (maquina, modelo, funcionalidade, n_patrimonio, setor)
                          VALUES (:maquina, :modelo, :funcionalidade, :n_patrimonio, :setor)";
        
            $stmtInsert = $pdo->prepare($sqlInsert);                      
            $stmtInsert->bindParam(':maquina', $maquina);
            $stmtInsert->bindParam(':modelo', $modelo);  
            $stmtInsert->bindParam(':funcionalidade', $funcionalidade); 
            $stmtInsert->bindParam(':n_patrimonio', $n_patrimonio);
            $stmtInsert->bindParam(':setor', $setor); 
            
            if ($stmtInsert->execute()) {
                echo "<script>
                        alert('Ativos cadastrada com sucesso!');
                        window.location.href ='ativos.php';
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