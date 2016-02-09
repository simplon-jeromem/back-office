<?php
class Redirection
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }
    public function redirect()
    {
         header("Location: $this->url");
    }
}

?>