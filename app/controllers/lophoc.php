<?php
require_once "../app/core/controller.php";
class lophoc extends Controller
{
  public function index($limit = 5, $offset = 0)
  {
    $search = $_GET['search'] ?? '';
    $sort = $_GET['sort'] ?? 'malop';
    $sortDir = $_GET['sortDir'] ?? 'asc';

    $lophocModel = $this->model('lophocModel');
    $result = $lophocModel->paging($limit, $offset, $search, $sort, $sortDir);
    $lophocs = $result['lophocs'];
    $totalPages = $result['totalPages'];
    $totalRecords = $result['totalRecords'];

    $this->view('layout/masterLayout', [
      'viewname' => 'lophoc/index',
      'lophocs' => $lophocs,
      'search' => $search,
      'sort' => $sort,
      'sortDir' => $sortDir,
      'title' => 'Danh sách lớp',
      'totalPages' => $totalPages,
      'totalRecords' => $totalRecords,
      'offset' => (int)$offset,
      'limit' => (int)$limit,
    ]);
  }

  public function create()
  {
    $this->view('layout/masterLayout', [
      'viewname' => 'lophoc/create',
      'title' => 'Thêm lớp học',
    ]);
  }

  public function store()
  {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
      $malop = $_POST['MaLop'] ?? $_POST['malop'] ?? '';
      $tenlop = $_POST['TenLop'] ?? $_POST['tenlop'] ?? '';

      $lophocModel = $this->model('lophocModel');
      $result = $lophocModel->create($malop, $tenlop);
      if ($result) {
        header("Location: /lophoc/index");
        exit();
      } else {
        echo "Thêm lớp thất bại";
        exit();
      }
    }
  }

  public function edit($malop = null)
  {
    if (!$malop) {
      header("Location: /lophoc/index");
      exit();
    }
    $lophocModel = $this->model('lophocModel');
    $lop = $lophocModel->getLopById($malop);
    if (!$lop) {
      header("Location: /lophoc/index");
      exit();
    }
    $this->view('layout/masterLayout', [
      'viewname' => 'lophoc/update',
      'title' => 'Sửa lớp',
      'lop' => $lop,
    ]);
  }

  public function update()
  {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
      $malop = $_POST['MaLop'] ?? $_POST['malop'] ?? '';
      $tenlop = $_POST['TenLop'] ?? $_POST['tenlop'] ?? '';

      $lophocModel = $this->model('lophocModel');
      $result = $lophocModel->update($malop, $tenlop);
      if ($result) {
        header("Location: /lophoc/index");
        exit();
      } else {
        echo "Cập nhật lớp thất bại";
        exit();
      }
    }
  }

  public function delete($malop = null)
  {
    $lophocModel = $this->model('lophocModel');
    if (!$malop) {
      header("Location: /lophoc/index");
      exit();
    }
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
      $confirm = $_POST['confirm'] ?? '';
      if ($confirm === 'yes') {
        $result = $lophocModel->delete($malop);
        if ($result) {
          header("Location: /lophoc/index");
          exit();
        } else {
          echo "Xóa lớp thất bại";
          exit();
        }
      } else {
        header("Location: /lophoc/index");
        exit();
      }
    }

    $lop = $lophocModel->getLopById($malop);
    if (!$lop) {
      header("Location: /lophoc/index");
      exit();
    }

    $this->view('layout/masterLayout', [
      'viewname' => 'lophoc/delete',
      'title' => 'Xóa lớp',
      'lop' => $lop,
    ]);
  }
}
