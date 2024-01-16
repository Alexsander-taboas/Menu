<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exclusão de Usuário</title>
    <link rel="stylesheet" href="./css/estilo.css">
</head>
<body>
    <div class="container">
        <h1>Exclusão de Usuário</h1>
        <?php include("./_menu.php"); ?>
    </div> 

    <div class="container">
        <?php
            $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
            require_once("./exc-login-view.php");
        ?>

        <form action="exc-loginbd.php" method="POST" enctype="multipart/form-data">
            
            <input type="hidden" name="id" value="<?=$id;?>">
            <input type="hidden" name="fotobd" value="<?=$resultado['fotoLogin'];?>">
            
            <div class="row-flex">
                <div class="col-1">                    
                    <div class="centralizar-h" style="cursor: pointer;">
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
                        placeholder="Nome completo" 
                        value="<?=$resultado['nomeLogin'];?>" readonly>
                </div>                
            </div>
            
            <div class="row-flex">
                <div class="col">
                    <label for="endereco">Endereço</label>
                    <input type="text" name="endereco" id="endereco" 
                        placeholder="Endereço comercial"  
                        value="<?=$resultado['enderecoLogin'];?>" readonly>
                </div>

                <div class="col">
                    <label for="fone">Fone</label>
                    <input type="tel" name="fone" id="fone" 
                        placeholder="Fone comercial" 
                        value="<?=$resultado['telefoneLogin'];?>" readonly>
                </div>
            </div>

            <div class="row-flex">
                <div class="col">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" 
                        placeholder="Email institucional" 
                        value="<?=$resultado['emailLogin'];?>" readonly>
                </div>                
            </div>

            <div class="row-flex">
                <div class="col">
                    <label for="nivel">Nível</label>
                    <select name="nivel" id="nivel" disabled>
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
                    <select name="status" id="status" disabled>
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
                    <input type="submit" style="background-color: red; border: 1px solid red;" value=" E X C L U I R ">
                </div>
            </div>
        </form>
    </div>
</body>
</html>