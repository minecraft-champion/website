<?php
namespace App\Rooter;

use JetBrains\PhpStorm\Pure;

class Rooter {

    private string $siteName = '';

    private array $mapUri = [];

    private array $mapTitle = [];

    private array $mapDesc = [];

    private string $defaultRoot = "home.php";

    /**
     * Rooter constructor.
     * @param string $uri Uri (ex: '/', '/news', '/video?id=16a', etc)
     * @param string $folder Folder of files
     * @param string|null $htmlBase name of the html base file
     */
    public function __construct(
        private string $uri,
        private HeaderCreator $header,
        private string $folder,
        private ?string $htmlBase = "html"
    ){}

    /**
     * Root to the right page
     */
    public function root()
    {
        $uri = $this->uri;
        $map = $this->mapUri;

        ob_start();
        if ($uri === '/'  || (str_contains($uri, '?') && substr($uri, 0, strpos($uri, '?')) == '/' )) {
            require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR . $this->defaultRoot;
        } else if (isset($map[$uri])) {
            require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR . $map[$uri];
        } else if ($this->doesItExist($uri)) {
            if (str_contains($uri, '?')) {
                require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . $this->folder . $this->detectorGetForm($uri);
            } else {
                require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . $this->folder . $uri . '.php';
            }
        } else {
            require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR . '404.php';
        }
        $content = ob_get_clean();
        if ($this->doesItExist($uri) || isset($map[$uri]) || $uri === '/') {
            $header = ['title' => $this->header->getHeaderTitle(), 'image' => $this->header->getHeaderImage()];
        } else {
            $header = ['title' => $this->header->getHeaderTitle('/404'), 'image' => $this->header->getHeaderImage('/404')];
        }
        $title = $this->getPageTitle();
        $description = $this->getPageDesc();

        require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR . $this->htmlBase . '.php';
    }

    /**
     * Set the home page
     * @param string $name Name of the file at the uri '/'
     */
    public function setDefault(string $name)
    {
        $this->defaultRoot = $name . '.php';
    }

    /**
     * Set the website name
     *
     * @param string $siteName website Name
     */
    public function setSiteName(string $siteName): void
    {
        $this->siteName = $siteName;
    }

    /**
     * Remap to the right page
     *
     * @param string $uri Uri (ex: '/', '/news', '/video?id=16a', etc)
     * @param string $link New link to the page ('video.php', 'test/test2.php', etc)
     */
    public function map(string $uri, string $link):void
    {
        $this->mapUri[$uri] = $link;
    }

    /**
     * Map a list of uri with a list of link
     * @param array $data List of uri with link ["/hey" => "test/test2.php"]
     */
    public function mapArray(array $data)
    {
        $this->mapUri = array_merge($this->mapUri, $data);
    }

    /**
     * Modify the title of a specific page
     *
     * @param string $uri Uri (ex: '/', '/news', '/video?id=16a', etc)
     * @param string $title New page's title ('Home Page', 'Just Video', etc)
     */
    public function mapTitle(string $uri, string $title):void
    {
        $this->mapTitle[$uri] = $title;
    }

    /**
     * Map a list of uri with a list of title
     * @param array $data List of uri with link ["/hey" => "This is a title"]
     */
    public function mapTitleArray(array $data)
    {
        $this->mapTitle = array_merge($this->mapTitle, $data);
    }

    /**
     * Add page's description
     *
     * @param string $uri Uri (ex: '/', '/news', '/video?id=16a', etc)
     * @param string $desc New page's description ("Video page, it's just that lmao", 'You can use the simple quote with \'it\s\' if you want')
     */
    public function mapDesc(string $uri, string $desc):void
    {
        $this->mapDesc[$uri] = $desc;
    }

    /**
     * Map a list of uri with a list of description
     * @param array $data List of uri with link ["/hey" => "This is just the description of an 'hey' page"]
     */
    public function mapDescArray(array $data)
    {
        $this->mapDesc = array_merge($this->mapDesc, $data);
    }

    /**
     * Informs if the file with this name exists
     *
     * @param string $uri Uri (ex: '/', '/hey', etc)
     * @return bool true = file exist ; false = file doesn't exist
     */
    #[Pure] private function doesItExist(string $uri): bool
    {
        if ($uri === '/' . $this->htmlBase) {
            return false;
        } else if (file_exists(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . $this->folder . $uri . '.php')) {
            return true;
        } else if (str_contains($uri, '?')) {
            if (file_exists(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . $this->folder . $this->detectorGetForm($uri))) {
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * Get the page's title
     *
     * @return string Page's title
     */
    #[Pure] private function getPageTitle(): string
    {
        $uri = $this->uri;
        $map = $this->mapTitle;

        if ($uri === '/' || (str_contains($uri, '?') && substr($uri, 0, strpos($uri, '?')) == '/' )) {
            return $this->transformEnd('Home');
        } else if ($this->doesItExist($uri)) {
            if (isset($map[$uri])) {
                return $this->transformEnd($map[$uri]);
            } else if (str_contains($uri, '?')) {
                if ($this->detectGetIntoMap($map, $uri) !== false) {
                    return $this->transformEnd($map[substr($uri, 0, (strpos($uri, '?')))]);
                }

                $title = strtoupper(substr($uri, 1, 1)) . substr($uri, 2, (strpos($uri, '?') - 2));
                return $this->transformEnd($title);

            }

            $title = strtoupper(substr($uri, 1, 1)) . substr($uri, 2, strlen($uri));
            return $this->transformEnd($title);
        }

        return $this->transformEnd("404");
    }

    /**
     * Get the page's description
     *
     * @return string Page's description
     */
    private function getPageDesc(): string
    {
        $uri = $this->uri;
        $map = $this->mapDesc;

        if ($uri === '/') {
            return 'Description';
        } else return $map[$uri] ?? 'No Description';
    }

    /**
     * Transform the end to add the name of the website
     *
     * @param  mixed $base Base to be transformed
     * @return string Base transformed
     */
    private function transformEnd(string $base): string
    {
        return $base . ' | ' . $this->siteName;
    }

    /**
     * Detects and returns the original file name when using GET in a form
     *
     * @param  mixed $uri Uri (ex: '/', '/hey?lul=yes', etc)
     * @return string File's name ; False = file doesn't exist
     */
    private function detectorGetForm(string $uri): string
    {
        if (str_contains($uri, '?')) {
            return substr($uri, 0, strpos($uri, '?')) . '.php';
        }
        return false;
    }

    /**
     * Detects if there is use of GET in the $uri link
     *
     * @param array $mapTitle Array defined by $this->mapTitle()
     * @param string $uri Uri (ex: '/', '/news', '/video?id=16a', etc)
     * @return bool true = use GET | false = doesn't use GET
     */
    private function detectGetIntoMap(array $mapTitle, string $uri): bool
    {
        if ($mapTitle[substr($uri, 0, (strpos($uri, '?')))] !== null) {
            return true;
        }
        return false;
    }
}
