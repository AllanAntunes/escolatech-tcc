    <?php
    if($slug != 'pagina-inicial' && $slug != 'login') {
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container">
            <a href="/" class="navbar-brand" style="color: #1166DD;">
                <i class="fas fa-terminal mr-1"></i><b>Escola</b>Tech
            </a>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a href="/cursos/" class="nav-link"><i class="fas fa-bars mr-2"></i>Cursos</a></li>
            </ul>
            <?php if($_SESSION) { ?>
            <div class="dropdown">
                <button type="button" id="dropdownUsuarioLogado" data-toggle="dropdown">
                    <strong class="mr-1" style="font-weight: normal;"><?php echo $_SESSION['nomeReduzido']; ?></strong>
                    <img src="<?php echo $_SESSION['URLFotoPerfil']; ?>" class="shadow-sm" id="fotoPerfil" style="width: 40px; height: 40px; border-radius: 100%;">
                    <i class="fas fa-caret-down ml-1"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/<?php echo $_GET['diretorio']; ?>/gerenciar-conta/"><i class="fas fa-user-cog mr-2"></i>Gerenciar conta</a>
                    <div class="dropdown-divider"></div>
                    <button type="button" class="dropdown-item text-danger" onclick="deslogar();"><i class="fas fa-sign-out-alt mr-2"></i>Sair</button>
                </div>
            </div>
            <?php } else { ?>
            <a href="/login/" class="btn btn-outline-primary mr-2">Login</a>
            <a href="/planos/" class="btn btn-primary">Matricule-se</a>
            <?php } ?>
        </div>
    </nav>
    <?php
    }
    if($slug == 'pagina-inicial') {
    ?>
    <div class="principal shadow">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a href="/" class="navbar-brand text-white">
                    <i class="fas fa-terminal mr-1"></i><b>Escola</b>Tech
                </a>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a href="/cursos/" class="nav-link text-white"><i class="fas fa-bars mr-2"></i>Cursos</a></li>
                </ul>
                <?php if($_SESSION) { ?>
                <div class="dropdown">
                    <button type="button" class="text-white" id="dropdownUsuarioLogado" data-toggle="dropdown">
                        <strong class="mr-1" style="font-weight: normal;"><?php echo $_SESSION['nomeReduzido']; ?></strong>
                        <img src="<?php echo $_SESSION['URLFotoPerfil']; ?>" class="shadow-sm" id="fotoPerfil" style="width: 40px; height: 40px; border-radius: 100%;">
                        <i class="fas fa-caret-down ml-1"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/<?php echo $_GET['diretorio']; ?>/gerenciar-conta/"><i class="fas fa-user-cog mr-2"></i>Gerenciar conta</a>
                        <div class="dropdown-divider"></div>
                        <button type="button" class="dropdown-item text-danger" onclick="deslogar();"><i class="fas fa-sign-out-alt mr-2"></i>Sair</button>
                    </div>
                </div>
                <?php } else { ?>
                <a href="/login/" class="btn btn-outline-white mr-2">Login</a>
                <a href="/planos/" class="btn btn-white">Matricule-se</a>
                <?php } ?>
            </div>
        </nav>
    <?php
    }
    include (file_exists('aberto/html/' . $slug . '.html')) ? 'aberto/html/' . $slug . '.html' : '404.html';
    if($slug != 'login') {
    ?>
        <button type="button" id="botaoToggleChat"><i class="fas fa-comments"></i></button>
        <div id="chat">
            <div id="barraSuperiorChat">
                <img src="/assets/midia/parte-do-logotipo-com-fundo-branco.png">
                <strong>Assistente virtual</strong>
            </div>
            <div id="areaChat"></div>
            <form class="form-inline" id="formEscreverMensagem" action="" method="GET">
                <input type="text" class="form-control" id="inputEscreverMensagem" placeholder="Digite a mensagem..." autocomplete="off">
                <button type="submit" class="btn" id="botaoEnviarInputEscreverMensagem"><i class="fas fa-paper-plane"></i></button>
            </form>
        </div>
    <?php
    }