<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Đăng nhập</title>
</head>
<body>
    <h1>Đăng nhập</h1>
    <?php if (isset ($_GET['error'])): ?>
        <p style="color: red;"><?php echo $_GET['error']; ?></p>
    <?php endif; ?>
    <form action="auth/login" method="post">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Mật khẩu:</label>
        <input id="password" name="password" required><br><br>
        <input type="submit" value="Đăng nhập">
</body>
</html>