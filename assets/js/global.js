function deslogar() {
    $.get("/include/logout.php", function(retorno) {
        if(retorno == '') {
            window.location.replace('/');
        } else {
            alert('Ocorreu um erro ao tentar deslogar. Tente novamente.');
        }
    });
}