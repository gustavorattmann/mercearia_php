<?php

	session_start();
	unset($_SESSION['login']);

	echo "<script>alert('Deslogado com sucesso!');window.location.href='home.php'</script>";

?>