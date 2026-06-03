<?php
   include 'conecta.php';
   $id = $_POST['id'];
    $maquina = $_POST['maquina'];
    $data_movimentacao = $_POST['data_movimentacao'];
    $setor_atual = $_POST['setor_atual'];
    $setor_anterior = $_POST['setor_anterior'];
    $responsavel = $_POST['responsavel'];
   
   $sql = "UPDATE alocacoes SET maquina=:maquina, data_movimentacao=:data_movimentacao, setor_atual=:setor_atual, setor_anterior=:setor_anterior, responsavel=:responsavel WHERE id=:id";
   $stmt = $pdo->prepare($sql);
   $stmt->bindParam(':id',$id);
   $stmt->bindParam(':maquina',$maquina);
   $stmt->bindParam(':data_movimentacao',$data_movimentacao);
   $stmt->bindParam(':setor_atual',$setor_atual);
   $stmt->bindParam(':setor_anterior',$setor_anterior);
   $stmt->bindParam(':responsavel',$responsavel);
   
   $stmt->execute();
   header("location: alocacoes.php");
?>