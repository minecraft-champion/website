<?php

namespace App\GetServerInfo;

use App\MinecraftQuery\MinecraftQuery;
use Symfony\Component\Yaml\Yaml;

class GetServerInfo
{
    private array $names = ["stable" => 1, "dev" => 1, "build" => 1];

    public function __construct(
        private string $name
    ){
        if (!isset($this->names[$this->name])) {
            exit("This server doesn't exist");
        }
    }

    /**
     * Get every server's names
     * @return array
     */
    public function getNames(): array
    {
        return $this->names;
    }

    public function getInfo()
    {
        if (!file_exists(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . $this->name . ".yml")) {
            exit("The config file is not present");
        }

        $yml = Yaml::parseFile(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . $this->name . ".yml");
        $data = $yml[$this->name];

        $query = new MinecraftQuery($data['host'], $data['port'], 3, true);

        return $query->getInfo();

    }
}