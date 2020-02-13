<?php

define('DEFAULT_PAGE', 'home');

class Url
{

    public function __construct()
    {}

    public function start()
    {
        // $url = $_SERVER['REQUEST_URI'];
        $url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : $_SERVER['REQUEST_URI'];
        // echo '<pre>' .print_r($_SERVER, true) .'</pre>';

        # Get the page
        $page = $this->getPage($url);

        // echo "Page: $page";

        $pages = json_decode(file_get_contents('pages.json'), true);
        // echo '<pre>' .var_export($pages, true) .'</pre>';

        if (isset($pages[$page])) {
            extract($pages[$page]);
            require 'pages/layout/app.php';
        } else {
            require 'requests/404.php';
            exit();
        }
    }

    private function getPage($url)
    {
        $url = explode('/', $url);
        $url = array_values(array_filter($url));
        // echo '<pre>' .print_r($url, true) .'</pre>';

        $path = end($url);
        $index = strpos($path, '.php');
        $index = $index === false ? -1 : $index;
        // echo "Position of '.php': $index <br>";

        $page = (strpos($path, "index") === false) ? $path : DEFAULT_PAGE;
        $page = ($index !== -1) ? substr($page, 0, $index - 1) : $page;
        // echo "Page: $page";

        if (! file_exists("pages/$page.php")) {
            require "requests/404.php";
            exit();
        }
        return $page;
    }
}