<?php
    //require_once("_sessao.php");
     
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        if(!empty($_FILES['foto']['name'])){
            // diretório que seja salvos as fotos do perfil do user
            $dir_fotos = "./fotos/";

            // retirando os espaços em branco do arquivo
            $nome_original = str_replace(" ","_",basename($_FILES["foto"]["name"]));

            // criando um token para ser adicionado ao nome do arquivo
            $token = md5(uniqid(rand(), true));

            // nome que será usado para UPLOAD do arquivo
            $nome_final = $dir_fotos.$token.$nome_original;

            $flag = true; 
            
            //verifica se o arquivo tem tamanho maior que 2mb
            if(!getimagesize($_FILES["foto"]["tmp_name"]) > 2000000){
                $flag = false;
            }

            // pegando somente a extensão do arquivo
            $extensao = strtolower(pathinfo($nome_original, PATHINFO_EXTENSION));

            // verificando se a extensão é válida
            if( ($extensao != "jpg") && ($extensao != "gif") &&
                ($extensao != "bmp") && ($extensao != "jpeg") &&
                ($extensao != "png") && ($extensao != "webp")){
                    $flag = false;
            }

            if($flag){
                // nome que será gravado no banco de dados
                $foto = $token.$nome_original;
            }
        }
        else
        {
            $foto = filter_input(INPUT_POST,"fotobd",FILTER_SANITIZE_SPECIAL_CHARS);
        }

        $id= filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

        $nome = filter_input(INPUT_POST,"nome",FILTER_SANITIZE_SPECIAL_CHARS);
        $endereco = filter_input(INPUT_POST,"endereco",FILTER_SANITIZE_SPECIAL_CHARS);
        $fone = filter_input(INPUT_POST,"fone",FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL);
        
        
        $senha1 = filter_input(INPUT_POST,"senha1",FILTER_SANITIZE_SPECIAL_CHARS);
        
        if($senha1 != "********"){
            $senha1 = password_hash($senha1, PASSWORD_DEFAULT); 
        }       
        $senha2 = filter_input(INPUT_POST,"senha2",FILTER_SANITIZE_SPECIAL_CHARS);
        $nivel = filter_input(INPUT_POST,"nivel",FILTER_SANITIZE_NUMBER_INT);
        $status = filter_input(INPUT_POST,"status",FILTER_SANITIZE_NUMBER_INT);

        $fotobd = filter_input(INPUT_POST,"fotobd",FILTER_SANITIZE_SPECIAL_CHARS);

        require_once("./_conexao/conexao.php");

        if($senha1 != "********"){
            $sql = "UPDATE `login` SET 
                        `nomeLogin` = :nome,
                        `enderecoLogin` = :endereco,
                        `telefoneLogin` = :fone,
                        `emailLogin`  = :email,
                        `senhaLogin`  = :senha,
                        `nivelLogin`  = :nivel,
                        `statusLogin` = :status,
                        `fotoLogin`   = :foto
                    WHERE `idLogin`   = :id";

            $comandoSQL = $conexao->prepare($sql);

            $comandoSQL->bindParam(':nome', $nome, PDO::PARAM_STR);
            $comandoSQL->bindParam(':endereco', $endereco, PDO::PARAM_STR);
            $comandoSQL->bindParam(':fone', $fone, PDO::PARAM_STR);
            $comandoSQL->bindParam(':email', $email, PDO::PARAM_STR);
            $comandoSQL->bindParam(':senha', $senha1, PDO::PARAM_STR);
            $comandoSQL->bindParam(':nivel', $nivel, PDO::PARAM_STR);
            $comandoSQL->bindParam(':status', $status, PDO::PARAM_STR);
            $comandoSQL->bindParam(':id', $id, PDO::PARAM_STR);
            $comandoSQL->bindParam(':foto', $foto, PDO::PARAM_STR);
        }
        else{
            $sql = "UPDATE `login` SET 
                        `nomeLogin` = :nome,
                        `enderecoLogin` = :endereco,
                        `telefoneLogin` = :fone,
                        `emailLogin`  = :email,
                        `nivelLogin`  = :nivel,
                        `statusLogin` = :status,
                        `fotoLogin`   = :foto
                    WHERE `idLogin`   = :id";

            $comandoSQL = $conexao->prepare($sql);

            $comandoSQL->bindParam(':nome', $nome, PDO::PARAM_STR);
            $comandoSQL->bindParam(':endereco', $endereco, PDO::PARAM_STR);
            $comandoSQL->bindParam(':fone', $fone, PDO::PARAM_STR);
            $comandoSQL->bindParam(':email', $email, PDO::PARAM_STR);
            $comandoSQL->bindParam(':nivel', $nivel, PDO::PARAM_STR);
            $comandoSQL->bindParam(':status', $status, PDO::PARAM_STR);
            $comandoSQL->bindParam(':id', $id, PDO::PARAM_STR);
            $comandoSQL->bindParam(':foto', $foto, PDO::PARAM_STR);
        }
        $comandoSQL->execute();

        if($comandoSQL->rowCount() == 1){
            //echo "Usuário atualizado com sucesso!";

            if(isset($flag)){
                // move um arquivo para uma pasta
                move_uploaded_file($_FILES["foto"]["tmp_name"], $nome_final);
                
                // exclui um arquivo do disco
                unlink($dir_fotos.$fotobd);
            }

            header("location:./view-login.php");
            exit();

        }else{
            echo "Erro na atualização.";

            echo("<pre>");
                $comandoSQL->debugDumpParams();
            echo("</pre>");
        }

    }else{
        echo("Entre em contado com Administrador!");
    }
        
    $conexao=null;