<?php
$hasError = isset($_GET['error']) && trim($_GET['error']) !== '';
$errorMessage = $hasError ? htmlspecialchars($_GET['error']) : '';
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng nhập</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      min-height: 100vh;
      background-color: #f8f9fa;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
    }

    .login-card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 16px 32px rgba(0, 0, 0, 0.08);
      max-width: 420px;
      width: 100%;
    }

    .login-card .card-body {
      padding: 2rem;
    }

    .login-title {
      font-size: 1.75rem;
      font-weight: 700;
      color: #212529;
    }

    .form-control {
      border-radius: 0.75rem;
      padding: 1rem 1rem;
    }

    .btn-login {
      border-radius: 0.75rem;
      padding: 0.95rem 1rem;
    }

    .btn-login:hover {
      background-color: #0b5ed7;
    }

    .auth-footer {
      color: #6c757d;
      font-size: 0.95rem;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
        <div class="card login-card">
          <div class="card-body">
            <div class="text-center mb-4">
              <h1 class="login-title">Đăng nhập</h1>
            </div>

            <?php if ($hasError): ?>
              <div class="alert alert-danger py-2" role="alert">
                <?= $errorMessage ?>
              </div>
            <?php endif; ?>

            <form action="/auth/login" method="post" class="mt-4">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="Tên đăng nhập" required autocomplete="username">
                <label for="username">Tên đăng nhập</label>
              </div>

              <div class="form-floating mb-4">
                <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" required autocomplete="current-password">
                <label for="password">Mật khẩu</label>
              </div>

              <button type="submit" class="btn btn-primary btn-login w-100 mb-3">Đăng nhập</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>