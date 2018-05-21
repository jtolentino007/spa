<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title><?=$title;?> - Spa Management System</title>
		<link rel="stylesheet" href="./assets/frontend-assets/pace/pace.min.css">
		<script src="./assets/frontend-assets/pace/pace.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="./assets/frontend-assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="./assets/frontend-assets/css/fa-svg-with-js.css">
		<link rel="stylesheet" href="./assets/frontend-assets/DataTables/datatables.min.css">
		<link rel="stylesheet" href="./assets/frontend-assets/toastr/toastr.min.css">
		<link rel="stylesheet" href="./assets/frontend-assets/select2-develop/dist/css/select2.min.css">
		<link rel="stylesheet" href="./assets/frontend-assets/sidebar-responsive/css/reset.css">
		<link rel="stylesheet" href="./assets/frontend-assets/sidebar-responsive/css/style.css">
		<link rel="stylesheet" href="./assets/frontend-assets/css/app.css">
		<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
		<script src="./assets/frontend-assets/jquery/jquery.min.js" type="text/javascript"></script>
		<script src="./assets/frontend-assets/DataTables/datatables.min.js" type="text/javascript"></script>
		<script src="./assets/frontend-assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>
		<script src="./assets/frontend-assets/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="./assets/frontend-assets/js/fa-brands.min.js" type="text/javascript"></script>
		<script src="./assets/frontend-assets/js/fa-regular.min.js" type="text/javascript"></script>
		<script src="./assets/frontend-assets/js/fa-solid.min.js" type="text/javascript"></script>
		<script src="./assets/frontend-assets/js/fa-v4-shims.min.js" type="text/javascript"></script>
		<script src="./assets/frontend-assets/js/fontawesome.min.js" type="text/javascript"></script>
		<script src="./assets/frontend-assets/js/fontawesome-all.min.js" type="text/javascript"></script>
		<script src="./assets/frontend-assets/toastr/toastr.min.js" type="text/javascript"></script>
		<script src="./assets/frontend-assets/sidebar-responsive/js/main.js" type="text/javascript"></script>
		<script src="./assets/frontend-assets/sidebar-responsive/js/modernizr.js" type="text/javascript"></script>
		<script src="./assets/frontend-assets/select2-develop/dist/js/select2.full.min.js" type="text/javascript"></script>
	</head>
	<body>
		<header class="cd-main-header">
			<a href="#" class="cd-logo"><img src="./assets/img/logo.png" alt="Logo"></a>

			<a href="#0" class="cd-nav-trigger">Menu<span></span></a>

			<nav class="cd-nav">
				<ul class="cd-top-nav">
					<li class="has-children account">
						<a href="#0">
							<?php echo $this->ion_auth->user()->row()->first_name.' '.$this->ion_auth->user()->row()->last_name; ?>
						</a>
						<ul>
							<li><a href="my_account">My Account</a></li>
							<li><a href="auth/logout">Logout</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</header> <!-- .cd-main-header -->

		<main class="cd-main-content">
			<nav class="cd-side-nav">
				<ul>
					<li class="cd-label">Main</li>
					<li>
						<a href="dashboard"><i class="fa fa-dashboard"></i>&nbsp;&nbsp;Dashboard</a>
					</li>
					<li>
						<a href="#0"><i class="fa fa-calculator"></i>&nbsp;&nbsp;&nbsp;Point of Sales</a>
					</li>
				</ul>

				<ul>
					<li class="cd-label">References</li>
					<li>
						<a href="clients"><i class="fa fa-users"></i>&nbsp;&nbsp;Clients</a>
					</li>
					<li>
						<a href="staffs"><i class="fa fa-user"></i>&nbsp;&nbsp;Staffs</a>
					</li>
					<li>
						<a href="sections"><i class="fa fa-box"></i>&nbsp;&nbsp;Sections</a>
					</li>
					<li>
						<a href="categories"><i class="fa fa-book"></i>&nbsp;&nbsp;Categories</a>
					</li>
					<li>
						<a href="equipments"><i class="fa fa-cube"></i>&nbsp;&nbsp;Equipments</a>
					</li>
					<li>
						<a href="services"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Services</a>
					</li>
				</ul>
				<ul>
					<li class="cd-label">Utilities</li>
					<li>
						<a href="user_accounts"><i class="fa fa-users"></i>&nbsp;User Accounts</a>
					</li>
					<li>
		        <a href="settings"><i class="fa fa-cog"></i>&nbsp;Settings</a>
		      </li>
				</ul>
			</nav>

			<div style="padding-top:65px; padding-left: 200px;">
				<?=$RenderBody;?>
				<h1 class="footer-title" style="margin: 10px 0 0 10px;">POWERED BY <strong>APPLICATION INTEGRATOR MANAGED SERVICES</strong></h1>
			</div> <!-- .content-wrapper -->
		</main> <!-- .cd-main-content -->
	</body>
</html>
