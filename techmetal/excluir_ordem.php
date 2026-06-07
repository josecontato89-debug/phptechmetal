<?php
include 'conecta.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        $sqlDelete = "DELETE FROM ordem_manutencoes WHERE id = :id";
        $stmtDelete = $pdo->prepare($sqlDelete);
        $stmtDelete->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmtDelete->execute()) {
            echo "<script>
                    alert('Ordem de manutenção excluída com sucesso!');
                    window.location.href ='ordem_manutencoes.php';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('Erro ao excluir registro!');
                    history.back();
                  </script>";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    header('Location: ordem_manutencoes.php');
    exit();
}
?>