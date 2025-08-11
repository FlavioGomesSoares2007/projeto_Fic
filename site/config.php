<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos/formulario.css">
    <style>
        @charset "UTF-8";

body {
    background-color: #060e81;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0px;
    font-family: Arial, Helvetica, sans-serif;
}
.box{
    background-color: white;
    width: 400px;
    padding: 30px;
    border-radius: 5px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.6);
}
a{
    color: white;
    text-decoration: none;
    background-color: #060e81;
    font-weight: bold;
    display: block;
    margin-left: 300px;
    padding: 10px 20px;
    border-radius: 5px;
    text-align: center;
}
    </style>
</head>
<body>
    <div class="box">   
        <?php
            $host = "turntable.proxy.rlwy.net:48410";
            $user = "root";
            $password = "tevZqPrdKTwISQKKcknhodLWHRhGNPWo";
            $database = "projetoFic";

            $conexao = new mysqli($host, $user, $password, $database);

            $nome = $_POST['nome'];
            $gmail = $_POST['gmail'];
            $cpf = $_POST['cpf'];
            $telefone = $_POST['telefone'];
            $senha = $_POST['senha'];
            $csenha = $_POST['confirma_senha'];
            $data_nascimento = $_POST['data'];
            $sexo = $_POST['genero'];

            if ($senha !== $csenha) {
                echo "As senhas não coincidem!";
                exit;
            }
        
            $sql_check = "SELECT * FROM alunos WHERE cpf = ? OR gmail = ?";
            $stmt_check = $conexao->prepare($sql_check);
            $stmt_check->bind_param("ss", $cpf, $gmail);
            $stmt_check->execute();
            $result = $stmt_check->get_result();

            if ($result->num_rows > 0) {
                echo " esse CPF ou Gmail já foi cadastrado!";
                exit;
            }

            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

            $sql_insert = "INSERT INTO alunos (  nome, gmail, cpf, telefone, senha, data_nascimento, sexo) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt_insert = $conexao->prepare($sql_insert);
            $stmt_insert->bind_param("sssiiss", $nome, $gmail, $cpf, $telefone, $senha_hash, $data_nascimento, $sexo);

            if ($stmt_insert->execute()) {
                echo "Cadastro realizado com sucesso!";
            } else {
                echo "Erro ao cadastrar: " . $stmt_insert->error;
            }

            $stmt_check->close();
            $stmt_insert->close();
            $conexao->close();
        ?>
        <div>
            <a href="index.html">Voltar</a>
        </div>
    </div>
</body>
</html>