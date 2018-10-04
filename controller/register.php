<?php
    
    session_start();

    if(isset($_POST['nome_completo']) && !empty($_POST['nome_completo'])){
        $_SESSION['register']['full_name'] = $_POST['nome_completo'];
    }else{
        echo "<script>alert('Por favor, preencher o campo Nome Completo!');history.go(-1)</script>";
    }
    
    if(isset($_POST['email']) && !empty($_POST['email'])){
        $_SESSION['register']['email'] = $_POST['email'];
    }else{
        echo "<script>alert('Por favor, preencher o campo E-mail!');history.go(-1)</script>";
    }

    if(isset($_POST['senha']) && !empty($_POST['senha'])){
        //$password = password_hash($_POST['senha'], PASSWORD_ARGON2I);
        
        //$_SESSION['register']['password'] = $password;
        
        $_SESSION['register']['password'] = $_POST['senha'];
    }else{
        echo "<script>alert('Por favor, preencher o campo Senha!');history.go(-1)</script>";
    }
    
    if(isset($_POST['cpf']) && !empty($_POST['cpf'])){
        $_SESSION['register']['cpf'] = $_POST['cpf'];
    }else{
        echo "<script>alert('Por favor, preencher o campo CPF!');history.go(-1)</script>";
    }
    
    if(isset($_POST['data_nascimento']) && !empty($_POST['data_nascimento'])){
        $_SESSION['register']['date_birth'] = $_POST['data_nascimento'];
    }else{
        echo "<script>alert('Por favor, preencher o campo Data de Nascimento!');history.go(-1)</script>";
    }

    if(isset($_POST['sexo']) && !empty($_POST['sexo'])){
        if($_POST['sexo'] == 'f'){
            $gender = 0;
        }else{
            $gender = 1;
        }
        
        $_SESSION['register']['gender'] = $gender;
    }else{
        echo "<script>alert('Por favor, preencher o campo Sexo!');history.go(-1)</script>";
    }

    if(isset($_POST['cep']) && !empty($_POST['cep'])){
        $_SESSION['register']['zip_code'] = $_POST['cep'];
    }else{
        echo "<script>alert('Por favor, preencher o campo CEP!');history.go(-1)</script>";
    }

    if(isset($_POST['endereco']) && !empty($_POST['endereco'])){
        $_SESSION['register']['address'] = $_POST['endereco'];
    }else{
        echo "<script>alert('Por favor, preencher o campo Endereço!');history.go(-1)</script>";
    }

    if(isset($_POST['numero']) && !empty($_POST['numero'])){
        $_SESSION['register']['number'] = $_POST['numero'];
    }else{
        echo "<script>alert('Por favor, preencher o campo Número!');history.go(-1)</script>";
    }

    if(isset($_POST['complemento']) && !empty($_POST['complemento'])){
        $_SESSION['register']['complement'] = $_POST['complemento'];
    }

    if(isset($_POST['bairro']) && !empty($_POST['bairro'])){
        $_SESSION['register']['neighborhood'] = $_POST['bairro'];
    }else{
        echo "<script>alert('Por favor, preencher o campo Bairro!');history.go(-1)</script>";
    }

    if(isset($_POST['cidade']) && !empty($_POST['cidade'])){
        $_SESSION['register']['city'] = $_POST['cidade'];
    }else{
        echo "<script>alert('Por favor, preencher o campo Cidade!');history.go(-1)</script>";
    }

    if(isset($_POST['uf']) && !empty($_POST['uf'])){
        $_SESSION['register']['state'] = $_POST['uf'];
    }else{
        echo "<script>alert('Por favor, preencher o campo Estado!');history.go(-1)</script>";
    }

    if(isset($_POST['nivel']) && !empty($_POST['nivel'])){
        $_SESSION['register']['level'] = $_POST['nivel'];
    }else{
        $_SESSION['register']['level'] = "cliente";
    }

    if(isset($_POST['cargo']) && !empty($_POST['cargo'])){
        $_SESSION['register']['role'] = $_POST['cargo'];
    }

    header('Location: ../model/users_DB.php?requisition=register');

?>