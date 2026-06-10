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
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-language" content="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="imagens/banner.png" type="image/png" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Ativos</title>

    <style>
        

        .header {
            float: right;
        }
    </style>
</head>

<body>

<!-- HEADER -->
<div class="container-fluid" style=" text-align:left; position:relative;">
<img src="imagens/banner.png"alt="" whidth = "900"  height = "300" srcset="">

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
            <?php 

                include 'menu.php';
            ?>
            </br>
            <?php echo $funcao; ?> 
        </nav>

<!-- BOTÃO -->
<div class="text-center my-3">
    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
        CADASTRAR ATIVOS
    </button>
</div>

<!-- TABELA -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-4">

            <div class="card shadow border-2">
                <div class="card-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-house-gear" viewBox="0 0 16 16">
  <path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.708L8 2.207l-5 5V13.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 2 13.5V8.207l-.646.647a.5.5 0 1 1-.708-.708z"/>
  <path d="M11.886 9.46c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.044c-.613-.181-.613-1.049 0-1.23l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
</svg>

                    <b>ATIVOS CADASTRADOS</b>
                </div>

                <div class="card-body">

                    <?php
                    include 'conecta.php';

                    $sql = "SELECT * FROM ativos ORDER BY maquina";
                    $consulta = $pdo->query($sql);
                    $listaativos = $consulta->fetchAll(PDO::FETCH_ASSOC);

                    if (count($listaativos) > 0) {

                        echo "<table class='table table-hover align-middle'>";
                        echo "<thead class='table-light'>
                                <tr>
                                    <th>ID</th>
                                    <th>MAQUINA</th>
                                    <th>MODELO</th>
                                    <th>FUNÇÂO</th>
                                    <th>Nº PATRIMONIO</th>
                                    <th>SETOR</th>
                                    
                                </tr>
                              </thead>";

                        echo "<tbody>";

                        foreach ($listaativos as $item) {
                            $id = $item['id'];
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($item['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['maquina']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['modelo']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['funcionalidade']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['n_patrimonio']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['setor']) . "</td>";
                            
                            echo "<td><a href='#' data-bs-toggle='modal' data-bs-target='#modalEditar' data-id='$id'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eraser-fill' viewBox='0 0 16 16'>
                            <path d='M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828zm.66 11.34L3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293z'/>
                          </svg></a> | <a href ='excluir_ativos.php?id=$id'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill text-danger' viewBox='0 0 16 16'>
                            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                          </svg></a></td>";
                            echo "</tr>";
                        }

                        echo "</tbody>";
                        echo "</table>";

                    } else {
                        echo "<p class='text-danger'><b>NÃO EXISTEM ATIVOS CADASTRADOS NO MOMENTO!</b></p>";
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
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-house-gear" viewBox="0 0 16 16">
  <path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.708L8 2.207l-5 5V13.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 2 13.5V8.207l-.646.647a.5.5 0 1 1-.708-.708z"/>
  <path d="M11.886 9.46c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.044c-.613-.181-.613-1.049 0-1.23l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
</svg>&nbsp; &nbsp; <h5 class="modal-title">CADASTRO DE ATIVOS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form action="cadastro_ativos.php" method="POST">
                <label class="form-label">MAQUINA</label>
                <input type="text" name="maquina" class="form-control" required/>
                <br/> 
                <label class="form-label">MODELO</label>
                <input type="text" name="modelo" class="form-control" required/>
                <br/> 
                <label class="form-label">FUNÇÂO</label>
                <input type="text" name="funcionalidade" class="form-control" required/>
                <br/> 
                <label class="form-label">Nº PATRIMONIO</label>
                <input type="number" name="n_patrimonio" class="form-control" required/>
                <br/> 
                <label class="form-label">SETOR</label>
                <input type="text" name="setor" class="form-control" required/>
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
      <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-house-gear" viewBox="0 0 16 16">
  <path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.708L8 2.207l-5 5V13.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 2 13.5V8.207l-.646.647a.5.5 0 1 1-.708-.708z"/>
  <path d="M11.886 9.46c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.044c-.613-.181-.613-1.049 0-1.23l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
</svg>&nbsp; &nbsp; <h5 class="modal-title" id="modalEditar">EDIÇÂO DE SETORES</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
           <div class="modal-body">
           <form action="editar_ativos.php" method="POST">
            <input type="hidden" id="edit_id" name="id"/>
                <label class="form-label">MAQUINA</label>
                <input type="text" name="maquina" class="form-control" id="edit_maquina" required/>
                <br/> 
                <label class="form-label">MODELO</label>
                <input type="text" name="modelo" class="form-control" id="edit_modelos" required/>
                <br/> 
                <label class="form-label">FUNÇÃO</label>
                <input type="text" name="funcionalidade" class="form-control" id="edit_funcionalidade" required/>
                <br/> 
                <label class="form-label">Nº PATRIMONIO</label>
                <input type="number" name="n_patrimonio" class="form-control" id="edit_n_patrimonio" required/>
                <br/>
                <label class="form-label">SETOR</label>
                <input type="text" name="setor" class="form-control" id="edit_setor" required/>
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
        fetch('buscar_ativos.php?id=' +id)
           .then(response=>response.json())
           .then(data=>{
               document.getElementById('edit_id').value = data.id;
               document.getElementById('edit_maquina').value = data.maquina;
               document.getElementById('edit_modelo').value = data.modelo;
               document.getElementById('edit_funcionalidade').value = data.funcionalidade;
               document.getElementById('edit_n_patrimonio').value = data.n_patrimonio;
               document.getElementById('edit_setor').value = data.setor;
              
           });
    })
</script>
</body>
</html>