<?php
require '../vendor/autoload.php';

use App\Rooter\Rooter;
use App\Rooter\HeaderCreator;

$header = new HeaderCreator($_SERVER['REQUEST_URI'], "Think about Minecraft in a <a href=\"/tournament\" class=\"link\">competitive</a> way", "/img/arena.jpg");
$header->mapTitleArray([
    "/tournament" => "Incredible competition made by <a href=\"/about\" class=\"link\">us</a>",
    "/sponsor" => "We're sponsored by many incredible <a href=\"/about\" class=\"link\">people</a>!",
    "/404" => "Error 404"
]);

$rooter = new Rooter($_SERVER['REQUEST_URI'], $header, 'elements');
$rooter->setSiteName("E-Sport PvP Minecraft");

$rooter->root();
