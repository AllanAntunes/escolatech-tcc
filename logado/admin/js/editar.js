var split = document.location.pathname.split("/");

if(split[3] == "novo") {
    var tarefa = "adicionarConteudo";
    var idCapitulo = split[4];

    $(".page-title").append("Adicionar conteúdo");

    $("#selecionarTipoDeConteudo").show();
} else {
    var tarefa = "editarConteudo";
    var idConteudo = split[3];

    $.getJSON("/include/completar-a-pagina-de-edicao.php?idConteudo=" + split[3], function(retorno) {
        if(retorno.tipo == 1) {
            $("#editarTopico").show();
            $("#botaoPublicarTopico").show();

            $(".page-title").append('Editar "' + retorno.titulo + '"');

            $("#tituloTopico").val(retorno.titulo);
            $("#posicaoTopico").val(retorno.posicao);
            $("#idVideoTopico").val(retorno.idVideo);
            $("#anexoURLTopico").val(retorno.anexoURL);

            idCapitulo = retorno.idCapitulo;

            $("#conteudoTopico").summernote({
                lang: "pt-BR",
                height: 400
            });

            $("#conteudoTopico").summernote('pasteHTML', retorno.conteudo);
        } else if(retorno.tipo == 2) {
            $("#editarListaDeExercicios").show();
            $("#botaoPublicarListaDeExercicios").show();
        } else {
            alert("Ocorreu um erro.");
        }
    });
}

$("#selecionarTipoTopico").click(function() {
    $("#selecionarTipoDeConteudo").hide();
    $("#editarTopico").show();
    $("#botaoPublicarTopico").show();

    $("#conteudoTopico").summernote({
        lang: "pt-BR",
        height: 400
    });
});

$("#selecionarTipoListaDeExercicios").click(function() {
    $("#selecionarTipoDeConteudo").hide();
    $("#editarListaDeExercicios").show();
    $("#botaoPublicarListaDeExercicios").show();
});

$("#formDeEdicaoDeTopico").submit(function() {
    if(tarefa == "adicionarConteudo") {
        $.post("/include/gerenciamento-de-conteudos.php", {
            tarefa: "adicionarConteudo",
            idCapitulo: idCapitulo,
            tipo: 1,
            posicao: $("#posicaoTopico").val(),
            titulo: $("#tituloTopico").val(),
            conteudo: $("#conteudoTopico").val(),
            anexoURL: $("#anexoURLTopico").val(),
            idVideo: $("#idVideoTopico").val()
        }, function(retorno) {
            if(retorno != "sucesso") {
                alert("Ocorreu um erro.");
            }
        });
    } else if(tarefa == "editarConteudo") {
        $.post("/include/gerenciamento-de-conteudos.php", {
            tarefa: "editarConteudo",
            idCapitulo: idCapitulo,
            idConteudo: idConteudo,
            tipo: 1,
            posicao: $("#posicaoTopico").val(),
            titulo: $("#tituloTopico").val(),
            conteudo: $("#conteudoTopico").val(),
            anexoURL: $("#anexoURLTopico").val(),
            idVideo: $("#idVideoTopico").val()
        }, function(retorno) {
            if(retorno != "sucesso") {
                alert("Ocorreu um erro.");
            }
        });
    } else {
        alert("Ocorreu um erro.");
    }
});