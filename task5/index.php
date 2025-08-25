<?php
session_start();

// ✅ Database Connection
$conn = new mysqli("localhost", "root", "123456", "blog", 3307);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// ✅ Login Handling
if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
        } else {
            $error = "❌ Invalid password";
        }
    } else {
        $error = "❌ User not found";
    }
}

// ✅ Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: project.php");
    exit();
}

// ✅ Add Post
if (isset($_POST['add']) && ($_SESSION['role']=="admin" || $_SESSION['role']=="editor")) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);
    $stmt->execute();
}

// ✅ Edit Post
if (isset($_POST['update']) && ($_SESSION['role']=="admin" || $_SESSION['role']=="editor")) {
    $id = intval($_POST['id']);
    $title = $_POST['title'];
    $content = $_POST['content'];
    $stmt = $conn->prepare("UPDATE posts SET title=?, content=? WHERE id=?");
    $stmt->bind_param("ssi", $title, $content, $id);
    $stmt->execute();
}

// ✅ Delete Post (Admin only)
if (isset($_GET['delete']) && $_SESSION['role']=="admin") {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM posts WHERE id=$id");
}

// ✅ Search & Pagination
$limit = 5;  
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$search = isset($_GET['search']) ? $_GET['search'] : "";
$where = $search ? "WHERE title LIKE '%$search%' OR content LIKE '%$search%'" : "";

$result = $conn->query("SELECT * FROM posts $where ORDER BY id DESC LIMIT $start, $limit");
$totalPosts = $conn->query("SELECT COUNT(*) AS total FROM posts $where")->fetch_assoc()['total'];
$totalPages = ceil($totalPosts / $limit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Final Project</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      min-height: 100vh;
      background: linear-gradient(135deg, #89f7fe, #66a6ff);
      font-family: "Segoe UI", sans-serif;
      display: flex;
      justify-content: center;
      align-items: start;
      padding: 20px;
    }
    .container {
      max-width: 750px;
      width: 100%;
    }
    .card {
      border-radius: 15px;
      background: #fff;
      box-shadow: 0px 8px 20px rgba(0,0,0,0.1);
    }
    .btn-custom { border-radius: 20px; font-weight: 500; }
    .card-header {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      color: white;
      border-radius: 12px 12px 0 0;
      font-weight: bold;
      text-align: center;
      padding: 12px;
    }
    .post-card {
      background: #fdfdfd;
      border-left: 5px solid #2575fc;
    }
    .post-card h5 { color: #2575fc; }
    .pagination .page-item.active .page-link {
      background-color: #2575fc;
      border-color: #2575fc;
    }
  </style>
</head>
<body>

<div class="container">

  <?php if (!isset($_SESSION['username'])): ?>
    <!-- ✅ Login Form -->
    <div class="card mx-auto p-4 shadow-sm">
      <div class="card-header">🔐 Login</div>
      <?php if (!empty($error)) echo "<div class='alert alert-danger mt-2'>$error</div>"; ?>
      <form method="POST">
        <input type="text" name="username" class="form-control mb-3" placeholder="Username" required>
        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
        <button name="login" class="btn btn-primary btn-custom w-100">Login</button>
      </form>
    </div>

  <?php else: ?>
    <!-- ✅ Dashboard -->
    <div class="card p-3 mb-4">
      <div class="d-flex justify-content-between align-items-center">
        <h3 class="text-primary">📖 EduReg Blog</h3>
        <div>
          <b><?= $_SESSION['username'] ?> (<?= $_SESSION['role'] ?>)</b>
          <a href="?logout=1" class="btn btn-sm btn-danger btn-custom">Logout</a>
        </div>
      </div>
    </div>

    <!-- ✅ Search -->
    <form class="d-flex mb-3" method="GET">
      <input type="text" name="search" class="form-control me-2" placeholder="Search posts..." value="<?= htmlspecialchars($search) ?>">
      <button class="btn btn-outline-primary btn-custom">Search</button>
    </form>

    <!-- ✅ Add Post -->
    <?php if ($_SESSION['role'] == "admin" || $_SESSION['role'] == "editor"): ?>
      <div class="card p-3 mb-3">
        <h5 class="text-success">➕ Add New Post</h5>
        <form method="POST">
          <input type="text" name="title" class="form-control mb-2" placeholder="Title" required>
          <textarea name="content" class="form-control mb-2" placeholder="Content" required></textarea>
          <button name="add" class="btn btn-success btn-custom">Add Post</button>
        </form>
      </div>
    <?php endif; ?>

    <!-- ✅ Posts -->
    <?php while($row = $result->fetch_assoc()): ?>
      <div class="card post-card mb-3 p-3">
        <h5><?= htmlspecialchars($row['title']) ?></h5>
        <p><?= nl2br(htmlspecialchars($row['content'])) ?></p>
        <small class="text-muted"><?= $row['created_at'] ?></small>
        <div class="mt-2">
          <?php if ($_SESSION['role'] == "admin" || $_SESSION['role'] == "editor"): ?>
            <button class="btn btn-sm btn-primary btn-custom" data-bs-toggle="collapse" data-bs-target="#edit<?= $row['id'] ?>">Edit</button>
          <?php endif; ?>
          <?php if ($_SESSION['role'] == "admin"): ?>
            <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger btn-custom">Delete</a>
          <?php endif; ?>
        </div>
        <div class="collapse mt-2" id="edit<?= $row['id'] ?>">
          <form method="POST">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input type="text" name="title" class="form-control mb-2" value="<?= htmlspecialchars($row['title']) ?>" required>
            <textarea name="content" class="form-control mb-2" required><?= htmlspecialchars($row['content']) ?></textarea>
            <button name="update" class="btn btn-warning btn-custom">Update</button>
          </form>
        </div>
      </div>
    <?php endwhile; ?>

    <!-- ✅ Pagination -->
    <nav class="mt-3">
      <ul class="pagination justify-content-center">
        <?php for ($i=1; $i<=$totalPages; $i++): ?>
          <li class="page-item <?= $i==$page ? 'active' : '' ?>">
            <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
          </li>
        <?php endfor; ?>
      </ul>
    </nav>
  <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
