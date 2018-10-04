<?php

    session_start();

    require_once '../config.php';

    date_default_timezone_set(SAO_PAULO);

    include_once 'partials/head.inc.php';

?>
    
    <script type="text/javascript" src="../assets/js/buscacep.js"></script>
    <script type="text/javascript" src="../assets/js/cadastro.js"></script>
    
<?php

    include_once 'partials/header.inc.php';
    include_once 'partials/navbar.inc.php';
    
?>
    
    <h1>Faça seu cadastro</h1>
    <form name="cadastro" method="post" action="../controller/register.php">
        <label for="nome_completo">Nome Completo: </label>
        <input type="text" name="nome_completo" id="nome_completo" required>
        <label for="email">E-mail: </label>
        <input type="email" name="email" id="email" required>
        <label for="senha">Senha: </label>
        <input type="password" name="senha" id="senha" required>
        <!--<label for="confirma">Confirma Senha: </label>
        <input type="password" name="confirma" id="confirma" required>-->
        <label for="cpf">CPF: </label>
        <input type="text" name="cpf" required><!-- id="cpf" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}" onblur="return mascara(this, '###.###.###-##')" -->
        <label for="data_nascimento">Data Nascimento: </label>
        <input type="date" name="data_nascimento" id="data_nascimento" min="<?= date('Y-m-d', strtotime('-120 years')) ?>" max="<?= date('Y-m-d', strtotime('-18 years')) ?>" required>
        <label for="sexo">Sexo: </label>
        <input type="radio" name="sexo" id="sexo" class="f" value="f" required><p>Feminino</p>
        <input type="radio" name="sexo" id="sexo" class="m" value="m" required><p>Masculino</p>
        <label for="cep">CEP: </label>
        <input type="text" name="cep" id="cep" onblur="pesquisacep(this.value);" required>
        <label for="endereco">Endereço: </label>
        <input type="text" name="endereco" id="endereco" required>
        <label for="numero">Número: </label>
        <input type="number" name="numero" id="numero" min="01" maxlength="4" required>
        <label for="complemento">Complemento: </label>
        <input type="text" name="complemento" id="complemento">
        <label for="bairro">Bairro: </label>
        <input type="text" name="bairro" id="bairro" required>
        <label for="cidade">Cidade: </label>
        <input type="text" name="cidade" id="cidade" required>
        <label for="uf">UF: </label>
        <input type="text" name="uf" id="uf" required>
        <button type="submit">Enviar</button>
        <button type="reset">Limpar</button>
    </form>

<?php

    include_once 'partials/footer.inc.php';

?>