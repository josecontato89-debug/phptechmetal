<?php
   include 'conecta.php';
   $id = $_POST['id'];
    $problema = $_POST['problema'];
    $prioridade = $_POST['prioridade'];
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];
   
   $sql = "UPDATE manutencoes SET problema=:problema, prioridade=:prioridade, data_inicio=:data_inicio, data_fim=:data_fim WHERE id=:id";
   $stmt = $pdo->prepare($sql);
   $stmt->bindParam(':id',$id);
   $stmt->bindParam(':problema',$problema);
   $stmt->bindParam(':prioridade',$prioridade);
   $stmt->bindParam(':data_inicio',$data_inicio);
   $stmt->bindParam(':data_fim',$data_fim);
   
   $stmt->execute();
   header("location: manutencoes.php");
?>