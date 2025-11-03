<?php
include 'bd.php';
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Battle Blog</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/uikit.min.css" />
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="tudo">
        <nav class="navbar bg-black navbar-expand-xl navbar-dark">
            <div class="container">
                <img src="assets/logo.png" alt="">
                <button class="navbar-toggler" type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#navbarOffcanvas"
                    aria-controls="navbarOffcanvas"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end bg-secondary" id="navbarOffcanvas"
                    tabindex="-1" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title text-light" id="offcanvasNavbarLabel">Offcanvas</h5>
                        <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <a class="nav-item nav-link active" aria-current="page" href="#">Bubbles</a>
                            <a class="nav-item nav-link" href="#">Cosmo</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>


        <section>

            <div class="uk-position-relative uk-visible-toggle uk-light carousel-centro" tabindex="-1" uk-slideshow="animation: fade">

                <div class="uk-slideshow-items">
                    <div>
                        <img src="assets/carousel.png" alt="" uk-cover>
                        <div class="uk-overlay uk-overlay-primary uk-position-bottom uk-text-center uk-transition-slide-bottom">
                            <h3 class="uk-margin-remove">Novos Modos/Mapas e Armas</h3>
                            <p class="uk-margin-remove">Battlefield 6 trás uma tematica de guerra atual que não vimos desde o Battlefield 4.</p>
                        </div>
                    </div>
                    <div>
                        <img src="assets/carousel2.png" alt="" uk-cover>
                        <div class="uk-overlay uk-overlay-primary uk-position-bottom uk-text-center uk-transition-slide-bottom">
                            <h3 class="uk-margin-remove">Veiculos</h3>
                            <p class="uk-margin-remove">As desenvolvedoras trouxe de volta as guerras aereas e terrestres com reformulações nos tanques, helicopteros e jatos.</p>
                        </div>
                    </div>
                    <div>
                        <img src="assets/carousel3.png" alt="" uk-cover>
                        <div class="uk-overlay uk-overlay-primary uk-position-right uk-text-center uk-transition-slide-right uk-width-medium">
                            <h3 class="uk-margin-remove">Battle Royale</h3>
                            <p class="uk-margin-remove">Uma Novidade bem antiga na saga. Depois do desastre do Battle Royale presente no Battlefield V, Dice tenta entrar em um novo genero trazendo o Battle Royale estilo BF6, o chamado RedSec.</p>
                        </div>
                    </div>
                </div>

                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href uk-slidenav-previous uk-slideshow-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href uk-slidenav-next uk-slideshow-item="next"></a>

            </div>
            <div>
                <div class="container">
                    <h2 class="clinic-carousel-title"><i class="bi bi-tools"></i> Atualizações do Battlefield 6 </h2>
                    <div class="row">
                        <?php
                        $query = "SELECT * FROM atualizacoes ORDER BY id DESC";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <div class="col-md-3 mb-4"> <!-- 4 cards por linha em md+ -->
                                    <div class="card bg-dark text-white h-100">
                                        <img src="<?= $row['imagem'] ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-att"><?= $row['titulo']; ?></p>
                                            <p class="card-text"><?= $row['versao']; ?></p>
                                            <p class="card-titulo"><?= $row['descricao']; ?></p>
                                            <button
                                                type="button"
                                                class="btn botao-att"
                                                data-bs-toggle="popover"
                                                data-bs-placement="top"
                                                data-bs-custom-class="custom-popover"
                                                data-bs-html="true"
                                                data-bs-title="<?= htmlspecialchars($row['descricao']); ?>"
                                                data-bs-content="<?= htmlspecialchars($row['motivo_att']); ?> <br><a href='<?= htmlspecialchars($row['link_att']); ?>' target='_blank'>Saiba mais</a>">
                                                O que mudou?
                                            </button>


                                        </div>
                                    </div>

                                </div>
                        <?php
                            }
                        } else {
                            echo "<p>Nenhuma atualização encontrada.</p>";
                        }
                        ?>
                    </div>

                    <h2 class="clinic-carousel-title"><i class="bi bi-pen-fill"></i> Publicações Recentes </h2>

                    <div class="row">
                        <div class="col-md-4 p-4">
                            <div class="border">
                                <div class="position-relative w-100" style="height: 250px;background-image: url(https://drop-assets.ea.com/images/7ci5pMD6oEF1LcWn6rl675/1800360db479da62b5e520ae83a89b47/battlefield-6-tactical-destruction-16x9.jpg); background-size: cover; background-position: center;">
                                    <div class="position-absolute bg-dark" style="opacity: .3; top: 0; left:0; right: 0; bottom: 0;"></div>
                                    <div class="position-absolute text-white d-flex flex-column justify-content-center align-items-center rounded-circle" style="top:10px; right:10px; width: 70px; height: 70px; background-color: #e73700;">
                                        <small>27</small>
                                        <small><b>MAR</b></small>
                                    </div>
                                    <a href="#" class="position-absolute px-3 py-2 text-white ler" style="bottom:10px; left: 10px; background-color: #e73700;"><small>LER</small></a>
                                </div>
                                <div class="px-3 pt-4 pb-3">
                                    <a href="#" class="d-inline-block" style="text-decoration:none;">
                                        <h1 style="font-weight:600; font-size:2rem; color:#fff;">
                                            Lorem ipsum dolor sit amet.
                                        </h1>
                                    </a>

                                    <p class="tex-secondary" style="color: #fff">asperiores dolore explicabo aut excepturi aliquam nam?</p>
                                    <div class="d-flex mt-4">
                                        <div class="d-flex align-items-center mr-4">
                                            <i class="bi bi-clock-fill me-1" style="color:#e73700;"></i>
                                            <small style="color:#e73700; margin-right: 20px">6 min ago</small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-chat-dots-fill me-1" style="color:#e73700;"></i>
                                            <small style="color:#e73700;">3 comments</small>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </section>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
            const popoverList = [...popoverTriggerList].map(el => new bootstrap.Popover(el));

            // Quando o popover abre, converte \n em <br>
            document.body.addEventListener('shown.bs.popover', function(e) {
                const popover = document.querySelector('.popover-body');
                if (popover) {
                    popover.innerHTML = popover.innerHTML.replace(/\n/g, '<br>');
                }
            });
        });
    </script>



</body>

</html>