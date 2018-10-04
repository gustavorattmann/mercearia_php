<?php

    include_once 'connection.inc.php';
    require_once '../config.php';
    
    date_default_timezone_set(SAO_PAULO);

    session_start();
    
    /* Insert */
    $register = "INSERT INTO usuarios(cpf,nome_completo,email,senha,data_nascimento,sexo,cep,endereco,numero,complemento,bairro,cidade,uf,nivel,cargo,data_cadastro,data_finalizacao) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    /* Selects */
    $select_customer = "SELECT cpf, nome_completo, email, data_nascimento, sexo, cep, endereco, numero, complemento, bairro, cidade, uf, data_cadastro, data_finalizacao FROM usuarios WHERE";
    $select_all_customers = "SELECT cpf, nome_completo, data_nascimento, sexo, cep, endereco, numero, complemento, bairro, cidade, uf, data_cadastro, data_finalizacao FROM usuarios";
    $select_employee = "SELECT u.cpf, u.nome_completo, u.email, u.sexo, c.nome, u.data_cadastro, u.data_finalizacao FROM usuarios u INNER JOIN cargo c ON u.cargo = c.id_cargo WHERE";
    $select_all_employees = "SELECT * FROM usuarios WHERE ";
    $verify_login = "SELECT cpf, email, senha, nivel FROM usuarios WHERE cpf = ? OR email = ?";
    
    if(isset($_GET['requisition'])){
        if($_GET['requisition'] == 'login'){
            if(isset($_SESSION['login']['login']) && isset($_SESSION['login']['password']) && !empty($_SESSION['login']['login']) && !empty($_SESSION['login']['password'])){
                $login = $_SESSION['login']['login'];
            }
            
            if(isset($login) && !empty($login)){
                $query = mysqli_stmt_init($connect);
                
                if(mysqli_stmt_prepare($query, $verify_login)){
                    mysqli_stmt_bind_param($query, 'ss', $login, $login);
                    mysqli_stmt_execute($query);
                    mysqli_stmt_store_result($query);
                    
                    if(mysqli_stmt_num_rows($query) == 1){
                        mysqli_stmt_bind_result($query, $cpf, $email, $password, $level);
                        mysqli_stmt_fetch($query);
                        
                        if($password == $_SESSION['login']['password']){
                            if($level == 'func'){
                                $select_employee .= " cpf = ? OR email = ?";
                                
                                if(mysqli_stmt_prepare($query, $select_employee)){
                                    mysqli_stmt_bind_param($query, 'ss', $login, $login);
                                    mysqli_stmt_execute($query);
                                    mysqli_stmt_store_result($query);
                                    
                                    if(mysqli_stmt_num_rows($query)){
                                        mysqli_stmt_bind_result($query, $cpf, $full_name, $email, $gender, $role, $date_register, $date_end);
                                        mysqli_stmt_fetch($query);

                                        $_SESSION['login']['cpf']          = $cpf;
                                        $_SESSION['login']['full_name']     = $full_name;
                                        $_SESSION['login']['email']         = $email;
                                        $_SESSION['login']['level']         = $level;
                                        $_SESSION['login']['role']          = $role;
                                        $_SESSION['login']['date_register'] = date('d/m/Y', strtotime($date_register));
                                        
                                        if($gender == 0){
                                            $gender = 'f';
                                        }else{
                                            $gender = 'm';
                                        }
                                        
                                        $_SESSION['login']['gender']        = $gender;
                                        
                                        if($date_end != NULL){
                                            $_SESSION['login']['date_end']  = date('d/m/Y', strtotime($date_end));
                                        }
                                        
                                        mysqli_stmt_free_result($query);
                                        
                                        echo "<script>alert('Login realizado com sucesso!');window.location.href='../public_html/home.php'</script>";
                                    }
                                }
                            }else{
                                $select_customer .= " cpf = ? OR email = ?";
                                
                                if(mysqli_stmt_prepare($query, $select_customer)){
                                    mysqli_stmt_bind_param($query, 'ss', $login, $login);
                                    mysqli_stmt_execute($query);
                                    mysqli_stmt_store_result($query);
                                    
                                    if(mysqli_stmt_num_rows($query)){
                                        mysqli_stmt_bind_result($query, $cpf, $full_name, $email, $date_birth, $gender, $zip_code, $address, $number, $complement, $neighborhood, $city, $state, $date_register, $date_end);
                                        mysqli_stmt_fetch($query);
                                        
                                        $_SESSION['login']['cpf']             = $cpf;
                                        $_SESSION['login']['full_name']       = $full_name;
                                        $_SESSION['login']['email']           = $email;
                                        $_SESSION['login']['date_birth']      = date('d/m/Y', strtotime($date_birth));
                                        $_SESSION['login']['zip_code']        = $zip_code;
                                        $_SESSION['login']['address']         = $address;
                                        $_SESSION['login']['number']          = $number;
                                        $_SESSION['login']['neighborhood']    = $neighborhood;
                                        $_SESSION['login']['city']            = $city;
                                        $_SESSION['login']['state']           = $state;
                                        $_SESSION['login']['level']           = $level;
                                        $_SESSION['login']['date_register']   = date('d/m/Y', strtotime($date_register));
                                        
                                        if($gender == 0){
                                            $gender = 'f';
                                        }else{
                                            $gender = 'm';
                                        }
                                        
                                        $_SESSION['login']['gender']          = $gender;
                                        
                                        if($complement != NULL){
                                            $_SESSION['login']['complement']  = $complement;
                                        }

                                        if($date_end != NULL){
                                            $_SESSION['login']['date_end']    = date('d/m/Y', $date_end);
                                        }
                                        
                                        mysqli_stmt_free_result($query);
                                        
                                        echo "<script>alert('Login realizado com sucesso!');window.location.href='../public_html/home.php'</script>";
                                    }
                                }
                            }
                        }else{
                            echo "Senha incorreta.";
                        }
                    }else{
                        echo "Login incorreto, certifique-se que está digitando seu e-mail ou cpf, conforme solicitado na página de login";
                    }
                }
            }else{
                "Desculpe mas não detectamos nenhum dados de login";
            }
            
            mysqli_stmt_close($query);
            mysqli_close($connect);
        }else if($_GET['requisition'] == 'register'){
            if(!isset($_SESSION['register']['full_name']) && !isset($_SESSION['register']['email']) && !isset($_SESSION['register']['password']) && !isset($_SESSION['register']['cpf']) && !isset($_SESSION['register']['date_birth']) && !isset($_SESSION['register']['gender']) && !isset($_SESSION['register']['zip_code']) && !isset($_SESSION['register']['address']) && !isset($_SESSION['register']['number']) && !isset($_SESSION['register']['neighborhood']) && !isset($_SESSION['register']['city']) && !isset($_SESSION['register']['state']) && !isset($_SESSION['register']['level'])){
                echo "Você não possui autorização para acessar esta página.";
            }else{
                if(empty($_SESSION['register']['full_name']) && empty($_SESSION['register']['email']) && empty($_SESSION['register']['password']) && empty($_SESSION['register']['cpf']) && empty($_SESSION['register']['date_birth']) && empty($_SESSION['register']['gender']) && empty($_SESSION['register']['zip_code']) && empty($_SESSION['register']['address']) && empty($_SESSION['register']['number']) && empty($_SESSION['register']['neighborhood']) && empty($_SESSION['register']['city']) && empty($_SESSION['register']['state']) && empty($_SESSION['register']['level'])){
                    echo "Desculpe, ocorreu alguma falha em nossa página, volte a página de cadastro.";
                }else{
                    $query = mysqli_stmt_init($connect);

                    if(mysqli_stmt_prepare($query, $verify_login)){
                        mysqli_stmt_bind_param($query, 'ss', $_SESSION['register']['cpf'], $_SESSION['register']['email']);
                        mysqli_stmt_execute($query);
                        mysqli_stmt_store_result($query);

                        if(mysqli_stmt_num_rows($query) == 1){
                            mysqli_stmt_bind_result($query, $cpf, $email, $senha, $level);
                            mysqli_stmt_fetch($query);
                            
                            $senha = NULL;
                            $level = NULL;
                            
                            if($cpf == $_SESSION['register']['cpf']){
                                echo "<script>alert('CPF já cadastrado...');window.location.href='../public_html/login.php'</script>";
                            }else{
                                echo "<script>alert('E-mail já cadastrado...');window.location.href='../public_html/login.php'</script>";
                            }
                            
                            mysqli_stmt_free_result($query);
                        }else{
                            $full_name      = $_SESSION['register']['full_name'];
                            $full_name      = $_SESSION['register']['full_name'];
                            $email          = $_SESSION['register']['email'];
                            $password       = $_SESSION['register']['password'];
                            $cpf            = $_SESSION['register']['cpf'];
                            $date_birth     = $_SESSION['register']['date_birth'];
                            $gender         = $_SESSION['register']['gender'];
                            $zip_code       = $_SESSION['register']['zip_code'];
                            $address        = $_SESSION['register']['address'];
                            $number         = $_SESSION['register']['number'];
                            $neighborhood   = $_SESSION['register']['neighborhood'];
                            $city           = $_SESSION['register']['city'];
                            $state          = $_SESSION['register']['state'];
                            $level          = $_SESSION['register']['level'];
                            $date_register  = date('Y-m-d H:i:s');
                            $data_end       = NULL;
                            
                            if(isset($_SESSION['register']['complement']) && !empty($_SESSION['register']['complement'])){
                                $complement = $_SESSION['register']['complement'];
                            }else{
                                $complement = NULL;
                            }
                            
                            if(isset($_SESSION['register']['role']) && !empty($_SESSION['register']['role'])){
                                $role = $_SESSION['register']['role'];
                            }else{
                                $role = NULL;
                            }
                            
                            unset($_SESSION['register']);

                            if(mysqli_stmt_prepare($query, $register)){
                                mysqli_stmt_bind_param($query,'sssssississssssss',$cpf,$full_name,$email,$password,$date_birth,$gender,$zip_code,$address,$number,$complement,$neighborhood,$city,$state,$level,$role,$date_register, $date_end);
                                
                                if(!mysqli_stmt_execute($query)){
                                    echo "<script>alert('Não foi possível realizar o cadastro!');history.go(-2)</script>";
                                }else{
                                    echo "<script>alert('Cadastro realizado com sucesso!');window.location.href='../public_html/login.php'</script>";
                                }
                            }
                        }
                    }

                    mysqli_stmt_close($query);

                    mysqli_close($connect);
                }
            }
        }else{
            echo "alguma coisa";
        }
    }else{
        echo "Não tem nada.";
    }

?>