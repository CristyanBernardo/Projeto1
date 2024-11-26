$(function() {
    // Alterna a exibição do menu ao clicar no botão
    $('#toggleMenuBtn').on('click', function(event) {
        event.stopPropagation(); // Evita que o clique feche o menu imediatamente

        var $button = $(this);
        var $dropdownMenu = $('#menuOptions');

        // Calcula a posição do botão
        var buttonOffset = $button.offset();
        var buttonWidth = $button.outerWidth();

        // Define a posição da lista flutuante
        $dropdownMenu.css({
            display: 'block', // Exibe o menu
            top: buttonOffset.top + $button.outerHeight(), // Abaixo do botão
            left: buttonOffset.left + (buttonWidth / 2) - ($dropdownMenu.outerWidth() / 2) // Centraliza em relação ao botão
        }).toggleClass('show');
    });

    // Fecha o menu ao clicar fora dele
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#menuOptions, #toggleMenuBtn').length) {
            $('#menuOptions').removeClass('show').css('display', 'none'); // Esconde o menu
        }
    });
});