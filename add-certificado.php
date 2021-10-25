<?php

include_once ('connect.php');

if(isset($_FILES['upload_documento'])){
    $arquivo = $_FILES['upload_documento'];

    if($arquivo['error']) header("Location: index.php?error=1");

    //Recebendo dados do formulario
    $nome = $_POST['nome_documento'];
    $tipo_atividade = $_POST['tipo_atividade'];
    $qtde_horas = $_POST['qtde_horas'];

    //Recebendo nome do arquivo
    $file_nome = $_FILES['upload_documento']['name'];

    $sql = "INSERT INTO certificados (nome_documento, tipo_atividade, qtde_horas, file_nome) VALUES (:nome_doc, :tipo_atividade, :qtde_horas, :file_nome)";
    $insert = $pdo->prepare($sql);
    $insert->bindParam(':nome_doc', $nome);
    $insert->bindParam(':tipo_atividade', $tipo_atividade);
    $insert->bindParam(':qtde_horas', $qtde_horas);
    $insert->bindParam(':file_nome', $file_nome);

    if ($insert->execute()) {
        //Recuperar último ID inserido no banco de dados
        $ultimo_id = $pdo->lastInsertId();

        //Diretório onde o arquivo vai ser salvo
        $diretorio = 'arquivos/' . $ultimo_id.'/';

        //Criar a pasta para armazenar 
        mkdir($diretorio, 0777);

        if(move_uploaded_file($_FILES['upload_documento']['tmp_name'], $diretorio.$file_nome)){
            header("Location: index.php?success");
        }else{
            header("Location: index.php?error=1");
        }
    }
    
    else{
        header("Location: index.php?error=1");
    } 
    
}

 ?>