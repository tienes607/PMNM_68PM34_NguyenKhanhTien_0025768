<div class="card mx-auto mt-4" style="max-width: 700px;">
  <div class="card-header bg-warning text-dark">
    <h2 class="mb-0">Sửa thông tin sinh viên</h2>
  </div>

  <div class="card-body">
    <form action="/sinhvien/update" method="POST">
      <div class="mb-3">
        <label for="MSSV" class="form-label">Mã sinh viên</label>
        <input type="text" class="form-control" name="MSSV" id="MSSV" value="<?= htmlspecialchars($sinhvien['MSSV'] ?? $sinhvien['mssv'] ?? '') ?>" readonly>
      </div>
      <div class="mb-3">
        <label for="HoTen" class="form-label">Họ tên</label>
        <input type="text" class="form-control" name="HoTen" id="HoTen" value="<?= htmlspecialchars($sinhvien['HoTen'] ?? $sinhvien['hoten'] ?? '') ?>" required>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="GioiTinh" class="form-label">Giới tính</label>
          <select class="form-select" name="GioiTinh" id="GioiTinh" required>
            <option value="">Chọn giới tính</option>
            <option value="Nam" <?= (($sinhvien['GioiTinh'] ?? $sinhvien['gioitinh'] ?? '') === 'Nam') ? 'selected' : '' ?>>Nam</option>
            <option value="Nữ" <?= (($sinhvien['GioiTinh'] ?? $sinhvien['gioitinh'] ?? '') === 'Nữ') ? 'selected' : '' ?>>Nữ</option>
            <option value="Khác" <?= (($sinhvien['GioiTinh'] ?? $sinhvien['gioitinh'] ?? '') === 'Khác') ? 'selected' : '' ?>>Khác</option>
          </select>
        </div>
        <div class="col-md-6 mb-3">
          <label for="MaLop" class="form-label">Lớp</label>
          <select class="form-select" name="MaLop" id="MaLop" required>
            <option value="">Chọn lớp</option>
            <?php foreach ($lophocs as $lop) : ?>
              <option value="<?= htmlspecialchars($lop['malop']) ?>" <?= (($sinhvien['MaLop'] ?? $sinhvien['malop'] ?? '') === $lop['malop']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($lop['tenlop']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-warning text-dark">
          Cập nhật
        </button>
        <a href="/sinhvien/index" class="btn btn-secondary">
          Hủy
        </a>
      </div>
    </form>
  </div>
</div>
