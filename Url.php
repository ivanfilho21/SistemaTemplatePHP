<?php

define("DEFAULT_PAGE", "home");

class Url
{

    public function __construct()
    {}

    public function start()
    {
        // $url = $_SERVER["REQUEST_URI"];
        $url = isset($_SERVER["PATH_INFO"]) ? $_SERVER["PATH_INFO"] : $_SERVER["REQUEST_URI"];
        // echo "<pre>" .print_r($_SERVER, true) ."</pre>";

        # Get the page
        $page = $this->getPage($url);

        // echo "Page: $page";

        $pages = json_decode(file_get_contents("pages.json"), true);
        // echo "<pre>" .var_export($pages, true) ."</pre>";

        if (isset($pages[$page])) {
            extract($pages[$page]);
            require "pages/layout/app.php";
        } else {
            require "requests/404.php";
            exit();
        }
    }

    private function getPage($url)
    {
        if ($url === "/") return DEFAULT_PAGE;

        $url = explode("/", $url);
        $url = array_values(array_filter($url));
        // echo "<pre>" .print_r($url, true) ."</pre>";

        $index = strpos($url[0], ".php");
        $index = $index === false ? -1 : $index;
        // echo "Index: $index <br>";

        $page = (strpos($url[0], "index") === false) ? $url[0] : DEFAULT_PAGE;
        $page = ($index !== -1) ? substr($page, 0, $index - 1) : $page;
        // echo "Page: $page";

        if (count($url) !== 1 || ! file_exists("pages/$page.php")) {
            require "requests/404.php";
            exit();
        }
        return $page;
    }
}