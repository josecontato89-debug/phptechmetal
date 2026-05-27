<?php
    $funcao = $_SESSION['funcao'];
    if ($funcao == "admin"){
       echo "<a href='home.php' style = 'color: black; text-decoration: none; font-weight: bold'>HOME</a>";
       echo "<b> | </b>";
       echo "<a href='setores.php' style = 'color: black; text-decoration: none; font-weight: bold'>SETORES</a>";
       echo "<b> | </b>";
       echo "<a href='ativos.php' style = 'color: black; text-decoration: none; font-weight: bold'>ATIVOS</a>";
       echo "<b> | </b>";
       echo "<a href='equipamentos.php' style = 'color: black; text-decoration: none; font-weight: bold'>EQUIPAMENTOS</a>";
       echo "<b> | </b>";
       echo "<a href='manutencoes.php' style = 'color: black; text-decoration: none; font-weight: bold'>MANUTENÇÕES</a>";
       echo "<b> | </b>";
       echo "<a href='operadores.php' style = 'color: black; text-decoration: none; font-weight: bold'>OPERADORES</a>";
       echo "<b> | </b>";       
       echo "<a href='alocacoes.php' style = 'color: black; text-decoration: none; font-weight: bold'>ALOCAÇÕES</a>";
      
    }
    else if ($funcao == "administrativo"){
       echo "<a href='home.php' style = 'color: black; text-decoration: none; font-weight: bold'>HOME</a>";
       echo "<b> | </b>";
       echo "<a href='setores.php' style = 'color: black; text-decoration: none; font-weight: bold'>SETORES</a>";
       echo "<b> | </b>";
       echo "<a href='ativos.php' style = 'color: black; text-decoration: none; font-weight: bold'>ATIVOS</a>";
       echo "<b> | </b>";
       echo "<a href='equipamentos.php' style = 'color: black; text-decoration: none; font-weight: bold'>EQUIPAMENTOS</a>";
       echo "<b> | </b>";
       echo "<a href='manutencoes.php' style = 'color: black; text-decoration: none; font-weight: bold'>MANUTENÇÕES</a>";
       echo "<b> | </b>";       
       echo "<a href='alocacoes.php' style = 'color: black; text-decoration: none; font-weight: bold'>ALOCAÇÕES</a>";
    }
    else{
        echo "<a href='manutencoes.php' style = 'color: black; text-decoration: none; font-weight: bold'>MANUTENÇÕES</a>";
        echo "<b> | </b>";
        echo "<a href='setores.php' style = 'color: black; text-decoration: none; font-weight: bold'>SETORES</a>";
    }
?>