<?php 
  include 'conecta.php';
  $id = $_GET['id'];
  $sql = "SELECT * FROM ativos WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $ativos= $stmt->fetch(PDO::FETCH_ASSOC);
  echo json_encode($ativos);
?>