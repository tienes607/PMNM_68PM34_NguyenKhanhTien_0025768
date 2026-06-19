<div class="card mx-auto mt-4" style="max-width: 700px;">
  <div class="card-header bg-success text-white">
    <h2 class="mb-0">Thêm sinh viên</h2>
  </div>

  <div class="card-body">
    <?php if (isset($error) && $error): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Lỗi!</strong> <?= htmlspecialchars($error) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <form action="/sinhvien/store" method="POST">
      <div class="mb-3">
        <label for="MSSV" class="form-label">Mã sinh viên</label>
        <input type="text" class="form-control" name="MSSV" id="MSSV" value="<?= isset($old_data['MSSV']) ? htmlspecialchars($old_data['MSSV']) : '' ?>" required>
      </div>
      <div class="mb-3">
        <label for="HoTen" class="form-label">Họ tên</label>
        <input type="text" class="form-control" name="HoTen" id="HoTen" value="<?= isset($old_data['HoTen']) ? htmlspecialchars($old_data['HoTen']) : '' ?>" required>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="GioiTinh" class="form-label">Giới tính</label>
          <select class="form-select" name="GioiTinh" id="GioiTinh" required>
            <option value="">Chọn giới tính</option>
            <option value="Nam" <?= isset($old_data['GioiTinh']) && $old_data['GioiTinh'] === 'Nam' ? 'selected' : '' ?>>Nam</option>
            <option value="Nữ" <?= isset($old_data['GioiTinh']) && $old_data['GioiTinh'] === 'Nữ' ? 'selected' : '' ?>>Nữ</option>
            <option value="Khác" <?= isset($old_data['GioiTinh']) && $old_data['GioiTinh'] === 'Khác' ? 'selected' : '' ?>>Khác</option>
          </select>
        </div>
        <div class="col-md-6 mb-3">
          <label for="MaLop" class="form-label">Lớp</label>
          <select class="form-select" name="MaLop" id="MaLop" required>
            <option value="">Chọn lớp</option>
            <?php foreach ($lophocs as $lop) : ?>
              <option value="<?= htmlspecialchars($lop['malop']) ?>" <?= isset($old_data['MaLop']) && $old_data['MaLop'] === $lop['malop'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($lop['tenlop']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-success">
          Lưu sinh viên
        </button>
        <a href="/sinhvien/index" class="btn btn-secondary">
          Hủy
        </a>
      </div>
    </form>
  </div>
</div>