<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'db.php';
$rows = [];
if ($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $stmt = $pdo->prepare("INSERT INTO users_nginx (name,email,phone) VALUES (?,?,?)");
        $stmt->execute([$_POST['name'], $_POST['email'], $_POST['phone']]);
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    }
    $rows = $pdo->query("SELECT * FROM users_nginx ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Nginx Web Server</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4" style="max-width:900px">
  <h1 class="mb-3"><span class="badge bg-success">Nginx</span> Web Server</h1>

  <div class="alert alert-success">
    <strong>Database Status:</strong> <?= htmlspecialchars($status) ?>
  </div>

  <div class="card mb-4">
    <div class="card-header">เพิ่มข้อมูลผู้ใช้</div>
    <div class="card-body">
      <form method="post">
        <div class="mb-3">
          <label class="form-label">ชื่อ</label>
          <input name="name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input name="email" type="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">เบอร์โทร</label>
          <input name="phone" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
      </form>
    </div>
  </div>

  <div class="card mb-4">
    <div class="card-header">ข้อมูลผู้ใช้</div>
    <div class="card-body">
      <table class="table table-bordered table-striped mb-0">
        <thead>
          <tr><th>ID</th><th>ชื่อ</th><th>Email</th><th>เบอร์โทร</th></tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $r): ?>
          <tr>
            <td><?= $r['id'] ?></td>
            <td><?= htmlspecialchars($r['name']) ?></td>
            <td><?= htmlspecialchars($r['email']) ?></td>
            <td><?= htmlspecialchars($r['phone']) ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
