<?php
     require_once("_sessao.php");
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $id= filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
        $fotobd = filter_input(INPUT_POST,"fotobd",FILTER_SANITIZE_SPECIAL_CHARS);
        $dir_fotos = "./imagens/";
        
        require_once("./_conexao/conexao.php");

        $sql = "DELETE FROM `login` 
                    WHERE `idLogin` = :id";

        $comandoSQL = $conexao->prepare($sql);

        $comandoSQL->bindParam(':id', $id, PDO::PARAM_STR);

        $comandoSQL->execute();

        if($comandoSQL->rowCount() == 1){
            //echo "Usuário EXCLUÍDO com sucesso!";

            // exclui um arquivo do disco
            unlink($dir_fotos.$fotobd);
            header("Location: ./view-login.php");
            exit();

        }else{
            echo "Erro na EXCLUSÃO.";

            // echo("<pre>");
            //     $comandoSQL->debugDumpParams();
            // echo("</pre>");
        }

    }else{
        echo("Entre em contado com Administrador!");
    }
        
    $conexao=null;