<?php
include 'config.php';

$id = intval($_GET['id']);
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM posts WHERE id=$id"));
if(!$data) die("404 Not Found");

if(isset($_POST['submit'])){
  $judul = $_POST['judul'];
  $isi   = $_POST['isi'];
  $img   = $_FILES['gambar']['name'];
  $tmp   = $_FILES['gambar']['tmp_name'];

  if($img){
    move_uploaded_file($tmp, "uploads/$img");
    $q = "UPDATE posts SET judul='$judul', isi='$isi', gambar='$img' WHERE id=$id";
  } else {
    $q = "UPDATE posts SET judul='$judul', isi='$isi' WHERE id=$id";
  }

  mysqli_query($conn, $q);
  header("Location:index.php"); exit();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Blog</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  body{background:#0f172a;color:#fff;font-family:Poppins,sans-serif;}
  .card-dark{background:#1e293b;border-radius:18px;}
  .title-edit {
    color: #fff; /* tanpa !important */
    font-weight: 600;
}
/* ✔ Edit Blog jadi putih */
  .form-control{
    background:#0f172a;
    color:#fff;
    border:1px solid #ffffff55;
  }
  .form-control::placeholder{color:#94a3b8;}
  img{border-radius:12px;max-height:180px;}
</style>
</head>

<body class="container d-flex justify-content-center align-items-center min-vh-100">
<div class="col-md-6">
  <div class="card-dark p-4 shadow-lg">

    <h4 class="title-edit">Edit Blog</h4>


    <form method="post" enctype="multipart/form-data">
      <input class="form-control mb-3" name="judul" value="<?= $data['judul'] ?>" required>
      <textarea class="form-control mb-3" rows="5" name="isi" required><?= $data['isi'] ?></textarea>

      <?php if($data['gambar']){ ?>
        <img src="uploads/<?= $data['gambar'] ?>" class="w-100 mb-3">
      <?php } ?>

      <input type="file" class="form-control mb-3" name="gambar">

      <div class="d-flex justify-content-between">
        <a href="index.php" class="btn btn-secondary btn-sm">←</a>
        <button class="btn btn-warning btn-sm" name="submit">Update</button>
      </div>
    </form>

  </div>
</div>
</body>
</html>
