<?php
$currentSort    = $sort    ?? 'mssv';
$currentSortDir = $sortDir ?? 'asc';
$currentSearch  = $search  ?? '';
$currentMalop   = $malop   ?? '';
$currentLimit   = (int)($limit  ?? 5);
$currentOffset  = (int)($offset ?? 0);

function buildQS($s, $sd, $se, $m, array $override = []): string {
    $p = array_merge([
        'sort'    => $s,
        'sortDir' => $sd,
        'search'  => $se,
        'malop'   => $m,
    ], $override);
    $p = array_filter($p, fn($v) => $v !== '' && $v !== null);
    return $p ? '?' . http_build_query($p) : '';
}

function sortLink($col, $limit, $curSort, $curSortDir, $curSearch, $curMalop) {
    $newDir = ($curSort === $col && $curSortDir === 'asc') ? 'desc' : 'asc';
    return "/sinhvien/index/{$limit}/0" . buildQS($col, $newDir, $curSearch, $curMalop);
}

function sortIcon($col, $curSort, $curSortDir) {
    if ($curSort !== $col) return '';
    return $curSortDir === 'asc' ? '<span class="text-primary ms-1">▲</span>' : '<span class="text-primary ms-1">▼</span>';
}
?>

<div class="card mb-4 mt-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h2 class="mb-0"><?php echo $title; ?></h2>
    <a href="/sinhvien/create" class="btn btn-success">+ Thêm sinh viên</a>
  </div>

  <div class="card-body">

    <form class="row g-2 align-items-end mb-3"
          method="GET"
          action="/sinhvien/index/<?php echo $currentLimit; ?>/0">

      <input type="hidden" name="sort"    value="<?php echo htmlspecialchars($currentSort); ?>">
      <input type="hidden" name="sortDir" value="<?php echo htmlspecialchars($currentSortDir); ?>">

      <div class="col-md-4">
        <label class="form-label small text-muted mb-1">Tìm kiếm</label>
        <input type="text" class="form-control" name="search"
               value="<?php echo htmlspecialchars($currentSearch); ?>"
               placeholder="Tìm theo tên hoặc MSSV...">
      </div>

      <div class="col-md-4">
        <label class="form-label small text-muted mb-1">Lớp học</label>
        <select class="form-select" name="malop">
          <option value="">-- Tất cả lớp --</option>
          <?php foreach ($lophocs as $lop): ?>
            <option value="<?php echo htmlspecialchars($lop['malop']); ?>"
              <?php echo ($currentMalop === $lop['malop']) ? 'selected' : ''; ?>>
              <?php echo htmlspecialchars($lop['tenlop']); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="col-md-2">
        <label class="form-label small text-muted mb-1">&nbsp;</label>
        <button type="submit" class="btn btn-primary w-100 d-block">Tìm kiếm</button>
      </div>
      <div class="col-md-2">
        <label class="form-label small text-muted mb-1">&nbsp;</label>
        <a href="/sinhvien/index" class="btn btn-secondary w-100 d-block">Đặt lại</a>
      </div>
    </form>

    <div class="d-flex justify-content-end align-items-center mb-2">
      <label class="me-2 mb-0 text-muted small">Hiển thị:</label>
      <select class="form-select form-select-sm w-auto"
              onchange="location.href='/sinhvien/index/'+this.value+'/0<?php echo htmlspecialchars(buildQS($currentSort, $currentSortDir, $currentSearch, $currentMalop)); ?>'"> 
        <?php foreach ([5, 10, 20, 50] as $opt): ?>
          <option value="<?php echo $opt; ?>" <?php echo ($currentLimit === $opt) ? 'selected' : ''; ?>>
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
              <a href="<?php echo sortLink('mssv', $currentLimit, $currentSort, $currentSortDir, $currentSearch, $currentMalop); ?>" class="text-white text-decoration-none">
                MSSV<?php echo sortIcon('mssv', $currentSort, $currentSortDir); ?>
              </a>
            </th>
            <th>
              <a href="<?php echo sortLink('hoten', $currentLimit, $currentSort, $currentSortDir, $currentSearch, $currentMalop); ?>" class="text-white text-decoration-none">
                Họ tên<?php echo sortIcon('hoten', $currentSort, $currentSortDir); ?>
              </a>
            </th>
            <th>Giới tính</th>
            <th>Lớp học</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($sinhviens)): ?>
            <tr>
              <td colspan="6" class="text-center py-4 text-muted">Không có sinh viên nào.</td>
            </tr>
          <?php else: ?>
            <?php foreach ($sinhviens as $i => $sv): ?>
              <tr>
                <td><?php echo $currentOffset + $i + 1; ?></td>
                <td><?php echo htmlspecialchars($sv['mssv'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($sv['hoten'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($sv['gioitinh'] ?? ''); ?></td>
                <td>
                  <?php if (!empty($sv['tenlop'])): ?>
                    <span class="badge" style="background-color:#a0d8e8;color:#333">
                      <?php echo htmlspecialchars($sv['tenlop']); ?>
                    </span>
                  <?php else: ?>
                    <span class="text-muted fst-italic">Chưa phân lớp</span>
                  <?php endif; ?>
                </td>
                <td>
                  <a href="/sinhvien/edit/<?php echo htmlspecialchars($sv['mssv'] ?? ''); ?>"
                     class="btn btn-sm btn-warning me-1">Sửa</a>
                  <a href="/sinhvien/delete/<?php echo htmlspecialchars($sv['mssv'] ?? ''); ?>"
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
      <div class="text-muted small">
        Hiển thị <?php echo $currentOffset + 1; ?>–<?php echo $currentOffset + count($sinhviens); ?>
        trong <?php echo $totalRecords; ?> bản ghi
      </div>
      <nav>
        <ul class="pagination mb-0">
          <?php for ($i = 1; $i <= $totalPages; $i++):
            $pageOffset  = ($i - 1) * $currentLimit;
            $qs          = buildQS($currentSort, $currentSortDir, $currentSearch, $currentMalop);
            $activeClass = ($pageOffset === $currentOffset) ? ' active' : '';
            $pageStyle   = $activeClass
              ? 'background-color:#0d6efd;color:#fff;border-color:#0d6efd;'
              : 'background-color:#f8fbff;color:#0d6efd;border-color:#0d6efd;';
          ?>
            <li class="page-item<?php echo $activeClass; ?>">
              <a class="page-link"
                 style="<?php echo $pageStyle; ?>"
                 href="/sinhvien/index/<?php echo $currentLimit; ?>/<?php echo $pageOffset; ?><?php echo $qs; ?>">
                <?php echo $i; ?>
              </a>
            </li>
          <?php endfor; ?>
        </ul>
      </nav>
    </div>

  </div>
</div>