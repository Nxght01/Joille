document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('login-form');

    loginForm.addEventListener('submit', async (event) => {
        event.preventDefault(); // Evita o envio padrão do formulário

        // Cria um FormData para enviar os dados do formulário via AJAX
        const formData = new FormData(loginForm);

        try {
            // Envia a solicitação AJAX
            const response = await fetch('login.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.status === 'success') {
                // Redireciona para a homepage se o login for bem-sucedido
                window.location.href = 'themes\web\_theme.php';
            } else {
                // Exibe uma mensagem de erro se o login falhar
                alert(result.message);
            }
        } catch (error) {
            console.error('Erro:', error);
            alert('Ocorreu um erro ao tentar fazer login.');
        }
    });
});
