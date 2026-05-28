<?php
   include 'conecta.php';
   $id = $_POST['id'];
   $nome = $_POST['nome'];
   $cpf = $_POST['cpf'];
   $funcao = $_POST['funcao'];
   $genero = $_POST['genero'];
   $login = $_POST['login'];
   $senha = $_POST['senha'];
   $sql = "UPDATE operadores SET nome=:nome,cpf=:cpf,funcao=:funcao,genero=:genero,login=:login,senha=:senha WHERE id=:id";
   $stmt = $pdo->prepare($sql);
   $stmt->bindParam(':id',$id);
   $stmt->bindParam(':nome',$nome);
   $stmt->bindParam(':cpf',$cpf);
   $stmt->bindParam(':funcao',$funcao);
   $stmt->bindParam(':genero',$genero);
   $stmt->bindParam(':login',$login);
   $stmt->bindParam(':senha',$senha);
   $stmt->execute();
   header("location: operadores.php");
?>