$(document).ready(function() {
    // Alterna a exibição do menu ao clicar no botão
    $('#toggleMenuBtn').click(function(event) {
        event.stopPropagation(); // Evita que o clique feche o menu imediatamente
        $('#menuOptions').toggleClass('show');
    });

    // Fecha o menu ao clicar fora dele
    $(document).click(function(event) {
        if (!$(event.target).closest('#menuOptions, #toggleMenuBtn').length) {
            $('#menuOptions').removeClass('show');
        }
    });
});