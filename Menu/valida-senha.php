<?php
    // valida se os dados vieram pelo método POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once("./_conexao/_conexao.php");

        $usuario = filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_EMAIL);
        $senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_SPECIAL_CHARS);

        try {
            $comandoSQL = "SELECT * FROM login WHERE emailLogin = :usuario";
            $comandoSQL = $conexao->prepare($comandoSQL);
            $comandoSQL->bindParam(":usuario", $usuario);
            $comandoSQL->execute();

            if ($comandoSQL->rowCount() > 0) {
                $linha = $comandoSQL->fetch();

                if (password_verify($senha, $linha["senhaLogin"])) {
                    session_start();
                    $_SESSION["nome"] = $linha["nomeLogin"];
                    $_SESSION["nivel"] = $linha["nivelLogin"]; // 0 usuário 1 administrador
                    $_SESSION["foto"] = $linha["fotoLogin"]; // 0 usuário 1 administrador

                     header("Location:./app/admin_page.php");
                    exit();
                } else {
                     header("Location:./index.php?status=erroSenha");
                    exit();
                }
            } else {
                 header("location:./index.php?status=erroUsuario");
                exit();
            }
        } catch (PDOException $erro) {
            echo "Erro..: " . $erro->getMessage();
        }
    } else {
        // echo("Entre em contato com o Administrador.");
        header("location:./index.php");
        exit();
    }
?>
