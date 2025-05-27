<?php 

require 'config/db.php';

// Verifica se o formulário foi enviado utilizando o método POST
if ($_SERVER ["REQUEST_METHOD"] == "PODST") {

//pega os dados do formulário enviados pelo método POST
$nome = $_POST [ 'nome'];     //Nome digitado pelo usuário 
$email = $_POST['email'];     //Email digitado pelo usuário

//Criptografia a senha antes de salvar no banco de dados
// password_hash() é uma função segura que utiliza o algoritimo bcrypt por padrão 
$senha = password_hash($_POST ['senha'], PASSWORD_DEFAULT);

//Prepara a query SQL com paramêtros (?) para evitar SQL Injection
$stmt = $conn->prepare("INSERT INTO usuário (nome, email, senha) VALUES (?,?,?)");

//substitui os parâmetros da query pelos valores reais de forma segura
//"sss" significa que estamos passando 3 strings ( s = string)
$stmt ->bind_param ("sss" , $nome, $email, $senha);

// Executa a query SQL no banco de dados
if ($stmt->execute()) {
// Se  o cadastro for feito com sucesso, redireciona para a tela de login
// Envia o parâmetro "sucesso=1" na URL para mostrar mensagem no login
header("Location: login.php?sucesso=1");
exit; // Finaliza o script imediatamente após
}

}
?>