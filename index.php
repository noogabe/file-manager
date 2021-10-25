<?php

/* Criando conexão PDO com o banco de dados Mysql */
include_once('connect.php');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$select = $pdo->query("SELECT * FROM certificados");

?>

<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel='stylesheet' type='text/css' href='css/style.css' media='screen' />

    <title>Certificados</title>
</head>

<body>

    <?php
    
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
                    <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#modalInsert">NOVO CERTIFICADO</button>
                </form>
            </nav>
        </div>
    </header>

    <!-- Modal Insert-->
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
                    <button type="submit" class="btn btn-primary" name="submit">Confirmar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <legend id="title" class="title h2 text-center">Lista de Certificados</legend>

    <!-- Início da grid -->

    <div class="container">

        <div class="row text-center border border-dark border-2">
            <div class="col">
                <div class="fw-bold mb-2 mt-2">
                    Nome do documento
                </div>
            </div>
            <div class="col">
                <div class="fw-bold mb-2 mt-2">
                    Tipo de atividade
                </div>
            </div>
            <div class="col">
                <div class="fw-bold mb-2 mt-2">
                    Horas
                </div>
            </div>
            <div class="col">
                <div class="fw-bold mb-2 mt-2">
                    Status
                </div>
            </div>
        </div>
        <?php

        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
            if ($row->status_documento === '1') $status = "Homologado";
            else $status = "Não-Homologado";

        ?>
            <div class="row text-center border border-top-0 border-dark">
                <div class="col mb-1 mt-1">
                    <a href="arquivos/<?php echo (urlencode($row->id_certificado)); ?>/<?php echo (urlencode($row->file_nome)); ?>"><?php echo ($row->nome_documento); ?></a>
                </div>
                <div class="col mb-1 mt-1">
                    <?php echo ($row->tipo_atividade); ?>
                </div>
                <div class="col mb-1 mt-1">
                    <?php echo ($row->qtde_horas); ?>
                </div>
                <div class="col mb-1 mt-1">
                    <?php echo ($status); ?>
                </div>
            </div>

        <?php }
        ?>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>