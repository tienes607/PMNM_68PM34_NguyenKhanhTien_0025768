<?php
require_once "../app/core/DB.php";
class sinhvienModel
{
  private $conn;
  public function __construct()
  {
    $this->conn = ConnectDB::Connect();
  }

  public function getAllSinhVien()
  {
    $query = "SELECT * FROM sinhvien";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function create($MSSV, $HoTen, $GioiTinh, $MaLop)
  {
    $existingStudent = $this->getSinhVienById($MSSV);
    if ($existingStudent) {
      return array('success' => false, 'error' => 'Mã số sinh viên đã tồn tại!');
    }

    $query = "INSERT INTO sinhvien (MSSV, HoTen, GioiTinh, MaLop) VALUES ( :MSSV, :HoTen, :GioiTinh, :MaLop )";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':MSSV', $MSSV);
    $stmt->bindParam(':HoTen', $HoTen);
    $stmt->bindParam(':GioiTinh', $GioiTinh);
    $stmt->bindParam(':MaLop', $MaLop);
    $result = $stmt->execute();
    
    return array('success' => $result, 'error' => $result ? null : 'Lỗi khi thêm sinh viên');
  }

  public function getSinhVienById($MSSV)
  {
    $query = "SELECT * FROM sinhvien WHERE MSSV = :MSSV";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':MSSV', $MSSV);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function update($MSSV, $HoTen, $GioiTinh, $MaLop)
  {
    $query = "UPDATE sinhvien SET HoTen = :HoTen, GioiTinh = :GioiTinh, MaLop = :MaLop WHERE MSSV = :MSSV";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':MSSV', $MSSV);
    $stmt->bindParam(':HoTen', $HoTen);
    $stmt->bindParam(':GioiTinh', $GioiTinh);
    $stmt->bindParam(':MaLop', $MaLop);
    return $stmt->execute();
  }

  public function delete($MSSV)
  {
    $query = "DELETE FROM sinhvien WHERE MSSV = :MSSV";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':MSSV', $MSSV);
    return $stmt->execute();
  }

  public function getAllLopHoc()
  {
    $query = "SELECT * FROM lophoc ORDER BY tenlop";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function paging($limit = 5, $offset = 0, $search = "", $malop = "", $sort = "mssv", $sortDir = "asc")
{
    $allowedSort = ['mssv', 'hoten'];
    $allowedDir  = ['asc', 'desc'];
    if (!in_array($sort, $allowedSort)) $sort = 'mssv';
    if (!in_array($sortDir, $allowedDir)) $sortDir = 'asc';

    $sql      = "SELECT sv.*, lh.tenlop FROM sinhvien sv LEFT JOIN lophoc lh ON sv.malop = lh.malop";
    $countSql = "SELECT COUNT(*) FROM sinhvien sv LEFT JOIN lophoc lh ON sv.malop = lh.malop";

    $conditions = [];
    if ($search !== "") {
        $conditions[] = "(sv.mssv LIKE :search OR sv.hoten LIKE :search)";
    }
    if ($malop !== "") {
        $conditions[] = "sv.malop = :malop";
    }
    if (!empty($conditions)) {
        $where     = ' WHERE ' . implode(' AND ', $conditions);
        $sql      .= $where;
        $countSql .= $where;
    }

    $sql .= " ORDER BY sv.{$sort} {$sortDir} LIMIT :limit OFFSET :offset";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':limit',  (int)$limit,  PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    if ($search !== "") $stmt->bindValue(':search', "%{$search}%", PDO::PARAM_STR);
    if ($malop  !== "") $stmt->bindValue(':malop',  $malop,        PDO::PARAM_STR);
    $stmt->execute();
    $sinhviens = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $countStmt = $this->conn->prepare($countSql);
    if ($search !== "") $countStmt->bindValue(':search', "%{$search}%", PDO::PARAM_STR);
    if ($malop  !== "") $countStmt->bindValue(':malop',  $malop,        PDO::PARAM_STR);
    $countStmt->execute();
    $totalRecords = (int)$countStmt->fetchColumn();

    $totalPages = $limit > 0 ? (int)ceil($totalRecords / $limit) : 1;

    return [
        'sinhviens'    => $sinhviens,
        'totalPages'   => $totalPages,
        'totalRecords' => $totalRecords,
    ];
}
}