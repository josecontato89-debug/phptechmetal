<?php
// 1. Incluir a conexão com o banco de dados
require_once 'conecta.php';

try {
    // 2. QUERY CORRIGIDA: Agora busca da tabela ordem_manutencoes
    // Relaciona com a tabela ativos usando a coluna id_ordem
    $sql = "SELECT a.maquina, COUNT(om.id) AS total 
            FROM ordem_manutencoes om 
            INNER JOIN ativos a ON om.id_ordem = a.id 
            GROUP BY a.maquina
            ORDER BY total DESC";
            
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    // Guardar todos os dados na variável $resultados
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erro na consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gráfico de Manutenções por Máquina</title>
    <script type="text/javascript">
      // Ajuste no carregamento do Google Charts para evitar conflito de execução assíncrona
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Máquina');
        data.addColumn('number', 'Quantidade de Manutenções');
        
        // O PHP injeta os dados dinamicamente aqui!
        data.addRows([
          <?php
          if (count($resultados) > 0) {
              foreach ($resultados as $linha) {
                  echo "['" . addslashes($linha['maquina']) . "', " . (int)$linha['total'] . "],";
              }
          } else {
              // Caso não haja nenhuma máquina com ordem aberta
              echo "['Sem registros de manutenção', 0]";
          }
          ?>
        ]);

        // Configurações do gráfico adaptadas para caber perfeitamente no seu card da Home
        var options = {
          'title': 'Distribuição de Máquinas em Manutenção',
          'width': '100%',
          'height': 350,
          'is3D': true,
          'chartArea': {'width': '95%', 'height': '80%'},
          'legend': {'position': 'bottom'}
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
</head>

<body>
    <div id="chart_div" style="width: 100%; min-height: 350px;"></div>
</body>
</html>