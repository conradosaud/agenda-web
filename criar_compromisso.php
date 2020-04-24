<?php
    session_start();
    if(is_null($_SESSION["usuario"])){
        echo "<script>alert('Somente usuários autenticados podem acessar esta tela.');window.location.href='index.php'</script>";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Novo contato</title>
        
        <link rel="stylesheet" href="estilo.css"/>
        
    </head>
    <body class="fundo fundo-painel">

        <div class="centro">

            <div class="caixa esquerda">

                <div class="cabecalho">
                    <a href="painel_usuario.php" style="color: #24305E;">Voltar</a>
                    <h1>Novo compromisso</h1>
                    <p>Adicione novos compromissos a sua agenda.</p>
                </div>

                <form action="controlador.php" method="POST">
                    <div class="campo-form">
                        <textarea class="full" name="descricao" rows="3" type="text" placeholder="Descrição do compromisso" minlength="3" required></textarea>
                    </div>
                    <div class="campo-data">
                    Data
                    <input name="data" type="date" value="<?php echo date("Y-m-d"); ?>"/>
                    </div>
                    <div class="campo-data">
                    Horário
                    <input name="hora" type="time" value="<?php echo date("H:s"); ?>"/>
                    </div>
                    
                    <div class="centro rodape">
                        <button class="botao-primario half" type="submit">Salvar</button>
                    </div>
                    
                    <input name="criar_compromisso" type="hidden"/>
                </form>

            </div>

        </div>

    </body>
</html>
