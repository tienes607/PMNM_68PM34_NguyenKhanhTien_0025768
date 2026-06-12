<div class="card mb-4 mt-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h2 class="mb-0">
      <?php echo $title; ?>
    </h2>
    <a href="/sinhvien/create" class="btn btn-success">+ Thêm sinh viên</a>
  </div>

  <div class="card-body">
    <form class="row g-2 align-items-end mb-3"
          method="GET"
          action="/sinhvien/index/<?php echo (int)$limit; ?>/<?php echo (int)$offset; ?>">
      <div class="col-md-4">
        <input
          type="text"
          class="form-control"
          id="search"
          name="search"
          value="<?php echo htmlspecialchars($search ?? ''); ?>"
          placeholder="Tìm theo tên hoặc MSSV...">
      </div>
      <div class="col-md-4">
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
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
      </div>
      <div class="col-md-2">
        <a href="/sinhvien/index" class="btn btn-secondary w-100">Đặt lại</a>
      </div>
    </form>

    <div class="d-flex justify-content-end align-items-center mb-2">
      <label class="me-2 mb-0 text-muted" for="limitSelect">Hiển thị:</label>
      <select class="form-select form-select-sm w-auto" id="limitSelect"
              onchange="window.location.href='/sinhvien/index/' + this.value + '/0<?php echo (!empty($search) ? '?search='.urlencode($search) : '') . (!empty($malop) ? ((!empty($search)?'&':'?').'malop='.urlencode($malop)) : ''); ?>'">
        <?php foreach ([5, 10, 20, 50] as $opt) : ?>
          <option value="<?php echo $opt; ?>" <?php echo ((int)$limit === $opt) ? 'selected' : ''; ?>>
            <?php echo $opt; ?> / trang
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="table-responsive">
      <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th>STT</th>
            <th>
              <?php
                $sortDir = (isset($sort) && $sort === 'asc') ? 'desc' : 'asc';
                $sortParams = [];
                if (!empty($search)) $sortParams[] = 'search=' . urlencode($search);
                if (!empty($malop))  $sortParams[] = 'malop='  . urlencode($malop);
                $sortParams[] = 'sort=' . $sortDir;
                $sortQs = '?' . implode('&', $sortParams);
              ?>
              <a href="/sinhvien/index/<?php echo (int)$limit; ?>/0<?php echo $sortQs; ?>"
                 class="text-white text-decoration-none">
                MSSV
                <?php echo (!isset($sort) || $sort === 'asc') ? '▲' : '▼'; ?>
              </a>
            </th>
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
              <td colspan="6" class="text-center py-4">Không có sinh viên nào.</td>
            </tr>
          <?php else : ?>
            <?php foreach ($sinhviens as $index => $sinhvien) : ?>
              <tr>
                <td><?php echo $startIndex + $index; ?></td>
                <td><?php echo htmlspecialchars($sinhvien['mssv'] ?? $sinhvien['MSSV'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($sinhvien['hoten'] ?? $sinhvien['HoTen'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($sinhvien['gioitinh'] ?? $sinhvien['GioiTinh'] ?? ''); ?></td>
                <td>
                  <?php if (!empty($sinhvien['tenlop'])) : ?>
                    <span class="badge" style="background-color: #a0d8e8; color: #333;">
                      <?php echo htmlspecialchars($sinhvien['tenlop']); ?>
                    </span>
                  <?php else : ?>
                    <span class="text-muted fst-italic">Chưa phân lớp</span>
                  <?php endif; ?>
                </td>
                <td>
                  <a href="/sinhvien/edit/<?php echo htmlspecialchars($sinhvien['mssv'] ?? $sinhvien['MSSV'] ?? ''); ?>"
                     class="btn btn-sm btn-warning me-1">Sửa</a>
                  <a href="/sinhvien/delete/<?php echo htmlspecialchars($sinhvien['mssv'] ?? $sinhvien['MSSV'] ?? ''); ?>"
                     class="btn btn-sm btn-danger"
                     onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này không?')">Xóa</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-3">
      <?php
        $from = (int)($offset ?? 0) + 1;
        $to   = (int)($offset ?? 0) + count($sinhviens);  // bỏ min() đi
        $total = $totalRecords ?? count($sinhviens);
      ?>
      <div class="text-muted small">
        Hiển thị <?php echo $from; ?>-<?php echo $to; ?> trong <?php echo $total; ?> bản ghi
      </div>
      <nav>
        <ul class="pagination mb-0">
          <?php
          $pageSize = (int)($limit ?? 10);
          for ($i = 1; $i <= $totalPages; $i++) {
            $pageOffset = ($i - 1) * $pageSize;
            $queryParams = [];
            if (!empty($search)) $queryParams[] = 'search=' . urlencode($search);
            if (!empty($malop))  $queryParams[] = 'malop='  . urlencode($malop);
            $queryString = $queryParams ? '?' . implode('&', $queryParams) : '';
            $activeClass = ($i === (int)(($offset / $pageSize) + 1)) ? ' active' : '';
            echo '<li class="page-item' . $activeClass . '">'
               . '<a class="page-link" href="/sinhvien/index/' . $pageSize . '/' . $pageOffset . $queryString . '">' . $i . '</a>'
               . '</li>';
          }
          ?>
        </ul>
      </nav>
    </div>
  </div>
</div>