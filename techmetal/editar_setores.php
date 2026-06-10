<?php
   include 'conecta.php';
   $id = $_POST['id'];
   $setor = $_POST['setor'];
   $quant_funcionarios = $_POST['quant_funcionarios'];
   $funcao = $_POST['funcao'];
   
   $sql = "UPDATE setores SET setor=:setor,quant_funcionarios=:quant_funcionarios,funcao=:funcao WHERE id=:id";
   $stmt = $pdo->prepare($sql);
   $stmt->bindParam(':id',$id);
   $stmt->bindParam(':setor',$setor);
   $stmt->bindParam(':quant_funcionarios',$quant_funcionarios);
   $stmt->bindParam(':funcao',$funcao);
   
   $stmt->execute();
   header("location: setores.php");
?>