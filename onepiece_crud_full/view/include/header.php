<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>One Piece – CRUD MVC</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Pirata+One&display=swap" rel="stylesheet">
  <style>
    .op-avatar { width:48px; height:48px; object-fit:cover; border-radius:8px; }
    .op-thumb  { width:100%; height:220px; object-fit:cover; }
    .op-card   { border-radius:16px; overflow:hidden; }

    body {
      background: url("../../img/wallpaperflare.com_wallpaper (1).jpg") no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
    }

  
    .content-wrapper {
    margin-top: 190px;   
    margin-bottom: 40px;
}

.op-form-wrapper {
    display: flex;
    justify-content: center;
}

.op-form-card {
    background: rgba(255, 255, 255, 0.94);
    border-radius: 18px;
}

  
  </style>
</head>
<body>

<nav class="navbar bg-transparent position-absolute top-0 start-50 translate-middle-x" style="z-index:1000;">
  <a class="navbar-brand">
    <img src="../../img/One_Piece_Logo.png" alt="One Piece" height="140">
  </a>
</nav>

<div class="container pb-4 content-wrapper">
