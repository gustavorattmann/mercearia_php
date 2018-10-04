    </head>
    <body>
        <header>
            <h1>Mercearia Tem de Tudo</h1>
            <p>Disponibilizando os melhores produtos aos nossos clientes.</p>
            <nav>
                <ul>
                    <?php
                        
                        if(!isset($_SESSION['login']['level'])){
                            
                    ?>
                           
                        <a href="login.php"><li>Login</li></a>
                        <a href="register.php"><li>Registrar-se</li></a>
                            
                    <?php
                            
                        }else{
                            
                    ?>
                           
                        <a href="profile.php"><li>Perfil</li></a>
                        <a href="logout.php"><li>Deslogar</li></a>
                            
                    <?php
                        
                        }
                            
                    ?>
                </ul>
            </nav>
        </header>