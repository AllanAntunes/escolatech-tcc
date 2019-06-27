	<?php
	if($_GET['diretorio'] == 'admin') {
		$dataBackgroundColor['logo-header'] = 'dark2';
		$dataBackgroundColor['navbar-header'] = 'dark';
	} else {
		$dataBackgroundColor['logo-header'] = 'blue';
		$dataBackgroundColor['navbar-header'] = 'blue2';
	}
	?>
	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header" data-background-color="<?php echo $dataBackgroundColor['logo-header']; ?>">
				<a href="/<?php echo $_GET['diretorio']; ?>/" class="logo navbar-brand text-white">
					<i class="fas fa-terminal mr-1"></i><b>Escola</b>Tech
				</a>
				<button class="navbar-toggler sidenav-toggler" type="button" data-toggle="collapse" data-target="collapse">
					<span class="navbar-toggler-icon">
						<i class="fas fa-bars"></i>
					</span>
				</button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="fas fa-bars"></i>
					</button>
				</div>
				<div class="dropdown d-lg-none">
					<button type="button" class="text-white" id="dropdownUsuarioLogado" data-toggle="dropdown">
						<img src="<?php echo $usuario['fotoPerfil']; ?>" class="shadow-sm" id="fotoPerfil" style="width: 40px; height: 40px; border-radius: 100%;">
					</button>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="/<?php echo $_GET['diretorio']; ?>/gerenciar-conta/"><i class="fas fa-user-cog mr-2"></i>Gerenciar conta</a>
						<div class="dropdown-divider"></div>
						<button type="button" class="dropdown-item text-danger" onclick="deslogar();"><i class="fas fa-sign-out-alt mr-2"></i>Sair</button>
					</div>
				</div>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="<?php echo $dataBackgroundColor['navbar-header']; ?>">
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
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
						</li>
					</ul>
				</div>
			</nav>
		</div>
		<div class="sidebar sidebar-style-1">
			<div class="sidebar-wrapper">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="<?php echo $_SESSION['URLFotoPerfil']; ?>" class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample">
								<span>
									<?php echo $_SESSION['nomeReduzido']; ?>
									<span class="user-level">Administrador</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>
							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="#"><span class="link-collapse">Meu perfil</span></a>
									</li>
									<li>
										<a href="#"><span class="link-collapse">Editar perfil</span></a>
									</li>
									<li>
										<a href="#"><span class="link-collapse">Configurações da conta</span></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<form class="nav-search d-lg-none">
						<div class="input-group">
							<div class="input-group-prepend">
								<button type="submit" class="btn btn-search pr-1">
									<i class="fa fa-search search-icon"></i>
								</button>
							</div>
							<input type="text" placeholder="Pesquise por..." class="form-control">
						</div>
					</form>
					<?php if($_GET['diretorio'] == 'admin') { ?>
					<ul class="nav nav-primary">
						<li class="nav-item <?php if($slug == 'cursos') { echo 'active'; } ?>">
							<a href="/<?php echo $_GET['diretorio']; ?>/">
								<i class="fas fa-list"></i>
								<p>Cursos</p>
							</a>
						</li>
						<li class="nav-item <?php if($slug == 'midias') { echo 'active'; } ?>">
							<a href="/<?php echo $_GET['diretorio']; ?>/midias/">
								<i class="fas fa-images"></i>
								<p>Mídias</p>
							</a>
						</li>
						<li class="nav-item <?php if($slug == 'usuarios') { echo 'active'; } ?>">
							<a href="/<?php echo $_GET['diretorio']; ?>/usuarios/">
								<i class="fas fa-users"></i>
								<p>Usuários</p>
							</a>
						</li>
					</ul>
					<?php } else { ?>
					<ul class="nav nav-primary">
						<li class="nav-item <?php if($slug == 'cursos') { echo 'active'; } ?>">
							<a href="/<?php echo $_GET['diretorio']; ?>/">
								<i class="fas fa-list"></i>
								<p>Cursos</p>
							</a>
						</li>
						<li class="nav-item <?php if($slug == 'certificados') { echo 'active'; } ?>">
							<a href="/<?php echo $_GET['diretorio']; ?>/certificados/">
								<i class="fas fa-file-alt"></i>
								<p>Certificados</p>
							</a>
						</li>
					</ul>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="main-panel">
			<?php include (file_exists('logado/' . $_GET['diretorio'] . '/html/' . $slug . '.html')) ? 'logado/' . $_GET['diretorio'] . '/html/' . $slug . '.html' : '404.html'; ?>
		</div>
    </div>