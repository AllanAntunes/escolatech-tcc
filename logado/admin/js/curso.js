var split = document.location.pathname.split("/");

if(split[3]) {
    $.getJSON('/include/listagem-de-um-curso.php?curso=' + split[3], function(retorno) {
        if(retorno.existe == true) {
            $(".page-title").append(retorno.titulo);

            $("#idCurso").val(retorno.id);

            var i = 0, j, append;
            while(retorno.capitulos[i]) {
                var numCapitulo = i + 1;

                $("#teste").append(`
                <div class="row mb-3">
                    <div class="col-md-9">
                        <h2 class="mr-3" style="display: inline;">Capítulo ` + numCapitulo + ` - <strong>` + retorno.capitulos[i].titulo + `</strong></h2>
                    </div>
                    <div class="col-md-3">
                        <div style="float: right;">
                            <button type="button" class="btn btn-primary btn-round btn-sm" data-toggle="modal" data-target="#modalEditarCapitulo-` + retorno.capitulos[i].id + `"><i class="fas fa-pen mr-2"></i>Editar</button>
                            <button type="button" class="btn btn-danger btn-round btn-sm" data-toggle="modal" data-target="#modalExcluirCapitulo-` + retorno.capitulos[i].id + `"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modalEditarCapitulo-` + retorno.capitulos[i].id + `" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar capítulo</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body bg-light">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form id="formEditarCapitulo-` + retorno.capitulos[i].id + `" action="" method="POST">
                                                <div class="form-row">
                                                    <div class="form-group col-md-9">
                                                        <label for="editarTituloCapitulo-` + retorno.capitulos[i].id + `">Título</label>
                                                        <input type="text" class="form-control" id="editarTituloCapitulo-` + retorno.capitulos[i].id + `" name="editarTituloCapitulo-` + retorno.capitulos[i].id + `" placeholder="Digite o novo título do capítulo" value="` + retorno.capitulos[i].titulo + `">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="editarPosicaoCapitulo-` + retorno.capitulos[i].id + `">Posição</label>
                                                        <input type="text" class="form-control" id="editarPosicaoCapitulo-` + retorno.capitulos[i].id + `" name="editarPosicaoCapitulo-` + retorno.capitulos[i].id + `" value="` + retorno.capitulos[i].posicao + `">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" form="formEditarCapitulo-` + retorno.capitulos[i].id + `"><i class="fas fa-send mr-2"></i>Enviar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modalExcluirCapitulo-` + retorno.capitulos[i].id + `" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Excluir capítulo</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body bg-light">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            Tem certeza que deseja excluir o capítulo ` + numCapitulo + ` - "` + retorno.capitulos[i].titulo + `"?
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger" id="confirmarExclusaoDeCapitulo-` + retorno.capitulos[i].id + `"><i class="fas fa-trash mr-2"></i>Excluir capítulo</button>
                                <button type="submit" class="btn btn-primary data-dismiss="modal">Voltar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $("#formEditarCapitulo-` + retorno.capitulos[i].id + `").submit(function() {
                        $.post("/include/gerenciamento-de-capitulos.php", {
                            tarefa: "editarCapitulo",
                            idCapitulo: ` + retorno.capitulos[i].id + `,
                            titulo: $("#editarTituloCapitulo-` + retorno.capitulos[i].id + `").val(),
                            posicao: $("#editarPosicaoCapitulo-` + retorno.capitulos[i].id + `").val()
                        }, function(retornoEditarCapitulo) {
                            if(retornoEditarCapitulo != "sucesso") {
                                alert("Ocorreu um erro. Tente novamente.");
                            }
                        });
                    });
                    
                    $("#confirmarExclusaoDeCapitulo-` + retorno.capitulos[i].id + `").click(function() {
                        $.post("/include/gerenciamento-de-capitulos.php", {
                            tarefa: "excluirCapitulo",
                            idCapitulo: ` + retorno.capitulos[i].id + `,
                            posicao: ` + retorno.capitulos[i].posicao + `
                        }, function(retornoExcluirCapitulo) {
                            if(retornoExcluirCapitulo == "sucesso") {
                                location.reload();
                            } else {
                                alert("Ocorreu um erro. Tente novamente.");
                            }
                        });
                    });
                </script>`);

                $("#idCapitulo-" + retorno.capitulos[i].id).val(retorno.capitulos[i].id);

                append = "";

                if(retorno.capitulos[i].temConteudo == 1) {
                    j = 0;
                    while(retorno.capitulos[i].conteudos[j]) {
                        if(retorno.capitulos[i].conteudos[j].tipo == 1) {
                            append = append + `
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body bg-primary-gradient" style="height: 170px;">
                                <div class="card-title" style="height: 95px; color: white; font-size: 18px;">
                                    ` + retorno.capitulos[i].conteudos[j].titulo + `
                                </div>
                                <div style="float: right;">
                                    <a href="/admin/editar/` + retorno.capitulos[i].conteudos[j].id + `/" class="btn btn-light btn-round btn-sm"><i class="fas fa-pen mr-2"></i>Editar</a>
                                    <button type="button" class="btn btn-danger btn-round btn-sm" data-toggle="modal" data-target="#modalExcluirConteudo-` + retorno.capitulos[i].conteudos[j].id + `"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modalExcluirConteudo-` + retorno.capitulos[i].conteudos[j].id + `" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Excluir tópico</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body bg-light">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-12">
                                                Tem certeza que deseja excluir o tópico "` + retorno.capitulos[i].conteudos[j].titulo + `"?
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger" id="confirmarExclusaoDeConteudo-` + retorno.capitulos[i].conteudos[j].id + `"><i class="fas fa-trash mr-2"></i>Excluir tópico</button>
                                    <button type="submit" class="btn btn-primary data-dismiss="modal">Voltar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        $("#confirmarExclusaoDeConteudo-` + retorno.capitulos[i].conteudos[j].id + `").click(function() {
                            $.post("/include/gerenciamento-de-conteudos.php", {
                                tarefa: "excluirConteudo",
                                tipo: 1,
                                idCapitulo: ` + retorno.capitulos[i].id + `,
                                idConteudo: ` + retorno.capitulos[i].conteudos[j].id + `,
                                posicao: ` + retorno.capitulos[i].conteudos[j].posicao + `
                            }, function(retornoExcluirConteudo) {
                                if(retornoExcluirConteudo == "sucesso") {
                                    location.reload();
                                } else {
                                    alert(retornoExcluirConteudo);
                                    alert("Ocorreu um erro. Tente novamente.");
                                }
                            });
                        });
                    </script>`;
                        } else if(retorno.capitulos[i].conteudos[j].tipo == 2) {
                            append = append + `
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body bg-info-gradient" style="height: 170px;">
                                <div class="card-title" style="height: 95px; color: white; font-size: 18px;">
                                    Lista de exercícios
                                </div>
                                <div style="float: right;">
                                    <a href="/admin/editar/` + retorno.capitulos[i].conteudos[j].id + `/" class="btn btn-light btn-round btn-sm"><i class="fas fa-pen mr-2"></i>Editar</a>
                                    <button type="button" class="btn btn-danger btn-round btn-sm" data-toggle="modal" data-target="#modalExcluirConteudo-` + retorno.capitulos[i].conteudos[j].id + `"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body bg-info-gradient" style="height: 170px;">
                                <div class="card-title" style="height: 95px; color: white; font-size: 18px;">
                                    Resoluções dos exercícios
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modalExcluirConteudo-` + retorno.capitulos[i].conteudos[j].id + `" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Excluir tópico</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body bg-light">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-12">
                                                Tem certeza que deseja excluir o tópico "` + retorno.capitulos[i].conteudos[j].titulo + `"?
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger" id="confirmarExclusaoDeConteudo-` + retorno.capitulos[i].conteudos[j].id + `"><i class="fas fa-trash mr-2"></i>Excluir tópico</button>
                                    <button type="submit" class="btn btn-primary data-dismiss="modal">Voltar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        $("#confirmarExclusaoDeConteudo-` + retorno.capitulos[i].conteudos[j].id + `").click(function() {
                            $.post("/include/gerenciamento-de-conteudos.php", {
                                tarefa: "excluirConteudo",
                                tipo: 2,
                                idConteudo: ` + retorno.capitulos[i].conteudos[j].id + `
                            }, function(retornoExcluirConteudo) {
                                if(retornoExcluirConteudo == "sucesso") {
                                    location.reload();
                                } else {
                                    alert("Ocorreu um erro. Tente novamente.");
                                }
                            });
                        });
                    </script>`;
                        }
    
                        j++;
                    }
                }

                $("#teste").append(`
                <div class="row mb-4">` + append + `
                    <div class="col-md-3">
                        <a href="/admin/editar/novo/` + retorno.capitulos[i].id + `/">
                            <div class="card text-primary text-center" style="border: 1px solid #1572e8; border-radius: unset;">
                                <div class="card-body" style="height: 170px;">
                                    <div class="mb-2" style="margin-top: 32.5px;"><i class="fas fa-plus fa-2x"></i></div>
                                    <span style="font-size: 18px;">Adicionar conteúdo</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>`);
                
                i++;
            }
        } else {
            window.location.href = "https://escolatech.net/admin/cursos/";
        }
    });
} else {
    window.location.href = "https://escolatech.net/admin/cursos/";
}

$("#formAdicionarCapitulo").submit(function() {
    $.post("/include/gerenciamento-de-capitulos.php", {
        tarefa: "adicionarCapitulo",
        idCurso: $("#idCurso").val(),
        titulo: $("#tituloNovoCapitulo").val(),
        posicao: $("#posicaoNovoCapitulo").val()
    }, function(retornoAdicionarCapitulo) {
        if(retornoAdicionarCapitulo != "sucesso") {
            alert("Ocorreu um erro. Tente novamente.");
        }
    });
});