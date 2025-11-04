<?php
include 'bd.php'; // conexão com o banco
session_start();
if (!isset($_GET['id'])) {
    echo "Post não encontrado.";
    exit;
}

$id = intval($_GET['id']); // segurança
$query = "SELECT * FROM tbl_posts WHERE id = $id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    echo "Post não encontrado.";
    exit;
}

$post = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($post['titulo']); ?></title>
    <?php include 'cdn.php'; ?>
</head>

<body>
    <div class="tudo">
        <?php include 'header.php'; ?>

        <img src="<?= $post['imagem'] ?>" alt="" class="img-post">
        <div class="container">

            <h1 class="titulo-post"><?= htmlspecialchars($post['titulo']); ?></h1>
            <div class="conteudo-post">
                <?= nl2br($post['conteudo']); ?>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>

</body>

</html>