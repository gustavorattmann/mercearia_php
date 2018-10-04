<?php
    
    session_start();

    include_once 'partials/head.inc.php';
    include_once 'partials/header.inc.php';
    include_once 'partials/navbar.inc.php';
       
?>
           
    <h1>Faça login</h1>
    <form name="autenticar" method="post" action="../controller/login.php">
        <label for="login">CPF/E-mail: </label>
        <input type="text" name="login" id="login">
        <label for="senha">Senha: </label>
        <input type="password" name="senha" id="senha">
        <button type="submit">Logar</button>
        <button type="reset">Limpar</button>
    </form>
    
<?php
        
    include_once 'partials/footer.inc.php';

?>