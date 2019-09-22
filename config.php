<?php

require "Url.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

$url = new Url();
$url->start();