        <nav class="navbar navbar-expand-md bg-light navbar-light shadow-sm">
            <div class="container">
                <strong class="mr-auto">Disciplinas</strong>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionar">Adicionar disciplina</button>
            </div>
        </nav>
    </div>
    <div class="container my-4">
        <div class="row">
            <?php
            if(isset($_POST['tarefa'])) {
                if($_POST['tarefa'] == 'editar') {
                    $id = $_POST['id'];
                    $nome = $_POST['nome'];
                    $slug = $_POST['slug'];
                    $posicao = $_POST['posicao'];
                    $cor = $_POST['cor'];
                    $icone = $_POST['icone'];
                    mysqli_query($conexao, "UPDATE disciplina SET nome = '$nome', slug = '$slug', posicao = $posicao, cor = '$cor', icone = '$icone' WHERE id = $id");
                } elseif($_POST['tarefa'] == 'adicionar') {
                    $nome = $_POST['nome'];
                    $slug = $_POST['slug'];
                    $posicao = $_POST['posicao'];
                    $cor = $_POST['cor'];
                    $icone = $_POST['icone'];
                    mysqli_query($conexao, "INSERT INTO disciplina (nome, slug, posicao, cor, icone) VALUES ('$nome', '$slug', $posicao, '$cor', '$icone')");
                } else {
                    $id = $_POST['id'];
                    mysqli_query($conexao, "DELETE FROM disciplina WHERE id = $id");
                }
            }

            $SQL = mysqli_query($conexao, 'SELECT * FROM disciplina ORDER BY posicao ASC');
            while($linha = mysqli_fetch_assoc($SQL)){
                    echo '
            <div class="col-sm-6 col-md-4 col-lg-3 text-center">
                    <div class="card shadow-sm mb-3 bg-light">
                        <div class="text-white py-4" style="background-color: ' . $linha['cor'] . ';">
                            <i class="' . $linha['icone'] . ' fa-3x mb-3"></i>
                            <h5 class="mb-0">' . $linha['nome'] . '</h5>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditar-' . $linha['id'] . '"><i class="fas fa-edit mr-2"></i>Editar</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir-' . $linha['id'] . '"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
            </div>
            <div id="modalEditar-' . $linha['id'] . '" class="modal fade" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar "' . $linha['nome'] . '"</h5>
                        </div>
                        <div class="modal-body">
                            <form id="formEditar-' . $linha['id'] . '" action="" method="POST">
                                <input type="text" id="tarefa" name="tarefa" value="editar" hidden>
                                <input type="text" id="id" name="id" value="' . $linha['id'] . '" hidden>
                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <label for="nome">Nome</label>
                                        <input type="text" id="nome" name="nome" class="form-control" placeholder="Digite o nome desejado" value="' . $linha['nome'] . '" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="posicao">Posição</label>
                                        <input type="text" id="posicao" name="posicao" class="form-control" value="' . $linha['posicao'] .  '" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="cor">Cor</label>
                                        <input type="color" id="cor" name="cor" class="form-control" value="' . $linha['cor'] . '" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="icone">Ícone</label>
                                        <input type="text" id="icone" name="icone" class="form-control" placeholder="Escolha o ícone desejado" value="' . $linha['icone'] . '" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="slug">Slug</label>
                                        <input type="text" id="slug" name="slug" class="form-control" value="' . $linha['slug'] . '" required>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" form="formEditar-' . $linha['id'] . '">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="modalExcluir-' . $linha['id'] . '" class="modal fade" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Excluir "' . $linha['nome'] . '"</h5>
                        </div>
                        <div class="modal-body">
                            <form id="formExcluir-' . $linha['id'] . '" action="" method="POST">
                                <input type="text" id="tarefa" name="tarefa" value="excluir" hidden>
                                <input type="text" id="id" name="id" value="' . $linha['id'] . '" hidden>
                            </form>
                            Você realmente deseja excluir a disciplina "' . $linha['nome'] . '"?
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger" form="formExcluir-' . $linha['id'] . '">Sim</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Não</button>
                        </div>
                    </div>
                </div>
            </div>';
            }
            ?>
        </div>
    </div>
    <div id="modalAdicionar" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar disciplina</h5>
                </div>
                <div class="modal-body">
                    <form id="formAdicionar" action="" method="POST">
                        <input type="text" id="tarefa" name="tarefa" value="adicionar" hidden>
                        <div class="form-row">
                            <div class="form-group col-md-10">
                                <label for="nome">Nome</label>
                                <input type="text" id="nome" name="nome" class="form-control" placeholder="Digite o nome desejado" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="posicao">Posição</label>
                                <input type="text" id="posicao" name="posicao" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="cor">Cor</label>
                                <input type="color" id="cor" name="cor" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="icone">Ícone</label>
                                <input type="text" id="icone" name="icone" class="form-control" placeholder="Escolha o ícone desejado" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="slug">Slug</label>
                                <input type="text" id="slug" name="slug" class="form-control" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="formAdicionar">Enviar</button>
                </div>
            </div>
        </div>
    </div>