<?php
include 'bd.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    // Verifica se os campos estão preenchidos
    if (empty($nome) || empty($email) || empty($senha)) {
        header("Location: cadastro.php?error=Campos obrigatórios não preenchidos");
        exit;
    }

    // Criptografa a senha
    $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

    // Query segura com prepared statement
    $stmt = $conn->prepare("INSERT INTO tbl_user (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $senha_hash);

    if ($stmt->execute()) {
        header("Location: login.php?success=1");
        exit;
    } else {
        echo "Erro ao cadastrar usuário: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
