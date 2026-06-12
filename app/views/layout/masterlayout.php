<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>

  <style>
    * {
      margin: 0;
      padding: 0;
    }

    html, body {
      height: 100%;
    }

    body {
      background-color: #f5f5f5;
      display: flex;
      flex-direction: column;
    }

    .header-bg {
      background-color: #a0d8e8 !important;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
      font-size: 24px;
      font-weight: bold;
      color: #333 !important;
    }

    .nav-link {
      color: #333 !important;
      font-weight: 500;
      margin: 0 10px;
    }

    .nav-link:hover {
      color: #0056b3 !important;
    }

    .content {
      width: 85%;
      margin: 20px auto;
      padding: 20px 0;
      flex: 1;
    }

    .card {
      border: none;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }

    .card-header {
      background-color: #a0d8e8 !important;
      color: #333 !important;
      border-radius: 8px 8px 0 0;
      border: none;
    }

    .table-striped tbody tr:nth-child(odd) {
      background-color: #e8f4f8;
    }

    .table-striped tbody tr:nth-child(even) {
      background-color: #fff;
    }

    .table-hover tbody tr:hover {
      background-color: #d0eaef !important;
    }

    .badge {
      padding: 6px 12px;
      border-radius: 4px;
    }

    .badge-info {
      background-color: #a0d8e8 !important;
      color: #333 !important;
    }

    .btn-add {
      background-color: #28a745;
      color: white;
      border: none;
    }

    .btn-add:hover {
      background-color: #218838;
      color: white;
    }

    .pagination .page-link {
      color: #a0d8e8;
    }

    .pagination .page-link:hover {
      background-color: #a0d8e8;
      color: white;
    }

    .pagination .page-item.active .page-link {
      background-color: #a0d8e8;
      border-color: #a0d8e8;
    }

    footer {
      margin-top: auto;
    }
  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <?php require_once '../app/views/layout/partial/header.php'; ?>
  <div class="content">
    <?php require_once '../app/views/' . $viewname . '.php'; ?>
  </div>
  <?php require_once '../app/views/layout/partial/footer.php'; ?>
</body>

</html>