<?php
    $this->layout("_theme");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="assets/css/cadastro.css">
  <script src="assets/js/register.js" async></script>
</head>
<body>
  <div class="register-container">
    <h2>Cadastro</h2>
    <form id="register-form" action="#" method="POST">
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

      <button type="submit">Cadastre-se</button>
      <a href="<?= url("login")?>"><span >tem cadastro? faça seu login aqui</span> <i class="fa-solid fa-up-right-from-square" style="color: #1a1a1a;"></i></span></a>
    </form>
  </div>
</body>
</html