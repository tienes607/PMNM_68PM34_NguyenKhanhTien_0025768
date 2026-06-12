<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary shadow-sm">
    <div class="container-fluid px-4">
      <a class="navbar-brand fw-bold fs-5" href="/">Quản lý sinh viên</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto gap-2 align-items-center">
          <li class="nav-item">
            <a class="btn btn-sm px-4 py-2 rounded-2 <?= strpos($_SERVER['REQUEST_URI'], '/sinhvien') !== false ? 'btn-light text-secondary fw-semibold' : 'btn-outline-light' ?>" 
               href="/sinhvien/index">Danh sách sinh viên</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-sm px-4 py-2 rounded-2 <?= strpos($_SERVER['REQUEST_URI'], '/lophoc') !== false ? 'btn-light text-secondary fw-semibold' : 'btn-outline-light' ?>" 
               href="/lophoc/index">Danh sách lớp học</a>
          </li>
          <li class="nav-item ms-3">
            <a class="btn btn-danger btn-sm px-4 py-2 rounded-2" href="#">Đăng xuất</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>