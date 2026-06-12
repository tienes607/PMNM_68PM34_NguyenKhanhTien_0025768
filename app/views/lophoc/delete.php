<div class="card mt-4">
  <div class="card-header bg-danger text-white">
    <h2 class="mb-0"><?php echo $title; ?></h2>
  </div>
  <div class="card-body">
    <p>Bạn sắp xóa lớp sau:</p>
    <ul>
      <li><strong>Mã lớp:</strong> <?php echo htmlspecialchars($lop['malop'] ?? ''); ?></li>
      <li><strong>Tên lớp:</strong> <?php echo htmlspecialchars($lop['tenlop'] ?? ''); ?></li>
    </ul>

    <form method="POST" action="/lophoc/delete/<?php echo htmlspecialchars($lop['malop'] ?? ''); ?>">
      <input type="hidden" name="confirm" value="yes" />
      <button type="submit" class="btn btn-danger">Xác nhận xóa</button>
      <a href="/lophoc/index" class="btn btn-secondary">Hủy</a>
    </form>
  </div>
</div>
