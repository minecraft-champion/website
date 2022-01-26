<?php
require '../vendor/autoload.php';

use App\Rooter\Rooter;
use App\Rooter\HeaderCreator;

$name = "E-Sport PvP Minecraft";

$header = new HeaderCreator($_SERVER['REQUEST_URI'], "Imaginez une véritable compétition PvP sur Minecraft", "/img/arena.jpg");
$header->mapTitleArray([
    "/404" => "Error 404",
    "/about" => "Qui sommes-nous ?"
]);

$rooter = new Rooter($_SERVER['REQUEST_URI'], $header, 'elements');
$rooter->setSiteName($name);
$rooter->setEnvVar([
    "name" => $name
]);

$rooter->root();
