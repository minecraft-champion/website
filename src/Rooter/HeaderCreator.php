<?php

namespace App\Rooter;

class HeaderCreator
{

    private array $title = [];

    private array $image = [];

    /**
     * @param string $uri Uri of the page
     * @param string $defaultTitle Default title
     * @param string $defaultImage Default image link
     */
    public function __construct(
        private string $uri,
        private string $defaultTitle,
        private string $defaultImage
    ){}

    /**
     * Get the header title
     * @param null|string $uri Uri of a page
     * @return string Title
     */
    public function getHeaderTitle(?string $uri = null): string
    {
        if ($uri != null) {
            return $this->title[$uri] ?? $this->defaultTitle;
        }
        return $this->title[$this->uri] ?? $this->defaultTitle;
    }

    /**
     * Get the header image
     * @param null|string $uri Uri of a page
     * @return string Image
     */
    public function getHeaderImage(?string $uri = null): string
    {
        if ($uri != null) {
            return $this->image[$uri] ?? $this->defaultImage;
        }
        return $this->image[$this->uri] ?? $this->defaultImage;
    }

    /**
     * Map the title to the uri
     * @param string $uri Uri of the page
     * @param string $title Title of the page
     */
    public function mapTitle(string $uri, string $title): void
    {
        $this->title[$uri] = $title;
    }

    /**
     * Map a list of title with a list of uri
     * @param array $data List of uri with title ["/hey" => "Hey guys!"]
     */
    public function mapTitleArray(array $data): void
    {
        $this->title = array_merge($this->title, $data);
    }

    /**
     * Map the image to the uri
     * @param string $uri Uri of the page
     * @param string $uriToImage Image's uri of the page
     */
    public function mapImage(string $uri, string $uriToImage): void
    {
        $this->image[$uri] = $uriToImage;
    }

    /**
     * Map a list of image's uri with a list of uri
     * @param array $data List of uri with image's uri ["/hey" => "/img/hey.jpg"]
     */
    public function mapImageArray(array $data): void
    {
        $this->image = array_merge($this->image, $data);
    }
}
