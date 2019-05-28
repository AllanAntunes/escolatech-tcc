<?php
session_start();
if(!isset($_SESSION['email'], $_SESSION['senha'], $_SESSION['tipo']) || $_SESSION['tipo'] == 1) {
    header('Location: https://escolatech.net/');
} else { ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="/global/assets/css/bootstrap.css">
	<link rel="stylesheet" href="/admin/assets/css/atlantis.min.css">
    <link rel="stylesheet" href="/global/assets/css/solid.min.css">
    <link rel="stylesheet" href="/global/assets/css/brands.min.css">
	<link rel="stylesheet" href="/global/assets/css/fontawesome.min.css">
	<?php
	if(isset($_GET['slug']) && file_exists($_GET['slug'] . '.html')) {
		echo '<link rel="stylesheet" href="/admin/assets/css/' . $_GET['slug'] . '.css"';
	}
	?>
    <link rel="stylesheet" href="/global/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet">
    <title>EscolaTech</title>
</head>
<body>
    <div class="wrapper">
		<div class="main-header">
			<div class="logo-header" data-background-color="blue">
				<a href="/admin/" class="navbar-brand text-white">
					<i class="fas fa-terminal mr-1"></i><b>Escola</b>Tech
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse">
					<span class="navbar-toggler-icon">
						<i class="fas fa-bars"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="fas fa-bars"></i>
					</button>
				</div>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
				<div class="container-fluid">
					<div class="collapse" id="search-nav">
						<form class="navbar-left navbar-form nav-search mr-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search pr-1">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								<input type="text" placeholder="Pesquise por..." class="form-control">
							</div>
						</form>
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button">
								<i class="fa fa-search"></i>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link" data-toggle="dropdown" href="#">
								<i class="fas fa-plus"></i>
							</a>
							<div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
								<div class="quick-actions-header">
									<span class="title mb-1">Quick Actions</span>
									<span class="subtitle op-8">Shortcuts</span>
								</div>
								<div class="quick-actions-scroll scrollbar-outer">
									<div class="quick-actions-items">
										<div class="row m-0">
											<a class="col-6 col-md-4 p-0" href="#">
												<div class="quick-actions-item">
													<i class="fas fa-file"></i>
													<span class="text">Generated Report</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="#">
												<div class="quick-actions-item">
													<i class="fas fa-database"></i>
													<span class="text">Criar novo banco de dados</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="#">
												<div class="quick-actions-item">
													<i class="fas fa-pen"></i>
													<span class="text">Criar nova postagem</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="#">
												<div class="quick-actions-item">
													<i class="fas fa-pen-alt"></i>
													<span class="text">Create New Task</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="#">
												<div class="quick-actions-item">
													<i class="fas fa-list"></i>
													<span class="text">Completed Tasks</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="#">
												<div class="quick-actions-item">
													<i class="fas fa-file-alt"></i>
													<span class="text">Create New Invoice</span>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown">
								<i class="fa fa-bell"></i>
								<span class="notification">4</span>
							</a>
							<ul class="dropdown-menu notif-box animated fadeIn">
								<li>
									<div class="dropdown-title">Você tem 4 novas notificações</div>
								</li>
								<li>
									<div class="notif-scroll scrollbar-outer">
										<div class="notif-center">
											<a href="#">
												<div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
												<div class="notif-content">
													<span class="block">
														New user registered
													</span>
													<span class="time">5 minutes ago</span>
												</div>
											</a>
											<a href="#">
												<div class="notif-icon notif-success"> <i class="fa fa-comment"></i> </div>
												<div class="notif-content">
													<span class="block">
														Rahmad commented on Admin
													</span>
													<span class="time">12 minutes ago</span>
												</div>
											</a>
											<a href="#">
												<div class="notif-img">
													<img src="/admin/assets/midia/profile.jpg" alt="Img Profile">
												</div>
												<div class="notif-content">
													<span class="block">
														Reza send messages to you
													</span>
													<span class="time">12 minutes ago</span>
												</div>
											</a>
											<a href="#">
												<div class="notif-icon notif-danger"> <i class="fa fa-heart"></i> </div>
												<div class="notif-content">
													<span class="block">
														Farrah liked Admin
													</span>
													<span class="time">17 minutes ago</span>
												</div>
											</a>
										</div>
									</div>
								</li>
								<li>
									<a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i> </a>
								</li>
							</ul>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
								<div class="avatar-sm">
									<img src="/admin/assets/midia/profile.jpg" class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="/admin/assets/midia/profile.jpg" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4>Hizrian</h4>
												<p class="text-muted">allan.antunes@escolatech</p><a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Meu perfil</a>
										<a class="dropdown-item" href="#">My Balance</a>
										<a class="dropdown-item" href="#">Inbox</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Configurações da conta</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Sair</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</div>
		<div class="sidebar sidebar-style-2">
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="/admin/assets/midia/profile.jpg" class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample">
								<span>
									Allan Antunes
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
					<ul class="nav nav-primary">
						<li class="nav-item <?php if(!isset($_GET['slug'])) { echo 'active'; } ?>">
							<a href="/admin/">
								<i class="fas fa-layer-group"></i>
								<p>Painel de controle</p>
							</a>
						</li>
						<li class="nav-item <?php if(isset($_GET['slug']) && $_GET['slug'] == 'cursos') { echo 'active'; } ?>">
							<a href="/admin/cursos/">
								<i class="fas fa-list"></i>
								<p>Cursos</p>
							</a>
						</li>
						<li class="nav-item <?php if(isset($_GET['slug']) && $_GET['slug'] == 'midias') { echo 'active'; } ?>">
							<a href="/admin/midias/">
								<i class="fas fa-images"></i>
								<p>Mídias</p>
							</a>
						</li>
						<li class="nav-item <?php if(isset($_GET['slug']) && $_GET['slug'] == 'usuarios') { echo 'active'; } ?>">
							<a href="/admin/usuarios/">
								<i class="fas fa-users"></i>
								<p>Usuários</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
        <?php
    if(isset($_GET['slug'])) {
        if(file_exists($_GET['slug'] . '.html')) {
			include $_GET['slug'] . '.html';
        } else {
            include '../global/404.html';
        }
    } else {
        include 'dashboard.html';
    }
}
        ?>
    </div>
	<script src="/global/assets/js/jquery-3.4.0.min.js"></script>
	<script src="/global/assets/js/popper.min.js"></script>
	<script src="/global/assets/js/bootstrap.min.js"></script>
	<script src="/admin/assets/js/atlantis.min.js"></script>
	<?php
	if(isset($_GET['slug']) && file_exists($_GET['slug'] . '.html')) {
		echo '<script src="/admin/assets/js/' . $_GET['slug'] . '.js"></script>';
	}
	?>
</body>
</html>