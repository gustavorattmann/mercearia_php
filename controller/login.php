<?php

    if(!isset($_POST['login']) && !isset($_POST['senha'])){
        die("Desculpe, mas não identificamos nenhum dados para autenticação, volte para a página de login e certifique-se que está digitando os dados corretamente nos campos solicitados.");
    }else if(empty($_POST['login'])){
        die("Desculpe, mas não identificamos nenhum dado para o campo de cpf/e-mail, volte para a página de login e certifique-se que está digitando os dados corretamente no campo solicitado.");
    }else if(empty($_POST['senha'])){
        die("Desculpe, mas não identificamos nenhum dado para o campo senha, volte para a página de login e certifique-se que está digitando os dados corretamente no campo solicitado.");
    }else{
        session_start();
        
        if(isset($_POST['login'])){
            $login   = $_POST['login'];
            $_SESSION['login']['login'] = $login;
        }

        if(isset($_POST['senha'])){
            $password = $_POST['senha'];
            $_SESSION['login']['password'] = $password;
        }
        
        header('Location: ../model/users_DB.php?requisition=login');
    }
        
?>