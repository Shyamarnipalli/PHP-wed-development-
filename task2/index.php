<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task 2 - Blog UI</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      font-family: 'Segoe UI', sans-serif;
      min-height: 100vh;
      padding-top: 50px;
    }
    .container-box {
      background: #fff;
      padding: 25px;
      border-radius: 15px;
      box-shadow: 0px 8px 20px rgba(0,0,0,0.15);
      margin-bottom: 30px;
    }
    h3 {
      text-align: center;
      margin-bottom: 20px;
      font-weight: bold;
      color: #2575fc;
    }
    .btn-custom {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      color: #fff;
      border: none;
      font-weight: 600;
    }
    .btn-custom:hover {
      background: linear-gradient(135deg, #2575fc, #6a11cb);
      transform: scale(1.05);
    }
  </style>
</head>
<body>

<div class="container">

  <!-- Registration Form -->
  <div class="container-box">
    <h3><i class="fa fa-user-plus"></i> Register</h3>
    <form>
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" placeholder="Enter username" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" placeholder="Enter password" required>
      </div>
      <button type="submit" class="btn btn-custom w-100"><i class="fa fa-user-plus"></i> Register</button>
    </form>
  </div>

  <!-- Login Form -->
  <div class="container-box">
    <h3><i class="fa fa-user-lock"></i> Login</h3>
    <form>
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" placeholder="Enter username" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" placeholder="Enter password" required>
      </div>
      <button type="submit" class="btn btn-custom w-100"><i class="fa fa-sign-in-alt"></i> Login</button>
    </form>
  </div>

  <!-- Add Post -->
  <div class="container-box">
    <h3><i class="fa fa-pen"></i> Add Post</h3>
    <form>
      <div class="mb-3">
        <label class="form-label">Post Title</label>
        <input type="text" class="form-control" placeholder="Enter title" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea class="form-control" rows="4" placeholder="Write your post..." required></textarea>
      </div>
      <button type="submit" class="btn btn-custom w-100"><i class="fa fa-paper-plane"></i> Publish</button>
    </form>
  </div>

  <!-- Posts Display -->
  <div class="container-box">
    <h3><i class="fa fa-list"></i> Blog Posts</h3>
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title">📌 Sample Post Title</h5>
        <p class="card-text">This is an example of a blog post content. Posts will be displayed here.</p>
        <button class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</button>
        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
      </div>
    </div>
  </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
