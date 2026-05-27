<!DOCTYPE html>
<html lang="pt-br" >

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-language" content="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="imagens/mechanic.png" type="image/png">
    <title> TechMetal </title>
    <style>
        body {
            background-color: #DCDCDC;
        }
        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    
    <body >
    
        
        <div class="container-fluid" style=" text-align: left;">
            <img src="Imagens/banner.png" alt="" whidth = "900"  height = "300" srcset="">
            
        </div>
        
        <br />
        <br />

    <div class="container">
        <div class="row justify-content-center" style="backgroud-color: #DCDCDC">
            <div class="col-md-4 card mb-4 rounded-3 shadow-sm text-start p-0">
                <img src="" alt="" srcset="">
                <div class="card-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#1E90FF" class="bi bi-person-check" viewBox="0 0 16 16">
                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                    <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                    </svg>&nbsp;&nbsp;<b>LOGIN ADMINISTRATIVO</b>
                </div>
                <div class="card-body" >
                    <form name="login" action="login.php" method="POST">
                        <label class="form-label"><b>LOGIN</b></label>
                        <input class="form-control" name="login" type="text" required />
                        <br />
                        <label class="form-label"><b>SENHA</b></label>
                        <input class="form-control" name="senha" type="password" required />
                        <br />
                        <button type="submit" class="btn btn-success">ENVIAR</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>