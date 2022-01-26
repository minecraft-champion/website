<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/support.css">
    <meta name="description" content="<?= $description ?>">
</head>
<body>
    <header class="header">
        <nav class="header-item navbar">
            <div class="navbar-background" id="navbar-background"></div>
            <a class="navbar-item navbar-link link" href="/">Home</a>
            <!--<a class="navbar-item navbar-link link" href="/tournament">Tournament</a>-->
            <!--<a class="navbar-item navbar-link link" href="/sponsor">Sponsor</a>-->
            <!--<a class="navbar-item navbar-link link" href="/wiki">Wiki</a>-->
            <a class="navbar-item navbar-link link" href="/about">About</a>
            <a class="navbar-item navbar-link link" href="/discord">Discord</a>
        </nav>
        <h1 class="title title-primary">
            <?= $header['title'] ?>
        </h1>
        <div class="background"><img src="<?= $header['image'] ?>" class="header-background background" id="header-background" alt="Background"></div>
    </header>
    <div class="content">
        <?= $content ?>
    </div>
    <footer class="footer">
        <div class="l-flex l-list3 footer-content">
            <div class="l-flex3-item l-flex-item footer-column center-vert">
                <p>©2022 - All Rights Reserved on the content</p>
                <p>Code source distribué sous licence <a href="https://www.gnu.org/licenses/gpl-3.0.en.html" class="link link-extern" target="_blank">GPLv3</a></p>
            </div>
            <div class="l-flex3-item l-flex-item footer-column">
                <a href="/" class="link footer-link">Home</a>
                <a href="/about" class="link footer-link">About</a>
                <a href="/discord" class="link footer-link">Discord</a>
            </div>
            <div class="l-flex3-item l-flex-item footer-column center-vert">
                <a href="https://anhgelus.me/" class="link-extern link footer-link credit link-credit" target="_blank">by Anhgelus</a>
            </div>
        </div>
    </footer>
    <script src="/js/app.js"></script>
</body>
</html>