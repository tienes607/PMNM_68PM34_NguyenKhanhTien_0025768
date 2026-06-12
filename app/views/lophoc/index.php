<div class="card mb-4 mt-4">
  <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
    <h2 class="mb-0"><?php echo $title; ?></h2>
    <a href="/lophoc/create" class="btn btn-light">Thêm lớp</a>
  </div>

  <div class="card-body">
    <form class="row g-3 align-items-end mb-4" method="GET" action="/lophoc/index/<?php echo (int)$limit; ?>/<?php echo (int)$offset; ?>">
      <div class="col-md-8">
        <label class="form-label" for="search">Tìm theo mã hoặc tên lớp</label>
        <input type="text" class="form-control" id="search" name="search" value="<?php echo htmlspecialchars($search ?? ''); ?>" placeholder="Tìm theo mã hoặc tên lớp...">
      </div>
      <div class="col-md-4 d-grid">
        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
      </div>
    </form>

    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th>STT</th>
            <th>Mã lớp</th>
            <th>Tên lớp</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php $startIndex = (int)($offset ?? 0) + 1; ?>
          <?php if (empty($lophocs)) : ?>
            <tr>
              <td colspan="4" class="text-center py-4">Không có lớp nào.</td>
            </tr>
          <?php else : ?>
            <?php foreach ($lophocs as $index => $lop) : ?>
              <tr>
                <td><?php echo $startIndex + $index; ?></td>
                <td><?php echo htmlspecialchars($lop['malop'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($lop['tenlop'] ?? ''); ?></td>
                <td>
                  <a href="/lophoc/edit/<?php echo htmlspecialchars($lop['malop']); ?>" class="btn btn-sm btn-warning me-1">Sửa</a>
                  <a href="/lophoc/delete/<?php echo htmlspecialchars($lop['malop']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa lớp này không?')">Xóa</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-3">
      <div class="text-muted">Hiển thị <?php echo count($lophocs); ?> / trang</div>
      <nav>
        <ul class="pagination mb-0">
          <?php
          $pageSize = (int)($limit ?? 10);
          for ($i = 1; $i <= $totalPages; $i++) {
            $pageOffset = ($i - 1) * $pageSize;
            $queryParams = [];
            if (!empty($search)) {
              $queryParams[] = 'search=' . urlencode($search);
            }
            $queryString = $queryParams ? '?' . implode('&', $queryParams) : '';
            $activeClass = $i === (int)(($offset / $pageSize) + 1) ? ' active' : '';
            echo '<li class="page-item' . $activeClass . '"><a class="page-link" href="/lophoc/index/' . $pageSize . '/' . $pageOffset . $queryString . '">' . $i . '</a></li>';
          }
          ?>
        </ul>
      </nav>
    </div>
  </div>
</div>
