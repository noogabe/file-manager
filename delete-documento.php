<?php

/* Incluindo conexão PDO com o banco de dados Mysql */
include_once('connect.php');

/* Função deletar diretório recursivamente */
function deleteDirectory($diretorio){

    /* Verifico se realmente é um diretorio */
    if (is_dir($diretorio)) {

        /* Busco todos os arquivos que estão dentro da pasta */
        $files = scandir($diretorio);

        /* Deleto um a um */
        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                if (filetype($diretorio . DIRECTORY_SEPARATOR . $file) == "dir") {

                    /* Se dentro da pasta conter outra pasta, deleto ela também recursivamente */
                    deleteDirectory($diretorio . DIRECTORY_SEPARATOR . $file);
                } else {
                    unlink($diretorio . DIRECTORY_SEPARATOR . $file);
                }
            }
        }
        reset($files);
        rmdir($diretorio);
    }
}

/* Recebendo valor do array input name id_documento na posição zero */
$id_documento = $_POST['id_documento'][0];

if (isset($id_documento)) {

    /* Removendo do banco de dados */
    $sql = $pdo->prepare('DELETE FROM documentos WHERE id_documento = :id_documento');
    $sql->bindParam(':id_documento', $id_documento);
    $sql->execute();

    /* Removendo arquivo do diretório */
    $diretorio = "arquivos/" . $id_documento;
    deleteDirectory($diretorio);

    header("Location: index.php?error=3");
} else {
    header("Location: index.php?error=4");
}
