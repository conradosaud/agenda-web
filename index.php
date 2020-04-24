<?php
    session_start();
    if(isset($_GET["logout"])){
        unset($_SESSION["usuario"]);
        session_destroy();
    }
    if(isset($_SESSION["usuario"]) && !is_null($_SESSION["usuario"])){
        echo "<script>alert('Você já está logado com um usuário.');window.location.href='painel_usuario.php';</script>";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        
        <link rel="stylesheet" href="estilo.css"/>
        
    </head>
    <body class="fundo fundo-inicio">

        <div class="meio">

            <div class="caixa esquerda">

                <div class="cabecalho">
                    <h1>Login</h1>
                    <p>Conecte-se ou crie uma conta</p>
                </div>

                <form action="controlador.php" method="POST">
                    <div class="campo-form">
                        <input name="usuario" type="text" placeholder="Digite seu usuário" />
                    </div>
                    <div class="campo-form">
                        <input name="senha" type="password" placeholder="Digite sua senha" />
                    </div>
                    <div class="centro">
                        <button class="botao-primario half" type="submit">Entrar</button>
                    </div>
                    
                    <input name="login" type="hidden"/>
                </form>

                <div class="rodape">
                    <p>Não possui uma conta? <a href="criar_conta.php">Clique aqui</a> e comece agora!</p>
                </div>

            </div>

        </div>

    </body>
</html>
