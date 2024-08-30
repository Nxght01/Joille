<?php
    $this->layout("_theme");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="assets/css/login.css">
  <script src="assets/js/login.js" async></script>
</head>
<body>
<div class="login-container">
    <h2>Login</h2>
    <form id="login-form" action="#" method="POST">
    
    <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>
      </div>

      <button type="submit">Faça login</button>
      <a href="<?= url("cadastro")?>"><span >Novo aqui? faça seu cadastro</span> <i class="fa-solid fa-up-right-from-square" style="color: #1a1a1a;"></i></span></a>
    </form>
  </div>
</body>
</html