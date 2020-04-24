<?php
    include_once 'controlador.php';
    
    if(is_null($_SESSION["usuario"])){
        echo "<script>alert('Somente usuários autenticados podem acessar esta tela.');window.location.href='index.php'</script>";
        die;
    }

    $contatos = pegar_todos_contatos($_SESSION["usuario"]["id"]);
    
    $data;
    if(isset($_GET["data"])){
        $data = $_GET["data"];
    }else{
        $data = date("Y-m-d");
    }
    $compromissos = pegar_todos_compromissos($_SESSION["usuario"]["id"], $data);


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        
        <link rel="stylesheet" href="estilo.css"/>
        
    </head>
    <body class="fundo fundo-painel">
        
        <div class="container">
        
            <div class="caixa full">
            
                <div class="cabecalho">
                    <small><a href="index.php?logout" style="color: #24305E;">Sair</a></small>
                    <h1>Sua agenda</h1>
                    <p>Seja bem-vindo de volta, <strong style="color:#374785"><?php $x = explode(" ", $_SESSION["usuario"]["nome"]); echo $x[0]; ?></strong>! </p> 
                </div>

                <hr>
				
                <h3>Seus compromissos</h3>
                <button class="botao-primario" onclick="window.location.href='criar_compromisso.php'">Adicionar novo</button>
                <div class="campo-data">
                    <strong>Data</strong>
                    <input id="inputData" type="date" value="<?php echo $data; ?>"/>
                    <button onclick="window.location.href='painel_usuario.php?data='+document.getElementById('inputData').value" style="margin-left: 10px;" class="botao-primario">Atualizar</button>
					
                    <!-- Se o usuário alterar a data de hoje o link "Restaurar" aparece para voltar a data de hoje -->
                    <?php if($data!=date("Y-m-d")){echo "<a href='painel_usuario.php'>Restaurar</a>";} ?>
                    
                </div>

                <br>

				<div class="tabela">

					<?php
						if(!$compromissos){
					?>
					<p>Você não tem nenhum compromisso marcado para a esta data.</p>
					<?php
						}else{
							for($i = 0; $i < count($compromissos); $i++){
					?>
					<div class="tabela-celula compromissos caixa">
						<ul>
							<li class="compromisso-status"><?php echo $compromissos[$i]["status"]; ?></li>
							<li class="compromisso-data">
								<span class="compromisso-dia"><?php echo $compromissos[$i]["data"]; ?></span> às 
								<span class="compromisso-hora"><?php echo $compromissos[$i]["hora"]; ?></span>
							</li>
							<li class="compromisso-descricao"><?php echo $compromissos[$i]["descricao"]; ?></li>
						</ul>
					</div>
					<?php
							}
						}
					?>
				
				</div>
				
				<hr style="margin-top: 20px;">
				
				<h3>Seus contatos</h3>
                <button class="botao-primario" onclick="window.location.href='criar_contato.php'">Novo contato</button>
                <br>
                
                <div class="tabela">
                
                    <?php
                        if(!$contatos){
                    ?>

                    <p>Nenhum contato cadastrado no momento.</p>

                    <?php
                        }else{

                            for($i = 0; $i < count($contatos); $i++){
                    ?>

                    <div class="tabela-celula contatos caixa" style="position: relative;">
                        <ul>
                            <li class="contato-nome"><?php echo $contatos[$i]["nome"]; ?></li>
                            <li class="contato-email"><?php echo $contatos[$i]["email"]; ?></li>
                            <li class="contato-telefone"><?php echo $contatos[$i]["telefone"]; ?></li>
                            <li class="contato-celular"><?php echo $contatos[$i]["celular"]; ?></li>
                            <li class="contato-endereco-completo">
                            <span class="contato-endereco"><?php echo $contatos[$i]["endereco"]; ?></span>, 
                            <span class="contato-bairro"><?php echo $contatos[$i]["bairro"]; ?></span>
                            <span class="contato-cep"><?php echo $contatos[$i]["cep"]; ?></span>, 
                            <span class="contato-cidade"><?php echo $contatos[$i]["cidade"]; ?></span> -
                            <span class="contato-uf"><?php echo $contatos[$i]["uf"]; ?></span>
                            </li>
                        </ul>
                        <div style="position: absolute; bottom: 10px; right: 20px; ">
                        <small><a href="controlador.php?excluir_contato=<?php echo $contatos[$i]["id_contato"]; ?>" style="color: #24305E;">Excluir</a></small>
                        </div>
                    </div>

                    <?php
                            }
                        }
                    ?>
                
                </div>
            
            </div>
        
        </div>
        
    </body>
</html>
