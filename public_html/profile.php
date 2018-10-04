<?php
    
    session_start();

    if(isset($_SESSION['login']['cpf']) && isset($_SESSION['login']['email'])){
        include_once 'partials/head.inc.php';
        include_once 'partials/header.inc.php';
        include_once 'partials/navbar.inc.php';
        
        require_once '../config.php';
        
        date_default_timezone_set(SAO_PAULO);
        
        if(isset($_SESSION['login']['full_name'])){
            $full_name      = $_SESSION['login']['full_name'];
        }
        
        $email              = $_SESSION['login']['email'];
        
        $cpf                = $_SESSION['login']['cpf'];
        $divide_cpf[0]      = substr($cpf, 0, 3);
        $divide_cpf[1]      = substr($cpf, 3, 3);
        $divide_cpf[2]      = substr($cpf, 6, 3);
        $divide_cpf[3]      = substr($cpf, 9, 2);
        
        $cpf                = $divide_cpf[0].'.'.$divide_cpf[1].'.'.$divide_cpf[2].'-'.$divide_cpf[3];      
        
?>
     
        <h1>Perfil de <?= $full_name ?></h1>
        <h4>Nome Completo: </h4><p><?= $full_name ?></p>
        <h4>E-mail: </h4><p><?= $email ?></p>
        <h4>CPF: </h4><p><?= $cpf ?></p>
       
<?php
        
        if(isset($_SESSION['login']['date_birth'])){
            $date_birth     = $_SESSION['login']['date_birth'];
            
?>
    
    <h4>Data de Nascimento: </h4><p><?= $date_birth ?></p>

<?php
            
        }
        
        if(isset($_SESSION['login']['gender'])){
            $gender         = $_SESSION['login']['gender'];
            
            if($gender == 'f'){
                $gender = 'feminino';
            }else{
                $gender = 'masculino';
            }
            
?>
    
    <h4>Sexo: </h4><p><?= $gender ?></p>

<?php
            
        }
        
        if(isset($_SESSION['login']['zip_code'])){
            $zip_code       = $_SESSION['login']['zip_code'];
            
            $divide_zip[0]     = substr($zip_code, 0, 5);
            $divide_zip[1]     = substr($zip_code, 5, 8);
            
            
            $cep = $divide_zip[0].'-'.$divide_zip[1];

?>
    
    <h4>CEP: </h4><p><?= $cep ?></p>

<?php

        }
        
        if(isset($_SESSION['login']['address']) && isset($_SESSION['login']['number'])){
            $address        = $_SESSION['login']['address'];
            $number         = $_SESSION['login']['number'];

?>
    
    <h4>Endereço: </h4><p><?= $address.' , '.$number ?></p>

<?php

        }
        
        if(isset($_SESSION['login']['complement'])){
            $complement     = $_SESSION['login']['complement'];
            
?>
    
    <h4>Complemento: </h4><p><?= $complement ?></p>

<?php
            
        }
        
        if(isset($_SESSION['login']['neighborhood'])){
            $neighborhood   = $_SESSION['login']['neighborhood'];
            
?>
    
    <h4>Bairro: </h4><p><?= $neighborhood ?></p>

<?php
            
        }
        
        if(isset($_SESSION['login']['city']) && isset($_SESSION['login']['state'])){
            $city           = $_SESSION['login']['city'];
            $state          = $_SESSION['login']['state'];
            
?>
    
    <h4>Cidade/Estado: </h4><p><?= $city.' - '.$state ?></p>

<?php
            
        }
        
        if(isset($_SESSION['login']['level'])){
            $level          = $_SESSION['login']['level'];
            
            if($level == 'func'){
                $level = 'funcionário';
            }
            
?>
    
    <h4>Nível de acesso: </h4><p><?= $level ?></p>

<?php

        }
        
        if(isset($_SESSION['login']['role'])){
            $role           = $_SESSION['login']['role'];
            
?>
    
    <h4>Cargo: </h4><p><?= $role ?></p>

<?php
            
        }
        
        if(isset($_SESSION['login']['date_register'])){
            $date_register  = $_SESSION['login']['date_register'];
            
            if($level == 'funcionário'){
                
?>
    
    <h4>Data de Admissão: </h4><p><?= $date_register ?></p>

<?php

            }else{
                
?>
    
    <h4>Data de Cadastro: </h4><p><?= $date_register ?></p>

<?php
                
            }
        }
        
        if(isset($_SESSION['login']['date_end'])){
            $date_end       = $_SESSION['login']['date_end'];
            
            if($level == 'funcionário'){
            
?>
    
    <h4>Data de Demissão: </h4><p><?= $date_end ?></p>

<?php
            
            }
        }
    
?>
    
    <h4></h4><p></p>

<?php

        include_once 'partials/footer.inc.php';
        
    }else{
        echo "Você não possui permissão para acessar está página";
    }

?>