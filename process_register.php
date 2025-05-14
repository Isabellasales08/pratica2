<?php 
//Inclui o arquivo de conexão com o banco de dados
require 'config/db.php';

//Verifica se o formulário foi enviado utilizando o método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Pega os dados do formulário enviados pelo método POST
    $nome = $_POST['nome'];     //Nome digitando pelo usuário
    $email = $_POST['email'];   //Email digitando pelo usauário

    //Criptografa a senha antes de salvar no banco de dados
    //Password_hash() é uma função segura que utiliza o algoritmo bcrypt por padrão
    $senha  = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    //Prepara o query SQL com parâmetros (?) para evitar SQL Injection
    $stmt = $conn->prepare("INSERT INTO usuarioS (nome, email, senha) VALUES (?, ?, ?)");

    //Substitui os parâmetros  da query pelos valeres reais de forma segura
    //"sss" significa que estamos passando 3 strings (s = string)
    $stmt->bind_param("sss", $nome, $email, $senha);

    //Executa a query SQL no banco de dados
    if ($stmt->execute()) {
        //Se o cadastro for feito com sucesso, redireciona para a tela de login
        //Envia o parâmetro "sucesso=1" na URL para mostrar mensagem de login
        header("Location: login.php?sucesso=1");
        exit; //Finaliza o script imediatamente após o redirecionamento
} else {
     // Caso ocorra algum erro (ex: email duplicado), exibe o erro na tela 
    echo "Erro ao cadastrar: " . $conn->error;
 

}


}

?>