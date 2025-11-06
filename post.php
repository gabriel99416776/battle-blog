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
// Busca o nome do autor
$autorNome = 'Autor desconhecido';
if (!empty($post['publicado_por'])) {
    $idAutor = intval($post['publicado_por']);
    $sqlAutor = "SELECT nome FROM tbl_user WHERE id = $idAutor LIMIT 1";
    $resAutor = mysqli_query($conn, $sqlAutor);
    if ($resAutor && mysqli_num_rows($resAutor) > 0) {
        $autor = mysqli_fetch_assoc($resAutor);
        $autorNome = $autor['nome'];
    }
}

// busca comentários ativos do post
$sqlComentarios = "SELECT c.*, u.nome AS usuario_nome 
                   FROM tbl_comentarios c
                   JOIN tbl_user u ON c.usuario_id = u.id
                   WHERE c.post_id = $id AND c.status = 'ativo'
                   ORDER BY c.data_comentario DESC";
$resComentarios = mysqli_query($conn, $sqlComentarios);
$comentarios = mysqli_fetch_all($resComentarios, MYSQLI_ASSOC);

$logado = isset($_SESSION['user_id']);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($post['titulo']); ?></title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="post.css">
    
</head>

<body>
    <div class="tudo">
        <?php include 'header.php'; ?>

        <img src="<?= $post['imagem'] ?>" alt="" class="img-post">
        <div class="wrap">
            <article class="post">
                <span class="sample-badge"><i class="<?= htmlspecialchars($post['icone_tema']) ?>" style="font-size: 15px; margin-right: 10px;"></i><?= htmlspecialchars($post['tema']) ?></span>
                <h1><?= htmlspecialchars($post['titulo']) ?></h1>
                <div class="meta">
                    Publicado em <?= date('d/m/Y', strtotime($post['data_publicacao'] ?? 'now')) ?> •
                    Autor: <?= htmlspecialchars($autorNome) ?>
                </div>

                <p><?= nl2br(htmlspecialchars($post['conteudo'])) ?></p>
            </article>

            <!-- COMENTÁRIOS -->
            <aside class="sidebar" aria-label="Comentários">
                <div class="comments-card">
                    <div style="display:flex;justify-content:space-between;align-items:center">
                        <strong style="color: #fff;">Comentários</strong>
                        <small class="muted"><?= count($comentarios) ?> comentário<?= count($comentarios) != 1 ? 's' : '' ?></small>
                    </div>

                    <!-- lista -->
                    <div id="comments-list">
                        <?php if ($comentarios): ?>
                            <?php foreach ($comentarios as $c): ?>
                                <div class="comment">
                                    <div style="display:flex;align-items:center;">
                                        <div class="who"><?= htmlspecialchars($c['usuario_nome']) ?></div>
                                        <div class="time">• <?= date('d/m/Y H:i', strtotime($c['data_comentario'])) ?></div>
                                    </div>
                                    <div class="text"><?= nl2br(htmlspecialchars($c['comentario'])) ?></div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="empty-note">Nenhum comentário ainda. Seja o primeiro!</div>
                        <?php endif; ?>
                    </div>

                    <div style="height:1px;background:transparent;margin:6px 0"></div>

                    <!-- formulário -->
                    <div class="comment-form">
                        <label class="muted" for="new-comment">Escreva um comentário</label>
                        <textarea id="new-comment" placeholder="Deixe sua opinião..." <?= !$logado ? 'disabled' : '' ?>></textarea>
                        <div class="row" style="justify-content:space-between;margin-top:8px">
                            <?php if (!$logado): ?>
                                <div class="muted" id="login-note">
                                    Você precisa <a href="login.php" class="btn ghost">entrar</a> para comentar
                                </div>
                            <?php else: ?>
                                <button class="btn" id="send-btn">Comentar</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </aside>
        </div>

        <!-- Abinha fixa (sempre visível) -->
        <button class="tab" id="open-tab" aria-controls="drawer" aria-expanded="false">
            Comentários <span class="count" id="cnt"><?= count($comentarios) ?></span>
        </button>

        <!-- Drawer (para mobile e também útil em desktop quando abrir pela abinha) -->
        <section class="drawer" id="drawer" aria-hidden="true">
            <button class="close" id="close-drawer" aria-label="Fechar">✕</button>
            <strong style="color: #fff;">Comentários</strong>
            <small class="muted"><?= count($comentarios) ?> comentário<?= count($comentarios) != 1 ? 's' : '' ?></small>

            <div id="drawer-comments" style="margin-top:12px;display:flex;flex-direction:column;gap:10px">
                <!-- mesmos comentários copiados -->
                <?php if ($comentarios): ?>
                    <?php foreach ($comentarios as $c): ?>
                        <div class="comment">
                            <div style="display:flex;align-items:center;">
                                <div class="who"><?= htmlspecialchars($c['usuario_nome']) ?></div>
                                <div class="time">• <?= date('d/m/Y H:i', strtotime($c['data_comentario'])) ?></div>
                            </div>
                            <div class="text"><?= nl2br(htmlspecialchars($c['comentario'])) ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-note">Nenhum comentário ainda. Seja o primeiro!</div>
                <?php endif; ?>
            </div>

            <div style="margin-top:auto">
                <hr style="margin:12px 0;border:none;border-top:1px solid #eef2f7" />
                <div class="comment-form">
                    <label class="muted" for="new-comment">Escreva um comentário</label>
                    <textarea id="drawer-comment" placeholder="Deixe sua opinião..." <?= !$logado ? 'disabled' : '' ?>></textarea>
                    <div class="row" style="justify-content:space-between;margin-top:8px">
                        <?php if (!$logado): ?>
                            <div class="muted" id="login-note">
                                Você precisa <a href="login.php" class="btn ghost">entrar</a> para comentar
                            </div>
                        <?php else: ?>
                            <button class="btn" id="drawer-send-btn">Comentar</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <?php include 'footer.php'; ?>
    </div>

    <script>
        const openTab = document.getElementById('open-tab');
        const drawer = document.getElementById('drawer');
        const closeDrawer = document.getElementById('close-drawer');
        // elementos do drawer (mobile)
        const drawerText = document.getElementById('drawer-text');
        const drawerSend = document.getElementById('drawer-send-btn');
        const drawerLoginToggle = document.getElementById('drawer-login-toggle');
        // inicializar
        openTab.addEventListener('click', () => {
            drawer.classList.add('open');
            drawer.setAttribute('aria-hidden', 'false');
            openTab.setAttribute('aria-expanded', 'true');
        });
        closeDrawer.addEventListener('click', () => {
            drawer.classList.remove('open');
            drawer.setAttribute('aria-hidden', 'true');
            openTab.setAttribute('aria-expanded', 'false');
        });



        // Envio de comentário via AJAX
        // Envio de comentário via AJAX
        document.addEventListener("DOMContentLoaded", () => {
            async function enviarComentario(textarea, btn) {
                const comentario = textarea.value.trim();
                if (!comentario) return alert("Digite um comentário!");
                btn.disabled = true;

                const formData = new FormData();
                formData.append("post_id", "<?= $id ?>");
                formData.append("comentario", comentario);

                try {
                    const res = await fetch("salvar_comentario.php", {
                        method: "POST",
                        body: formData
                    });
                    const json = await res.json();
                    if (json.sucesso) {
                        const list = document.getElementById("comments-list");
                        const novo = document.createElement("div");
                        novo.className = "comment";
                        novo.innerHTML = `
                    <div style="display:flex;align-items:center;">
                        <div class="who">${json.usuario}</div>
                        <div class="time">• agora mesmo</div>
                    </div>
                    <div class="text">${json.comentario}</div>
                `;
                        list.prepend(novo);
                        textarea.value = "";
                    } else {
                        alert(json.erro);
                    }
                } catch (e) {
                    alert("Erro ao enviar comentário!");
                }
                btn.disabled = false;
            }

            const btn1 = document.getElementById("send-btn");
            const textarea1 = document.getElementById("new-comment");
            const btn2 = document.getElementById("drawer-send-btn");
            const textarea2 = document.getElementById("drawer-comment");

            if (btn1 && textarea1) btn1.addEventListener("click", () => enviarComentario(textarea1, btn1));
            if (btn2 && textarea2) btn2.addEventListener("click", () => enviarComentario(textarea2, btn2));
        });
    </script>
</body>

</html>