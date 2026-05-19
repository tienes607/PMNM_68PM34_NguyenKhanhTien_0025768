<?php
class Sinhvien_ett{
    public $hoten;
    public $mssv;
    public $gioitinh;

    public function __construct($hoten, $mssv, $gioitinh) {
        $this->hoten = $hoten;
        $this->mssv = $mssv;
        $this->$gioitinh = $gioitinh;
    }
}
?>