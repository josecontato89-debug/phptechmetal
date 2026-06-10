<?php 
  include 'conecta.php';
  $id = $_GET['id'];
  $sql = "SELECT * FROM setores WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $setor= $stmt->fetch(PDO::FETCH_ASSOC);
  echo json_encode($setor);
?>