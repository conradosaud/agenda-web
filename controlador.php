<?php
    session_start();

    // recebe os dados da tela criar_conta.php
    if(isset($_POST["criar_conta"])){
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];
        
        // $resultado recebe o que rolou no banco de dados
        $resultado = inserir_usuarios($nome, $email, $usuario, $senha);
        
        // se o resultado for positivo ele já autentica o usuário criado
        if($resultado){
            $resposta = autenticar($usuario, $senha);
            criar_sessao($resposta);
        }else{
            // se der errado emite mensagem de erro e retorna a tela de criação
            // note que o input do html já previne alguns tratamentos de erros simples
            echo "<script>alert('Erro ao criar usuário.');window.location.href='criar_conta.php';</script>";
            die;
        }
        
    }
    
    // recebe os dados da tela criar_contato.php
    if(isset($_POST["criar_contato"])){
        $id_usuario = $_SESSION["usuario"]["id"];
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $telefone = $_POST["telefone"];
        $celular = $_POST["celular"];
        $endereco = $_POST["endereco"];
        $bairro = $_POST["bairro"];
        $cep = $_POST["cep"];
        $cidade = $_POST["cidade"];
        $uf = $_POST["uf"];
        
        $resultado = inserir_contato($id_usuario, $nome, $email, $telefone, $celular,
            $endereco, $bairro, $cep, $cidade, $uf);
        
        // se for criado com sucesso envia o usuário diretamente para o painel
        if($resultado){
            echo "<script>window.location.href='painel_usuario.php';</script>";
            die;
        }else{
            echo "<script>alert('Erro ao criar contato.'); window.location.href='criar_contato.php';</script>";
            die;
        }

    }
    
    // recebe os dados da tela criar_compromisso.php
    if(isset($_POST["criar_compromisso"])){
        $id_usuario = $_SESSION["usuario"]["id"];
        $descricao = $_POST["descricao"];
        $data = $_POST["data"];
        $hora = $_POST["hora"];
        
        $resultado = inserir_compromisso($id_usuario, $descricao, $data, $hora);
        
        // se for criado com sucesso envia o usuário diretamente para o painel
        if($resultado){
            echo "<script>window.location.href='painel_usuario.php';</script>";
            die;
        }else{
            echo "<script>alert('Erro ao criar compromisso.'); window.location.href='criar_compromisso.php';</script>";
            die;
        }

    }
    
    // recebe os dados da tela index.php que é a tela de login
    if(isset($_POST["login"])){
        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];
        
        $resultado = autenticar($usuario, $senha);
        criar_sessao($resultado);
        
    }
    
    // recebe o comando de exclusão da tela painel_usuario.php 
    if(isset($_GET["excluir_contato"])){
        $id_contato = $_GET["excluir_contato"];
        
        $resultado = excluir_contato($id_contato);
        
        if($resultado){
            echo "<script>window.location.href='painel_usuario.php';</script>";
            die;
        }else{
            echo "<script>alert('Erro ao excluir contato.');window.location.href='painel_usuario.php';</script>";
            die;
        }
    }
    
    // guardar dados dos usuários autenticados na sessão da página
    function criar_sessao($resultado){
         // se for autenticado com sucesso os dados são saldos em uma variável de sessão
        // e o usuário é movido diretamente para a tela painel_usuario.php
        if($resultado){
            $_SESSION["usuario"] = $resultado;
            echo "<script>window.location.href='painel_usuario.php'</script>";
            die;
        }else{
            // caso contrário ele retorna a tela de login
            echo "<script>alert('Usuário ou senha incorretos.');window.location.href='index.php';</script>";
            die;
        }
    }
    
    // cria uma instância do banco de dados
    function criar_instancia(){
        include_once 'Conexao.php';
        $banco = new Conexao();
        $db = $banco->instance();
        return $db;
    }
    
    // insere novos usuários no banco
    function inserir_usuarios($nome, $email, $username, $senha){
        
        $db = criar_instancia();
        
        // primeiro verifica se já existe algum cadastro com o mesmo usuário
        try{
            
            $query = $db->prepare("SELECT * FROM usuarios WHERE username = '$username';");
            $query->execute();
            
            if($query->rowCount() > 0){
                return false;
            }
            
        }catch(Exception $e){
            print($e);
        }
        
        
        // se não tiver nenhum usuário cadastrado, então insere o novo usuário
        try{
            
            $query = $db->prepare("INSERT INTO usuarios (nome, email, username, senha) 
            VALUES ('$nome', '$email', '$username', '$senha');");
            $query->execute();
            
            if($query->rowCount() == 1){
                return true;
            }else{
                return false;
            }
            
        }catch(Exception $e){
            print($e);
        }
        
    }
    
    // insere novos contatos no banco
    function inserir_contato($id_usuario, $nome, $email, $telefone, $celular,
            $endereco, $bairro, $cep, $cidade, $uf){
        
        $db = criar_instancia();

        try{
            
            $query = $db->prepare("INSERT INTO contatos (
                id_usuario, nome, email, telefone, celular, endereco, bairro, cep, cidade, uf) 
            VALUES 
                ('$id_usuario', '$nome', '$email', '$telefone', '$celular', '$endereco', '$bairro', '$cep', '$cidade', '$uf');");
            $query->execute();
            
            if($query->rowCount() == 1){
                return true;
            }else{
                return false;
            }
            
        }catch(Exception $e){
            print($e);
        }
        
    }
    
    // insere novos compromissos no banco
    function inserir_compromisso($id_usuario, $descricao, $data, $hora){
        
        $db = criar_instancia();
        
        // insere compromissos com o status [ATIVO] automaticamente
        try{
            
            $query = $db->prepare("INSERT INTO compromissos (id_usuario, descricao, data, hora, status) 
            VALUES 
                ('$id_usuario', '$descricao', '$data', '$hora', 'Ativo');");
            $query->execute();
            
            if($query->rowCount() == 1){
                return true;
            }else{
                return false;
            }
            
        }catch(Exception $e){
            print($e);
        }
        
    }
    
    // faz a autenticação do usuário pelo nome de usuário e senha
    function autenticar($username, $senha){
        
        $db = criar_instancia();
        
        try{
            
            $query = $db->prepare("SELECT * FROM usuarios WHERE username = '$username' AND senha = '$senha';");
            $query->execute();
            
            if($query->rowCount() > 0){
                
                $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                
                $array;

                // passa os dados por array e retorna para que o sistema já possa ter informações do usuário
                foreach($dados as $listado){
                    $array = array(
                        "id"=>$listado["id"],
                        "nome"=>$listado["nome"],
                        "email"=>$listado["email"],
                        "username"=>$listado["username"],
                    );
                }
                
                return $array;

            }else{
                return 0;
            }
            
        }catch(Exception $e){
            print($e);
        }
    }
    
    // pega todos os contatos do banco pelo id do usuário conectado na sessão e guarda em um array
    function pegar_todos_contatos($id_usuario){
        
        $db = criar_instancia();
        
        try{
            
            // busca todos os contatos pelo id do usuário e os traz em ordem alfabética
            $query = $db->prepare("SELECT * FROM contatos WHERE id_usuario = '$id_usuario' ORDER BY nome ASC;");
            $query->execute();
            
            if($query->rowCount() > 0){
                
                $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                
                $array;
                $contatos = array();

                foreach($dados as $listado){
                    $array = array(
                        "id_contato"=>$listado["id_contato"],
                        "nome"=>$listado["nome"],
                        "email"=>$listado["email"],
                        "telefone"=>$listado["telefone"],
                        "celular"=>$listado["celular"],
                        "endereco"=>$listado["endereco"],
                        "bairro"=>$listado["bairro"],
                        "cep"=>$listado["cep"],
                        "cidade"=>$listado["cidade"],
                        "uf"=>$listado["uf"]
                    );
                    array_push($contatos, $array);
                }
                
                return $contatos;

            }else{
                return 0;
            }
            
        }catch(Exception $e){
            print($e);
        }
    }
    
    // pega todos os compromissos do banco pelo id do usuário e pela data que o usuário escolheu
    function pegar_todos_compromissos($id_usuario, $data){
        
        $db = criar_instancia();
        
        try{
            
            // busca todos os compromissos pela data e em ordem de horário
            $query = $db->prepare("SELECT * FROM compromissos WHERE id_usuario = '$id_usuario' AND data = '$data' ORDER BY hora;");
            $query->execute();
            
            if($query->rowCount() > 0){
                
                $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                
                $array;
                $compromissos = array();

                foreach($dados as $listado){
                    $array = array(
                        "id_compromisso"=>$listado["id_compromisso"],
                        "data"=>organizaData($listado["data"]),
                        "hora"=>organizaHora($listado["hora"]),
                        "status"=>$listado["status"],
                        "descricao"=>$listado["descricao"]
                    );
                    array_push($compromissos, $array);
                }
                
                return $compromissos;

            }else{
                return 0;
            }
            
        }catch(Exception $e){
            print($e);
        }
    }
    
    // excluir um contato pelo id
    function excluir_contato($id_contato){
        
        $db = criar_instancia();
        
        try{
            
            // busca todos os contatos pelo id do usuário e os traz em ordem alfabética
            $query = $db->prepare("DELETE FROM contatos WHERE id_contato = '$id_contato';");
            $query->execute();
            
            if($query->rowCount() == 1){
                return true;
            }else{
                return false;
            }
            
        }catch(Exception $e){
            print($e);
        }
    }
    
    // converte a data do banco ano-mês-dia para dia/mês/ano
    function organizaData($data){
        $pedacos = explode("-",$data);
        $data_organizada = $pedacos[2]."/".$pedacos[1]."/".$pedacos[0];
        return $data_organizada;
    }
    
    // converte a hora do banco hora:minuto:secundo para hora:minuto
    function organizaHora($hora){
        $pedacos = explode(":",$hora);
        $hora_organizada = $pedacos[0].":".$pedacos[1];
        return $hora_organizada;
    }