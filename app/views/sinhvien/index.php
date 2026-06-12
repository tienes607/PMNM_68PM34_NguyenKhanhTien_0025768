<div class="card mb-4 mt-4">
  <div class="card-header d-flex justify-content-between align-items-center bg-success text-white">
    <h2 class="mb-0"><?php echo $title; ?></h2>
    <a href="/sinhvien/create" class="btn btn-light">Thêm sinh viên</a>
  </div>

  <div class="card-body">
    <form class="row g-3 align-items-end mb-4"
          method="GET"
          action="/sinhvien/index/<?php echo (int)$limit; ?>/<?php echo (int)$offset; ?>">
      <div class="col-md-5">
        <label class="form-label" for="search">
          Tìm theo tên hoặc MSSV
        </label>
        <input
          type="text"
          class="form-control"
          id="search"
          name="search"
          value="<?php echo htmlspecialchars($search ?? ''); ?>"
          placeholder="Tìm theo tên hoặc MSSV...">
      </div>
      <div class="col-md-4">
        <label class="form-label" for="malop">
          Lọc theo lớp
        </label>
        <select class="form-select" id="malop" name="malop">
          <option value="">-- Tất cả lớp --</option>
          <?php foreach ($lophocs as $lop) : ?>
            <option
              value="<?php echo htmlspecialchars($lop['malop']); ?>"
              <?php echo (isset($malop) && $malop === $lop['malop']) ? 'selected' : ''; ?>>

              <?php echo htmlspecialchars($lop['tenlop']); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-3 d-grid">
        <button type="submit" class="btn btn-primary">
          Tìm kiếm
        </button>
      </div>
    </form>
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th>STT</th>
            <th>MSSV</th>
            <th>Họ tên</th>
            <th>Giới tính</th>
            <th>Lớp học</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php $startIndex = (int)($offset ?? 0) + 1; ?>
          <?php if (empty($sinhviens)) : ?>
            <tr>
              <td colspan="6" class="text-center py-4">
                Không có sinh viên nào.
              </td>
            </tr>
          <?php else : ?>
            <?php foreach ($sinhviens as $index => $sinhvien) : ?>
              <tr>
                <td>
                  <?php echo $startIndex + $index; ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($sinhvien['mssv'] ?? $sinhvien['MSSV'] ?? ''); ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($sinhvien['hoten'] ?? $sinhvien['HoTen'] ?? ''); ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($sinhvien['gioitinh'] ?? $sinhvien['GioiTinh'] ?? ''); ?>
                </td>
                <td>
                  <?php if (!empty($sinhvien['tenlop'])) : ?>
                    <span class="badge bg-primary">
                      <?php echo htmlspecialchars($sinhvien['tenlop']); ?>
                    </span>
                  <?php else : ?>
                    <span class="badge bg-secondary">
                      Chưa phân lớp
                    </span>
                  <?php endif; ?>
                </td>
                <td>
                  <a
                    href="/sinhvien/edit/<?php echo htmlspecialchars($sinhvien['mssv'] ?? $sinhvien['MSSV'] ?? ''); ?>"
                    class="btn btn-sm btn-warning me-1">Sửa
                  </a>
                  <a
                    href="/sinhvien/delete/<?php echo htmlspecialchars($sinhvien['mssv'] ?? $sinhvien['MSSV'] ?? ''); ?>"
                    class="btn btn-sm btn-danger"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này không?')">Xóa
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>


    <div class="d-flex justify-content-between align-items-center mt-3">
      <div class="text-muted">Hi?n th? <?php echo count($sinhviens); ?> / trang</div>
      <nav>
        <ul class="pagination mb-0">
          <?php
          $pageSize = (int)($limit ?? 5);
          for ($i = 1; $i <= $totalPages; $i++) {
            $pageOffset = ($i - 1) * $pageSize;
            $queryParams = [];
            if (!empty($search)) {
              $queryParams[] = 'search=' . urlencode($search);
            }
            if (!empty($malop)) {
              $queryParams[] = 'malop=' . urlencode($malop);
            }
            $queryString = $queryParams ? '?' . implode('&', $queryParams) : '';
            $activeClass = $i === (int)(($offset / $pageSize) + 1) ? ' active' : '';
            echo '<li class="page-item' . $activeClass . '"><a class="page-link" href="/sinhvien/index/' . $pageSize . '/' . $pageOffset . $queryString . '">' . $i . '</a></li>';
          }
          ?>
        </ul>
      </nav>
    </div>
  </div>
</div>
