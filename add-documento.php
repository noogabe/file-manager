<?php
/* Incluindo conexão PDO com o banco de dados Mysql */
include_once('connect.php');

if (isset($_FILES['upload_documento'])) {
    $arquivo = $_FILES['upload_documento'];

    //Se o parametro erro do arquivo existir, redireciona para a página inicial com error=1
    if ($arquivo['error']) header("Location: index.php?error=1");

    //Recebendo dados do formulario de inserir documento
    $nome = $_POST['nome_documento'];
    $tipo_atividade = $_POST['tipo_atividade'];
    $qtde_horas = $_POST['qtde_horas'];

    //Recebendo nome original e type-extensão do arquivo 
    $file_nome = $_FILES['upload_documento']['name'];
    $file_type = $_FILES['upload_documento']['type'];

    //Data atual
    $file_date = date('Y/m/d');

    $sql = "INSERT INTO documentos (nome_documento, tipo_atividade, qtde_horas, file_nome, file_type, file_date) VALUES (:nome_doc, :tipo_atividade, :qtde_horas, :file_nome, :file_type, :file_date)";
    $insert = $pdo->prepare($sql);
    $insert->bindParam(':nome_doc', $nome);
    $insert->bindParam(':tipo_atividade', $tipo_atividade);
    $insert->bindParam(':qtde_horas', $qtde_horas);
    $insert->bindParam(':file_nome', $file_nome);
    $insert->bindParam(':file_type', $file_type);
    $insert->bindParam(':file_date', $file_date);

    if ($insert->execute()) {

        //Recuperar último ID inserido no banco de dados
        $ultimo_id = $pdo->lastInsertId();

        //Diretório onde o arquivo vai ser salvo
        $diretorio = 'arquivos/' . $ultimo_id . '/';
        //Criar a pasta para armazenar 
        mkdir($diretorio, 0755);

        //Movendo o arquivo enviado para a pasta criada
        if (move_uploaded_file($_FILES['upload_documento']['tmp_name'], $diretorio . $file_nome)) {
            header("Location: index.php?error=2");
        } else {
            header("Location: index.php?error=1");
        }
    } else {
        header("Location: index.php?error=1");
    }
}
