<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
@charset "UTF-8";

body {
    background-color: #060e81;
    min-height: 102vh; 
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0px;
    font-family: Arial, Helvetica, sans-serif;
    padding: 20px;
    box-sizing: border-box;
}

.box {
    background-color: white;
    width: 100%;        
    max-width: 400px;   
    padding: 30px;
    border-radius: 5px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.6);
}

p{
    text-align: center;
}
a {
    color: white;
    text-decoration: none;
    background-color: #060e81;
    font-weight: bold;
    display: block;
    padding: 10px 5px;
    border-radius: 5px;
    text-align: center;
    transition: background 0.3s;
    margin: auto;
    max-width: 150px;
}

a:hover {
    background-color: #0041a8;
}

@media (max-width: 500px) {
    body {
        padding: 10px;
    }

    .box {
        padding: 20px;
    }

    a {
        width: 100%; 
        max-width: none;
        margin: 20px 0 0 0;
    }
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
                echo "<p><strong>As senhas não coincidem!</strong></p>" . '<a href="formulario.html">Voltar</a>';
                exit;
            }

            
        
            $sql_check = "SELECT * FROM alunos WHERE cpf = ? OR gmail = ?";
            $stmt_check = $conexao->prepare($sql_check);
            $stmt_check->bind_param("ss", $cpf, $gmail);
            $stmt_check->execute();
            $result = $stmt_check->get_result();

            if ($result->num_rows > 0) {
                echo " <p><strong>Esse CPF ou Gmail já foi cadastrado!</strong></p>" . '<a href="formulario.html">Voltar</a>';
                exit;
            }

            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

            $sql_insert = "INSERT INTO alunos (  nome, gmail, cpf, telefone, senha, data_nascimento, sexo) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt_insert = $conexao->prepare($sql_insert);
            $stmt_insert->bind_param("sssisss", $nome, $gmail, $cpf, $telefone, $senha_hash, $data_nascimento, $sexo);

            if ($stmt_insert->execute()) {
                echo "<p><strong>Cadastro realizado com sucesso!</strong></p>" . '<a href="login.html">Voltar</a>';
            } else {
                echo "<p><strong>Erro ao cadastrar:</strong></p> " .'<a href="formulario.html">Voltar</a>' . $stmt_insert->error;
            }

            $stmt_check->close();
            $stmt_insert->close();
            $conexao->close();
        ?>

            

    </div>
</body>
</html>