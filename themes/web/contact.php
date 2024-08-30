<?php
    $this->layout("_theme");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato</title>
    <link rel="stylesheet" href="assets/css/contato.css">
    </head>
<body>
    <div class="container">
        <h2>Entre em Contato</h2>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="mensagem">Mensagem:</label>
                <textarea id="mensagem" name="mensagem" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Enviar Mensagem">
            </div>
        </form>
    </div>
</body>
</html>