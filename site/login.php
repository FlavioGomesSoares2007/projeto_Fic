
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="estilos/boas.css">
</head>
<body>
     <div class="div">
            <?php
            
            session_start();

            $host = "turntable.proxy.rlwy.net:48410";
            $user = "root";
            $password = "tevZqPrdKTwISQKKcknhodLWHRhGNPWo";
            $database = "projetoFic";

            $conexao = new mysqli($host, $user, $password, $database);

            $cpf = $_POST['cpf'];
            $senhaDigitada = $_POST['senha'];

            // Busca usuário pelo CPF
            $sql = "SELECT id, nome, senha FROM alunos WHERE cpf = ?";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("s", $cpf);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();

                // Verifica se a senha digitada bate com o hash
                if (password_verify($senhaDigitada, $user['senha'])) {
                    $_SESSION['usuario_id'] = $user['id'];
                    $_SESSION['usuario_nome'] = $user['nome'];
                    echo "<p>Bem-vindo, " . htmlspecialchars($user['nome']) . " 😎</p>";
                } else {
                    echo "<p>Senha incorreta!</p>";
                }
            } else {
                echo "<p>Usuário não encontrado!</p>";
            }

            $stmt->close();
            $conexao->close();
        ?>
        <a href="#">continuar</a>
    </div>
</body>
</html>