        <nav class="navbar navbar-expand-md bg-light navbar-light shadow-sm">
            <div class="container">
                <strong class="mr-auto">Disciplinas</strong>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionar">Adicionar disciplina</button>
            </div>
        </nav>
    </div>
    <div class="container my-4">
        <div class="row">
            <div class="col-md-12">
                <table id="disciplinas" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Posição</th>
                            <th>Nome</th>
                            <th>Cor</th>
                            <th colspan="3">Ícone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(isset($_POST['tipo'])){
                            if($_POST['tipo'] != 'excluir'){
                                $nome = $_POST['nome'];
                                $cor = $_POST['cor'];
                                $icone = $_POST['icone'];
                                $posicao = $_POST['posicao'];
                                $slug = $_POST['slug'];

                                if($_POST['tipo'] == 'editar'){
                                    $id = $_POST['id'];
                                    mysqli_query($conexao, "UPDATE disciplina SET nome = '$nome', cor = '$cor', icone = '$icone', posicao = $posicao, slug = '$slug' WHERE id = $id");
                                } else{
                                    mysqli_query($conexao, "INSERT INTO disciplina (nome, slug, posicao, cor, icone) VALUES ('$nome', '$slug', '$posicao', '$cor', '$icone')");
                                }
                            } else{
                                $id = $_POST['id'];
                                mysqli_query($conexao, "DELETE FROM disciplina WHERE id = $id");
                            }
                        }

                        $SQL = mysqli_query($conexao, 'SELECT * FROM disciplina');
                        while($linha = mysqli_fetch_assoc($SQL)){
                            echo '
                        <tr>
                            <td>' . $linha['posicao'] . '</td>
                            <td>' . $linha['nome'] . '</td>
                            <td><div style="height: 25px; width: 25px; background-color: ' . $linha['cor'] . '; display: inline-flex;"></div><span style="vertical-align: super;" class="ml-2">' . $linha['cor'] . '</span></td>
                            <td><div style="height: 25px; width: 25px; display: inline-flex;" class="mr-2"><i class="' . $linha['icone'] . '"></i></div>' . $linha['icone'] . '</td>
                            <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditar-' . $linha['id'] . '"><i class="fas fa-pen"></i></button></td>
                            <td><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalExcluir-' . $linha['id'] . '"><i class="fas fa-times"></i></button></td>
                        </tr>
                        <div id="modalEditar-' . $linha['id'] . '" class="modal fade" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar "' . $linha['nome'] . '"</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formEditar-' . $linha['id'] . '" action="" method="POST">
                                            <input type="text" id="tipo" name="tipo" value="editar" hidden>
                                            <input type="text" id="id" name="id" value="' . $linha['id'] . '" hidden>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="nome">Nome</label>
                                                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Digite o nome desejado" value="' . $linha['nome'] . '" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-2">
                                                    <label for="cor">Cor</label>
                                                    <input type="color" id="cor" name="cor" class="form-control" value="' . $linha['cor'] . '" required>
                                                </div>
                                                <div class="form-group col-md-7">
                                                    <label for="icone">Ícone</label>
                                                    <input type="text" id="icone" name="icone" class="form-control" placeholder="Escolha o ícone desejado" value="' . $linha['icone'] . '" required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="posicao">Posição</label>
                                                    <input type="text" id="posicao" name="posicao" class="form-control" placeholder="Escolha a posição desejada" value="' . $linha['posicao'] . '" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="slug">Slug</label>
                                                    <input type="text" id="slug" name="slug" class="form-control" placeholder="Digite o slug desejado" value="' . $linha['slug'] . '" required>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" form="formEditar-' . $linha['id'] . '">Salvar alterações</button>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="modalAdicionar" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar disciplina</h5>
                </div>
                <div class="modal-body">
                    <form id="formEditar" action="" method="POST">
                        <input type="text" id="tipo" name="tipo" value="adicionar" hidden>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="nome">Nome</label>
                                <input type="text" id="nome" name="nome" class="form-control" placeholder="Digite o nome desejado" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="cor">Cor</label>
                                <input type="color" id="cor" name="cor" class="form-control" required>
                            </div>
                            <div class="form-group col-md-10">
                                <label for="icone">Ícone</label>
                                <input type="text" id="icone" name="icone" class="form-control" placeholder="Escolha o ícone desejado" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="formEditar">Enviar</button>
                </div>
            </div>
        </div>
    </div>