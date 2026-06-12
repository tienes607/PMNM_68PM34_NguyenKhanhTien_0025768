<?php
$currentSort    = $sort    ?? 'malop';
$currentSortDir = $sortDir ?? 'asc';
$currentSearch  = $search  ?? '';
$currentLimit   = (int)($limit  ?? 5);
$currentOffset  = (int)($offset ?? 0);

function buildQS(array $override = []): string {
    global $currentSort, $currentSortDir, $currentSearch;
    $p = array_merge([
        'sort'    => $currentSort,
        'sortDir' => $currentSortDir,
        'search'  => $currentSearch,
    ], $override);
    $p = array_filter($p, fn($v) => $v !== '' && $v !== null);
    return $p ? '?' . http_build_query($p) : '';
}

function sortLink(string $col, int $limit): string {
    global $currentSort, $currentSortDir;
    $newDir = ($currentSort === $col && $currentSortDir === 'asc') ? 'desc' : 'asc';
    return "/lophoc/index/{$limit}/0" . buildQS(['sort' => $col, 'sortDir' => $newDir]);
}

function sortIcon(string $col): string {
    global $currentSort, $currentSortDir;
    if ($currentSort !== $col) return '<span class="text-secondary ms-1" style="opacity:.4">↕</span>';
    return $currentSortDir === 'asc' ? '<span class="ms-1">▲</span>' : '<span class="ms-1">▼</span>';
}
?>

<div class="card mb-4 mt-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h2 class="mb-0"><?php echo $title; ?></h2>
    <a href="/lophoc/create" class="btn btn-success">+ Thêm lớp</a>
  </div>

  <div class="card-body">
    <form class="row g-2 align-items-end mb-3"
          method="GET"
          action="/lophoc/index/<?php echo $currentLimit; ?>/0">

      <input type="hidden" name="sort" value="<?php echo htmlspecialchars($currentSort); ?>">
      <input type="hidden" name="sortDir" value="<?php echo htmlspecialchars($currentSortDir); ?>">

      <div class="col-md-8">
        <label class="form-label small text-muted mb-1" for="search">Tìm kiếm</label>
        <input type="text" class="form-control" id="search" name="search"
               value="<?php echo htmlspecialchars($currentSearch); ?>"
               placeholder="Tìm theo mã hoặc tên lớp...">
      </div>

      <div class="col-md-2">
        <label class="form-label small text-muted mb-1">&nbsp;</label>
        <button type="submit" class="btn btn-primary w-100 d-block">Tìm kiếm</button>
      </div>
      <div class="col-md-2">
        <label class="form-label small text-muted mb-1">&nbsp;</label>
        <a href="/lophoc/index" class="btn btn-secondary w-100 d-block">Đặt lại</a>
      </div>
    </form>

    <div class="d-flex justify-content-end align-items-center mb-2">
      <label class="me-2 mb-0 text-muted small">Hiển thị:</label>
      <select class="form-select form-select-sm w-auto"
              onchange="location.href='/lophoc/index/'+this.value+'/0<?php echo htmlspecialchars(buildQS()); ?>'">
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
              <a href="<?php echo sortLink('malop', $currentLimit); ?>" class="text-white text-decoration-none">
                Mã lớp<?php echo sortIcon('malop'); ?>
              </a>
            </th>
            <th>
              <a href="<?php echo sortLink('tenlop', $currentLimit); ?>" class="text-white text-decoration-none">
                Tên lớp<?php echo sortIcon('tenlop'); ?>
              </a>
            </th>
            <th>Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($lophocs)): ?>
            <tr>
              <td colspan="4" class="text-center py-4 text-muted">Không có lớp nào.</td>
            </tr>
          <?php else: ?>
            <?php foreach ($lophocs as $i => $lop): ?>
              <tr>
                <td><?php echo $currentOffset + $i + 1; ?></td>
                <td><?php echo htmlspecialchars($lop['malop'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($lop['tenlop'] ?? ''); ?></td>
                <td>
                  <a href="/lophoc/edit/<?php echo htmlspecialchars($lop['malop']); ?>" class="btn btn-sm btn-warning me-1">Sửa</a>
                  <a href="/lophoc/delete/<?php echo htmlspecialchars($lop['malop']); ?>" class="btn btn-sm btn-danger"
                     onclick="return confirm('Bạn có chắc chắn muốn xóa lớp này không?')">Xóa</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-3">
      <div class="text-muted small">
        Hiển thị <?php echo $currentOffset + 1; ?>–<?php echo $currentOffset + count($lophocs); ?>
        trong <?php echo $totalRecords; ?> bản ghi
      </div>
      <nav>
        <ul class="pagination mb-0">
          <?php for ($i = 1; $i <= $totalPages; $i++):
            $pageOffset  = ($i - 1) * $currentLimit;
            $qs          = buildQS();
            $activeClass = ($pageOffset === $currentOffset) ? ' active' : '';
            $pageStyle   = $activeClass
              ? 'background-color:#0d6efd;color:#fff;border-color:#0d6efd;'
              : 'background-color:#f8fbff;color:#0d6efd;border-color:#0d6efd;';
          ?>
            <li class="page-item<?php echo $activeClass; ?>">
              <a class="page-link"
                 style="<?php echo $pageStyle; ?>"
                 href="/lophoc/index/<?php echo $currentLimit; ?>/<?php echo $pageOffset; ?><?php echo $qs; ?>">
                <?php echo $i; ?>
              </a>
            </li>
          <?php endfor; ?>
        </ul>
      </nav>
    </div>
  </div>
</div>
