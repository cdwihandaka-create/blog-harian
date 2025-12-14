<?php
include 'config.php';
$q=mysqli_query($conn,"SELECT * FROM posts ORDER BY id DESC");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Blog Harian</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  body{background:#0f172a;color:white;font-family:Poppins,sans-serif;}
  .card-dark{background:#1e293b;border:none;border-radius:18px;padding:20px;}
  img{border-radius:12px;max-height:220px;width:100%;object-fit:cover;}
    h3{
    color:#fff !important;
    font-weight:600;
  }
</style>
</head>

<body class="container py-5">

<div class="d-flex justify-content-between mb-4">
  <h3>Blog Harian</h3>
  <a href="tambah.php" class="btn btn-primary">+ Tulis</a>
</div>

<?php while($r=mysqli_fetch_assoc($q)){ ?>
  <div class="card-dark mb-4 shadow">

    <?php if($r['gambar']){ ?>
      <img src="uploads/<?= $r['gambar'] ?>" class="mb-3">
    <?php } ?>

    <h5 class="fw-bold"><?= $r['judul'] ?></h5>
    <small class="text-secondary"><?= date("d M Y",strtotime($r['created_at'])) ?></small>
    <p class="mt-2"><?= nl2br($r['isi']) ?></p>

    <a href="edit.php?id=<?= $r['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
    <a href="hapus.php?id=<?= $r['id'] ?>" onclick="return confirm('Hapus?')" class="btn btn-danger btn-sm">Hapus</a>
  </div>
<?php } ?>

</body>
</html>