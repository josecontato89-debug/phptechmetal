<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header('Location: index.php?status=erro&msg=Acesso Negado');
    exit();
}
$funcao = $_SESSION['funcao'];
if($funcao != "admin"){
    header('location: home.php?status=erro&msg=Acesso Negado');
    exit();
}
$nome = $_SESSION['nome'];
include 'conecta.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-language" content="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="imagens/banner.png" type="image/png" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Ordens de Manutenção</title>
    <style>
        .header {
            float: right;
        }
    </style>
</head>

<body>

<div class="container-fluid" style="text-align:left; position:relative;">
    <img src="imagens/banner.png" alt="" width="900" height="300">
    <div class="header" style="position:absolute; top:10px; right:10px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
          <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
        </svg>
        <b><?= htmlspecialchars($nome) ?></b> |
        <a href="sair.php" style="color:black; text-decoration:none; font-weight:bold;">SAIR</a>
    </div>
</div>

<br/>
<nav>
    <?php include 'menu.php'; ?>
    <br/>
    <?php echo $funcao; ?> 
</nav>

<div class="text-center my-3">
    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalOrdem">
        ABRIR ORDEM DE MANUTENÇÃO
    </button>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 mb-4">
            <div class="card shadow border-2">
                <div class="card-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-paperclip" viewBox="0 0 16 16">
  <path d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0z"/>
