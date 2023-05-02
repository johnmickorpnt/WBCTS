<?php
$APP_DOMAIN = "localhost";
$APP_DIR = "wbcts";

init();

function init(){
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

function asset($asset){
    global $APP_DIR;
    $currUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $module = strrpos($currUrl, $APP_DIR);
    $link = substr($currUrl, $module + strlen($APP_DIR));
    return     substr_count($link, '/') >= 2 ? "../assets/{$asset}" : "assets/{$asset}";
}

function img($img){
    return "assets/images/$img";
}

// Used for heredoc strings
$img = function($img){
    return "assets/images/$img";
};

function component($link){
    include("components/{$link}");
}
