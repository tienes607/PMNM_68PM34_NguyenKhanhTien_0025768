<?php
session_start();
require_once '../app/Core/App.php';
class middleware{
    function checkLogin(){
        $publicPage = ['/home/login'];
        if(!isset($_SESSION['username']) && !in_array($_SERVER['REQUEST_URI'], $publicPage)){
            header('Location: /home/login');
            exit();
        }
    }
}
?>