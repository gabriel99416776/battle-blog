<?php
session_start();

// Remove todas as variáveis da sessão
session_unset();

// Destroi a sessão completamente
session_destroy();

// Redireciona para a página de login
header("Location: index.php");
exit;
?>
