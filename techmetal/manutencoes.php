<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header('Location: index.php?status=erro&msg=Acesso Negado');
    exit();
}

$nome = $_SESSION['nome'];
$funcao = $_SESSION['funcao'];
if($funcao != "admin"){
    header('location: home.php?status=erro&msg=Acesso Negado');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-language" content="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="imagens/banner.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>MANUTENÇÃO</title>

    <style>
        
        .header {
            float: right;
        }
    </style>
</head>

<body>

<!-- HEADER -->
<div class="container-fluid" style=" text-align:left; position:relative;">
<img src="imagens/banner.png"  alt="" whidth = "900"  height = "300" srcset="">

    <div class="header" style="position:absolute; top:10px; right:10px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="25" fill="currentColor" class="bi bi-wrench-adjustable-circle-fill" viewBox="0 0 16 16">
  <path d="M6.705 8.139a.25.25 0 0 0-.288-.376l-1.5.5.159.474.808-.27-.595.894a.25.25 0 0 0 .287.376l.808-.27-.595.894a.25.25 0 0 0 .287.376l1.5-.5-.159-.474-.808.27.596-.894a.25.25 0 0 0-.288-.376l-.808.27z"/>
  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m-6.202-4.751 1.988-1.657a4.5 4.5 0 0 1 7.537-4.623L7.497 6.5l1 2.5 1.333 3.11c-.56.251-1.18.39-1.833.39a4.5 4.5 0 0 1-1.592-.29L4.747 14.2a7.03 7.03 0 0 1-2.949-2.951M12.496 8a4.5 4.5 0 0 1-1.703 3.526L9.497 8.5l2.959-1.11q.04.3.04.61"/>
</svg>

        <b><?= htmlspecialchars($nome) ?></b> |
        <a href="sair.php" style="color:black; text-decoration:none; font-weight:bold;">SAIR</a>
    </div>
</div>

<br/>
        <nav>
            <?php
                include 'menu.php';
            ?>
        </nav>

<!-- BOTÃO -->
<div class="text-center my-3">
    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
        CADASTRAR MANUTENÇÕES
    </button>
</div>

<!-- TABELA -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-4">

            <div class="card shadow border-2">
                <div class="card-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-wrench-adjustable-circle-fill" viewBox="0 0 16 16">
  <path d="M6.705 8.139a.25.25 0 0 0-.288-.376l-1.5.5.159.474.808-.27-.595.894a.25.25 0 0 0 .287.376l.808-.27-.595.894a.25.25 0 0 0 .287.376l1.5-.5-.159-.474-.808.27.596-.894a.25.25 0 0 0-.288-.376l-.808.27z"/>
  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m-6.202-4.751 1.988-1.657a4.5 4.5 0 0 1 7.537-4.623L7.497 6.5l1 2.5 1.333 3.11c-.56.251-1.18.39-1.833.39a4.5 4.5 0 0 1-1.592-.29L4.747 14.2a7.03 7.03 0 0 1-2.949-2.951M12.496 8a4.5 4.5 0 0 1-1.703 3.526L9.497 8.5l2.959-1.11q.04.3.04.61"/>
</svg>

                    <b>SERVIÇOS EM ANDAMENTO</b>
                </div>

                <div class="card-body">

                    <?php
                    include 'conecta.php';
                   

                    $sql = "SELECT * FROM manutencoes ORDER BY prioridade";
                    $consulta = $pdo->query($sql);
                    $listaservicos = $consulta->fetchAll(PDO::FETCH_ASSOC);

                    if (count($listaservicos) > 0) {

                        echo "<table class='table table-hover align-middle'>";
                        echo "<thead class='table-light'>
                                <tr>
                                    <th>ID</th>
                                    <th>PROBLEMA</th>
                                    <th>PRIORIDADE</th>
                                    <th>DATA DE INICIO</th>
                                    <th>DATA DE TERMINO</th>
                                    
                                    
                                </tr>
                              </thead>";

                        echo "<tbody>";

                        foreach ($listaservicos as $item) {
                            $id = $item['id'];
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($item['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['problema']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['prioridade']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['data_inicio']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['data_fim']) . "</td>";
                           
                            echo "<td><a href='#' data-bs-toggle='modal' data-bs-target='#modalEditar' data-id='$id'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eraser-fill' viewBox='0 0 16 16'>
                            <path d='M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828zm.66 11.34L3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293z'/>
                          </svg></a> | <a href ='excluir_manutencao.php?id=$id'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill text-danger' viewBox='0 0 16 16'>
                            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                          </svg></a></td>";
                            echo "</tr>";
                        }

                        echo "</tbody>";
                        echo "</table>";

                    } else {
                        echo "<p class='text-danger'><b>NÃO EXISTEM MANUTENÇÕES CADASTRADAS NO MOMENTO!</b></p>";
                    }
                    ?>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- JS Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- MODAL -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
            <<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-wrench-adjustable-circle-fill" viewBox="0 0 16 16">
  <path d="M6.705 8.139a.25.25 0 0 0-.288-.376l-1.5.5.159.474.808-.27-.595.894a.25.25 0 0 0 .287.376l.808-.27-.595.894a.25.25 0 0 0 .287.376l1.5-.5-.159-.474-.808.27.596-.894a.25.25 0 0 0-.288-.376l-.808.27z"/>
  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m-6.202-4.751 1.988-1.657a4.5 4.5 0 0 1 7.537-4.623L7.497 6.5l1 2.5 1.333 3.11c-.56.251-1.18.39-1.833.39a4.5 4.5 0 0 1-1.592-.29L4.747 14.2a7.03 7.03 0 0 1-2.949-2.951M12.496 8a4.5 4.5 0 0 1-1.703 3.526L9.497 8.5l2.959-1.11q.04.3.04.61"/>
</svg>&nbsp; &nbsp; <h5 class="modal-title">CADASTRO DE MANUTENÇÕES</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form action="cadastro_manutencoes.php" method="POST">
                <label class="form-label">PROBLEMA</label>
                <input type="text" name="problema" class="form-control" required/>
                <br/> 
                <label class="form-label">PRIORIDADE</label>
                <select type="text" name="prioridade" class="form-select" required>
                <option value="ALTA">ALTA</option>
                <option value="MEDIA">MEDIA</option>
                <option value="BAIXA">BAIXA</option>
                </select>
                <br/> 
                <label class="form-label">DATA DE INICIO</label>
                <input type="date" name="data_inicio" class="form-control" required/>
                <br/> 
                <label class="form-label">DATA DE TERMINO</label>
                <input type="date" name="data_fim" class="form-control" required/>
                <br/> 
                
                <br/> 
                
                <button type="submit" class="btn btn-outline-success">CADASTRAR </button>    
                </form>
            </div>
            <div class="modal-footer">  
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">FECHAR</button>
                
            </div>

        </div>

    </div>
</div>
<!-- Janela modal - editar pessoas-->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-wrench-adjustable-circle-fill" viewBox="0 0 16 16">
  <path d="M6.705 8.139a.25.25 0 0 0-.288-.376l-1.5.5.159.474.808-.27-.595.894a.25.25 0 0 0 .287.376l.808-.27-.595.894a.25.25 0 0 0 .287.376l1.5-.5-.159-.474-.808.27.596-.894a.25.25 0 0 0-.288-.376l-.808.27z"/>
  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m-6.202-4.751 1.988-1.657a4.5 4.5 0 0 1 7.537-4.623L7.497 6.5l1 2.5 1.333 3.11c-.56.251-1.18.39-1.833.39a4.5 4.5 0 0 1-1.592-.29L4.747 14.2a7.03 7.03 0 0 1-2.949-2.951M12.496 8a4.5 4.5 0 0 1-1.703 3.526L9.497 8.5l2.959-1.11q.04.3.04.61"/>
</svg>&nbsp; &nbsp; <h5 class="modal-title" id="modalEditar">EDIÇÂO DE MANUTENÇÃO</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
           <div class="modal-body">
           <form action="editar_manutencoes.php" method="POST">
            <input type="hidden" id="edit_id" name="id"/>
            <label class="form-label">PROBLEMA</label>
                <input type="text" name="problema" class="form-control" id="edit_problema" required/>
                <br/> 
                <label class="form-label">PRIORIDADE</label>
                <select type="text" name="prioridade" class="form-select" id="edit_prioridade" required>
                <option value="ALTA">ALTA</option>
                <option value="MEDIA">MEDIA</option>
                <option value="BAIXA">BAIXA</option>
                </select>
                <br/> 
                <label class="form-label">DATA DE INICIO</label>
                <input type="date" name="data_inicio" class="form-control" id="edit_data_inicio" required/>
                <br/> 
                <label class="form-label">DATA DE TERMINO</label>
                <input type="date" name="data_fim" class="form-control" id="edit_data_fim" required/>
                <br/> 
                
                <button type="submit" class="btn btn-outline-success">ATUALIZAR </button>    
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
        let id =button.getAttribute('data-id');
        fetch('buscar_manutencoes.php?id=' +id)
           .then(response=>response.json())
           .then(data=>{
               document.getElementById('edit_id').value = data.id;
               document.getElementById('edit_problema').value = data.problema;
               document.getElementById('edit_prioridade').value = data.prioridade;
               document.getElementById('edit_data_inicio').value = data.data_inicio;
               document.getElementById('edit_data_fim').value = data.data_fim;
               
           });
    })
</script>
</body>
</html>