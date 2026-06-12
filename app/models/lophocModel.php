<?php
require_once "../app/core/DB.php";
class lophocModel
{
  private $conn;
  public function __construct()
  {
    $this->conn = ConnectDB::Connect();
  }

  public function getAllLopHoc()
  {
    $query = "SELECT * FROM lophoc ORDER BY tenlop";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function paging($limit = 5, $offset = 0, $search = "", $sort = "malop", $sortDir = "asc")
  {
    $allowedSort = ['malop', 'tenlop'];
    $allowedDir = ['asc', 'desc'];
    if (!in_array($sort, $allowedSort, true)) {
      $sort = 'malop';
    }
    if (!in_array($sortDir, $allowedDir, true)) {
      $sortDir = 'asc';
    }

    $sql = "SELECT * FROM lophoc";
    $countSql = "SELECT COUNT(*) FROM lophoc";
    if ($search !== "") {
      $where = " WHERE (malop LIKE :search OR tenlop LIKE :search)";
      $sql .= $where;
      $countSql .= $where;
    }
    $sql .= " ORDER BY {$sort} {$sortDir} LIMIT :limit OFFSET :offset";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    if ($search !== "") {
      $stmt->bindValue(':search', "%{$search}%", PDO::PARAM_STR);
    }
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $countStmt = $this->conn->prepare($countSql);
    if ($search !== "") {
      $countStmt->bindValue(':search', "%{$search}%", PDO::PARAM_STR);
    }
    $countStmt->execute();
    $totalRecords = (int)$countStmt->fetchColumn();
    $totalPages = $limit > 0 ? (int)ceil($totalRecords / $limit) : 1;

    return ['lophocs' => $result, 'totalPages' => $totalPages, 'totalRecords' => $totalRecords];
  }

  public function create($malop, $tenlop)
  {
    $query = "INSERT INTO lophoc (malop, tenlop) VALUES (:malop, :tenlop)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':malop', $malop);
    $stmt->bindParam(':tenlop', $tenlop);
    return $stmt->execute();
  }

  public function getLopById($malop)
  {
    $query = "SELECT * FROM lophoc WHERE malop = :malop";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':malop', $malop);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function update($malop, $tenlop)
  {
    $query = "UPDATE lophoc SET tenlop = :tenlop WHERE malop = :malop";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':malop', $malop);
    $stmt->bindParam(':tenlop', $tenlop);
    return $stmt->execute();
  }

  public function delete($malop)
  {
    $query = "DELETE FROM lophoc WHERE malop = :malop";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':malop', $malop);
    return $stmt->execute();
  }
}
