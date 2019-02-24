        <nav class="navbar navbar-expand-md bg-light navbar-light shadow-sm">
            <div class="container">
                <form class="form-inline" action="" method="POST">
                    <label for="tipo">Tipo:</label>
                    <select name="tipo" id="tipo" class="form-control ml-2 mr-3" required>
                        <option disabled value>Selecione o tipo</option>
                        <option>Acadêmico</option>
                        <option>Postagem</option>
                        <option>Notícia</option>
                    </select>
                    <label for="diretorio">Disciplina</label>
                    <select name="diretorio" id="diretorio" class="form-control mx-2" onchange="this.form.submit()" required>
                        <option disabled value>Selecione a disciplina</option>
                    </select>
                </form>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adicionarMidia">Adicionar mídia</button>
            </div>
        </nav>
    </div>
    <div class="container my-4">
    </div>