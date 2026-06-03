<?php
   include'conecta.php';
   if(isset($_GET['id']) && !empty($_GET['id'])){
     $id= filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
     try {
        $sql ="DELETE FROM alocacoes WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if($stmt->execute()){
            header("Location: alocacoes.php?msg=Sucesso");
            exit;
        
        }
        else{
            header("Location: alocacoes.php?msg=Não consegui apagar");
        }
        //algo de errado não esta certo aqui mas funciona//
     } catch (PDOException $e) {
        die("Erro:".$e->getMessage());
     }
   }
   else{
    header("Location: excluir_alocacoes.php");
            exit;
   }
?>