<div class="card mt-4">
  <div class="card-header bg-danger text-white">
    <h2 class="mb-0"><?php echo $title; ?></h2>
  </div>
  <div class="card-body">
    <p>Bạn sắp xóa sinh viên sau:</p>
    <ul>
      <li><strong>MSSV:</strong> <?php echo htmlspecialchars($sinhvien['MSSV'] ?? $sinhvien['mssv'] ?? ''); ?></li>
      <li><strong>Họ tên:</strong> <?php echo htmlspecialchars($sinhvien['HoTen'] ?? $sinhvien['hoten'] ?? ''); ?></li>
      <li><strong>Lớp:</strong> <?php echo htmlspecialchars($sinhvien['MaLop'] ?? $sinhvien['malop'] ?? ''); ?></li>
    </ul>

    <form method="POST" action="/sinhvien/delete/<?php echo htmlspecialchars($sinhvien['MSSV'] ?? $sinhvien['mssv'] ?? ''); ?>">
      <input type="hidden" name="confirm" value="yes" />
      <button type="submit" class="btn btn-danger">Xác nhận xóa</button>
      <a href="/sinhvien/index" class="btn btn-secondary">Hủy</a>
    </form>
  </div>
</div>
