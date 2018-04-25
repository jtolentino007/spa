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
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		  <a class="navbar-brand" href="#"><i class="fa fa-hand-spock"></i> SPA MANAGEMENT SYSTEM</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarColor02">
				<ul class="nav navbar-nav mr-auto"></ul>
		    <ul class="navbar-nav mr-right">
		      <li class="nav-item">
		        <a class="nav-link text-center" href="dashboard"><i class="fa fa-dashboard"></i><br>DASHBOARD</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link text-center" href="clients"><i class="fa fa-users"></i><br>CLIENTS</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link text-center" href="staffs"><i class="fa fa-user"></i><br>STAFFS</a>
		      </li>
					<li class="nav-item">
		        <a class="nav-link text-center" href="sections"><i class="fa fa-box"></i><br>SECTIONS</a>
		      </li>
					<li class="nav-item">
		        <a class="nav-link text-center" href="beds"><i class="fa fa-bed"></i><br>BEDS</a>
		      </li>
					<li class="nav-item">
		        <a class="nav-link text-center" href="services"><i class="fa fa-cogs"></i><br>SERVICES</a>
		      </li>
					<li class="nav-item">
		        <a class="nav-link text-center" href="transaction"><i class="fa fa-th-large"></i><br>TRANSACTION</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link text-center" href="settings"><i class="fa fa-cog"></i><br>SETTINGS</a>
		      </li>
					<li class="nav-item">
		        <a class="nav-link text-center" href="auth/logout"><i class="fa fa-dashboard"></i><br>LOGOUT</a>
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
