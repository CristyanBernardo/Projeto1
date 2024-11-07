$(document).ready(function() {
    // Alterna a visibilidade do menu suspenso ao clicar no ícone
    $('#createAccountBtn').on('click', function() {
        $('#menuOptions').toggle();  // Alterna a exibição do menu
    });

    // Redirecionar para a página de cadastro
    $('#registerOption').on('click', function() {
        window.location.href = '/pagina-de-cadastro';  // Substitua pelo caminho real
    });

    // Redirecionar para a página de login
    $('#loginOption').on('click', function() {
        window.location.href = '/pagina-de-login';  // Substitua pelo caminho real
    });
});
