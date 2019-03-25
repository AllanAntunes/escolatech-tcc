<?php if(!isset($_GET['materia']) && !isset($_GET['disciplina'])){ ?>
        <nav class="navbar navbar-expand-md bg-light navbar-light shadow-sm">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><i class="fas fa-home mr-2"></i>Disciplinas</li>
                </ol>
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
            while($disciplina = mysqli_fetch_assoc($SQL)){
                    echo '
            <div class="col-sm-6 col-md-4 col-lg-3 text-center">
                <div class="card shadow-sm mb-3 bg-light">
                    <a href="' . $disciplina['slug'] . '/">
                        <div class="text-white py-4" style="background-color: ' . $disciplina['cor'] . ';">
                            <i class="' . $disciplina['icone'] . ' fa-3x mb-3"></i>
                            <h5 class="mb-0">' . $disciplina['nome'] . '</h5>
                        </div>
                    </a>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditar-' . $disciplina['id'] . '"><i class="fas fa-edit mr-2"></i>Editar</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir-' . $disciplina['id'] . '"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>
            <div id="modalEditar-' . $disciplina['id'] . '" class="modal fade" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar "' . $disciplina['nome'] . '"</h5>
                        </div>
                        <div class="modal-body">
                            <form id="formEditar-' . $disciplina['id'] . '" action="" method="POST">
                                <input type="text" id="tarefa" name="tarefa" value="editar" hidden>
                                <input type="text" id="id" name="id" value="' . $disciplina['id'] . '" hidden>
                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <label for="nome">Nome</label>
                                        <input type="text" id="nome" name="nome" class="form-control" placeholder="Digite o nome desejado" value="' . $disciplina['nome'] . '" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="posicao">Posição</label>
                                        <input type="text" id="posicao" name="posicao" class="form-control" value="' . $disciplina['posicao'] .  '" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="cor">Cor</label>
                                        <input type="color" id="cor" name="cor" class="form-control" value="' . $disciplina['cor'] . '" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="icone">Ícone</label>
                                        <input type="text" id="icone" name="icone" class="form-control" placeholder="Escolha o ícone desejado" value="' . $disciplina['icone'] . '" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="slug">Slug</label>
                                        <input type="text" id="slug" name="slug" class="form-control" value="' . $disciplina['slug'] . '" required>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" form="formEditar-' . $disciplina['id'] . '">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="modalExcluir-' . $disciplina['id'] . '" class="modal fade" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Excluir "' . $disciplina['nome'] . '"</h5>
                        </div>
                        <div class="modal-body">
                            <form id="formExcluir-' . $disciplina['id'] . '" action="" method="POST">
                                <input type="text" id="tarefa" name="tarefa" value="excluir" hidden>
                                <input type="text" id="id" name="id" value="' . $disciplina['id'] . '" hidden>
                            </form>
                            Você realmente deseja excluir a disciplina "' . $disciplina['nome'] . '"?
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger" form="formExcluir-' . $disciplina['id'] . '">Sim</button>
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
<?php } elseif(!isset($_GET['materia'])){ ?>
        <nav class="navbar navbar-expand-md bg-light navbar-light shadow-sm">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/conteudo/"><i class="fas fa-home mr-2"></i>Disciplinas</a></li>
                    <li class="breadcrumb-item active">
                        <?php
                        $disciplina = $_GET['disciplina'];
                        $disciplina = mysqli_query($conexao, "SELECT * FROM disciplina WHERE slug = '$disciplina'");
                        $disciplina = mysqli_fetch_assoc($disciplina);
                        echo $disciplina['nome'];
                        ?>
                    </li>
                </ol>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionar">Adicionar matéria</button>
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
                    mysqli_query($conexao, "UPDATE materia SET nome = '$nome', slug = '$slug', posicao = $posicao WHERE id = $id");
                } elseif($_POST['tarefa'] == 'adicionar') {
                    $nome = $_POST['nome'];
                    $slug = $_POST['slug'];
                    $posicao = $_POST['posicao'];
                    mysqli_query($conexao, "INSERT INTO materia (nome, slug, posicao, idDisciplina) VALUES ('$nome', '$slug', $posicao, 9)");
                } else {
                    $id = $_POST['id'];
                    mysqli_query($conexao, "DELETE FROM materia WHERE id = $id");
                }
            }
            $SQL = mysqli_query($conexao, 'SELECT * FROM materia WHERE idDisciplina = ' . $disciplina['id'] . ' ORDER BY posicao ASC');
            while($materia = mysqli_fetch_assoc($SQL)){
                echo '
            <div class="col-sm-6 col-md-4 col-lg-3 text-center">
                <div class="card shadow-sm mb-3 bg-light">
                    <a href="/admin/conteudo/' . $disciplina['slug'] . '/' . $materia['slug'] . '/">
                        <div class="text-white py-4" style="background-color: ' . $disciplina['cor'] . ';">
                            <h5 class="mb-0">' . $materia['nome'] . '</h5>
                        </div>
                    </a>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditar-' . $materia['id'] . '"><i class="fas fa-edit mr-2"></i>Editar</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir-' . $materia['id'] . '"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>
            <div id="modalEditar-' . $materia['id'] . '" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar "' . $materia['nome'] . '"</h5>
                    </div>
                    <div class="modal-body">
                        <form id="formEditar-' . $materia['id'] . '" action="" method="POST">
                            <input type="text" id="tarefa" name="tarefa" value="editar" hidden>
                            <input type="text" id="id" name="id" value="' . $materia['id'] . '" hidden>
                            <div class="form-row">
                                <div class="form-group col-md-10">
                                    <label for="nome">Nome</label>
                                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Digite o nome desejado" value="' . $materia['nome'] . '" required>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="posicao">Posição</label>
                                    <input type="text" id="posicao" name="posicao" class="form-control" value="' . $materia['posicao'] .  '" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="slug">Slug</label>
                                    <input type="text" id="slug" name="slug" class="form-control" value="' . $materia['slug'] . '" required>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" form="formEditar-' . $materia['id'] . '">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="modalExcluir-' . $materia['id'] . '" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Excluir "' . $materia['nome'] . '"</h5>
                    </div>
                    <div class="modal-body">
                        <form id="formExcluir-' . $materia['id'] . '" action="" method="POST">
                            <input type="text" id="tarefa" name="tarefa" value="excluir" hidden>
                            <input type="text" id="id" name="id" value="' . $materia['id'] . '" hidden>
                        </form>
                        Você realmente deseja excluir a disciplina "' . $materia['nome'] . '"?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" form="formExcluir-' . $materia['id'] . '">Sim</button>
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
                    <h5 class="modal-title">Adicionar matéria</h5>
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
                            <div class="form-group col-md-12">
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
<?php } else{ ?>
        <nav class="navbar navbar-expand-md bg-light navbar-light shadow-sm">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/conteudo/"><i class="fas fa-home mr-2"></i>Disciplinas</a></li>
                    <?php
                    $disciplina = $_GET['disciplina'];
                    $disciplina = mysqli_query($conexao, "SELECT * FROM disciplina WHERE slug = '$disciplina'");
                    $disciplina = mysqli_fetch_assoc($disciplina);

                    $materia = $_GET['materia'];
                    $materia = mysqli_query($conexao, "SELECT * FROM materia WHERE slug = '$materia'");
                    $materia = mysqli_fetch_assoc($materia);
                    ?>
                    <li class="breadcrumb-item"><a href="/admin/conteudo/<?php echo $disciplina['slug']; ?>"><?php echo $disciplina['nome']; ?></a></li>
                    <li class="breadcrumb-item active"><?php echo $materia['nome']; ?></li>
                </ol>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionar">Adicionar assunto</button>
            </div>
        </nav>
    </div>
<?php } ?>