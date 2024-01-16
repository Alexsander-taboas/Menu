<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualização de Usuário</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <div class="container">
        <h1>Atualização de Usuário</h1>
        
    </div> 

    <div class="container">
        <?php
            $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
            require_once("./alt-login-view.php");
        ?>

        <form action="alt-loginbd.php" method="POST" enctype="multipart/form-data">
            
            <input type="hidden" name="id" value="<?=$id;?>">
            <input type="hidden" name="fotobd" value="<?=$resultado['fotoLogin'];?>">
            
            <div class="row-flex">
                <div class="col-1">                    
                    <div class="centralizar-h" style="cursor: pointer;">
                       <input type="file" name="foto" id="foto" onchange="preview();">
                    <?php
                       $imagem = $resultado['fotoLogin']; 
                       if(strlen($imagem) > 0){
                    ?>
                        <label for="foto">
                            <img id="imagem" src="./fotos/<?=$resultado['fotoLogin'];?>" alt="" style="max-width: 100px;">
                        </label>
                    <?php
                       }else{
                    ?>                    
                        <label for="foto"><img id="imagem" src="./imagens/perfil.png" alt="" style="max-width: 100px;"></label>
                    <?php
                       }
                    ?>
                    </div>
                </div>
                
                <div class="col" style="margin-top: 15px;">                    
                    <label for="nome" >Nome</label>
                    <input type="text" name="nome" id="nome" 
                        placeholder="Nome completo" value="<?=$resultado['nomeLogin'];?>">
                </div>                
            </div>
            
            <div class="row-flex">
                <div class="col">
                    <label for="endereco">Endereço</label>
                    <input type="text" name="endereco" id="endereco" 
                        placeholder="Endereço comercial"  value="<?=$resultado['enderecoLogin'];?>">
                </div>

                <div class="col">
                    <label for="fone">Fone</label>
                    <input type="tel" name="fone" id="fone" 
                        placeholder="Fone comercial"  value="<?=$resultado['telefoneLogin'];?>">
                </div>
            </div>

            <div class="row-flex">
                <div class="col">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" 
                        placeholder="Email institucional" 
                        value="<?=$resultado['emailLogin'];?>">
                </div>                
            </div>

            <div class="row-flex">
                <div class="col">
                    <label for="senha1">Senha</label>
                    <input type="password" name="senha1" id="senha1" 
                        placeholder="Senha com 8 digitos" 
                        value="********">
                    <p class="mens_erro">Senhas diferentes</p>
                </div>

                <div class="col">
                    <label for="senha2">Confirmação de Senha</label>
                    <input type="password" name="senha2" id="senha2" 
                        placeholder="Mesma senha informada anteriormente"  
                        value="********">
                    <p class="mens_erro">Senhas diferentes</p>
                </div>

            </div>

            <div class="row-flex">
                <div class="col">
                    <label for="nivel">Nível</label>
                    <select name="nivel" id="nivel">
                        <option value="1" 
                            <?=$ativo=$resultado["nivelLogin"]=="0"?" selected":"";?>
                        >Usuário</option>
                        <option value="2"
                            <?=$ativo=$resultado["nivelLogin"]=="1"?" selected":"";?>
                        >Administrador</option>
                    </select>
                </div>

                <div class="col">
                    <label for="status">Status</label>
                    <select name="status" id="status">
                        <option value="0"
                            <?=$ativo=$resultado["statusLogin"]=="0"?" selected":"";?>
                        >Desativado</option>
                        <option value="1"
                            <?=$ativo=$resultado["statusLogin"]=="1"?" selected":"";?>
                        >Ativado</option>
                    </select>
                </div>
            </div>

            <div class="row-flex">
                <div class="col centralizar-h"  style="margin-top: 35px;">
                    <input type="reset" value="Voltar"
                        onclick="javascript:history.go(-1)">
                    <div class="espaco-h"></div>
                    <input type="submit" id="submit" value=" S A L V A R ">
                </div>
            </div>
        </form>
    </div>

    <script>
        let senha1 = document.querySelector('#senha1');
        let senha2 = document.querySelector('#senha2');
        let submit = document.querySelector('#submit');
        let mens_erro = document.querySelector('.mens_erro');

        function verifica(){
            if(senha1.value == senha2.value){
                mens_erro.style.display = 'none';
                submit.disabled = false;
            }else{
                mens_erro.style.display = 'block';
                submit.disabled = true;
            }
        }

        senha1.addEventListener('input', function(){
            verifica();
        });

        senha2.addEventListener('input', function(){
            verifica();
        });

        // FOTO -------------------
        function preview(){
            let file_foto = document.querySelector('#foto').files[0];
            let img_imagem = document.querySelector('#imagem');

            
            // faz a leitura da imagem
            let visualizacao = new FileReader();
            
            if(file_foto){
                // esse comando dispara o evento load da 
                // imagem quando ela for lida completamente            
                visualizacao.readAsDataURL(file_foto);
            }else{                
                img_imagem.src = "";
            }

            // evento de load quando disparada carrega a imagem da variável visualizacao
            visualizacao.onloadend = function(){
                img_imagem.src = visualizacao.result;
            }
        }
        // FIM FOTO -------------------
        
    </script>
</body>
</html>