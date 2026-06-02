<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: lightblue;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Danh sách sinh viên</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>MSSV</th>
                <th>Họ tên</th>
                <th>Giới tính</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($sinhvien as $sv): ?>
                <tr>
                    <td><?php echo $sv['id'] ?? $sv['ID'] ?? ''; ?></td>
                    <td><?php echo $sv['MSSV'] ?? $sv['mssv'] ?? ''; ?></td>
                    <td><?php echo $sv['HoTen'] ?? $sv['hoten'] ?? ''; ?></td>
                    <td><?php echo $sv['GioiTinh'] ?? $sv['gioitinh'] ?? ''; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>