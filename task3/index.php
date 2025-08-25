<?php
/******************************************************
 * Blog App UI (index.php)
 * Only UI with forms & layout. 
 * Database code kept as placeholder for formality.
 ******************************************************/

// --- Database Connection Placeholder ---
try {
    // Placeholder connection code (not actually used here)
    // Normally: new PDO("mysql:host=localhost;dbname=blog", "user", "pass");
} catch (Exception $e) {
    // Just suppress DB errors for demo
}

// --- Simulated session (for demo only) ---
session_start();
$_SESSION['user'] = ['username'=>'demoUser','role'=>'admin']; // fake login for UI showcase

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Blog App – UI Demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />
  <style>
    :root{
      --grad-1: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
      --grad-2: linear-gradient(135deg, #12c2e9 0%, #c471ed 50%, #f64f59 100%);
    }
    body {
      min-height: 100vh;
      background: var(--grad-1);
      background-attachment: fixed;
      font-family: "Segoe UI", system-ui, -apple-system, Arial, sans-serif;
    }
    .glass {
      backdrop-filter: blur(10px);
      background: rgba(255,255,255,0.12);
      border: 1px solid rgba(255,255,255,0.25);
      border-radius: 18px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    }
    .brand-badge{
      background: var(--grad-2);
      color: #fff;
      padding: 10px 16px;
      border-radius: 999px;
      font-weight: 600;
      letter-spacing: 0.3px;
      box-shadow: 0 10px 18px rgba(0,0,0,0.25);
    }
    .card-raise{
      transition: transform .25s ease, box-shadow .25s ease;
    }
    .card-raise:hover{
      transform: translateY(-3px);
      box-shadow: 0 16px 40px rgba(0,0,0,0.35);
    }
    .btn-gradient{
      background: var(--grad-2);
      border: none;
      color: #fff;
    }
    .btn-gradient:hover{
      filter: brightness(1.03);
      transform: translateY(-1px);
    }
    .form-control, .btn {
      border-radius: 12px;
    }
    .role-badge{
      font-size: 0.85rem;
      padding: .35rem .6rem;
      border-radius: 999px;
      color:#fff;
    }
    .role-admin{ background:#0d6efd; }
  </style>
</head>
<body>
  <header class="container py-4">
    <div class="d-flex align-items-center justify-content-between">
      <div class="brand-badge animate__animated animate__fadeInDown">Blog UI Demo – Forms & CRUD Layout</div>
      <div>
        <span class="text-white me-3">Signed in as <strong>demoUser</strong>
        <span class="ms-2 role-badge role-admin">admin</span></span>
        <button class="btn btn-outline-light btn-sm">Logout</button>
      </div>
    </div>
  </header>

  <main class="container pb-5">
    <div class="row g-4">
      <div class="col-lg-4">
        <!-- Post Editor -->
        <div class="p-4 glass text-white card-raise">
          <h4 class="mb-3">Post Editor</h4>
          <form class="row g-3">
            <div class="col-12">
              <label class="form-label">Title</label>
              <input type="text" class="form-control" placeholder="Enter title">
            </div>
            <div class="col-12">
              <label class="form-label">Content</label>
              <textarea rows="5" class="form-control" placeholder="Write your post..."></textarea>
            </div>
            <div class="col-12 d-grid">
              <button class="btn btn-light text-dark">Create Post</button>
            </div>
          </form>
        </div>
      </div>

      <div class="col-lg-8">
        <!-- Search -->
        <div class="p-4 glass text-white mb-4 card-raise">
          <form class="row g-2 align-items-center">
            <div class="col-sm-8">
              <input type="text" class="form-control" placeholder="Search posts...">
            </div>
            <div class="col-sm-2 d-grid">
              <button class="btn btn-light text-dark">Search</button>
            </div>
            <div class="col-sm-2 d-grid">
              <button class="btn btn-outline-light">Reset</button>
            </div>
          </form>
        </div>

        <!-- Posts List -->
        <div class="glass card-raise">
          <div class="p-4 border-bottom border-white border-opacity-25 text-white d-flex justify-content-between">
            <h4 class="mb-0">Posts</h4>
            <span class="small">Total: 3</span>
          </div>
          <div class="p-3 p-md-4 bg-white rounded-bottom">
            <!-- Sample post -->
            <div class="card mb-3 shadow-sm card-raise">
              <div class="card-body">
                <h5 class="card-title mb-2">Sample Post Title</h5>
                <p class="card-text mb-2">This is an example post. Actual data will appear here if database is enabled.</p>
                <div class="d-flex justify-content-end gap-2">
                  <button class="btn btn-sm btn-warning">Edit</button>
                  <button class="btn btn-sm btn-danger">Delete</button>
                </div>
              </div>
            </div>
            <!-- Pagination -->
            <nav>
              <ul class="pagination justify-content-center mt-4">
                <li class="page-item disabled"><span class="page-link">Prev</span></li>
                <li class="page-item active"><span class="page-link">1</span></li>
                <li class="page-item"><span class="page-link">2</span></li>
                <li class="page-item"><span class="page-link">3</span></li>
                <li class="page-item"><span class="page-link">Next</span></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer class="container py-4 text-center">
    <span class="text-white-50 small">UI Demo Only • Database disabled</span>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
