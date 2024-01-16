<?php
    // iniciando uma session
    // session_start();
    // excluindo as variáveis de session
    // session_unset();
    // destruir a session
    // session_destroy();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuário</title>
    <link rel="stylesheet" href="./css/estilo.css">
    <style>
        input{ margin:25px 0px; }

        .login{
            width: 500px;
            margin: 0 auto;
            margin-top: 60px;
        }  
        
        .esconder{ display: none; }
    </style>

</head>
<body>
    <div class="container">
        <h1>Login de Usuário</h1>
    </div>
    
    <?php
        $status = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_SPECIAL_CHARS);

        if(isset($status) && ($status=="erroSenha")){
            echo '<div class="alert erro">Senha errada!</div>';
        }

        if(isset($status) && ($status=="erroUsuario")){
            echo '<div class="alert erro">Usuário inexistente!</div>';
        }
    ?>

    <div class="login">
        <form action="valida-senha.php" method="POST">
            <label for="usuario">USUÁRIO</label>
            <input type="text" name="usuario" id="usuario"
                placeholder="Email cadastrado" required autofocus>
                
            <label for="usuario">USUÁRIO</label>
            <input type="password" name="senha" id="senha"
                placeholder="Senha de oito digitos" required>  

            <div class="centralizar-h">
                <input type="submit" value=" L O G I N ">
            </div>
            <div class="centralizar-h">
                <a href="./app/view-login.php">GERENCIADOR DE LOGIN</a>
            </div>
            <div class="centralizar-h">
                <a href="./app/cad-login.php">Cadastro de usuário</a>
            </div>
        </form>
    </div>

    <script>
        const mensagem = setInterval(myMens, 3000);

        function myMens(){
            document.querySelector('.alert').classList.add("esconder");
            clearInterval(mensagem);
            
        }        
    </script>
</body>
</html>