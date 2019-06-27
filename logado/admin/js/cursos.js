$.getJSON("/include/listagem-de-cursos.php", function(retorno) {
    var i = 0;
    while(retorno[i]) {
        function lightDoHSL(hex) {
            var hexadecimal = /^#?([A-f0-9]{2})([A-f0-9]{2})([A-f0-9]{2})$/i.exec(hex);

            var r = parseInt(hexadecimal[1], 16) / 255;
            var g = parseInt(hexadecimal[2], 16) / 255;
            var b = parseInt(hexadecimal[3], 16) / 255;

            var light = ((Math.max(r, g, b) + Math.min(r, g, b)) / 2) * 100;

            return light;
        }
        var light = lightDoHSL(retorno[i].cor);

        $("#cursos").append(`
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-2">
                            <div class="card mb-2">
                                <a href="/admin/curso/` + retorno[i].slug + `/">
                                    <div class="card-body text-white text-center py-4" style="background-color: ` + retorno[i].cor + `;">
                                        <img src="` + retorno[i].imagemURL + `" class="mb-3" height="40px">
                                        <h4 class="mb-0" style="color: hsl(0,0%,calc((` + light + ` - 70) * (-100%)));">` + retorno[i].titulo + `</h4>
                                    </div>
                                </a>
                                <div class="card-footer">
                                    <div style="float: right;">
                                        <a href="/admin/editar/" class="btn btn-primary btn-round btn-sm" data-toggle="modal" data-target="#modalEditarCurso-` + retorno[i].id + `"><i class="fas fa-pen mr-2"></i>Editar</a>
                                        <button type="button" class="btn btn-danger btn-round btn-sm" data-toggle="modal" data-target="#modalExcluirCurso-` + retorno[i].id + `"><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modalEditarCurso-` + retorno[i].id + `" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar curso</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body bg-light">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form id="formEditarCurso-` + retorno[i].id + `" action="" method="POST">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label for="editarTituloCurso-` + retorno[i].id + `">Título</label>
                                                                <input type="text" class="form-control" id="editarTituloCurso-` + retorno[i].id + `" name="editarTituloCurso-` + retorno[i].id + `" value="` + retorno[i].titulo + `">
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-3">
                                                                <label for="editarPosicaoCurso-` + retorno[i].id + `">Posição</label>
                                                                <input type="text" class="form-control" id="editarPosicaoCurso-` + retorno[i].id + `" name="editarPosicaoCurso-` + retorno[i].id + `" value="` + retorno[i].posicao + `">
                                                            </div>
                                                            <div class="form-group col-md-9">
                                                                <label for="editarCorCurso-` + retorno[i].id + `">Cor</label>
                                                                <input type="color" class="form-control" id="editarCorCurso-` + retorno[i].id + `" name="editarCorCurso-` + retorno[i].id + `" value="` + retorno[i].cor + `">
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label for="editarImagemURLCurso-` + retorno[i].id + `">URL da imagem</label>
                                                                <input type="text" class="form-control" id="editarImagemURLCurso-` + retorno[i].id + `" name="editarImagemURLCurso-` + retorno[i].id + `" value="` + retorno[i].imagemURL + `">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" form="formEditarCurso-` + retorno[i].id + `"><i class="fas fa-send mr-2"></i>Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modalExcluirCurso-` + retorno[i].id + `" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Excluir curso</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body bg-light">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    Tem certeza que deseja excluir o curso "` + retorno[i].titulo + `"?
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger" id="confirmarExclusaoDeCurso-` + retorno[i].id + `"><i class="fas fa-trash mr-2"></i>Excluir curso</button>
                                        <button type="submit" class="btn btn-primary data-dismiss="modal">Voltar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $("#formEditarCurso-` + retorno[i].id + `").submit(function() {
                                $.post('/include/gerenciamento-de-cursos.php', {
                                    tarefa: "editarCurso",
                                    idCurso: ` + retorno[i].id + `,
                                    titulo: $("#editarTituloCurso-` + retorno[i].id + `").val(),
                                    posicao: $("#editarPosicaoCurso-` + retorno[i].id + `").val(),
                                    cor: $("#editarCorCurso-` + retorno[i].id + `").val(),
                                    imagemURL: $("#editarImagemURLCurso-` + retorno[i].id + `").val()
                                }, function(retorno) {
                                    if(retorno != "sucesso") {
                                        alert("Ocorreu um erro. Tente novamente.");
                                    } else {
                                        setTimeout(function() {
                                            enviarForm("formEditarCurso-` + retorno[i].id + `");
                                        }, 1000);
                                    }
                                });
                                return false;
                            });

                            $("#confirmarExclusaoDeCurso-` + retorno[i].id + `").click(function() {
                                $.post('/include/gerenciamento-de-cursos.php', {
                                    tarefa: "excluirCurso",
                                    idCurso: ` + retorno[i].id + `,
                                    posicao: ` + retorno[i].posicao + `
                                }, function(retorno) {
                                    if(retorno == "sucesso") {
                                        setTimeout(function() {
                                            location.reload();
                                        }, 1000);
                                    } else {
                                        alert("Ocorreu um erro. Tente novamente.");
                                    }
                                });
                            });
                        </script>`);
        
        i++;
    }
});

$("#formAdicionarCurso").submit(function() {
    $.post('/include/gerenciamento-de-cursos.php', {
        tarefa: "adicionarCurso",
        titulo: $("#tituloCurso").val(),
        posicao: $("#posicaoCurso").val(),
        cor: $("#corCurso").val(),
        imagemURL: $("#imagemURLCurso").val()
    }, function(retorno) {
        if(retorno != "sucesso") {
            alert("Ocorreu um erro. Tente novamente.");
        }
    });
});