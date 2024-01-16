<?php
    $dns = "mysql:host=localhost;dbname=cart_db;charset=utf8";
    $user = "root";
    $pass = "";

    try{
        
        $conexao = new PDO($dns, $user, $pass);
        //echo("Conexão realizada com <b>Sucesso</b>!");

    }catch(PDOException $erro){
        /*
        echo("Código de Erro = ".$erro->getCode()."<br>");
        echo("Descrição do Erro = ".$erro->getMessage());
        */
        
        echo("Entre em contato com o Administrador.");

    }

