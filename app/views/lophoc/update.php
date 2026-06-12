<div class="card mx-auto mt-4" style="max-width: 700px;">
  <div class="card-header bg-warning text-dark">
    <h2 class="mb-0">Sửa lớp</h2>
  </div>

  <div class="card-body">
    <form action="/lophoc/update" method="POST">
      <div class="mb-3">
        <label for="MaLop" class="form-label">Mã lớp</label>
        <input type="text" class="form-control" name="MaLop" id="MaLop" value="<?= htmlspecialchars($lop['malop'] ?? '') ?>" readonly>
      </div>
      <div class="mb-3">
        <label for="TenLop" class="form-label">Tên lớp</label>
        <input type="text" class="form-control" name="TenLop" id="TenLop" value="<?= htmlspecialchars($lop['tenlop'] ?? '') ?>" required>
      </div>
      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-warning text-dark">Cập nhật</button>
        <a href="/lophoc/index" class="btn btn-secondary">Hủy</a>
      </div>
    </form>
  </div>
</div>
