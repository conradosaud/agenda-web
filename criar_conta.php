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
        <title>Criar conta</title>
        
        <link rel="stylesheet" href="estilo.css"/>
        
    </head>
    <body class="fundo fundo-inicio">

        <div class="meio">

            <div class="caixa esquerda">

                <div class="cabecalho">
                    <h1>Criar conta</h1>
                    <p>Crie sua conta e comece agora mesmo!</p>
                </div>

                <form action="controlador.php" method="POST">
                    <div class="campo-form">
                        <input name="nome" type="text" placeholder="Seu nome completo" minlength="3" required/>
                    </div>
                    <div class="campo-form">
                        <input name="email" type="email" placeholder="Seu e-mail" minlength="5"  required/>
                    </div>
                    <div class="campo-form">
                        <input name="usuario" type="text" placeholder="Escolha seu usuário" minlength="3"  required/>
                    </div>
                    <div class="campo-form">
                        <input name="senha" type="password" placeholder="Digite sua senha" minlength="3"  required/>
                    </div>
                    <div class="centro">
                        <button class="botao-primario half" type="submit">Cadastrar</button>
                    </div>
                    
                    <input name="criar_conta" type="hidden"/>
                </form>

                <div class="rodape">
                    <p>Já possui uma conta? <a href="index.php">Clique aqui</a> para se conectar.</p>
                </div>

            </div>

        </div>

    </body>
</html>
