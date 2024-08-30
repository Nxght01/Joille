<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>..:: Meu Sitema ::..</title>
    <link rel="stylesheet" href="assets/css/_theme.css">
</head>

<body>
<header>
    <div class="header-image">
    <img src="assets/images/joille.png" alt="Logo" class="header-logo">
    </div>
    <div class="header-nav">
        <ul class="header-nav-list">
        <a href="<?= url();?>">Home </a>
    <a href="<?= url("sobre"); ?>">Sobre</a>
    <a href="<?= url("contato"); ?>">Contato</a>
    <a href="<?= url("services"); ?>">Serviços</a>
    <a href="<?= url("faqs"); ?>">FAQs</a>
    <a href="<?= url("login");?>">Login</a>
    <a href="<?= url("cadastro");?>">Cadastro</a>
    
            
        </ul>
    </div>

</header>

<?php
    echo $this->section("content");
?>
<footer>
    <p>&copy; 2024. Joille Fornecedor de Serviços. Todos os direitos reservados.</p>
  </footer>
</body>
</html>