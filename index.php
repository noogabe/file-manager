<?php

/* Incluindo conexão PDO com o banco de dados Mysql */
include_once('connect.php');

//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$select = $pdo->query("SELECT * FROM certificados");

?>

<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Ajax JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link async href='https://fonts.googleapis.com/icon?family=Material+Icons+Round' rel='stylesheet'>
    <link rel='stylesheet' type='text/css' href='css/style.css' media='screen' />
    <link rel='shortcut icon' href='img/icon.png'>

    <title>Certificados</title>
</head>

<body>

    <?php

    /* Capturando o erro passado pelo GET no link */
    $erro = isset($_GET['error']) ? $_GET['error'] : 0;

    ?>

    <!-- Header com barra superior fixa -->
    <header id="page-header">
        <div class="container" id="nav-container">
            <nav class="navbar navbar-light bg-dark fixed-top">
                <a href="index.php" id="brand-name" class="navbar-brand">
                    <img id="brand-img" src="img/logo.PNG" alt="Grupo tiradentes" width="30" height="30" class="d-inline-block align-text-top">
                    Grupo Tiradentes
                </a>
                <form class="form-inline">
                    <button id="btn_add" type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#modalInsert">
                        <span class='material-icons-round align-middle'>add</span>
                        <strong class="align-middle">Adicionar</strong>
                    </button>
                </form>
            </nav>
        </div>
    </header>

    <!-- Modal inserir novo certificado-->
    <div class="modal fade" id="modalInsert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Novo Certificado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="add-certificado.php" enctype="multipart/form-data">
                        <!-- Campo nome do documento -->
                        <div class="form-floating mb-3">
                            <input type="text" autocomplete="off" class="text-box form-control" id="campo_nome_documento" name="nome_documento" placeholder="Nome do documento" required oninvalid="this.setCustomValidity('Ops, você esqueceu de preencher este campo.')" oninput="setCustomValidity('')">
                            <label for="campo_nome_documento">Nome do documento</label>
                        </div>

                        <!-- Campo tipo do documento -->
                        <div class="form-floating mb-3">
                            <input type="text" autocomplete="off" class="text-box form-control" id="campo_tipo_atividade" name="tipo_atividade" placeholder="Tipo do documento" required oninvalid="this.setCustomValidity('Ops, você esqueceu de preencher este campo.')" oninput="setCustomValidity('')">
                            <label for="campo_tipo_atividade">Tipo de atividade</label>
                        </div>

                        <!-- Campo quantidade de horas -->
                        <div class="form-floating mb-3">
                            <input type="number" autocomplete="off" class="text-box form-control" id="campo_qtde_horas" name="qtde_horas" placeholder="Quantidade de horas" required oninvalid="this.setCustomValidity('Ops, você esqueceu de preencher este campo.')" oninput="setCustomValidity('')">
                            <label for="campo_qtde_horas">Horas</label>
                        </div>

                        <!-- Campo upload documento -->
                        <div>
                            <input type="file" class="text-box form-control" id="campo_upload_documento" name="upload_documento" required oninvalid="this.setCustomValidity('Ops, você esqueceu de selecionar o seu arquivo.')" oninput="setCustomValidity('')">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" name="submit" id="btn_submit">Confirmar</button>
                </div>
                </form>
            </div>
        </div>
    </div><br>

    <br>

    <div>&nbsp;</div>

    <?php

        /* Exibe alertas de sucesso ou erro de acordo com o valor do parâmetro error passado via GET */
        if ($erro == 1) {
            echo "
            <div id='alertError' class='alert alert-danger d-flex alert-dismissible fade show' role='alert'>
                <span class='material-icons-round align-middle'>warning</span>
                <div>
                    Não foi possível adicionar este certificado! 
                </div>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        } else if($erro == 2){
            echo "
            <div id='alertSuccess' class='alert alert-success d-flex alert-dismissible fade show' role='alert'>
                <span class='material-icons-round align-middle'>check_circle</span>
                <div>
                    Certificado adicionado com sucesso. 
                </div>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }

        ?>

    <legend id="title" class="title h2 text-center">Lista de Certificados</legend>

    <!-- Início da grid -->

    <div class="container">

        <div class="row text-left">
            <div class="col">
                <div class="fw-bold">
                    Nome do documento
                </div>
            </div>
            <div class="col">
                <div class="fw-bold">
                    Tipo de atividade
                </div>
            </div>
            <div class="col">
                <div class="fw-bold">
                    Horas
                </div>
            </div>
            <div class="col">
                <div class="fw-bold">
                    Status
                </div>
            </div>
        </div>
        <?php

        /* Se o valor booleano de status_documento for 1 então Homologado, senão Não-Homologado */
        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
            if ($row->status_documento === '1') $status = "Homologado";
            else $status = "Não-Homologado";

        ?>  
            <!-- Exibe os certificados cadastrados e na coluna nome_documento exibe um link
                com o caminho para fazer download do documento -->
            <div class="row text-left">
                <div class="col">
                    <a href="arquivos/<?php echo (urlencode($row->id_certificado)); ?>/<?php echo (urlencode($row->file_nome)); ?>"><?php echo ($row->nome_documento); ?></a>
                </div>
                <div class="col">
                    <?php echo ($row->tipo_atividade); ?>
                </div>
                <div class="col">
                    <?php echo ($row->qtde_horas); ?>
                </div>
                <div class="col">
                    <?php echo ($status); ?>
                </div>
            </div>

        <?php } ?>

        
    </div>

    <script>
        /* Faz os alertas desaparecerem automaticamente após 5 segundos */
        $(document).ready(function(){
            setTimeout(function(){
                $('.alert').alert('close');
            }, 5000);
        });

    </script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>