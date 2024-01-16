<?php
   // require_once("_sessao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <div class="container">
        <h1>Cadastro de Usuário</h1>
    </div> 

    <div class="container">
        <form action="cad-loginbd.php" method="POST" enctype="multipart/form-data">
            <div class="row-flex">
                <div class="col-1">                    
                    <div class="centralizar-h" style="cursor: pointer;">                        
                        <input type="file" name="foto" id="foto" onchange="preview();">
                        <label for="foto"><img id="imagem" src="./imagens/perfil.png" 
                        style="max-width: 150px;"
                        alt=""></label>
                    </div>
                </div>
                
                <div class="col" style="margin-top: 15px;">                    
                    <label for="nome" >Nome</label>
                    <input type="text" name="nome" id="nome" placeholder="Nome completo">
                </div>                
            </div>
            
            <div class="row-flex">
                <div class="col">
                    <label for="endereco">Endereço</label>
                    <input type="text" name="endereco" id="endereco" placeholder="Endereço comercial">
                </div>

                <div class="col">
                    <label for="fone">Fone</label>
                    <input type="tel" name="fone" id="fone" placeholder="Fone comercial">
                </div>
            </div>

            <div class="row-flex">
                <div class="col">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email institucional">
                </div>                
            </div>

            <div class="row-flex">
                <div class="col">
                    <label for="senha1">Senha</label>
                    <input type="password" name="senha1" id="senha1" placeholder="Senha com 8 digitos">
                </div>

            </div>

            <div class="row-flex">
                <div class="col">
                    <label for="nivel">Nível</label>
                    <select name="nivel" id="nivel">
                        <option value="0" selected>Usuário</option>
                        <option value="1">Administrador</option>
                    </select>
                </div>

                <div class="col">
                    <label for="status">Status</label>
                    <select name="status" id="status">
                        <option value="0" selected>Desativado</option>
                        <option value="1">Ativado</option>
                    </select>
                </div>
            </div>

            <div class="row-flex">
                <div class="col centralizar-h"  style="margin-top: 35px;">
                    <input type="reset" value="Voltar"
                        onclick="javascript:history.go(-1)">
                    <div class="espaco-h"></div>
                    <input type="submit" id="submit"  value=" S A L V A R ">
                </div>
            </div>
        </form>
    </div>

    <script>
        
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