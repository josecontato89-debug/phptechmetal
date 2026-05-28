<?php 
  include 'conecta.php';
  $id = $_GET['id'];
  $sql = "SELECT * FROM operadores WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $usuario= $stmt->fetch(PDO::FETCH_ASSOC);
  echo json_encode($usuario);
?>