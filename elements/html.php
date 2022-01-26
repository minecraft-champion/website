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
            <a class="navbar-item navbar-link link" href="/tournament">Tournament</a>
            <a class="navbar-item navbar-link link" href="/sponsor">Sponsor</a>
            <a class="navbar-item navbar-link link" href="/wiki">Wiki</a>
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
            <div class="l-flex3-item l-flex-item footer-column">
                <a href="/" class="link footer-link">Home</a>
                <a href="/tournament" class="link footer-link">Tournament</a>
                <a href="/sponsor" class="link footer-link">Sponsor</a>
            </div>
            <div class="l-flex3-item l-flex-item footer-column">
                <a href="/wiki" class="link footer-link">Wiki</a>
                <a href="/about" class="link footer-link">About</a>
                <a href="/discord" class="link footer-link">Discord</a>
            </div>
            <div class="l-flex3-item l-flex-item footer-column">
                <a href="https://patreon.com/" class="link link-extern footer-link" target="_blank">Patreon</a>
                <a href="https://twitch.tv/" class="link link-extern footer-link" target="_blank">Twitch</a>
                <a href="http://anhgelus.me/" class="link-extern link footer-link credit link-credit" target="_blank">by Anhgelus</a>
            </div>
        </div>
    </footer>
    <script src="/js/app.js"></script>
</body>
</html>