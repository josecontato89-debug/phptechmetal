<?php
   include 'conecta.php';
   $id = $_POST['id'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $objetivo = $_POST['objetivo'];
    $quantidade = $_POST['quantidade'];
   
   $sql = "UPDATE equipamentos SET nome=:nome, tipo=:tipo, objetivo=:objetivo, quantidade=:quantidade WHERE id=:id";
   $stmt = $pdo->prepare($sql);
   $stmt->bindParam(':id',$id);
   $stmt->bindParam(':nome',$nome);
   $stmt->bindParam(':tipo',$tipo);
   $stmt->bindParam(':objetivo',$objetivo);
   $stmt->bindParam(':quantidade',$quantidade);
   
   $stmt->execute();
   header("location: equipamentos.php");
?>