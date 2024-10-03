<?php
require_once "app/controllers/controller.php";

if (!empty($_GET["action"])) {
    $action = $_GET["action"];
} else {
    $action = "home";
}

$params = explode("/",$action);

switch ($params[0]) {
    
}