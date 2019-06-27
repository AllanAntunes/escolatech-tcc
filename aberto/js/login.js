function enviarForm(idForm) {
    document.getElementById(idForm).submit();
}

$('#formLogin').submit(function() {
    $('.alert').hide();
    if($('#email').hasClass('is-invalid')) {
        $('#email').removeClass('is-invalid');
        $('#invalid-feedback-email').hide();
    }
    if($('#senha').hasClass('is-invalid')) {
        $('#senha').removeClass('is-invalid');
        $('#invalid-feedback-senha').hide();
    }
    var patternEmail = /^[A-z0-9._-]{1,}@[A-z0-9.-]{1,}\.[A-z0-9.-]{2,}$/;
    if(patternEmail.test($('#email').val()) == false) {
        $('#email').focus();
        $('#email').addClass('is-invalid');
        $('#invalid-feedback-email').show();
        return false;
    } else if($('#senha').val() == '' || $('#senha').val().length <= 7) {
        $('#senha').focus();
        $('#senha').addClass('is-invalid');
        $('#invalid-feedback-senha').show();
        return false;
    } else {
        $.post('../include/login.php',
        {
            email: $('#email').val(),
            senha: $('#senha').val()
        },
        function(retorno) {
            setTimeout(function() {
                retorno = JSON.parse(retorno);
                if(retorno.confere == true) {
                    switch(retorno.tipo) {
                        case 1:
                            $('#formLogin').attr('action', '/aluno/');
                            break;
                        default:
                            $('#formLogin').attr('action', '/admin/');
                    }
                    enviarForm('formLogin');
                } else {
                    $('.alert').show();
                }
            }, 1000);
        });
        return false;
    }
});