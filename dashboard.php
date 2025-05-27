<?php 
//Inicia a sessão para poder acessar as variáveis de sessão
session_start();

//Verifica se o usuário está logado (se a variável de sessão 'usuário_id' existe)
if (!isset($_SESSION['usuario_id'])) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: login.php");
    exit; // Encerra o script imediatamente após o redirecionamento
}

// Se o usuário estiver logado, exibe a mensagem de boas-vindas com o nome armazenado na sessão
echo "<h2>Bem-vindo, " . $_SESSION['nome'] . "!</h2>";

// Exibe um link para o usuário sair da conta (logout)
echo "<a href='logout.php'>Sair</a>";
?>
?>