<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title><?=$title;?> - Spa Management System</title>
		<link rel="stylesheet" href="./assets/frontend-assets/pace/pace.min.css">
		<script src="./assets/frontend-assets/pace/pace.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="./assets/frontend-assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="./assets/frontend-assets/css/fa-svg-with-js.css">
		<link rel="stylesheet" href="./assets/frontend-assets/css/app.css">
		<link rel="stylesheet" href="./assets/frontend-assets/DataTables/datatables.min.css">
		<link rel="stylesheet" href="./assets/frontend-assets/toastr/toastr.min.css">
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
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		  <a class="navbar-brand" href="#"><i class="fa fa-hand-spock"></i> SPA MANAGEMENT SYSTEM</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarColor02">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item">
		        <a class="nav-link" href="dashboard">Dashboard</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="clients">Clients</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="staffs">Staffs</a>
		      </li>
					<li class="nav-item">
		        <a class="nav-link" href="beds">Beds</a>
		      </li>
					<li class="nav-item">
		        <a class="nav-link" href="services">Services</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="settings">Settings</a>
		      </li>
					<li class="nav-item">
		        <a class="nav-link" href="auth/logout">Logout</a>
		      </li>
		    </ul>
		  </div>
		</nav>
		<div class="row">
			<div class="container-fluid" style="padding: 20px;">
				<?=$RenderBody;?>
			</div>
		</div>
	</body>
</html>
