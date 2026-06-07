<?php
include 'conecta.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $id_ordem = $_POST['id_ordem']; // Armazena o ID da nova maquina selecionada
    $equipamentos = $_POST['equipamentos'];
    $manutencao = $_POST['manutencao'];
    
    try {
        $sqlUpdate = "UPDATE ordem_manutencoes 
                      SET id_ordem = :id_ordem, equipamentos = :equipamentos, manutencao = :manutencao 
                      WHERE id = :id";
                      
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':id_ordem', $id_ordem);
        $stmtUpdate->bindParam(':equipamentos', $equipamentos);
        $stmtUpdate->bindParam(':manutencao', $manutencao);
        $stmtUpdate->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmtUpdate->execute()) {
            echo "<script>
                    alert('Ordem de manutenção atualizada com sucesso!');
                    window.location.href ='ordem_manutencoes.php';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('Erro ao atualizar dados da ordem!');
                    history.back();
                  </script>";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>