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
                <h5 class="offcanvas-title text-light" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/battlefield/">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">GamesBlog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Apoiador</a>
                    </li>

                    <?php if (isset($_SESSION['user_nome'])): ?>
                        <div class="btn-group">
                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #e73700; color: #fff; letter-spacing: 1px; font-weight: bold; margin-left: 10px;">
                                👋 <?= htmlspecialchars($_SESSION['user_nome']); ?>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="painel.php">Painel</a></li>


                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="logout.php">Sair</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</nav>
