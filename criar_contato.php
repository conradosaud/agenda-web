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
                    <h1>Novo contato</h1>
                    <p>Adicione novos contatos a sua agenda.</p>
                </div>

                <form action="controlador.php" method="POST">
                    <div class="campo-form">
                        <input name="nome" type="text" placeholder="Nome" minlength="3" required />
                    </div>
                    <div class="campo-form">
                        <input name="email" type="email" placeholder="E-mail" minlength="5" required />
                    </div>
                    <div class="campo-form">
                        <input name="telefone" type="text" placeholder="Telefone" />
                    </div>
                    <div class="campo-form">
                        <input name="celular" type="text" placeholder="Celular" />
                    </div>
                    <div class="campo-form">
                        <input name="endereco" type="text" placeholder="Endereço e número" minlength="5" required />
                    </div>
                    <div class="campo-form">
                        <input name="bairro" type="text" placeholder="Bairro" minlength="3" required />
                    </div>
                    <div class="campo-form">
                        <input name="cep" type="text" placeholder="CEP" minlength="3" required />
                    </div>
                    <div class="campo-form">
                        <input name="cidade" type="text" placeholder="Cidade" minlength="3" required />
                    </div>
                    <div class="campo-form">
                        <input name="uf" type="text" placeholder="UF" minlength="1" required />
                    </div>
                    <div class="centro">
                        <button class="botao-primario half" type="submit">Salvar</button>
                    </div>
                    
                    <input name="criar_contato" type="hidden"/>
                </form>

            </div>

        </div>

    </body>
</html>
