<?php
     require_once("_sessao.php");
    //$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

    require_once("./_conexao/conexao.php");

    try {

        $sql = "SELECT * FROM login WHERE idLogin = :id";

        $comandoSQL = $conexao->prepare($sql);

        $comandoSQL->bindParam(':id', $id);
        $comandoSQL->execute();
        $resultado = $comandoSQL->fetch(PDO::FETCH_ASSOC);

    }catch(PDOException $erro){
        echo("Erro: ".$erro->getMessage());
    }

    $conexao = null; // Fechando a conexão