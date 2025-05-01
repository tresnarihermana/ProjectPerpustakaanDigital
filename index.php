<?php
session_start();
if (!isset($_SESSION['status'])) {
    header("Location: login.php");
    exit;
} else {
include 'layout/navbar.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman User</title>
    <style>
        .carousel-item{
            height: 480px;
            width: 1246px;
        }
    </style>
</head>
<body>
       <!-- carousel -->
       <div class="container">
      <div id="carouselExampleAutoplaying"class="carousel slide" data-bs-ride="carousel" style="margin-top: 20px;">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <a href="#">
            <img src="storage/img/carousel1.png" class="d-block w-100" alt="...">
          </a>
          </div>
          <div class="carousel-item">
            <a href="#">
            <img src="storage/img/carousel2.png" class="d-block w-100" alt="..."> 
          </a>
          </div>
          <div class="carousel-item">
            <a href="#">
            <img src="storage/img/carousel3.png" class="d-block w-100" alt="...">
          </a>
          </div>
          <div class="carousel-item">
            <a href="#">
            <img src="storage/img/carousel4.png" class="d-block w-100" alt="...">
          </a>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
</body>
</html>