<?php
    session_start();

    $host = "turntable.proxy.rlwy.net:48410";
    $user = "root";
    $password = "tevZqPrdKTwISQKKcknhodLWHRhGNPWo";
    $database = "projetoFic";

    $conexao = new mysqli($host, $user, $password, $database);

    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    // Busca usuário pelo CPF
    $sql = "SELECT * FROM alunos WHERE cpf = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $hash = $user['senha'];

        // Verifica a senha
        if (password_verify($senha, $hash)) {
            echo "Login efetuado com sucesso! Bem-vindo, " . htmlspecialchars($user['nome']);
            // Aqui pode redirecionar para página privada:
            // header("Location: dashboard.php");
            // exit();
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado!";
    }

    $stmt->close();
    $conexao->close();
?>
