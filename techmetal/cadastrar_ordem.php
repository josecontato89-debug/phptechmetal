<?php
include 'conecta.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_ordem = $_POST['id_ordem']; // Este campo agora armazena o ID da maquina vindo de ativos
    $equipamentos = $_POST['equipamentos'];
    $manutencao = $_POST['manutencao'];
    
    try {
        $sqlInsert = "INSERT INTO ordem_manutencoes (id_ordem, equipamentos, manutencao)
                      VALUES (:id_ordem, :equipamentos, :manutencao)";
    
        $stmtInsert = $pdo->prepare($sqlInsert);                      
        $stmtInsert->bindParam(':id_ordem', $id_ordem);
        $stmtInsert->bindParam(':equipamentos', $equipamentos);  
        $stmtInsert->bindParam(':manutencao', $manutencao); 
        
        if ($stmtInsert->execute()) {
            echo "<script>
                    alert('Ordem de manutenção aberta com sucesso!');
                    window.location.href ='ordem_manutencoes.php';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('Erro ao processar a abertura da Ordem!');
                    history.back();
                  </script>";
        }
    } catch (PDOException $e) {
       echo "Erro: " . $e->getMessage();
    }
}
?>