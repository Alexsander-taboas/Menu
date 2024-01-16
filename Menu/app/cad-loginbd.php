<?php
   // require_once("_sessao.php");
/*
    echo("<pre>");

        print_r($_POST);
        print_r($_SERVER["REQUEST_METHOD"]);

    echo("</pre>");
*/

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        
        if(!empty($_FILES['foto']['name'])){
            // diretório que seja salvos as fotos do perfil do user
            $dir_fotos = "./images/";

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
            $foto = "perfil.png";
        }

        $nome = filter_input(INPUT_POST,"nome",FILTER_SANITIZE_SPECIAL_CHARS);
        $endereco = filter_input(INPUT_POST,"endereco",FILTER_SANITIZE_SPECIAL_CHARS);
        $fone = filter_input(INPUT_POST,"fone",FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL);
        $senha = filter_input(INPUT_POST,"senha1",FILTER_SANITIZE_SPECIAL_CHARS);
        $nivel = filter_input(INPUT_POST,"nivel",FILTER_SANITIZE_NUMBER_INT);
        $status = filter_input(INPUT_POST,"status",FILTER_SANITIZE_NUMBER_INT);

        try {
            require_once("../_conexao/_conexao.php"); 
            
            $comandoSQL = $conexao->prepare("            
                INSERT INTO `login` (
                    `nomeLogin`,
                    `enderecoLogin`,
                    `emailLogin`,
                    `telefoneLogin`,
                    `senhaLogin`,
                    `nivelLogin`,
                    `statusLogin`,
                    `fotoLogin`)
                VALUES (
                    :nome,
                    :endereco,
                    :email,
                    :fone,
                    :senha,
                    :nivel,
                    :status,
                    :foto
                )
            ");
                      
            /*
            $comandoSQL->bindParam(":nome", $nome, PDO::PARAM_STR);
            $comandoSQL->bindParam(":endereco", $endereco, PDO::PARAM_STR);
            $comandoSQL->bindParam(":email", $email, PDO::PARAM_STR);
            $comandoSQL->bindParam(":fone", $fone, PDO::PARAM_STR);
            $comandoSQL->bindParam(":senha", $senha1, PDO::PARAM_STR);
            */
            $comandoSQL->execute(array(
                ':nome'     => $nome,
                ':endereco' => $endereco,
                ':email'    => $email,
                ':fone'     => $fone,
                ':senha'    => password_hash($senha, PASSWORD_DEFAULT),
                ':nivel'    => $nivel,
                ':status'   => $status,
                ':foto'     => $foto
            ));

            if($comandoSQL->rowcount() > 0){
                // echo("Usuário registrado com sucesso!");

                if(isset($flag)){
                    move_uploaded_file($_FILES["foto"]["tmp_name"], $nome_final);
                }
                 
                header("Location ../index.php");
                exit();
                

                // echo("<pre>");
                //     $comandoSQL->debugDumpParams();
                // echo("</pre>");
            }else{
                echo("Erro no registro.");
            }

            $conexao = null; // fechando a conexao com o banco

        } catch (PDOException $erro) {
            echo ("Entre em contato com o Administrador.");
        }

    }else{
        echo("Entre em contado com Administrador!");
    }