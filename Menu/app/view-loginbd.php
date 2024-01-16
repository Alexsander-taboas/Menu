<?php
     require_once("_sessao.php");
    
    require_once("../_conexao/_conexao.php");

    try{
        // comando SQL para buscar todos os registros da tabela
        $sql = "SELECT * FROM login";
        // executa o comando SQL no banco de dados
        $dadosSelecionados = $conexao->query($sql);
        // prepara os dados para serem visualizados
        $dados = $dadosSelecionados->fetchAll();
        // calcula o total de registros lidos da tabela
        $totalRegistros = $dadosSelecionados->rowCount();

    }catch(PDOException $erro){
        echo("Código do Erro.: ".$erro->getCode());
        echo("Descrição......: ".$erro->getMessage());
    }