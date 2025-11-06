<?php
include 'bd.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["sucesso" => false, "erro" => "Você precisa estar logado."]);
    exit;
}

$usuario_id = $_SESSION['user_id'];
$post_id = intval($_POST['post_id'] ?? 0);
$comentario = trim($_POST['comentario'] ?? '');

if (!$post_id || $comentario == '') {
    echo json_encode(["sucesso" => false, "erro" => "Comentário inválido."]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO tbl_comentarios (post_id, usuario_id, comentario, data_comentario, status) VALUES (?, ?, ?, NOW(), 'ativo')");
$stmt->bind_param("iis", $post_id, $usuario_id, $comentario);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    // busca nome do usuário logado
    $u = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nome FROM tbl_user WHERE id=$usuario_id"));
    echo json_encode([
        "sucesso" => true,
        "usuario" => htmlspecialchars($u['nome']),
        "comentario" => htmlspecialchars($comentario)
    ]);
} else {
    echo json_encode(["sucesso" => false, "erro" => "Erro ao salvar comentário."]);
}
