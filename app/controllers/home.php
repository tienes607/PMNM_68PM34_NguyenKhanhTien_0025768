<?php
class Home
{
    public function index()
    {
       require_once '../app/views/sinhvien/index.php';
    }
    public function login(){
        require_once '../app/views/home/login.php';
    }
}
?>