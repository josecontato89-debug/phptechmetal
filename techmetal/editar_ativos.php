<?php
   include 'conecta.php';
   $id = $_POST['id'];
    $maquina = $_POST['maquina'];
    $modelo = $_POST['modelo'];
    $funcionalidade = $_POST['funcionalidade'];
    $n_patrimonio = $_POST['n_patrimonio'];
    $setor = $_POST['setor'];
   
   $sql = "UPDATE ativos SET maquina=:maquina, modelo=:modelo, funcionalidade=:funcionalidade, n_patrimonio=:n_patrimonio, setor=:setor  WHERE id=:id";
   $stmt = $pdo->prepare($sql);
   $stmt->bindParam(':id',$id);
   $stmt->bindParam(':maquina',$maquina);
   $stmt->bindParam(':modelo',$modelo);
   $stmt->bindParam(':funcionalidade',$funcionalidade);
   $stmt->bindParam(':n_patrimonio',$n_patrimonio);
   $stmt->bindParam(':setor',$setor);
   
   $stmt->execute();
   header("location: ativos.php");
?>