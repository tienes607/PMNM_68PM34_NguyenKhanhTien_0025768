<?php
require_once '../app/core/Controller.php';
class sinhvien extends Controller {
    function index() {
        $SinhvienModel = $this->model('SinhvienModel');
        $sinhvien = $SinhvienModel -> getAllSinhvien();
        $this -> view('sinhvien/index', ['sinhvien' => $sinhvien]);
    }

    function create() {
        require_once '../app/views/sinhvien/create.php';
    }
}