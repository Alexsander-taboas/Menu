<?php
    require_once("_sessao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="ISO-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualização de Usuário</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <div class="container">
        <h1>Visualização de Usuários </h1>
    </div> 


    <div class="container">
        <table>
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th width="80">FOTO</th>
                    <th>NOME</th>
                    <th>EMAIL</th>
                    <th width="250">TELEFONE</th>
                    <th width="90">ATUALIZAR</th>
                    <th width="90">EXCLUIR</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once("./view-loginbd.php");
                    if($totalRegistros > 0){
                        foreach($dados as $linha){

                ?>
                <tr>
                    <td><?= $linha["idLogin"];?></td>
                    <td>
                        <img id="imagem" src="./images/<?=$linha['fotoLogin'];?>" 
                             alt="" style="max-width: 100px;">
                    </td>
                    <td><?=$linha["nomeLogin"];?></td>
                    <td><?= $linha["emailLogin"];?></td>
                    <td><?= $linha["telefoneLogin"];?></td>

                    <td align="center">
                        <a href="alt-login.php?id=<?= $linha['idLogin'];?>">
                            <img src="./imagens/folder.png" alt="Atualizar" width="30">
                        </a>
                    </td>


                    <td align="center">
                        <a href="exc-login.php?id=<?= $linha['idLogin'];?>">
                            <img src="./imagens/delete.png" alt="Excluir" width="30">
                        </a>
                    </td>
                </tr>
                <?php
                        }
                    }
                    else{
                        echo("
                            <tr>
                                <td colspan=6>
                                    NÃO HÁ REGISTROS GRAVADOS.
                                </td>
                            </tr>
                        ");
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>