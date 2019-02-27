<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/solid.min.css">
    <link rel="stylesheet" href="/css/brands.min.css">
    <link rel="stylesheet" href="/css/fontawesome.min.css">
    <?php include('admin/configuracoes.php'); ?>
    <title>EscolaEnem</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
        <div class="container">
            <button class="navbar-toggler border-0 mr-auto" type="button" data-toggle="collapse" data-target="#menu">
                <i class="fas fa-bars"></i>
            </button>
            <a href="/" class="navbar-brand mr-md-3 text-primary">
                <i class="fas fa-book"></i>
                <b>Escola</b>Enem
            </a>
            <button class="navbar-toggler border-0 ml-auto" type="button" data-toggle="collapse" data-target="#pesquisar">
                <i class="fas fa-search"></i>
            </button>
            <button class="navbar-toggler border-0 ml-2" type="button" data-toggle="collapse" data-target="#area-de-logon">
                <i class="fas fa-user-circle"></i>
            </button>
            <div class="collapse navbar-collapse mr-auto" id="menu">
            <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" role="button" data-toggle="dropdown"><i class="fas fa-bars mr-2"></i>Disciplinas</a>
                        <div class="dropdown-menu">
                            <a href="/matematica" class="dropdown-item">Matemática</a>
                            <div class="dropdown-divider"></div>
                            <a href="/quimica" class="dropdown-item">Química</a>
                            <a href="/fisica" class="dropdown-item">Física</a>
                            <a href="/biologia" class="dropdown-item">Biologia</a>
                            <div class="dropdown-divider"></div>
                            <a href="/portugues" class="dropdown-item">Português</a>
                            <a href="/literatura" class="dropdown-item">Literatura</a>
                            <a href="/espanhol" class="dropdown-item">Espanhol</a>
                            <a href="/ingles" class="dropdown-item">Inglês</a>
                            <div class="dropdown-divider"></div>
                            <a href="/historia" class="dropdown-item">História</a>
                            <a href="/geografia" class="dropdown-item">Geografia</a>
                            <a href="/atualidades" class="dropdown-item">Atualidades</a>
                            <div class="dropdown-divider"></div>
                            <a href="/redacao" class="dropdown-item">Redação</a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse mr-auto" id="pesquisar">
                <form class="form-inline mx-auto">
                    <input type="text" id="input-pesquisar" class="form-control menu-input-pesquisa bg-light" placeholder="Estude um assunto...">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="collapse navbar-collapse" id="area-de-logon">
                <button type="button" class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#login">Login</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastre-se">Cadastre-se</button>
            </div>
        </div>
    </nav>
    <?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $SQL = mysqli_query($conexao, "SELECT conteudo FROM conteudo WHERE id = '$id'");
        if(mysqli_num_rows($SQL) >= 1){
            $linha = mysqli_fetch_assoc($SQL);
            echo $linha['conteudo'];
        } else{
            include('404.php');
        }
    } elseif(isset($_GET['disciplina'])){
        $disciplina = $_GET['disciplina'];
        $SQL = mysqli_query($conexao, "SELECT nome FROM disciplina WHERE nome = '$disciplina'");
        if(mysqli_num_rows($SQL) >= 1){
            include('paginacao.php');
        }
    } else{ ?>
    <div class="jumbotron jumbotron-fluid text-white shadow-sm mb-4 jumbotron-principal-fundo">
        <div class="container">
            <h2>O EscolaEnem descomplica a sua vida de estudante!</h2>
            <p class="lead mb-5">Comece grátis</p>
            <button type="button" class="btn btn-light mr-2" data-toggle="modal" data-target="#cadastre-se"><b>Cadastre-se agora</b></button>
            ou
            <a href="#input-pesquisar" class="btn btn-light ml-2">Estude um assunto<i class="fas fa-search ml-2"></i></a>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php
            $posicao = mysqli_query($conexao, 'SELECT posicao FROM disciplina');
            $i = 0;
            while($linha = mysqli_fetch_assoc($posicao)){
                $i++;
                $SQL = mysqli_query($conexao, 'SELECT * FROM disciplina WHERE posicao = ' . $i);
                $linhaSQL = mysqli_fetch_assoc($SQL);
                    echo '
            <div class="col-sm-6 col-md-3 text-center">
                <a href="/' . $linhaSQL['slug'] . '/">
                    <div class="bg-gradient-' . $linhaSQL['slug'] . ' text-white shadow-sm p-4 mb-3 rounded">
                        <i class="' . $linhaSQL['icone'] . ' fa-3x pb-3"></i>
                        <h5 class="m-0">' . $linhaSQL['nome'] . '</h5>
                    </div>
                </a>
            </div>';
            }
            ?>
        </div>
    </div>
    <div class="jumbotron jumbotron-fluid text-white text-right shadow-sm jumbotron-secundario-fundo">
        <div class="container">
            A
        </div>
    </div>
    <div class="modal fade" id="login" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="login">Login</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="/login.php" method="POST">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="senha" class="form-control" placeholder="Senha" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                    <a href="#recuperarSenha" class="btn btn-outline-primary">Esqueci a senha</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="cadastre-se" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cadastre-se">Cadastre-se</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="/cadastro.php" method="POST">
                        <div class="form-group">
                            <input type="text" name="nomeCompleto" class="form-control" placeholder="Nome completo" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="senha" class="form-control" placeholder="Senha" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="confirmarSenha" class="form-control" placeholder="Confirmar a senha" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Criar usuário</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="modal fade" id="login" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="login">Login</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="/login.php" method="POST">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="senha" class="form-control" placeholder="Senha" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                    <a href="#recuperarSenha" class="btn btn-outline-primary">Esqueci a senha</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="cadastre-se" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cadastre-se">Cadastre-se</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="/cadastro.php" method="POST">
                        <div class="form-group">
                            <input type="text" name="nomeCompleto" class="form-control" placeholder="Nome completo" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="senha" class="form-control" placeholder="Senha" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="confirmarSenha" class="form-control" placeholder="Confirmar a senha" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Criar usuário</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>