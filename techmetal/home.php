<?php
    session_start();
    if (!isset($_SESSION['nome'])) {
        header('Location: index.php?status=erro&msg=Acesso negado');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-language" content="pt-br">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="imagens/logo_aba.png" type="image/png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        
        <title>Mecanica</title>
        <style>
            .header {
                float: right;
            }
            .texto-destaque{
                font-size: 24px;
                color: #005B74;
                font-weight:bold
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <img src="imagens/banner.png" alt="" width="900" height="300">
            <?php
                echo "<div class='header'>";
                if (isset($_SESSION['nome'])) {
                    $nome = $_SESSION['nome'];
                    echo "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-person-circle' viewBox='0 0 16 16'>
                        <path d='M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0'/>
                        <path fill-rule='evenodd' d='M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1'/>
                        </svg>&nbsp;<b>".$nome."</b> | <a href='sair.php' style='color: black; text-decoration: none; font-weight: bold;'>SAIR</a>";
                }
                echo "</div>";
            ?>
        </div>
        <br/>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <nav>
            <?php
                include 'menu.php';
            ?>
        </nav>
        <br/>
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card shadow border-2">
                        <div class="card-header bg-gray border-bottom py-3">
                            <span class="texto-destaque">Manutenções Ativas</span>
                        </div>
                        <div class="card-body" style="text-align: center;">
                            <?php 
                            $meses = [
                                1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
                                5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
                                9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
                            ];
                            $mes_atual = $meses[(int)date('m')];
                            $ano_atual = date('Y');

                            echo "<p class='text-muted'>Máquinas atualmente em manutenção e reparos:</p>";
                            
                            include 'conecta.php';
                            
                            // Query ajustada para buscar as ordens ativas contando quantas manutenções cada máquina possui no momento
                            $sql = "SELECT a.maquina, COUNT(om.id) AS total_no_mes 
                                    FROM ordem_manutencoes om 
                                    INNER JOIN ativos a ON om.id_ordem = a.id 
                                    GROUP BY a.maquina 
                                    ORDER BY total_no_mes DESC";
                                    
                            $consulta = $pdo->query($sql);
                            $listaordens = $consulta->fetchAll(PDO::FETCH_ASSOC);
                            
                            if (count($listaordens) > 0) {
                                echo "<table class='table table-hover align-middle'>";
                                echo "<thead class='table-light'>
                                        <tr>
                                            <th>MÁQUINA EM MANUTENÇÃO</th>
                                            <th>ORDENS ABERTAS</th>
                                        </tr>
                                      </thead><tbody>";
                                
                                foreach ($listaordens as $item) {
                                    echo "<tr>";
                                    echo "<td style='text-align: left; padding-left: 20px;'>" . htmlspecialchars($item['maquina']) . "</td>";
                                    echo "<td><span class='badge bg-warning text-dark fs-6'>" . htmlspecialchars($item['total_no_mes']) . "</span></td>";
                                    echo "</tr>";
                                }
                                
                                echo "</tbody></table>";
                            } else {
                                echo "<p class='text-danger'><b>NÃO EXISTEM MÁQUINAS EM MANUTENÇÃO NO MOMENTO!</b></p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card shadow border-2">
                        <div class="card-header bg-gray border-bottom py-3">
                            <span class="texto-destaque">GRÁFICO INDICADOR</span>
                        </div>
                        <div class="card-body">
                            <?php
                                // Inclui o arquivo do gráfico que processa os dados de ordem_manutencoes
                                include 'graf_manutencoes.php';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>