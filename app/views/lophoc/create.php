<div class="card mx-auto mt-4" style="max-width: 700px;">
  <div class="card-header bg-primary text-white">
    <h2 class="mb-0">Thêm lớp</h2>
  </div>

  <div class="card-body">
    <form action="/lophoc/store" method="POST">
      <div class="mb-3">
        <label for="MaLop" class="form-label">Mã lớp</label>
        <input type="text" class="form-control" name="MaLop" id="MaLop" required>
      </div>
      <div class="mb-3">
        <label for="TenLop" class="form-label">Tên lớp</label>
        <input type="text" class="form-control" name="TenLop" id="TenLop" required>
      </div>
      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Lưu lớp</button>
        <a href="/lophoc/index" class="btn btn-secondary">Hủy</a>
      </div>
    </form>
  </div>
</div>
