<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
  <style>
    header nav {
      height: 64px;
    }
    .nav-actions {
      margin-left: auto;
    }
  </style>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
      <div class="container-fluid d-flex align-items-center">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="/sinhvien/index">Quản lý sinh viên</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/lophoc/index">Quản lý lớp học</a>
          </li>
        </ul>
        <div class="nav-actions">
          <a href="/lophoc/index" class="btn btn-outline-light">Danh sách lớp</a>
        </div>
      </div>
    </nav>
  </header>
</body>

</html>