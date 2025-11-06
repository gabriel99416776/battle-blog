<?php
include 'bd.php'; // conexão com o banco
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($post['titulo']); ?></title>
    <?php include 'cdn.php'; ?>

    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:300,400,600);

        .snip1336 {
            font-family: 'Roboto', Arial, sans-serif;
            position: relative;
            overflow: hidden;
            margin: 80px auto;
            min-width: 230px;
            max-width: 450px;
            width: 100%;
            color: #ffffff;
            text-align: left;
            line-height: 1.4em;
            background-color: #141414;
        }

        .snip1336 * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            -webkit-transition: all 0.25s ease;
            transition: all 0.25s ease;
        }

        .snip1336 img {
            max-width: 100%;
            vertical-align: top;
            opacity: 0.85;
        }

        .snip1336 figcaption {
            width: 100%;
            background-color: #141414;
            padding: 25px;
            position: relative;
        }

        .snip1336 figcaption:before {
            position: absolute;
            content: '';
            bottom: 100%;
            left: 0;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 55px 0 0 400px;
            border-color: transparent transparent transparent #141414;
        }

        .snip1336 figcaption a {
            padding: 5px;
            border: 1px solid #ffffff;
            color: #ffffff;
            font-size: 0.7em;
            text-transform: uppercase;
            margin: 10px 0;
            display: inline-block;
            opacity: 0.65;
            width: 47%;
            text-align: center;
            text-decoration: none;
            font-weight: 600;
            letter-spacing: 1px;
            width: 100%;
        }

        .snip1336 figcaption a:hover {
            opacity: 1;
        }

        .snip1336 .profile {
            border-radius: 50%;
            position: absolute;
            bottom: 100%;
            left: 25px;
            z-index: 1;
            max-width: 90px;
            opacity: 1;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }

        .snip1336 .follow {
            margin-right: 4%;
            border-color: #2980b9;
            color: #2980b9;
        }

        .snip1336 h2 {
            margin: 0 0 5px;
            font-weight: 500;
        }

        .snip1336 h2 span {
            display: block;
            font-size: 0.6em;
            color: #2980b9;
            letter-spacing: 1px;
        }

        .snip1336 p {
            margin: 0 0 10px;
            font-size: 0.8em;
            letter-spacing: 1px;
            opacity: 0.8;
        }
    </style>

</head>

<body>
    <div class="tudo">
        <?php include 'header.php'; ?>

        <figure class="snip1336">
            <img src="assets/fundo-painel.png" alt="sample87" />
            <figcaption>
                <img src="assets/painel.png" alt="profile-sample4" class="profile" />

                <h2><?= htmlspecialchars($_SESSION['user_nome']); ?><span><?= htmlspecialchars($_SESSION['user_classe']); ?></span></h2>
                <p>Email - <?= htmlspecialchars($_SESSION['user_email']); ?></p>
                <a href="#" class="info">Troca Foto</a>
            </figcaption>
        </figure>


    </div>

</body>

</html>