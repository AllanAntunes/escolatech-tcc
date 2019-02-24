        <nav class="navbar navbar-expand-md bg-light navbar-light shadow-sm">
            <div class="container">
                <strong class="mr-auto">Editar novo assunto
                </strong>
                <button type="submit" class="btn btn-primary ml-5" form="editor">Publicar</button>
            </div>
        </nav>
    </div>
    <div class="container my-4">
        <div class="row">
            <div class="col-md-12">
                <form id="editor" action="/admin/?slug=editar" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="disciplina">Disciplina:</label>
                            <select name="disciplina" id="disciplina" class="form-control" required>
                                <option disabled value selected>Selecione a disciplina</option>
                                <?php
                                $SQL = mysqli_query($conexao, 'SELECT id, nome FROM disciplina');
                                while($linha = mysqli_fetch_assoc($SQL)){
                                    echo '
                                    <option value="' . $linha['id'] . '">' . $linha['nome'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="materia">Matéria:</label>
                            <select name="materia" id="materia" class="form-control" required>
                                <option disabled value selected>Selecione a matéria</option>
                            </select>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="slug">Slug:</label>
                            <input type="text" name="slug" id="slug" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="titulo">Título:</label>
                            <input type="text" name="titulo" id="titulo" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="midiaDestaque">Mídia destaque:</label>
                            <div class="input-group">
                                <input type="text" name="midiaDestaque" id="midiaDestaque" class="form-control" value="Selecionar arquivo" readonly>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#midia">Procurar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <textarea name="conteudo" id="conteudo" class="form-control" style="height:500px;" required></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <h5 class="mb-3">SEO</h4>
                            <div class="form-group">
                                <label for="tituloSEO">Título:</label>
                                <input type="text" name="tituloSEO" id="tituloSEO" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="descricao">Descrição:</label>
                                <textarea type="text" name="descricao" id="descricao" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="keywords">Palavras-chave:</label>
                                <input type="text" name="keywords" id="keywords" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-3">Avançado</h4>
                            <div class="form-group">
                                <label for="head">Head:</label>
                                <textarea type="text" name="head" id="head" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="finalBody">Final do body:</label>
                                <textarea type="text" name="finalBody" id="finalBody" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>