</svg>
                    <b>ORDENS DE MANUTENÇÃO ATIVAS</b>
                </div>

                <div class="card-body">
                    <?php
                    // SQL Adaptado para trazer o nome da máquina a partir da tabela ativos (usando a coluna id_ordem para salvar o id do ativo)
                    $sql = "SELECT om.id, ati.maquina AS maquina_nome, eq.nome AS equipamento_nome, m.problema, m.prioridade, m.data_inicio, m.data_fim 
                            FROM ordem_manutencoes om
                            INNER JOIN ativos ati ON om.id_ordem = ati.id
                            INNER JOIN equipamentos eq ON om.equipamentos = eq.id
                            INNER JOIN manutencoes m ON om.manutencao = m.id
                            ORDER BY om.id DESC";
                    
                    $consulta = $pdo->query($sql);
                    $listaOrdens = $consulta->fetchAll(PDO::FETCH_ASSOC);

                    if (count($listaOrdens) > 0) {
                        echo "<table class='table table-hover align-middle'>";
                        echo "<thead class='table-light'>
                                <tr>
                                    <th>ID</th>
                                    <th>MÁQUINA EM MANUTENÇÃO</th>
                                    <th>EQUIPAMENTO UTILIZADO</th>
                                    <th>DESCRIÇÃO DO PROBLEMA</th>
                                    <th>INÍCIO</th>
                                    <th>PREVISÃO FIM</th>
                                    <th>AÇÕES</th>
                                </tr>
                              </thead><tbody>";

                        foreach ($listaOrdens as $item) {
                            $id = $item['id'];
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($item['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['maquina_nome']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['equipamento_nome']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['problema']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['data_inicio']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['data_fim']) . "</td>";
                            echo "<td>
                                    <a href='#' data-bs-toggle='modal' data-bs-target='#modalEditar' data-id='$id'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eraser-fill' viewBox='0 0 16 16'>
                                          <path d='M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828zm.66 11.34L3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293z'/>
                                        </svg>
                                    </a> | 
                                    <a href='excluir_ordem.php?id=$id' onclick=\"return confirm('Deseja realmente remover esta ordem de manutenção?');\">
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill text-danger' viewBox='0 0 16 16'>
                                          <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                                        </svg>
                                    </a>
                                  </td>";
                            echo "</tr>";
                        }
                        echo "</tbody></table>";
                    } else {
                        echo "<p class='text-danger text-center'><b>NÃO EXISTEM ORDENS DE MANUTENÇÃO NO MOMENTO!</b></p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalOrdem" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">NOVA ORDEM DE MANUTENÇÃO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="cadastrar_ordem.php" method="POST">
                    
                    <label class="form-label">SELECIONE A MÁQUINA (ATIVO)</label>
                    <select name="id_ordem" class="form-select" required>
                        <option value="">-- Escolha uma Máquina cadastrada --</option>
                        <?php
                        $queryAtivos = $pdo->query("SELECT id, maquina FROM ativos ORDER BY maquina");
                        while($ativo = $queryAtivos->fetch(PDO::FETCH_ASSOC)){
                            echo "<option value='".$ativo['id']."'>".htmlspecialchars($ativo['maquina'])."</option>";
                        }
                        ?>
                    </select>
                    <br/> 

                    <label class="form-label">EQUIPAMENTO UTILIZADO</label>
                    <select name="equipamentos" class="form-select" required>
                        <option value="">-- Selecione o Equipamento --</option>
                        <?php
                        $queryEq = $pdo->query("SELECT id, nome FROM equipamentos ORDER BY nome");
                        while($eq = $queryEq->fetch(PDO::FETCH_ASSOC)){
                            echo "<option value='".$eq['id']."'>".htmlspecialchars($eq['nome'])."</option>";
                        }
                        ?>
                    </select>
                    <br/>

                    <label class="form-label">MANUTENÇÃO / PROCEDIMENTO VINCULADO</label>
                    <select name="manutencao" class="form-select" required>
                        <option value="">-- Selecione a Ficha de Manutenção --</option>
                        <?php
                        $queryMat = $pdo->query("SELECT id, problema, equipamentos FROM manutencoes ORDER BY id DESC");
                        while($mat = $queryMat->fetch(PDO::FETCH_ASSOC)){
                            echo "<option value='".$mat['id']."'>Nº ".$mat['id']." - Para: ".htmlspecialchars($mat['equipamentos'])." (".htmlspecialchars($mat['problema']).")</option>";
                        }
                        ?>
                    </select>
                    <br/> 
                    
                    <button type="submit" class="btn btn-outline-success w-100">CADASTRAR ORDEM</button>    
                </form>
            </div>
            <div class="modal-footer">  
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">FECHAR</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title">EDIÇÃO DE ORDENS</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
           <form action="editar_ordem.php" method="POST">
                <input type="hidden" id="edit_id" name="id"/>
                
                <label class="form-label">MÁQUINA EM MANUTENÇÃO (ATIVO)</label>
                <select name="id_ordem" id="edit_id_ordem" class="form-select" required>
                    <?php
                    $queryAtivos2 = $pdo->query("SELECT id, maquina FROM ativos ORDER BY maquina");
                    while($ativo2 = $queryAtivos2->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value='".$ativo2['id']."'>".htmlspecialchars($ativo2['maquina'])."</option>";
                    }
                    ?>
                </select>
                <br/> 

                <label class="form-label">EQUIPAMENTO UTILIZADO</label>
                <select name="equipamentos" id="edit_equipamentos" class="form-select" required>
                    <?php
                    $queryEq2 = $pdo->query("SELECT id, nome FROM equipamentos ORDER BY nome");
                    while($eq2 = $queryEq2->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value='".$eq2['id']."'>".htmlspecialchars($eq2['nome'])."</option>";
                    }
                    ?>
                </select>
                <br/>

                <label class="form-label">MANUTENÇÃO / PROCEDIMENTO VINCULADO</label>
                <select name="manutencao" id="edit_manutencao" class="form-select" required>
                    <?php
                    $queryMat2 = $pdo->query("SELECT id, problema, equipamentos FROM manutencoes ORDER BY id DESC");
                    while($mat2 = $queryMat2->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value='".$mat2['id']."'>Nº ".$mat2['id']." - Para: ".htmlspecialchars($mat2['equipamentos'])." (".htmlspecialchars($mat2['problema']).")</option>";
                    }
                    ?>
                </select>
                <br/> 
                
                <button type="submit" class="btn btn-outline-success w-100">ATUALIZAR ORDEM</button>    
           </form>       
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">FECHAR</button>
      </div>
    </div>
  </div>
</div>

<script>
    document.getElementById('modalEditar').addEventListener('show.bs.modal', function(event){
        let button = event.relatedTarget;
        let id = button.getAttribute('data-id');
        fetch('buscar_ordem.php?id=' + id)
           .then(response => response.json())
           .then(data => {
               document.getElementById('edit_id').value = data.id;
               document.getElementById('edit_id_ordem').value = data.id_ordem;
               document.getElementById('edit_equipamentos').value = data.equipamentos;
               document.getElementById('edit_manutencao').value = data.manutencao;
           });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>