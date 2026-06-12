<?php
require_once "../app/core/controller.php";
class sinhvien extends Controller
{
  public function index($limit = 5, $offset = 0, $search = "")
  {
    $search = $_GET['search'] ?? $search;
    $malop = $_GET['malop'] ?? '';

    $sinhvienModel = $this->model('sinhvienModel');
    $lophocs = $sinhvienModel->getAllLopHoc();
    $result = $sinhvienModel->paging($limit, $offset, $search, $malop);
    $sinhviens = $result['sinhviens'];
    $totalPages = $result['totalPages'];

    $this->view('layout/masterLayout', [
      'viewname' => 'sinhvien/index',
      'sinhviens' => $sinhviens,
      'lophocs' => $lophocs,
      'search' => $search,
      'malop' => $malop,
      'title' => 'Danh sách sinh viên',
      'totalPages' => $totalPages,
      'offset' => $offset,
      'limit' => $limit,
    ]);
  }

  public function create()
  {
    $sinhvienModel = $this->model('sinhvienModel');
    $lophocs = $sinhvienModel->getAllLopHoc();
    $this->view('layout/masterLayout', [
      'viewname' => 'sinhvien/create',
      'title' => 'Thêm sinh viên',
      'lophocs' => $lophocs,
    ]);
  }

  public function store()
  {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
      $MSSV = $_POST['MSSV'] ?? $_POST['mssv'] ?? '';
      $HoTen = $_POST['HoTen'] ?? $_POST['hoten'] ?? '';
      $GioiTinh = $_POST['GioiTinh'] ?? $_POST['gioitinh'] ?? '';
      $MaLop = $_POST['MaLop'] ?? $_POST['malop'] ?? '';

      $sinhvienModel = $this->model('sinhvienModel');
      $result = $sinhvienModel->create($MSSV, $HoTen, $GioiTinh, $MaLop);
      if ($result) {
        header("Location: /sinhvien/index");
        exit();
      } else {
        echo "Thêm mới sinh viên thất bại!";
        exit();
      }
    }
  }

  public function edit($MSSV = null)
  {
    if (!$MSSV) {
      header("Location: /sinhvien/index");
      exit();
    }

    $sinhvienModel = $this->model('sinhvienModel');
    $sinhvien = $sinhvienModel->getSinhVienById($MSSV);
    
    if (!$sinhvien) {
      header("Location: /sinhvien/index");
      exit();
    }

    $lophocs = $sinhvienModel->getAllLopHoc();
    $this->view('layout/masterLayout', [
      'viewname' => 'sinhvien/update',
      'title' => 'Sửa thông tin sinh viên',
      'sinhvien' => $sinhvien,
      'lophocs' => $lophocs,
    ]);
  }

  public function update()
  {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
      $MSSV = $_POST['MSSV'] ?? $_POST['mssv'] ?? '';
      $HoTen = $_POST['HoTen'] ?? $_POST['hoten'] ?? '';
      $GioiTinh = $_POST['GioiTinh'] ?? $_POST['gioitinh'] ?? '';
      $MaLop = $_POST['MaLop'] ?? $_POST['malop'] ?? '';

      $sinhvienModel = $this->model('sinhvienModel');
      $result = $sinhvienModel->update($MSSV, $HoTen, $GioiTinh, $MaLop);
      if ($result) {
        header("Location: /sinhvien/index");
        exit();
      } else {
        echo "Cập nhật sinh viên thất bại!";
        exit();
      }
    }
  }

  public function delete($MSSV = null)
  {
    $sinhvienModel = $this->model('sinhvienModel');

    if (!$MSSV) {
      header("Location: /sinhvien/index");
      exit();
    }

    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
      $confirm = $_POST['confirm'] ?? '';
      if ($confirm === 'yes') {
        $result = $sinhvienModel->delete($MSSV);
        if ($result) {
          header("Location: /sinhvien/index");
          exit();
        } else {
          echo "Xóa sinh viên thất bại!";
          exit();
        }
      } else {
        header("Location: /sinhvien/index");
        exit();
      }
    }

    $sinhvien = $sinhvienModel->getSinhVienById($MSSV);
    if (!$sinhvien) {
      header("Location: /sinhvien/index");
      exit();
    }

    $this->view('layout/masterLayout', [
      'viewname' => 'sinhvien/delete',
      'title' => 'Xóa sinh viên',
      'sinhvien' => $sinhvien,
    ]);
  }
}